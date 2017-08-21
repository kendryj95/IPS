<?php
/* @var $this UsuarioIpsController */
/* @var $model UsuarioIps */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idusuario_ips'); ?>
		<?php echo $form->textField($model,'idusuario_ips'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pwd'); ?>
		<?php echo $form->textField($model,'pwd',array('size'=>60,'maxlength'=>90)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estatus'); ?>
		<?php echo $form->textField($model,'estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creado'); ?>
		<?php echo $form->textField($model,'fecha_creado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_creado'); ?>
		<?php echo $form->textField($model,'hora_creado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_expiracion'); ?>
		<?php echo $form->textField($model,'fecha_expiracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_expiracion'); ?>
		<?php echo $form->textField($model,'hora_expiracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_usuario'); ?>
		<?php echo $form->textField($model,'tipo_usuario',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->