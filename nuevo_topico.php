<?php include_once("includes/conexion.php"); ?>
<?php include_once("includes/funciones.php"); ?>
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
				<h2>Nuevo topico</h2>
				<form action ="crear_topico.php" method ="post">
					<p><input type="text" placeholder="Nombre del topico" name ="nombre_menu" value = "" id = "nombre_menu" required/>*</p>
					<p>Posicion:
								<select name="posicion">
								<?php
									$topico_set = get_todos_topicos();
									$contar_topico = mysql_num_rows($topico_set);
									for($contar = 1; $contar <= $contar_topico+1; $contar++)
									{
										echo "<option value =\"{$contar}\">$contar</option>";
									}
								?>
						           
								</select>   
					</p>
					<p>Visible:
							<input type="radio" name="visible" value ="0"/>NO
							&nbsp;
							<input type="radio" name="visible" value ="1"/>SI
					</p>
					<input type = "submit" value = "Agregar topico"/>
				</form>
			</td>
		 </tr>
	   </table>
	</div>
<?php require("includes/footer.php") ?>
