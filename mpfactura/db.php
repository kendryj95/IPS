<?php

try{

	$conexion= new PDO("mysql:host=192.168.1.117;dbname=insignia_payments_solutions_mm","moises.marquina","QzSgay2j");
	//echo "Conexion Establecida";


} catch(PDOException $e){
	echo "Error:". $e->getMessage();
	die(); // matar ejecucion de la pagina
}
?>