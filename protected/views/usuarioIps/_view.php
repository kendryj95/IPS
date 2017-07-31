<?php
/* @var $this UsuarioIpsController */
/* @var $data UsuarioIps */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuario_ips')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idusuario_ips), array('view', 'id'=>$data->idusuario_ips)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pwd')); ?>:</b>
	<?php echo CHtml::encode($data->pwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estatus')); ?>:</b>
	<?php echo CHtml::encode($data->estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creado')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_creado')); ?>:</b>
	<?php echo CHtml::encode($data->hora_creado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_expiracion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_expiracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_expiracion')); ?>:</b>
	<?php echo CHtml::encode($data->hora_expiracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_usuario); ?>
	<br />

	*/ ?>

</div>