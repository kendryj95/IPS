<?php
/* @var $this PagosController */
/* @var $data Pagos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pago')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pago), array('view', 'id'=>$data->id_pago)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_metodo_pago')); ?>:</b>
	<?php echo CHtml::encode($data->id_metodo_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_pago')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_pago')); ?>:</b>
	<?php echo CHtml::encode($data->hora_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_compra')); ?>:</b>
	<?php echo CHtml::encode($data->estado_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_pago')); ?>:</b>
	<?php echo CHtml::encode($data->estado_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moneda')); ?>:</b>
	<?php echo CHtml::encode($data->moneda); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('monto')); ?>:</b>
	<?php echo CHtml::encode($data->monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payer_info_email')); ?>:</b>
	<?php echo CHtml::encode($data->payer_info_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payer_id')); ?>:</b>
	<?php echo CHtml::encode($data->payer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_compra')); ?>:</b>
	<?php echo CHtml::encode($data->id_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_api_call')); ?>:</b>
	<?php echo CHtml::encode($data->id_api_call); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_producto')); ?>:</b>
	<?php echo CHtml::encode($data->id_producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_id')); ?>:</b>
	<?php echo CHtml::encode($data->sms_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_sc')); ?>:</b>
	<?php echo CHtml::encode($data->sms_sc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_contenido')); ?>:</b>
	<?php echo CHtml::encode($data->sms_contenido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_key_name')); ?>:</b>
	<?php echo CHtml::encode($data->sms_key_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('redirect_url')); ?>:</b>
	<?php echo CHtml::encode($data->redirect_url); ?>
	<br />

	*/ ?>

</div>