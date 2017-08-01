<?php
/* @var $this NotificacionesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Notificaciones',
);

/*$this->menu=array(
	array('label'=>'Create Notificaciones', 'url'=>array('create')),
	array('label'=>'Manage Notificaciones', 'url'=>array('admin')),
);*/
?>
<h2 style="text-align: center;">Notificaciones</h2>
<hr>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ ?>

<?php
/*echo "<pre>";
print_r($_GET);
echo "</pre>";*/
?>

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notificaciones-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		'id_compra',
		'asunto',
		'mensaje',
		'fecha',
		'hora',
		'estado',

		array(
			'class'=>'CButtonColumn',
		),
	),
));*/ ?>


<?php

$this->widget('booster.widgets.TbExtendedGridView' , array (
        'id'=>'notificaciones-grid',
        'type'=>'striped bordered', 
        'responsiveTable' => true,
        'dataProvider' => $model->search(),
        'ajaxUrl' => Yii::app()->createUrl("notificaciones/index"),
        'summaryText'=>'Mostrando {start} a {end} de {count} registros', 
        'template' => '{items}<div class="form-group"><div class="col-md-5 col-sm-12">{summary}</div><div class="col-md-7 col-sm-12">{pager}</div></div><br />',
        'htmlOptions' => array('class' => 'trOverFlow col-xs-12 col-sm-12 col-md-12 col-lg-12'),
        'filter'=> $model,
        'columns'=> array( 
			/*array(
				'class'=>'booster.widgets.TbRelationalColumn',
				'name' => 'id_compra',
				'url' => $this->createUrl('notificaciones/relational'),
				'value'=> '"test-subgrid"',
				'afterAjaxUpdate' => 'js:function(tr,rowid,data){
					bootbox.alert("I have afterAjax events too! This will only happen once for row with id: "+rowid);
				}'
			), */
        	array(
	            'name' => 'id_compra',
	            'header' => 'Ticket',
	            'type' => 'raw',
	            'htmlOptions' => array('style' => 'text-align: center;'),
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
				//'value'=>'CHtml::link("$data->id_compra", array("controller/action", "id_compra"=>$data->id_compra))'
				'value'=>'CHtml::link("$data->id_compra", "#modal", array("data-toggle" => "modal"))'
				/*'value'=>"CHtml::ajaxLink(
							'Test request',         
							array('ajax/reqTest01Loading'),
							array(
								'update'=>'#req_res_loading',
								'beforeSend' => 'function() {           
									$('#maindiv').addClass('loading');
								}',
								'complete' => 'function() {
									$('#maindiv').removeClass('loading');
								}',        
							)
						)"*/
        	), 

        	array(
	            'name' => 'asunto',
	            'header' => 'Asunto',
	            'type' => 'raw',
	            'htmlOptions' => array('style' => 'text-align: center;'),
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
        	), 
        	array(
	            'name' => 'mensaje',
	            'header' => 'Mensaje',
	            'type' => 'raw',
	            'htmlOptions' => array('style' => 'text-align: center;'),
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
        	), 
            array(
                'name' => 'fecha',
                'header' => 'Fecha',
                'type' => 'date',
                'htmlOptions' => array('style' => 'text-align: center;'),
                'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
            ),
            array(
            	'name' => 'hora',
            	'header' => 'Hora',
            	'htmlOptions' => array('style' => 'text-align: center;'),
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
            ),
        ),
    ));

?>
<script type="text/javascript">
	$(document).ready(function(){
		registrarNotificacion();
	});

	function registrarNotificacion(){
	    var paymentId = getVariableURL('paymentId');
	    var idCompra = getVariableURL('idCompra');

	    if((paymentId != "") && (idCompra != "")){
	        $.ajax({
	            url:"<?php echo Yii::app()->createUrl('/notificaciones/agregarNotificacion'); ?>",
	            type:"POST",    
	            data:{purchase_id: idCompra, payment_id: paymentId},
	            
	            beforeSend: function(){
	               
	            },

	            complete: function(){ },

	            success: function(data){
	                console.log(data);
					$('#notificaciones-grid').yiiGridView('update', {
						data: $(this).serialize()
					});
	            },
	            error: function(){
	                console.log("ERROR - registrarNotificacion");
	            }
	        });
	    }
	}

</script>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'modal')
); ?>
 
    <div class="modal-header" style="background-color: gainsboro;">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>¡GRACIAS POR SU COMPRA!</h4>
    </div>
 
    <div class="modal-body">
        <p>One fine body...</p>
    </div>
 
    <div class="modal-footer">
        <?php /*$this->widget(
            'booster.widgets.TbButton',
            array(
                'context' => 'primary',
                'label' => 'Save changes',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        );*/ ?>
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Close',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php $this->endWidget(); ?>