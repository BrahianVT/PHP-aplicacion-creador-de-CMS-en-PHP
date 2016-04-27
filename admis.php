<!DOCTYPE HTML>
<?php include_once("includes/secion.php"); ?>
<?php include_once("includes/funciones.php"); ?>
<?phpconfirmar_logueo();?>
<?php include("includes/header.php"); ?>
	   <table id = "estructura">
	     <tr>
			<td id = "navegacion">
			    &nbsp;
			</td>
			<td id = "pagina">
			  <h2> Menu de Staff</h2>
			     <p> Bienvenido al area de Staff <?php echo $_SESSION['usuario']; ?></p>
				 <ul>
				    <li><a href = "contenido.php">Administrar contenido</a></li>
					<li><a href = "nuevo_usuario.php">Agregar usuario Staff</a></li>
					<li><a href = "logout.php">Logout</a></li>
				 </ul>
			</td>
		 </tr>
	   </table>
	</div>
	<?php include("includes/footer.php"); ?>