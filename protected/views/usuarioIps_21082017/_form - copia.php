<?php
/* @var $this UsuarioIpsController */
/* @var $model UsuarioIps */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-ips-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<?php echo $form->textField($model,'pwd',array('size'=>60,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'pwd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estatus'); ?>
		<?php echo $form->textField($model,'estatus'); ?>
		<?php echo $form->error($model,'estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_creado'); ?>
		<?php echo $form->textField($model,'fecha_creado'); ?>
		<?php echo $form->error($model,'fecha_creado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_creado'); ?>
		<?php echo $form->textField($model,'hora_creado'); ?>
		<?php echo $form->error($model,'hora_creado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_expiracion'); ?>
		<?php echo $form->textField($model,'fecha_expiracion'); ?>
		<?php echo $form->error($model,'fecha_expiracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_expiracion'); ?>
		<?php echo $form->textField($model,'hora_expiracion'); ?>
		<?php echo $form->error($model,'hora_expiracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_usuario'); ?>
		<?php echo $form->textField($model,'tipo_usuario',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'tipo_usuario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->