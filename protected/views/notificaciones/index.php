<?php
/* @var $this NotificacionesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Notificaciones',
);

?>
<h2 style="text-align: center;">Notificaciones</h2>
<hr>

<style>
    html, body{
        height: 95vh;
    }

   .interna embed {
        display: block;
        margin: 0 auto;
        width: 100%;
        height: 450px;
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
            array(
	            'name' => 'estado',
	            'header' => 'Estado',
	            'type' => 'raw',
	            'value' => function($data){
	            	$objeto = Yii::app()->Funciones->getColorLabelEstadoNotificaciones($data->estado);
	            	Controller::widget(
					    'booster.widgets.TbLabel',
					    array(
					        'label' => $objeto['label'],
					        'htmlOptions'=>array('style'=>'background-color: '.$objeto['background_color'].';'),	
					    )
					);
	            },
	            'htmlOptions' => array('style' => 'text-align: center;'),
	            'headerHtmlOptions' => array('class'=>'tableHover hrefHover'),
        	),
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

															                $("#notificaciones-grid").yiiGridView("update", {
																				data: $(this).serialize()
																			});

															                if(compras.length > 0){

															                	var text = "";
															                	
																				for(var i = 0; i < compras.length; i++) {
																					text += "<div class=\"panel panel-default\"><div class=\"panel-heading\"><h4 class=\"panel-title\"><a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse"+i+"\"><strong>Producto: </strong>"+compras[i].desc_producto+"</a></h4></div><div id=\"collapse"+i+"\" class=\"panel-collapse collapse\"><div class=\"panel-body\"><table style=\"border: 1px solid black;\" width=\"100%\"><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Estado de compra</b></div></td><td>"+compras[0].estado_compra+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Estado de pago</b></div></td><td>"+compras[0].estado_pago+"</td></tr><tr><td align=\"center\" class=\"title\" style=\"padding-left: 5px\"><div><b>Email del comprador</b></div></td><td>"+compras[0].payer_info_email+"</td></tr>";

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

																					text += "</table></div></div></div>";
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
 
    <div class="modal-body" style="overflow: scroll; height: 450px;">
        <!--<p>One fine body...</p>-->
    </div>
 
    <div class="modal-footer">
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
 
    <div class="modal-body" style="overflow: scroll; height: 450px;">
        <!--<p>One fine body...</p>-->
    </div>
 
    <div class="modal-footer">
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