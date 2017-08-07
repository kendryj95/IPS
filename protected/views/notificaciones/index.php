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
	            'name' => 'id_compra',
	            'header' => 'Ticket',
	            'type' => 'raw',
	            'htmlOptions' => array('style' => 'text-align: center;'),
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
	            'value'=>'CHtml::link("$data->id_compra", "#", array("class" => "idCompra_reg", "id_registro" => "$data->id_compra", "data-toggle" => "modal", ))'

        	), */
        	array(
	            'name' => 'id_compra',
	            'header' => 'Ticket',
	            'type' => 'raw',
	            'htmlOptions' => array('style' => 'text-align: center;'),
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),

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

            /*array(
            	'name' => 'estatus',
            	'header' => 'Estatus',
            	'htmlOptions' => array('style' => 'text-align: center;'),
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
            ),*/

            array(
	            'class' => 'CButtonColumn',
	            'header' => 'Acciones',
	            'template' => '{ver}',
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
	            'htmlOptions' => array('style' => 'text-align: center;'),
	            'buttons' => array('ver' => array('label' => ' ',
							            		   'url' => 'Yii::app()->createUrl("/notificaciones/entregarContenido", array("id_compra"=>$data->id_compra))',
							            		   'options' => array('class'=>'glyphicon glyphicon-eye-open', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Ver', 'style'=>'color:black;', 'data-toggle' => 'modal', 'data-tooltip'=>'tooltip', 'data-target' => '#modal'),
							            		   'click' => 'function(){
								                                    $.ajax({
								                                        beforeSend: function(){
								                                           $("#modal").addClass("loading");
								                                        },
								                                        complete: function(){
								                                           $("#modal").removeClass("loading");
								                                        },
								                                        type: "POST",
								                                        url: $(this).attr("href"),
								                                        success: function(data) { 
								                                            
															                $("#modal .modal-header").html("<a class=\"close\" data-dismiss=\"modal\">&times;</a><h4>COMPRA #"+data.id_compra+"</h4>");
															                var compras = data.notificacion_compras;

															                if(compras.length > 0){
															                	$("#modal .modal-body").html(JSON.stringify(compras));
															                }
															                else{
															                	$("#modal .modal-body").html("Disculpe, esta compra presenta errores.");
															                }

															                $("#modal").modal("show");
								                                        },
								                                        error: function() { 
								                                            alert("ERROR - entregarContenido");
								                                        }
								                                    });
					                                }'
						                         ),
	            ),
	        ),
        ),
    ));

?>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'modal')
); ?>
 
    <div class="modal-header modalHeaderStyle">
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

<script type="text/javascript">
	$(document).ready(function(){
		registrarNotificacion();

		$(".idCompra_reg").click(function (e) {
			var id_compra = $(this).attr('id_registro');
			entregarContenido(id_compra);
			//e.stopPropagation();
		    //e.preventDefault();
		    //return false;
		});

		//$('#notificaciones-grid .pagination li').on('change', 'a', function(e){
		//$('#notificaciones-grid .pagination li a').live('click', function (e) {

		    //I want do something here
		    //e.stopPropagation();
		    //e.preventDefault();
		    //return false;
		//});

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

	function entregarContenido(id_compra){
		//alert("sasdsd");
		//console.log(document.getElementById("modal"));
		
		$.ajax({
            url:"<?php echo Yii::app()->createUrl('/notificaciones/entregarContenido'); ?>",
            type:"POST",    
            data:{id_compra: id_compra},
            
            beforeSend: function(){
               
            },

            complete: function(){ },

            success: function(data){
                console.log(data);
                $('#modal .modal-header').html('<a class="close" data-dismiss="modal">&times;</a><h4>COMPRA #'+id_compra+'</h4>');
                $('#modal .modal-body').html(data.id_compra);
				
				//$('#modal').modal("show");
            },
            error: function(){
                console.log("ERROR - entregarContenido");
            }
        });

        $('#modal').modal("show");
	}

</script>