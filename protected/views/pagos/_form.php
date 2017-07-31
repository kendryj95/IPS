<?php
/* @var $this PagosController */
/* @var $model Pagos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_metodo_pago'); ?>
		<?php echo $form->textField($model,'id_metodo_pago'); ?>
		<?php echo $form->error($model,'id_metodo_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_pago'); ?>
		<?php echo $form->textField($model,'fecha_pago'); ?>
		<?php echo $form->error($model,'fecha_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_pago'); ?>
		<?php echo $form->textField($model,'hora_pago'); ?>
		<?php echo $form->error($model,'hora_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado_compra'); ?>
		<?php echo $form->textField($model,'estado_compra',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'estado_compra'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado_pago'); ?>
		<?php echo $form->textField($model,'estado_pago',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'estado_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'moneda'); ?>
		<?php echo $form->textField($model,'moneda',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'moneda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payer_info_email'); ?>
		<?php echo $form->textField($model,'payer_info_email',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'payer_info_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payer_id'); ?>
		<?php echo $form->textField($model,'payer_id',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'payer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_compra'); ?>
		<?php echo $form->textField($model,'id_compra',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'id_compra'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_api_call'); ?>
		<?php echo $form->textField($model,'id_api_call',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'id_api_call'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_producto'); ?>
		<?php echo $form->textField($model,'id_producto'); ?>
		<?php echo $form->error($model,'id_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms_id'); ?>
		<?php echo $form->textField($model,'sms_id',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'sms_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms_sc'); ?>
		<?php echo $form->textField($model,'sms_sc',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sms_sc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms_contenido'); ?>
		<?php echo $form->textField($model,'sms_contenido',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sms_contenido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms_key_name'); ?>
		<?php echo $form->textField($model,'sms_key_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sms_key_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'redirect_url'); ?>
		<?php echo $form->textField($model,'redirect_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'redirect_url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->