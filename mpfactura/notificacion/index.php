<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../db.php");
require_once ("../lib/mercadopago.php");
require_once("../funfech.php");



$id_pay=$_POST["idpay"];
$msj="";
$mp = new MP("6433021778260883", "HQWtBgQbvUbdk8abet8kmFyzAwz4P6dM");
if ($id_pay) {
	$sql= $conexion->query("SELECT id_api_call FROM pagos WHERE id_compra='$id_pay' ");
	$res=$sql->fetch();
	if ($res!==false) {
		$paymentInfo = $mp->get_payment_info($id_pay);
		$productos = $mp->get_preference($res["id_api_call"]);
		$products= $productos["response"]["items"];
		$prjson= $productos;
		$payjson= $paymentInfo;
	}else{
		$msj.="<h5 class='alert alert-danger'>El codigo introducido no existe o es incorrecto.</h5>";

	}
} 



$fecha= $paymentInfo["response"]["collection"]["date_created"];
$status= $paymentInfo["response"]["collection"]["status"];
if ($status=="approved") {
	$status="Aprovado";
}

$tipo_pago= $paymentInfo["response"]["collection"]["payment_type"];
if ($tipo_pago=="account_money") {
	$tipo_pago="Dinero de Cuenta";
}
if ($tipo_pago=="credit_card") {
	$tipo_pago="Tarjeta de Credito";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Notificaciones</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" href="../../images/logo_ips.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
	<link rel="stylesheet" href="../../css/fonts.css">
	<link rel="stylesheet" type="text/css" href="../../css/styles.css">
	<script src="../../js/jquery-3.2.1.min.js"></script>
	<script src="../../js/JqueryValidate.js"></script>
	
</head>
<body>
<div id="preloader">
		<div class="loader"></div>
	</div>
<div class="container">
<center><img src="../logo_notificaciones.png" class="img-responsive"><img src="../pago.png" class="pull-right img-responsive"></center>
<br>
<div class="row">
	<div class="col-lg-8">
		<form  action="" id="formu" name="formu" method="POST">
		<div class="form-group">
			<label><span class="glyphicon glyphicon-icon-keys"></span> Codigo:</label> 
			<input type="text" name="idpay" id="idpay" placeholder="Ingrese el id de la compra o collection id" class="form-control">
			<span class="glyphicon form-control-feedback" ></span>
			<br>
		</div>
		<button type="submit"  class="btn btn-danger">Buscar <span class="glyphicon glyphicon-search"></span></button>
		</form>
	</div>
</div>
<?php echo $msj; ?>
<?php if ($id_pay and $res!==false) {?>
<h3>Datos del Comprador</h3>
<hr class="section-heading-spacer">
<br>

<table class ="table table-striped table-bordered table-hover table-responsive" id="tabla">
 	<thead class="btn-danger">
 	    <tr>
 	    <th>Id</th>
 	    <th>Identificación</th>
 	    <th>Nombre</th>
 	    <th>Apellido</th>
 	    <th>Correo</th>
 	    <th>Telefono</th>
 	    <th>Pais</th>
 	    </tr>
 	</thead>
 	<tbody>
 	    <tr>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["payer"]["id"] ?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["payer"]["identification"]["type"]; ?> <?php echo $paymentInfo["response"]["collection"]["payer"]["identification"]["number"]; ?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["payer"]["first_name"]; ?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["payer"]["last_name"]; ?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["payer"]["email"]; ?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["payer"]["phone"]["number"]; ?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["site_id"]; ?></td>
 	    </tr>
 	</tbody>
</table>
<h3>Productos Comprados</h3>
<hr class="section-heading-spacer">
<table class ="table table-striped table-bordered table-hover table-responsive" id="tabla">
 	<thead class="btn-danger">
 	    <tr>
 	    <th>Id</th>
 	    <th>Nombre</th>
 	    <th>Descripción</th>
 	    <th>Precio</th>
 	    <th>Cantidad</th>
 	    </tr>
 	</thead>
 	<tbody>
 	<?php foreach ($products as $producto): ?>
 	    <tr>
 	    	<td><?php echo $producto["id"]?></td>
 	    	<td><?php echo $producto["title"]?></td>
 	    	<td><?php echo $producto["description"]?></td>
 	    	<td><?php echo $producto["unit_price"]?></td>
 	    	<td><?php echo $producto["quantity"]?></td>
 	    </tr>
 	<?php endforeach; ?>
 	</tbody>
</table>
<h3>Datos del Pago</h3>
<hr class="section-heading-spacer">
<table class ="table table-responsive table-striped table-bordered table-hover" id="tabla">
 	<thead class="btn-danger">
 	    <tr>
 	    <th>Estado</th>
 	    <th>Fecha de pago</th>
 	    <th>Hora de pago</th>
 	    <th>Moneda</th>
 	    <th>Monto Pagado</th>
 	    <th>Monto Recibido</th>
 	    <th>Disposición del Dinero</th>
 	    <th>Tipo de Pago</th>
 	    </tr>
 	</thead>
 	<tbody>
 	    <tr>
 	    	<td><?php echo $status;?></td>
 	    	<td><?php echo fecha($fecha)?></td>
 	    	<td><?php echo hora($fecha)?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["currency_id"]; ?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["transaction_amount"] ?></td>
 	    	<td><?php echo $paymentInfo["response"]["collection"]["net_received_amount"]; ?></td>
 	    	<td><?php echo fecha($paymentInfo["response"]["collection"]["money_release_date"])?></td>
 	    	<td><?php echo $tipo_pago;?> 
 	    	<?php if($tipo_pago=="Tarjeta de Credito"):?>
 	    	<a class="btn btn-default" href="#info_credi" data-toggle="modal" title="Info de la tarjeta de credito"><span class="glyphicon glyphicon-eye-open"></span>
 	    	</a>
 	    	<?php endif;?>
 	    	</td>
 	    </tr>
 	</tbody>
</table>
<br>


<form action="reporte/" method="POST" target='_blank'>
<input type="hidden" class="form-control" name="pro" value="<?php echo htmlspecialchars(json_encode($prjson));?>">
<input type="hidden" name="pay" value="<?php echo htmlspecialchars(json_encode($payjson));?>">
<button type="submit" style="background-color:#444444; color:white;" class="btn nn" id="exportpdf">Exportar a PDF</button>
</form>

<?php }else {?>

<?php }?>

</div>
<br>
<hr class="section-heading-spacer">

<br>
<style type="text/css">
	
	#footer {
	position:fixed;
    right:0;
    left:0;
    z-index:1030;
    bottom:0;
    margin: 0px 0px;
    font-size: 0.8em;
    text-align: center;
    border-top: 1px solid grey;
    background: white;
	}
</style>
<div id="footer">
	<center>
		<img src="../../images/logo_imc_red.png" width="150px" height="40px">
		<br><strong>Copyright &copy; <?php echo date('Y'); ?> by <a href="http://insignia.com.ve/">Insignia Mobile Communications C.A.</a></strong>.<br/>
		<strong>All Rights Reserved.</strong><br/>
		</center>
</div>
<?php if($paymentInfo["response"]["collection"]["cardholder"]):?>
<div class="modal fade" id="info_credi">
		<div class="modal-dialog-personalizado">
			<div class="modal-content">
				<!-- Header de la ventana -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Info de Tarjeta</h4>
				</div>
				<!-- Contenido de la ventana -->
				<div class="modal-body">
					<img src="../pago.png" class="img-responsive" style="width: 366px;height: 54px" alt="Imagen" title="Logo Oficial ">
					<br/>

					<!--contenido de la ventana emergente!-->
					<div class="form-group">
						<label>Nombre: <?php echo $paymentInfo["response"]["collection"]["cardholder"]["name"]; ?></label>
					</div>
					<div class="form-group">
						<label>Tipo de Identificación: <?php echo $paymentInfo["response"]["collection"]["cardholder"]["identification"]["type"]; ?></label>
					</div>
					<div class="form-group">
						<label>Numero de Identificación: <?php echo $paymentInfo["response"]["collection"]["cardholder"]["identification"]["number"]; ?></label>
					</div>


				</div>
				<!-- Footer de la ventana -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<script src="../../js/main.js"></script>
<script src="../../js/bootstrap.min.js"></script>
</body>
</html>