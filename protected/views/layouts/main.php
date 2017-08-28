<?php 

/* @var $this Controller */
/*error_reporting(-1);
ini_set('display_errors', true);*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/favicon-16x16.png">
	<link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/favicon.ico">
	<link rel="manifest" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/simple-sidebar.css">
	<script src="http://72.14.188.47/ips/lib/dist/checkout.js"></script>
	<script src="https://use.fontawesome.com/e694455cac.js"></script>
	<!--<script src='https://insigniamobile.net.ve/testVersion/insignia_payments_solutions_IPS/webservice_ips/dist/checkout.js'></script>-->

	<?php  
		$baseUrl = Yii::app()->baseUrl; 
		Yii::app()->clientScript->registerCssFile($baseUrl.'/css/estilos.css');

		Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.dataTables.min.js');
		Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/bootstrap-notify/bootstrap-notify.min.js');
		Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/dataTables.bootstrap.min.js');
		Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/funciones.js');
		//Yii::app()->clientScript->registerScriptFile('https://insigniamobile.net.ve/testVersion/insignia_payments_solutions_IPS/webservice_ips/dist/checkout.js');	
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<script type="text/javascript">

	$(document).ready(function(){
		$('#tipo_search').change(function(){

				var tipo = $(this).val();

				const producto = '1';
				const cliente = '2';
				const pais = '3';
				const subcategoria = '4';
				const categoria = '5';

				switch(tipo){
					case producto:
						$('#text_search').attr('placeholder','Nombre del producto');
						break;
					case cliente:
						$('#text_search').attr('placeholder','Nombre del cliente');
						break;
					case pais:
						$('#text_search').attr('placeholder','Pais del deporte');
						break;
					case subcategoria:
						$('#text_search').attr('placeholder','Nombre de la subcategoria');
						break;
					case categoria:
						$('#text_search').attr('placeholder','Nombre de la categoria');
						break;
				}
			});
		
	});

</script>

<body>
<div class="container-fluid">
	<?php	
		Yii::import('application.extensions.shoppingCart.ECartPositionBehaviour');
		//$dd = $this->widget('booster.widgets.TbBadge', array('context' => 'danger', 'label' => '2'));
		 $badget = Yii::app()->shoppingCart->getCount() > 0 ? $this->widget(
			 'booster.widgets.TbBadge',
			 array(
				 'context' => 'danger',
				 // 'default', 'success', 'info', 'warning', 'danger'
				 'label' => Yii::app()->shoppingCart->getCount()
			 )
			 ,true
			 ) : '';

		$this->widget('booster.widgets.TbNavbar',
	    array(
	        'type' => 'inverse',
	        'brand' => '<div style="display: flex; justify-content: center; align-content: center">'.CHtml::image(Yii::app()->getBaseUrl().'/images/logo_ips.png').Yii::app()->name.'</div>',//.CHtml::image(Yii::app()->getBaseUrl().'/images/logo_imc_red.png'),
	        //'brand' => Yii::app()->name.' <span class="none" aria-hidden="true"></span> '.CHtml::image(Yii::app()->getBaseUrl().'/images/logo_ips.png'),//.CHtml::image(Yii::app()->getBaseUrl().'/images/logo_imc_red.png'),
	        'brandUrl' => array('/site/index'),
	        'brandOptions' => array("class"=>"boton_menu"),
	        'collapse' => true, // requires bootstrap-responsive.css
	        'fixed' => 'top',
	        'fluid' => true,
	        'items' => array(
	            array(
	                'class' => 'booster.widgets.TbMenu',
	                'type'  => 'navbar',
	                'htmlOptions' => array('class' => 'menu_superior'),
	                'items' =>  array(
		                    array('icon' => 'glyphicon glyphicon-home','url' => array('/site/index'), 'itemOptions'=>array('id' => 'boton_home')),
		                    array('label' => 'Carrito '.$badget, 'encodeLabel' => false, 'icon' => 'glyphicon glyphicon-shopping-cart','url' => array('/cart/index')),
		                    array('label' => 'Nosotros', 'url' => array('/site/page', 'view'=>'about')),
		                    array('label' => 'Contáctanos', 'url' => array('/site/contact')),
		                    array('label' => 'Buscar', 'url' => 'javascript:void(0)', 'itemOptions' => array('data-toggle' => 'modal', 'data-target' => '.bs-example-modal-sm')),
		                    array('label' => 'Acceder', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
		                    array(
		                        'label' => Yii::app()->user->name,
		                        'url' => '#',
		                        'icon' => 'glyphicon glyphicon-user',
		                        'visible'=>!Yii::app()->user->isGuest,
		                        'items' => array(
		                        	array('label' => 'Perfil', 'encodeLabel'=> false, 'icon'=>'glyphicon glyphicon-cog', 'url' => array('/usuarioips/security')),
		                        	array('label' => 'Notificaciones'.$badget, 'encodeLabel'=> false, 'icon'=>'glyphicon glyphicon-bell', 'url'=>Yii::app()->createUrl('/notificaciones/index')),'---',
		                            array('label' => 'Salir', 'icon'=>'glyphicon glyphicon-log-out', 'url'=>Yii::app()->createUrl('/site/logout'))
		                   	 	),
		                	),
		                )
	        		),
	    		)
	        )
		);
	?>
</div>

<div class="container-fluid contenedor_principal">
	<?php echo $content; ?>
	<div class="clear"></div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
<<<<<<< HEAD
	<div class="modal-content">
		<div class="modal-header modal-headerIPS">
			<a class="close" data-dismiss="modal">&times;</a>
			<h4>Buscar</h4>
		</div>
	 
	    <div class="modal-body" style="background: #EDECED;">
		<div class="text-center">
			<form class="form-inline" method="post" action="index.php?r=site/busqueda">
		    		<div class="form-group">
		                <input type="text" class="form-control" name="text_search" id="text_search" placeholder="Nombre del producto">
		    		</div>
				<select name="tipo_search" id="tipo_search" class="form-control">
					<option value="1">Producto</option>
					<option value="2">Cliente</option>
					<option value="3">País</option>
					<option value="5">Categoría</option>
					<option value="4">Subcategoría</option>
				</select>
				<button type="submit" class="btn btn-primaryIPS">Buscar</button>
		        </form>
	        </div>
	    </div>
    </div>
  </div>
</div>

<div id="footer">
		<img src="images/logo_imc_red.png" width="150px" height="40px">
		<br><strong>Copyright &copy; <?php echo date('Y'); ?> by <a href="http://insignia.com.ve/">Insignia Mobile Communications C.A.</strong></a>.<br/>
		<strong>All Rights Reserved.</strong><br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->
</body>
</html>
