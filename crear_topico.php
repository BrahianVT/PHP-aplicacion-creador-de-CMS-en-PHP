<?php include_once("includes/conexion.php"); ?>
<?php include_once("includes/funciones.php"); ?>
<?php
	//validacion de datos del formulario
	$errores = array();
	//if(!isset($_POST['nombre_menu']) ||empty($_POST['nombre_menu'])){
		//$errores[] = 'nombre_menu';
	//}
	//if(!isset($_POST['posicion']) ||empty($_POST['posicion'])){
	//	$errores[] = 'posicion';
	//}
	//if(!empty($errores)){
	//	redireccionar("nuevo_topico.php");
	//}
	$campos_requeridos = array('nombre_menu' , 'posicion', 'visible');
	foreach($campos_requeridos as $campos){
		if(!isset($_POST[$campos]) || empty($_POST[$campos])){
			$errores[] = $campos; 
		}
	}
	$longitud = array('nombre_menu' => 30);
	foreach($longitud as $campos => $maxLon){
		if(strlen(trim(mysql_prep($_POST[$campos]))) > $maxLon){
			$errores []= $campo;
		}
	}
?>
<?php 
	$nombre_menu = mysql_prep($_POST['nombre_menu']);
	$posicion = mysql_prep($_POST['posicion']);
	$visible = mysql_prep($_POST['visible']);
?>
<?php 
	$query = "INSERT INTO Topico (
				nombre_menu , posicion, visible)
				VALUES ( '{$nombre_menu}' , {$posicion} , {$visible}
				)";
	if($res = mysql_query($query, $conexion)){
		redireccionar("contenido.php");
	}
	else{
		echo "<p> Error al procesar la creacion de un nuevo topico.</p>";
		echo"<p>" .mysql_error() ."</p>";
	}
?>
<?php mysql_close($conexion)?>