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

<br>
<div class="bs-example" data-example-id="thumbnails-with-custom-content">
	<div class="row">
		<?php foreach($productos_promo AS $info_producto){ ?>
			<div class="col-sm-4 col-md-2">
				<div class="thumbnail">
					<!--<img alt="100%x200" data-src="holder.js/100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjE3IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIxNyAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVjMzA4NGQxMzUgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMXB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWMzMDg0ZDEzNSI+PHJlY3Qgd2lkdGg9IjIxNyIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4MC41IiB5PSIxMDQuOCI+MjE3eDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">-->
					<div class="caption">
						<p><strong><?php echo "Producto: ".$info_producto['nombre_producto']; ?></strong></p>
						<p><?php echo "<strong>Contenido en formato: </strong>".ucfirst($info_producto['tipo_contenido'])." (".$info_producto['abrev_tipo'].")"; ?></p>
						<p style="text-align: right; font-size: 20px;"><span class="label label-danger"><strong>$ <?= number_format((float)$info_producto['precio'], 2, '.', ''); ?></strong></span></p>

						<p>
							<?php 
								echo "<br>".CHtml::link('Comprar', Yii::app()->createUrl('/cart/addToCart', array('id_producto' => $info_producto['idproductos_digitales'])), array('class' => 'btn btn-sm btn-success'))." ";
								$this->widget('booster.widgets.TbButton',
								    array(
								        'label' => 'Detalles',
								        'context' => 'info',
								        'size' => 'small',
								        'htmlOptions' => array(
								            'data-toggle' => 'modal',
								            'data-target' => '#myModal',
								        ),
								    )
								); 
							?>
							<!--<a href="#" class="btn btn-success" role="button">Comprar</a>
							<a href="#" class="btn btn-info" role="button">Ver detalles</a>-->
						</p>
						
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<br>

<?php $this->beginWidget('booster.widgets.TbModal',array('id' => 'myModal')); ?> 
    
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Modal header</h4>
    </div>
 
    <div class="modal-body">
        <p>One fine body...</p>
    </div>
 
    <div class="modal-footer">
        <?php 
        	$this->widget('booster.widgets.TbButton',
	            array(
	                'context' => 'primary',
	                'label' => 'Save changes',
	                'url' => '#',
	                'htmlOptions' => array('data-dismiss' => 'modal'),
	            )
	        ); 
        	
        	$this->widget('booster.widgets.TbButton',
	            array(
	                'label' => 'Close',
	                'url' => '#',
	                'htmlOptions' => array('data-dismiss' => 'modal'),
	            )
        	);
        ?>
    </div>
<?php $this->endWidget(); ?>