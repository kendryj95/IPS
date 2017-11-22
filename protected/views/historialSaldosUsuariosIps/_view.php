<?php
/* @var $this HistorialSaldosUsuariosIpsController */
/* @var $data HistorialSaldosUsuariosIps */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saldo_ips')); ?>:</b>
	<?php echo CHtml::encode($data->saldo_ips); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cambios')); ?>:</b>
	<?php echo CHtml::encode($data->cambios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_actualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_actualizacion); ?>
	<br />


</div>