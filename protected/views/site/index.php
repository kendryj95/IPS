
<div class="row">
<div class="col-lg-12 col-md-12 col-xs-12">

<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;

$this->widget('booster.widgets.TbCarousel', array(
    'items'=>array_map(function($record){
        return array(
            'image'=>'images/'.CHtml::encode($record['nombre_de_archivo']),
            'label'=>CHtml::encode($record['titulo']),
            'caption'=>CHtml::encode($record['descripcion']),
        );
    }, $images_carousel)
));
?>
</div>
</div>
<?php


// Asignarle el saldo IPS a la variable session de Yii.
if (!Yii::app()->user->isGuest) {
	if (!(Yii::app()->user->hasState('saldo_ips'))) {
		Yii::app()->user->setState('saldo_ips', number_format($saldo_ips->saldo_ips,2,'.',''));
	}
}

?>

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

<br>
<div class="bs-example" data-example-id="thumbnails-with-custom-content">
	<div class="row">
	<?php foreach($categorias as $cat): ?>
		<div class="col-sm-4 col-md-2">
	    	<div class="thumbnail">
		      <img src="<?= Yii::app()->request->baseUrl; ?>/images/<?= str_replace(" ","-",$cat->deporte) . "_" . str_replace(" ","-",$cat->abreviatura) ?>.png" alt="<?= $cat->abreviatura ?>" style="width: 178.16px; height: 178.16px">
		      <div class="caption">
		        <div class="text-center">
		        	<h4><?= $cat->abreviatura ?></h4>
		        </div>
		        <p style="text-align: center">Ver productos digitales de la <b><?= $cat->abreviatura ?></b></p>
		        <div class="text-center">
		        	<!-- <p><a href="#" class="btn btn-primaryIPS" role="button">Ver producto/s</a></p> -->
		        	<?php echo CHtml::link('Ver Producto/s',array('site/prod_categoria',
                   'cat'=> $cat->abreviatura), array('class'=>'btn btn-primaryIPS')); ?>
		        </div>
		      </div>
	    	</div>
  		</div>
  	<?php endforeach; ?>	
	</div>
</div>
<br>

<?php $this->beginWidget('booster.widgets.TbModal',array('id' => 'modal-detalle')); ?> 
    
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
