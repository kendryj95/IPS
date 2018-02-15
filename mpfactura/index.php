<?php 
require 'FPDF/fpdf.php';
include 'db.php';
include_once("funfech.php");


$fact=$_POST["fact"];
$data=$_POST["data"];

$moneda='';
$factura= json_decode($fact,true);
$datos=json_decode($data,true);
//datos a insertar
$idp=$datos["id_mp"];
$id_c=$datos["id_collec"];
$estado= $datos["estado"];
$productos=$factura["products"];
$urlreturn=$datos["url_return"];
$client_email=$datos["client"]["email"];
$client_telf=$datos["client"]["telephone"];
//sms contenidos
$sms_sc=$datos["token"]["cliente"]["sc"];
$sms_id=$datos["token"]["cliente"]["id"];
$nombre_tok=$datos["token"]["cliente"]["nombre"];
$index="unde";
//esto es una validacion de porsiacaso.... cuando guardaba por php en base de datos.. ahora esta con node
/*
$sql2= $conexion->query("SELECT id_api_call FROM pagos WHERE id_api_call='$idp'");
$resul= $sql2->fetch();

if ($resul!==false) {
	echo "Error ya el pago esta registrado";
}
else {
foreach ($productos as $pro):
$sql= $conexion->prepare("INSERT INTO pagos (id_pago, id_metodo_pago, fecha_pago, hora_pago, estado_compra, estado_pago, moneda, monto, cantidad,id_compra, id_api_call, id_producto_insignia, sms_id, sms_sc, sms_contenido, redirect_url, consumidor_email, consumidor_telefono) VALUES (DEFAULT, 8, CURDATE(), CURTIME(), :estado_com, :estado_pa, :mone, :mon, :can,:id_com,:idcall, :id_pro, :sms_id, :sms_sc, :sms_con, :url,:email, :telf)");
$sql->execute(array(
	":estado_com"=>"completed",
	":estado_pa"=>$estado,
	":mone"=>$factura["currency"],
	":mon"=>$pro["price"],
	":can"=>$pro["quantity"],
	":id_com"=>$id_c,
	":idcall"=>$idp,
	":id_pro"=>$pro["id"],
	":sms_sc"=>$sms_sc,
	":sms_id"=>$sms_id,
	":sms_con"=>$index."_".$sms_sc."_".$nombre_tok."_".$pro["description"],
	":url"=>$urlreturn,
	":email"=>$client_email,
	":telf"=>$client_telf));
endforeach;
}
*/
if ($factura["currency"]=="VEF") {
	$moneda.="BsF";
}
if ($factura["currency"]=="ARG") {
	$moneda.="$";
}
if ($factura["currency"]=="COP") {
	$moneda.="$";
}
if ($factura["currency"]=="MXN") {
	$moneda.="$";
}
if ($factura["currency"]=="PEN") {
	$moneda.="S/.";
}
if ($factura["currency"]=="CLP") {
	$moneda.="$";
}
if ($factura["currency"]=="BRL") {
	$moneda.="R$";
}

$fecha=fecha(date("y-m-d"));
$hora=hora(date("H:i"));
$fpdf = new FPDF();
$fpdf -> AddPage("P","Letter",0);
$fpdf -> Image('Logo.png',10,7,60);
$fpdf -> Image('mercadopago_logo.png',148,7,60);
$fpdf -> Ln(20);
$fpdf -> SetFont("Arial", "B", 12);
$fpdf -> Cell(200,10,utf8_decode('Lista de productos comprados'), 1, 0, 'C');
$fpdf -> Ln(20);
$fpdf -> SetFont("Arial", "B", 12);
$fpdf -> Cell(30,7,'Pago realizado el '.$fecha.' a las '.$hora, 0, 0, 'L');


$fpdf -> Ln(10);
$fpdf -> Cell(70,7,'Nombre', 1, 0, 'C');
$fpdf -> Cell(60,7,'Categoria', 1, 0, 'C');
$fpdf -> Cell(35,7,utf8_decode('Precio'), 1, 0, 'C');
$fpdf -> Cell(35,7,'Cantidad', 1, 0, 'C');
$fpdf -> SetFont("Arial", "I", 12);
 foreach ($productos as $pro):
	$fpdf -> Ln(7);
$fpdf -> Cell(70,7,$pro["name"], 1, 0, 'C');
$fpdf -> Cell(60,7,$pro["description"], 1, 0, 'C');
$fpdf -> Cell(35,7,$pro["price"].' '.$moneda, 1, 0, 'C');
$fpdf -> Cell(35,7,$pro["quantity"], 1, 0, 'C');
endforeach;
$fpdf -> Ln(10);
$fpdf -> Ln(10);
$fpdf -> SetFont("Arial", "B", 12);
$fpdf -> Cell(30,7,'Monto total:', 0, 0, 'L');
$fpdf -> Cell(10,7,$factura["total"].' '.$moneda, 0, 0, 'L');
$fpdf -> Ln(10);
$fpdf -> Cell(30,7,'Estado de Pago: '.$estado, 0, 0, 'L');
$fpdf -> ln(10);
$fpdf -> Cell(30,7,'Numero de comprobante: #'.$id_c, 0, 0, 'L');





$fpdf -> SetFont("Arial", "B", 10);
$fpdf -> Ln(20);
$fpdf -> Cell(200,10,utf8_decode('www.insignia.com.ve'), 0, 0, 'C');
$fpdf -> SetY(-15);
$fpdf -> SetFont("Times", "B", 24);
$fpdf -> Output("D","Soporte de Pago de Insignia Payments Solutions.pdf");



?>