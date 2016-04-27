<?php
	require("constantes.php");
	//crear conexion
	$conexion = mysql_connect(DB_SERVIDOR,DB_USUARIO,DB_PASS);
	if(!$conexion)
		die("hubo un error ala base de datos ". mysql_error());
	
	//seleccionar base
	$db_seleccionada = mysql_select_db(DB_NOMBRE,$conexion);
	if(!$db_seleccionada)
		die("No se pudo seleecionar la base ".mysql_error());
?>