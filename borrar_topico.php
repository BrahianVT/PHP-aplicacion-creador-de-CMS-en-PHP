<?php include_once("includes/conexion.php"); ?>
<?php include_once("includes/funciones.php"); ?>
<?php 
	if(intval($_GET['topico']) == 0){
		redireccionar("contenido.php");
	}
		
			$id = mysql_prep($_GET['topico']);
		if($topico = get_topico_id($id))
		{
			$query = "DELETE FROM topico WHERE id={$id}";
			$resultado = mysql_query($query,$conexion);
			if(mysqli_affected_rows() == 1){
				redireccionar("contenido.php");
			}	
			else{
				echo "<p> No se pudo realizar el registro</p>";
				echo "<p>".mysql_error()."</p>";
				echo "<a href =\"contenido.php\">Regresar a pagina principal</a>";
			}
		}else{
			redireccionar("contenido.php");
		}
?>

<?php require("includes/footer.php") ?>
