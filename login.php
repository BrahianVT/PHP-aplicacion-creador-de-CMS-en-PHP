<?php include_once("includes/secion.php"); ?>
<?php include_once("includes/conexion.php"); ?>
<?php include_once("includes/funciones.php"); ?>
<?php 
	if(isset($_POST['submit'])){
		$errores = array();	//formulario a sido procesado
		$campos_requeridos = array('usuario','contrasena');
		//$errores = array_merge($errores, revisar_campos_requeridos($campos_requeridos,$_POST));
		$campo_con_longitud = array('usuario' =>30 ,'contrasena' => 30);
		//$errores = array_merge($errores, revisar_max_longitud_campo($campos_con_longitud,$_POST));
		
		$usuario = trim(mysql_prep($_POST['usuario']));
		$contrasena = trim(mysql_prep($_POST['contrasena']));
		$hashed_contrasena = sha1($contrasena);
	
	if(empty($errores)){
		$query = "SELECT id, usuario ";
		$query.= "FROM usuarios ";
		$query.= "WHERE usuario = '{$usuario}' ";
		$query.= "AND hashed_contrasena = '{$hashed_contrasena}' ";
		$query.= "LIMIT 1";
		$resultado_set = mysql_query($query);
		//$confirmar_consulta($resultado_set);
		
		if(mysql_num_rows($resultado_set) == 1){
			$usuario_encontrado = mysql_fetch_array($resultado_set);
			$_SESSION['id'] = $usuario_encontrado['id'];
			$_SESSION['usuario'] = $usuario_encontrado['usuario'];
			redireccionar("admis.php");
		}else{
			$mensaje = "El usuario no fue encontrado o los campos";
			$mensaje.= "son incorrectos";
		}
	}else{
		if(count($errores) == 1){
			$mensaje = "Hubo algun error en el formulario.";
		}else{
			$mensaje = "Hubieron ". count($errores). " errores en el formulario";
		}
	}
	}else{
		if(isset($_GET['logout']) && $_GET['logout'] == 1){
			$mensaje = "Usted a cerrado cesion ahora";
		}
		$usuario = "";
		$contrasena = "";
	}
?>

<?php include("includes/header.php"); ?>
<table id = "estructura">
	     <tr>
			<td id = "navegacion">
				<a href = "staff.php">Regresar pagina principal</a><br/>
			</td>
			<td id = "pagina">
				<h2>Iniciar Secion</h2>
				<?php if(!empty($mensaje)){echo "<p class=\"mensaje\">". $mensaje . "</p>";} ?>
				<?php if(!empty($errores)){/* $mostrar_errores($errores);*/ }?>
				<form action = "login.php" method = "post">
				<table>
					<tr>
					  <td>Usuario:</td>
					  <td><input type = "text" name = "usuario"placeholder = "Agregar usuario" maxlength = "30" value = "<?php echo htmlentities($usuario);?>"></td>
					</tr>
					<tr>
					  <td><br><br>Contrasenia:</td>
					   <td><br><br><input type = "password" name = "contrasena"placeholder = "Agrege contrasenia" maxlength = "30" value = "<?php echo htmlentities($contrasena);?>"></td>
					</tr>
					<tr><td></td>
					   <td colspan = "2"><br><br><input name = "submit"type = "submit" value = "Login"/></td>
					</tr>
				</table>
				</form>
			</td>
		 </tr>
	   </table>
<?php require("includes/footer.php"); ?>
