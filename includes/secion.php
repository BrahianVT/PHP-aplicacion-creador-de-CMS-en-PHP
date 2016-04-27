<?php session_start();
	function confirmar_logueo(){
		if(!isset($_SESSION['id'])){
		redireccionar("login.php");
		}
	}
	function logueo_in(){
		return isset($_SESSION['id']);
	}
?>
