<?php
/* @var $this PublicidadController */
/* @var $model Publicidad */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idpublicidad'); ?>
		<?php echo $form->textField($model,'idpublicidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtipo_publicidad'); ?>
		<?php echo $form->textField($model,'idtipo_publicidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_de_archivo'); ?>
		<?php echo $form->textField($model,'nombre_de_archivo',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>125)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->