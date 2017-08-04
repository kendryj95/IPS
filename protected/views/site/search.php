<div class="bs-example" data-example-id="thumbnails-with-custom-content">
	<div class="row">
		<?php if(count($productos_promo) > 0): ?>
			<p><b>Se encontraron los siguientes resultados: </b></p>
		<?php foreach($productos_promo AS $info_producto){ ?>
			<div class="col-sm-4 col-md-2">
				<div class="thumbnail">
					<div class="caption">
					<p style="text-align: right; font-size: 20px;"><span class="label labelPrecio"><strong>$ <?= number_format((float)$info_producto['precio'], 2, '.', ''); ?></strong></span></p>
						<p><strong><?php echo "Producto: ".$info_producto['nombre_producto']; ?></strong></p>
						<p><?php echo "<strong>Contenido en formato: </strong>".ucfirst($info_producto['tipo_contenido'])." (".$info_producto['abrev_tipo'].")"; ?></p>
						

						<!--<p> -->
							<?php 

								$this->widget('booster.widgets.TbButton',
								    array(
								        'label' => 'Comprar',
								        'context' => 'success',
								        'size' => 'small',
								        'icon' => 'fa fa-money',
								        'buttonType' => 'link',
								        'url' => Yii::app()->createUrl('/cart/addToCart', array('id_producto' => $info_producto['idproductos_digitales'])),
								        
								    )
								);
								echo "&nbsp;";	
								$this->widget('booster.widgets.TbButton',
								    array(
								        'label' => 'Detalles',
								        'context' => 'info',
								        'size' => 'small',
								        'icon' => 'fa fa-eye',
								        'htmlOptions' => array(
								            'data-toggle' => 'modal',
								            'data-target' => '#myModal',
								            'class' => 'detailPD',
								            'data-idPD' => $info_producto['id_producto_sms'],
								     
								        ),
								    )
								); 
							?>
							
						<!--</p>-->
					</div>
				</div>
			</div>
		<?php } ?>
		<?php else: ?>
			<div class="container">
                    <div class="row">
                        <div class="col-md-3" style="text-align: center;">
                            <img src="images/cart_empty.png"  alt="Shopping Cart" width="200" height="200">
                        </div>
                        <div class="col-md-9">
                            <h2>Oops!</h2>
                            <h3>No existen productos correspondiente a la busqueda.</h3>
                        </div>
                    </div>
                </div>
        <?php endif; ?>
	</div>
</div>