<?php
/* @var $this PaquetesSaldosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Paquetes Saldos',
);


?>

<h1>Paquetes Saldos</h1>

<div class="alert alert-info">
	<p>Elige el paquete de saldo que gustes para poder gozar de nuestros productos sin necesidad de pagar con un procesador de pago externo al de nuestra plataforma.</p>
</div>

<div class="bs-example" data-example-id="thumbnails-with-custom-content">
	<div class="row">
		<?php foreach($model as $paquetes): ?>
				<div class="col-sm-4 col-md-2">
					<div class="thumbnail">
						<div class="caption">
							<label><strong><?php echo "Paquete de: " ?></strong></label>
							<h3 style="color: #C30B13; text-align: center">$<?= number_format($paquetes->saldo,2,'.','') ?></h3>
			
							<!--<p> -->
								<?php
			
									$this->widget('booster.widgets.TbButton',
									    array(
									        'label' => 'Comprar',
									        'context' => 'success',
									        'size' => 'small',
									        'icon' => 'fa fa-money',
									        'buttonType' => 'link',
									        'url' => Yii::app()->createUrl('/cart/addToCart', array('paqueteSaldo' => $paquetes->id, 'categoria' => '')),
									        'htmlOptions' => array('class' => 'btn btn-primaryIPS')
									        
									    )
									); 
								?>
								
							<!--</p>-->
						</div>
					</div>
				</div>
		<?php endforeach; ?>
	</div>
</div>


