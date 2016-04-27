<?php include_once("includes/funciones.php"); ?>
<?php 
	//1.- buscar la sesion
	session_start();
	//2.- Quitar todas las variables de sesion 
	$_SESSION = array();
	
	//3.- destruir el session cookie
   if(isset($_COOKIE[session_name()])){
		setcookie(session_name(), '', time()-42000, '/');
   }
   //4.- destruir la sesion
	session_destroy();
	redireccionar("login.php?logout=1");
	
?>