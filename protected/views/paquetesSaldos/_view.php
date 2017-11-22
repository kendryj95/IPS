<?php
/* @var $this PaquetesSaldosController */
/* @var $data PaquetesSaldos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saldo')); ?>:</b>
	<?php echo CHtml::encode($data->saldo); ?>
	<br />


</div>