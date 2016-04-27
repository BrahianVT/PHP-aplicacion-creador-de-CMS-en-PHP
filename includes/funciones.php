<?php 
//aqui las funciones a utilizar
function mysql_prep($valor){
	$magic_quotes_activo = get_magic_quotes_gpc();
	$nueva_version_php = function_exists( "mysql_real_escape_string");
	if($nueva_version_php){
		if ( $magic_quotes_activo){ $valor = stripcslashes($valor);}
		}else{
			if(!magic_quotes_activo){$valor = addslashes ($valor);}
		}
	return $valor;
}
 function confirmar_consulta($resultados_set){
	if(!$resultados_set)
		die("Hubo un error en la base de datos ". mysql_error());
 }
 function get_todos_topicos(){
	global $conexion;
	$query = "SELECT *FROM Topico ORDER BY posicion ASC"; 			
	$topicos_set = mysql_query($query,$conexion);
	confirmar_consulta($topicos_set);
	return $topicos_set;
 }
 function get_paginas_para_topicos ($topico_id, $publico=true){
 global $conexion;
 $query = "SELECT *FROM paginas ";
 $query .="WHERE topicos_id ={$topico_id} "; 
 if($publico){
	$query .= "AND visible = 1";
 }
 $query .= " ORDER BY posicion ASC";							
 $paginas_set = mysql_query($query,$conexion);
 confirmar_consulta($paginas_set);
	return $paginas_set;
 }
function get_topico_id($topico_id){
	global $conexion;
	$query = "SELECT * ";
	$query .= "FROM topico ";
	$query .= "WHERE id=" . $topico_id . " ";
	$query .= "LIMIT 1";
	$topico_set= mysql_query($query, $conexion);
	confirmar_consulta($topico_set);
	if($topico = mysql_fetch_array($topico_set)){
		return $topico;
	}
	else{
	return NULL;
	}	
}
function get_pagina_id($pagina_id){

	global $conexion;
	$query = "SELECT * ";
	$query .="FROM paginas ";
	$query .="WHERE id=" . $pagina_id . " ";
	$query.=" LIMIT 1";
	$pagina_set = mysql_query($query , $conexion);
	confirmar_consulta($pagina_set);
	if($pagina = mysql_fetch_array($pagina_set)){
		return $pagina;
	}
	else{
		return NULL;
	}
}
function get_pagina_default($topico_id){
	$pagina_set= get_paginas_para_topicos($topico_id , true);
	if($primera_pagina = mysql_fetch_array($pagina_set)){
		return $primera_pagina;
	}else{
		return null;
	}
}
function buscar_pagina_sel(){
	global $sel_topico_id;
	global $sel_pagina_id;
	if(isset($_GET['topico'])){
		$sel_topico_id = get_topico_id($_GET['topico']);
		$sel_pagina_id = get_pagina_default($sel_topico_id['id']);
	}
	elseif(isset($_GET['pagina'])){
		$sel_pagina_id = get_pagina_id($_GET['pagina']);
		$sel_topico_id = NULL;
	}
	else{
		$sel_pagina_id = NULL;
		$sel_topico_id = NULL;
	}
}
function navegacion($sel_topico_id , $sel_pagina_id){
		
		$topicos_set = get_todos_topicos();
					while($topico = mysql_fetch_array($topicos_set)){
							echo "<li";
							if($topico["id"] == $sel_topico_id['id']){
								echo " class=\"selected\"";
							}
							echo "><a href=\" editar_topico.php?topico=".urlencode($topico["id"])." \">{$topico["nombre_menu"]} </a></li>";
							$paginas_set = get_paginas_para_topicos($topico["id"]);
							echo "<ul class = \" paginas \">";
							while($pagina = mysql_fetch_array($paginas_set)){
							
								echo "<li";
								if($pagina["id"] == $sel_pagina_id['id']){
								echo " class=\"selected\"";
								}
								echo "><a href=\" contenido.php?pagina=".urlencode($pagina["id"]). "\">{$pagina["nombre_menu"]}</a></li>";
							}
							echo "</ul>";
					}
}
 function redireccionar($ubicacion = NULL){
	if($ubicacion != null){
		header("Location: {$ubicacion}");
		exit;
	}
 }
 function navegacion_publica ($sel_topico_id, $sel_pagina_id){
	$topicos_set = get_todos_topicos();
					while($topico = mysql_fetch_array($topicos_set)){
							echo "<li";
							if($topico["id"] == $sel_topico_id['id']){
								echo " class=\"selected\"";
							}
							echo "><a href=\" index.php?topico=".urlencode($topico["id"])." \">{$topico["nombre_menu"]} </a></li>";
							if($topico["id"] == $sel_topico_id["id"]){
							$paginas_set = get_paginas_para_topicos($topico["id"]);
							echo "<ul class = \" paginas \">";
							while($pagina = mysql_fetch_array($paginas_set)){
							
								echo "<li";
								if($pagina["id"] == $sel_pagina_id['id']){
								echo " class=\"selected\"";
								}
								echo "><a href=\" index.php?pagina=".urlencode($pagina["id"]). "\">{$pagina["nombre_menu"]}</a></li>";
							}
							echo "</ul>";
							}
					}
					echo "</ul>";
 }
?>