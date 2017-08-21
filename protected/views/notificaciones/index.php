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

<style>
    html, body{
        height: 95vh;
    }

   .interna embed {
        display: block;
        margin: 0 auto;
        width: 120%;
        height: 550px;
    }
</style>
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
							            		   'options' => array('class'=>'glyphicon glyphicon-eye-open', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Ver', 'style'=>'color:black;', 'data-toggle' => 'modal', 'data-tooltip'=>'tooltip', 'data-target' => '#modal-detalleCompra'),
							            		   'click' => 'function(){
														            $.ajax({
														                beforeSend: function(){
														                   $("#modal-detalleCompra").addClass("loading");
														                },
														                complete: function(){
														                   $("#modal-detalleCompra").removeClass("loading");
														                },
														                type: "POST",
														                url: $(this).attr("href"),
														                success: function(data) { 
														                    
															                $("#modal-detalleCompra .modal-header").html("<a class=\"close\" data-dismiss=\"modal\">&times;</a><h4>COMPRA #"+data.id_compra+"</h4>");
															                var compras = data.notificacion_compras;

															                if(compras.length > 0){

															                	var text = "";
															                	console.log(compras.length);
																				for(var i = 0; i < compras.length; i++) {
																					text += "<table id=\"table-detalle\" class=\"table table-striped\"><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Estado de compra</b></div></td><td>"+compras[0].estado_compra+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Estado de pago</b></div></td><td>"+compras[0].estado_pago+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Email del comprador</b></div></td><td>"+compras[0].payer_info_email+"</td></tr>";
																					
																					if(compras[i].contenido_texto != null){
																						text += "<tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Shortcode</b></div></td><td>"+compras[i].sms_sc+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Email de recepcion</b></div></td><td>"+compras[i].consumidor_email+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Notificar al</b></div></td><td>"+compras[i].consumidor_telefono+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Categoria</b></div></td><td>"+compras[i].categoria+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Deporte</b></div></td><td>"+compras[i].deporte+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Pais</b></div></td><td>"+compras[i].pais+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Tipo</b></div></td><td>"+compras[i].tipo+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Abreviatura</b></div></td><td>"+compras[i].abreviatura+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Contenido</b></div></td><td>"+compras[i].contenido_texto+"</td></tr>";
																					}else{
																						
																						if(compras[i].abreviatura == ".mp3"){
																							text += "<tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Shortcode</b></div></td><td>"+compras[i].sms_sc+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Email de recepcion</b></div></td><td>"+compras[i].consumidor_email+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Notificar al</b></div></td><td>"+compras[i].consumidor_telefono+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Categoria</b></div></td><td>"+compras[i].categoria+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Deporte</b></div></td><td>"+compras[i].deporte+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Pais</b></div></td><td>"+compras[i].pais+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Tipo</b></div></td><td>"+compras[i].tipo+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Contenido</b></div></td><td><audio src=\"data:audio/mp3; base64, " + compras[i].contenido_archivo + "\" controls> </audio></td></tr>";
																						}
																						
																						if(compras[i].abreviatura == ".pdf"){
																							text += "<tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Shortcode</b></div></td><td>"+compras[i].sms_sc+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Email de recepcion</b></div></td><td>"+compras[i].consumidor_email+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Notificar al</b></div></td><td>"+compras[i].consumidor_telefono+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Categoria</b></div></td><td>"+compras[i].categoria+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Deporte</b></div></td><td>"+compras[i].deporte+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Pais</b></div></td><td>"+compras[i].pais+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Tipo</b></div></td><td>"+compras[i].tipo+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Contenido</b></div></td><td><a href=\"#\" data-toggle=\"modal\" data-target=\"#modal-ContenidoArchivo\" onclick=\"alertaaaa();\">" + compras[i].nombre_archivo + "</a><div class=\"interna\"><embed src=\"data:application/pdf; base64, " + compras[i].contenido_archivo + "\"></div></td></tr>";
																						}

																						if(compras[i].abreviatura == ".txt"){
																							text += "<tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Shortcode</b></div></td><td>"+compras[i].sms_sc+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Email de recepcion</b></div></td><td>"+compras[i].consumidor_email+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Notificar al</b></div></td><td>"+compras[i].consumidor_telefono+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Categoria</b></div></td><td>"+compras[i].categoria+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Deporte</b></div></td><td>"+compras[i].deporte+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Pais</b></div></td><td>"+compras[i].pais+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Tipo</b></div></td><td>"+compras[i].tipo+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Contenido</b></div></td><td><textarea rows=\"4\" cols=\"50\">" + compras[i].contenido_texto + "</textarea></td></tr>";
																						}
																					}
																					text += "</table><br><br>";
																				};
																				
																				$("#modal-detalleCompra .modal-body").html(text);
															                }
															                else{
															                	$("#modal-detalleCompra .modal-body").html("Disculpe, esta compra presenta errores.");
															                }

															                $("#modal-detalleCompra").modal("show");
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
<!--$("#modal-detalleCompra .modal-body").html(JSON.stringify(compras));-->

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'modal-detalleCompra')
); ?>
 
    <div class="modal-header modal-headerIPS">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>¡GRACIAS POR SU COMPRA!</h4>
    </div>
 
    <div class="modal-body" style="overflow: scroll; height: 350px;">
        <!--<p>One fine body...</p>-->
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
                'htmlOptions' => array('data-dismiss' => 'modal', 'class' => 'btn-defaultIPS'),
            )
        ); ?>
    </div>
 
<?php $this->endWidget(); ?>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'modal-ContenidoArchivo')
); ?>
 
    <div class="modal-header modal-headerIPS">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>REVISI&Oacute;N DE CONTENIDO</h4>
    </div>
 
    <div class="modal-body" style="overflow: scroll; height: 350px;">
        <!--<p>One fine body...</p>-->
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
                'htmlOptions' => array('data-dismiss' => 'modal', 'class' => 'btn-defaultIPS'),
            )
        ); ?>
    </div>
 
<?php $this->endWidget(); ?>

<script type="text/javascript">
	function alertaaaa(){
		alert("sssssss");
		$('#modal-ContenidoArchivo .modal-body').html("SSSDSEDWWEF566V22D65F5G98");
	}
	$(document).ready(function(){
		registrarNotificacion();

		/*$(".idCompra_reg").click(function (e) {
			var id_compra = $(this).attr('id_registro');
			//entregarContenido(id_compra);
			//e.stopPropagation();
		    //e.preventDefault();
		    //return false;
		});*/

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
		
		/*$.ajax({
            url:"<?php //echo Yii::app()->createUrl('/notificaciones/entregarContenido'); ?>",
            type:"POST",    
            data:{id_compra: id_compra},
            
            beforeSend: function(){
               
            },

            complete: function(){ },

            success: function(data){
                console.log(data);
                $('#modal-detalleCompra .modal-header').html('<a class="close" data-dismiss="modal">&times;</a><h4>COMPRA #'+id_compra+'</h4>');
                $('#modal-detalleCompra .modal-body').html(data.id_compra);
				
				//$('#modal-detalleCompra').modal("show");
            },
            error: function(){
                console.log("ERROR - entregarContenido");
            }
        });

        $('#modal-detalleCompra').modal("show");*/
        console.log(id_compra);
        return 0;
        
	}

</script>