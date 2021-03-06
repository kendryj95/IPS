<script type="text/javascript">
	$(document).ready(function(){

		$('.detailPD').on('click', function(){
			var idPD = $(this).attr('data-idPD');

			$.ajax({
				type: 'POST',
				data: {id: idPD},
				dataType: 'json',
				url: 'index.php?r=site/detallesPD',
				success: function(response){
					if (response.fallo.msg != 'SI') {
						console.log(response.detalle);
						$('#table-detalle #cliente > div').text(response.detalle.nombre_cliente);
						$('#table-detalle #nombrePD > div').text(response.detalle.nombre_producto);
						$('#table-detalle #categoria > div').text(response.detalle.categoria);
						$('#table-detalle #subcategoria > div').text(response.detalle.subcategoria);
						$('#table-detalle #tipo_contenido > div').text(response.detalle.tipo_contenido);
						$('#table-detalle #precio > div').text(response.detalle.precio);

					} else {
						console.log('hubo un error');
					}
				},
				error: function(error){
					console.log('Ha ocurrido un error en la llamada ajax');
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
  $(".pr").click(function(){
      
  		 document.getElementById("hhh").innerHTML='<h3 class="alert alert-info"><center><span class="glyphicon glyphicon-thumbs-up"></span> Ha sido agregado al carrito exitosamente <span class="glyphicon glyphicon-thumbs-up"></span></center></h3>';

  		 window.setTimeout(function(){
			window.location.reload();
		 }, 01000); // dos segundos
     });
});

</script>
<div class="bs-example" data-example-id="thumbnails-with-custom-content">
	<div class="row">
		<?php if(count($productos_promo) > 0): ?>
			<p><b>Se encontraron los siguientes resultados: </b></p>
		<?php foreach($productos_promo as $info_producto){ ?>
			<div class="col-sm-6 col-md-2">
				<div class="thumbnail">
					<div class="caption">
					<p style="text-align: right; font-size: 20px;"><span class="label label-primaryIPS"><strong>$ <?= number_format((float)$info_producto['precio'], 2, '.', ''); ?></strong></span></p>
						<p><strong><?php echo "Producto: ".$info_producto['nombre_producto']; ?></strong></p>
						<p><?php echo "<strong>Contenido en formato: </strong>".ucfirst($info_producto['tipo_contenido'])." (".$info_producto['abrev_tipo'].")"; ?></p>
						

						<!--<p> -->
							<?php

								if (isset($_GET['cat'])) {
									$categoria = $_GET['cat'];
								} elseif (isset($_POST['text_search'])) {
									$categoria = $_POST['text_search'];
								}

								$this->widget('booster.widgets.TbButton',
								    array(
								        'label' => 'Comprar',
								        'context' => 'success',
								        'size' => 'small',
								        'icon' => 'fa fa-money',
								        'buttonType' => 'link',
								        'url' => Yii::app()->createUrl('/cart/addToCart', array('id_producto' => $info_producto['idproductos_digitales'], 'categoria' => $categoria)),
								        'htmlOptions' => array('class' => 'pr btn btn-primaryIPS')
								        
								    )
								);
								echo "<br>";	
								$this->widget('booster.widgets.TbButton',
								    array(
								        'label' => 'Detalles',
								        'context' => 'info',
								        'size' => 'small',
								        'icon' => 'fa fa-eye',
								        'htmlOptions' => array(
								            'data-toggle' => 'modal',
								            'data-target' => '#myModal',
								            'class' => 'detailPD btn-defaultIPS',
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
	<div class="row">
		<div class="container-fluid">
		<div class="col-lg-9">
		<div id="hhh"></div>
			
		</div>
		</div>
	</div>
</div>

<?php $this->beginWidget('booster.widgets.TbModal',array('id' => 'myModal')); ?> 
    
    <div class="modal-header modal-headerIPS">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Detalles del Producto</h4>
    </div>
 
    <div class="modal-body modal-body-detalles" style="background: #EDECED;">
		<table id="table-detalle" class="table table-striped"> 
			<tr>
				<td align="center" class="title" style="padding-left: 5px">
					<div class="centrar"><b>NOMBRE DE CLIENTE</b></div>
				</td>
				<td id="cliente" class="content" style="padding-left: 5px"><div  style="height: 62px; overflow: hidden; display: flex; justify-content: center; align-items: center"></div></td>
			</tr>
			<tr>
				<td align="center" class="title">
					<div class="centrar"><b>NOMBRE DEL PRODUCTO</b></div>
				</td>
				<td id="nombrePD" class="content" style="padding-left: 5px"><div class="centrar"></div></td>
			</tr>
			<tr>
				<td align="center" class="title" style="padding-left: 5px">
					<div class="centrar"><b>CATEGORÍA</b></div>
				</td>
				<td id="categoria" class="content" style="padding-left: 5px"><div class="centrar"></div></td>
			</tr>
			<tr>
				<td align="center" class="title" style="padding-left: 5px">
					<div class="centrar"><b>SUBCATEGORIA</b></div>
				</td>
				<td id="subcategoria" class="content" style="padding-left: 5px"><div class="centrar"></div></td>
			</tr>
			<tr>
				<td align="center" class="title" style="padding-left: 5px">
					<div class="centrar"><b>TIPO DE CONTENIDO</b></div>
				</td>
				<td id="tipo_contenido" class="content" style="padding-left: 5px"><div class="centrar"></div></td>
			</tr>
			<tr>
				<td align="center" class="title" style="padding-left: 5px">
					<div class="centrar"><b>PRECIO</b></div>
				</td>
				<td id="precio" class="content" style="padding-left: 5px"><div class="centrar"></div></td>
			</tr>
		</table>
    </div>

    <div class="modal-footer">
        <?php 
        	$this->widget('booster.widgets.TbButton',
	            array(
	                'label' => 'Cerrar',
	                'url' => '#',
	                'htmlOptions' => array('data-dismiss' => 'modal', 'class' => 'btn btn-primaryIPS'),
	            )
        	);
        ?>
    </div>
<?php $this->endWidget(); ?>