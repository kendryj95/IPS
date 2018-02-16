<?php 
include_once("../../db.php");
include_once("../../funfech.php");
include_once("../../FPDF/fpdf.php");

$data=json_decode($_POST["pro"],true);
$productos=$data["response"]["items"];
$info=json_decode($_POST["pay"],true);

$fecha=fecha(date("y-m-d"));
$hora=hora(date("H:i"));
$fpdf = new FPDF();
$fpdf -> AddPage("P","Letter",0);
$fpdf -> Ln(10);
$fpdf -> Image('../../Logo.png',10,10,60);
$fpdf -> Ln(20);
$fpdf -> SetFont("Arial", "B", 12);
$fpdf -> Cell(200,10,utf8_decode('Información de compra MercadoPago'), 0, 0, 'C');
$fpdf -> Ln(20);
$fpdf -> SetFont("Arial", "B", 10);
$fpdf -> Cell(30,7,'Reporte generado el '.$fecha.' a las '.$hora, 0, 0, 'L');

$fpdf -> SetFont("Arial", "B", 13);
$fpdf -> Ln(10);
$fpdf -> Cell(30,7,'1) Datos del Comprador', 0, 0, 'L');
$fpdf -> Ln(10);
$fpdf -> SetFont("Arial", "B", 10);
$fpdf -> Cell(20,7,'ID', 1, 0, 'C');
$fpdf -> Cell(30,7,utf8_decode('Identificación'), 1, 0, 'C');
$fpdf -> Cell(28,7,'Nombre', 1, 0, 'C');
$fpdf -> Cell(30,7,'Apellido', 1, 0, 'C');
$fpdf -> Cell(60,7,'Correo', 1, 0, 'C');
$fpdf -> Cell(27,7,'Telefono', 1, 0, 'C');

$fpdf -> SetFont("Arial", "I", 9);
 
$fpdf -> Ln(7);
$fpdf -> Cell(20,7,$info["response"]["collection"]["payer"]["id"], 1, 0, 'C');
$fpdf -> Cell(30,7,$info["response"]["collection"]["payer"]["identification"]["type"].' '.$info["response"]["collection"]["payer"]["identification"]["number"], 1, 0, 'C');
$fpdf -> Cell(28,7,$info["response"]["collection"]["payer"]["first_name"], 1, 0, 'C');
$fpdf -> Cell(30,7,$info["response"]["collection"]["payer"]["last_name"], 1, 0, 'C');
$fpdf -> Cell(60,7,$info["response"]["collection"]["payer"]["email"], 1, 0, 'C');
$fpdf -> Cell(27,7,$info["response"]["collection"]["payer"]["phone"]["number"], 1, 0, 'C');

$fpdf -> Ln(10);
$fpdf -> SetFont("Arial", "B", 13);
$fpdf -> Cell(30,7,'2) Productos Comprados', 0, 0, 'L');
$fpdf -> Ln(10);
$fpdf -> SetFont("Arial", "B", 10);
$fpdf -> Cell(40,7,'ID', 1, 0, 'C');
$fpdf -> Cell(50,7,'Nombre', 1, 0, 'C');
$fpdf -> Cell(50,7,utf8_decode('Descripción'), 1, 0, 'C');
$fpdf -> Cell(30,7,'Precio', 1, 0, 'C');
$fpdf -> Cell(20,7,'Cantidad', 1, 0, 'C');
foreach ($productos as $pro):
$fpdf -> Ln(7);
$fpdf -> SetFont("Arial", "I", 9);
$fpdf -> Cell(40,7,$pro["id"], 1, 0, 'C');
$fpdf -> Cell(50,7,$pro["title"], 1, 0, 'C');
$fpdf -> Cell(50,7,$pro["description"], 1, 0, 'C');
$fpdf -> Cell(30,7,$pro["unit_price"], 1, 0, 'C');
$fpdf -> Cell(20,7,$pro["quantity"], 1, 0, 'C');
endforeach;
$fpdf -> ln(10);
$fpdf -> SetFont("Arial", "B", 13);
$fpdf -> Cell(30,7,'3) Datos del Pago', 0, 0, 'L');
$fpdf -> ln(10);
$fpdf -> SetFont("Arial", "B", 10);
$fpdf -> Cell(23,7,'ID', 1, 0, 'C');
$fpdf -> Cell(27,7,'Estado', 1, 0, 'C');
$fpdf -> Cell(20,7,'Moneda', 1, 0, 'C');
$fpdf -> Cell(30,7,'Monto Pagado', 1, 0, 'C');
$fpdf -> Cell(30,7,'Monto Recibido', 1, 0, 'C');
$fpdf -> Cell(35,7,'Dinero Disponible', 1, 0, 'C');
$fpdf -> Cell(30,7,'Tipo de Pago', 1, 0, 'C');
$fpdf -> ln(7);
$fpdf -> SetFont("Arial", "I", 9);
$fpdf -> Cell(23,7,$info["response"]["collection"]["id"], 1, 0, 'C');
$fpdf -> Cell(27,7,$info["response"]["collection"]["status"], 1, 0, 'C');
$fpdf -> Cell(20,7,$info["response"]["collection"]["currency_id"], 1, 0, 'C');
$fpdf -> Cell(30,7,$info["response"]["collection"]["transaction_amount"], 1, 0, 'C');
$fpdf -> Cell(30,7,$info["response"]["collection"]["net_received_amount"], 1, 0, 'C');
$fpdf -> Cell(35,7,fecha($info["response"]["collection"]["money_release_date"]), 1, 0, 'C');
$fpdf -> Cell(30,7,$info["response"]["collection"]["payment_type"], 1, 0, 'C');
$fpdf ->ln(10);
$fpdf -> SetFont("Arial", "B", 10);
$fpdf -> Cell(30,7,'Pago realizado el '.fecha($info["response"]["collection"]["date_created"]).' a las '.hora($info["response"]["collection"]["date_created"]), 0, 0, 'L');








$fpdf -> SetFont("Arial", "B", 10);
$fpdf -> Ln(20);
$fpdf -> Cell(200,10,utf8_decode('www.insignia.com.ve'), 0, 0, 'C');
$fpdf -> SetY(-15);
$fpdf -> SetFont("Times", "B", 24);
$fpdf -> Output();



?>