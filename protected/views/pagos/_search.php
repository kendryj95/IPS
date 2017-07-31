<?php
/* @var $this PagosController */
/* @var $model Pagos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_pago'); ?>
		<?php echo $form->textField($model,'id_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_metodo_pago'); ?>
		<?php echo $form->textField($model,'id_metodo_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_pago'); ?>
		<?php echo $form->textField($model,'fecha_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_pago'); ?>
		<?php echo $form->textField($model,'hora_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado_compra'); ?>
		<?php echo $form->textField($model,'estado_compra',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado_pago'); ?>
		<?php echo $form->textField($model,'estado_pago',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'moneda'); ?>
		<?php echo $form->textField($model,'moneda',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payer_info_email'); ?>
		<?php echo $form->textField($model,'payer_info_email',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payer_id'); ?>
		<?php echo $form->textField($model,'payer_id',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_compra'); ?>
		<?php echo $form->textField($model,'id_compra',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_api_call'); ?>
		<?php echo $form->textField($model,'id_api_call',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_producto'); ?>
		<?php echo $form->textField($model,'id_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_id'); ?>
		<?php echo $form->textField($model,'sms_id',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_sc'); ?>
		<?php echo $form->textField($model,'sms_sc',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_contenido'); ?>
		<?php echo $form->textField($model,'sms_contenido',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_key_name'); ?>
		<?php echo $form->textField($model,'sms_key_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'redirect_url'); ?>
		<?php echo $form->textField($model,'redirect_url',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->