<?php
/* @var $this CategoriasContenidoController */
/* @var $model CategoriasContenido */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categorias-contenido-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deporte'); ?>
		<?php echo $form->textField($model,'deporte',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'deporte'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'abreviatura'); ?>
		<?php echo $form->textField($model,'abreviatura',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'abreviatura'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pais'); ?>
		<?php echo $form->textField($model,'pais',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pais'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->