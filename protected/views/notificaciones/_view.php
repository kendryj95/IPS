<?php
/* @var $this NotificacionesController */
/* @var $data Notificaciones */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_notificacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_notificacion), array('view', 'id'=>$data->id_notificacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuario_ips')); ?>:</b>
	<?php echo CHtml::encode($data->idusuario_ips); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->id_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asunto')); ?>:</b>
	<?php echo CHtml::encode($data->asunto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mensaje')); ?>:</b>
	<?php echo CHtml::encode($data->mensaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora')); ?>:</b>
	<?php echo CHtml::encode($data->hora); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	*/ ?>

</div>