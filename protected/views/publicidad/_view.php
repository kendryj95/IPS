<?php
/* @var $this PublicidadController */
/* @var $data Publicidad */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idpublicidad')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idpublicidad), array('view', 'id'=>$data->idpublicidad)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtipo_publicidad')); ?>:</b>
	<?php echo CHtml::encode($data->idtipo_publicidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_de_archivo')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_de_archivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>