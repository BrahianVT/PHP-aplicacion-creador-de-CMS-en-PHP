<?php include_once("includes/conexion.php"); ?>
<?php include_once("includes/funciones.php"); ?>
<?php 
	if(intval($_GET['topico']) ==0){
		redireccionar("contenido.php");
	}
	if(isset($_POST['submit'])){
		$errores = array();
		$campos_requerios = array('nombre_menu', 'posicion','visible');
		foreach($campos_requerios as $campo){
			if(!isset($_POST[$campo]) || (empty($_POST[$campo]) && ($_POST[$campo] != 0))){
				$errores[] = $campo;
			}
		}
		$lon_campos = array('nombre_menu' => 30);
		foreach($lon_campos as $campo => $maxlen){
			if(strlen(trim(mysql_prep($_POST[$campo]))) > $maxlen){$errores[] = $campo;}
		}
		
		if(empty($errores)){
			$id = mysql_prep($_GET['topico']);
			$nombre_menu = mysql_prep($_POST['nombre_menu']);
			$posicion = mysql_prep($_POST['posicion']);
			$visible = mysql_prep($_POST['visible']);
			$query = "UPDATE topico SET
					  nombre_menu = '{$nombre_menu}',
					  posicion = {$posicion},
					  visible = {$visible}
					   WHERE id={$id}";
			$resultado = mysql_query($query , $conexion);
			if(mysql_affected_rows() == 1){
				$mensaje = "Topico editado exitosamente";
			}
			else{
			   $mensaje = "Topico editado exitosamente";
			   $mensaje .= "<br/>".mysql_error();
			}
		}
		else{
				$mensaje = "Hubieron". count($errores). " en el formulario";
			}
	}

?>
<?php  buscar_pagina_sel();?>
<?php include("includes/header.php"); ?>
	   <table id = "estructura">
	     <tr>
			<td id = "navegacion">
				<ul class = "topicos">
			    <?php navegacion($sel_topico_id , $sel_pagina_id);?>
				</ul>
			</td>
			<td id = "pagina">
				<h2>Editar topico : <?php echo $sel_topico_id['nombre_menu']; ?></h2>
				<?php	if(!empty($mensaje)){
					echo "<p class=\"mensaje\">" . $mensaje."</p>";
				}?>
				<?php
					if(!empty($errores)){
						echo "<p class=\"errores\">";
						echo "Favor de revisar los sig campos";
						foreach($errores as $error){
							echo "-" . $error . "<br/>";
						}
						echo "</p>";
					}
				?>
				<form action ="editar_topico.php?topico=<?php echo urlencode($sel_topico_id['id']); ?>" method ="post">
					<p><input type="text"  name ="nombre_menu" value = "<?php echo $sel_topico_id['nombre_menu'];  ?>" id = "nombre_menu" required/>*</p>
					<p>Posicion:
								<select name="posicion">
								<?php
									$topico_set = get_todos_topicos();
									$contar_topico = mysql_num_rows($topico_set);
									for($contar = 1; $contar <= $contar_topico+1; $contar++)
									{
										echo "<option value =\"{$contar}\"";
										if($sel_topico_id['posicion'] == $contar){
											echo "selected";
										}
										echo ">{$contar}</option>";
									}
								?>
						           
								</select>   
					</p>
					<p>Visible:
							<input type="radio" name="visible" value ="0"
							<?php if($sel_topico_id['visible'] == 0){ echo " checked"; } ?>/>NO
							&nbsp;
							<input type="radio" name="visible" value ="1"
							<?php if($sel_topico_id['visible'] == 1){ echo " checked"; } ?>/>SI
					</p>
					<input type = "submit"name = "submit" value = "Editar topico"/>
					<br><a href ="borrar_topico.php?topico=<?php echo urlencode($sel_topico_id['id']);?>" onclick="return confirm('Desea eliminar?')">Borrar topico</a>
				</form>
				<br>
				<a href = "contenido.php">Cancelar</a>
			</td>
		 </tr>
	   </table>
	</div>
<?php require("includes/footer.php") ?>
