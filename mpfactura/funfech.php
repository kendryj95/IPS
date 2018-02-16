<?php
function fecha($fecha) { // la fecha tomada de la base de datos ejemplo 2017-05-28 21:53:04, con esta funcion la mejorares a vista del cliente
	$timestamp= strtotime($fecha); // Aqui se guardara la fecha tomada de la base de datos
	$meses= ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

	$dia= date("d",$timestamp); // para obtener el dia
	$mes= date("m",$timestamp) - 1; // para obtener el mes teniendo encuenta que el array arranca desde cero
	$year= date("Y",$timestamp);

	$fecha = "$dia de ". $meses[$mes] ." del ".$year;
	return $fecha;
}
function hora($fecha) {
	$timestamp= strtotime($fecha);
	$hora= date("H",$timestamp)-5;
	$min= date("i",$timestamp);
	$horaa = $hora.":".$min;
	return $horaa;

}
?>