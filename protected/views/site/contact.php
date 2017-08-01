<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contáctanos';

?>

<?php /*if(Yii::app()->user->hasFlash('contact')): */?><!--

<div class="flash-success">
	<?php /*echo Yii::app()->user->getFlash('contact'); */?>
</div>

<?php /*else: */?>

<p>
Si tiene alguna pregunta, rellene el siguiente formulario para ponerse en contacto con nosotros. Gracias.
</p>

<div class="form">

<?php /*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); */?>

	<p class="note"><strong>Campos con <span class="required">*</span> son obligatorios.</strong></p>

	<?php /*echo $form->errorSummary($model); */?>

	<div class="row">
		<?php /*echo $form->labelEx($model,'name'); */?>
		<?php /*echo $form->textField($model,'name'); */?>
		<?php /*echo $form->error($model,'name'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'email'); */?>
		<?php /*echo $form->textField($model,'email'); */?>
		<?php /*echo $form->error($model,'email'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'subject'); */?>
		<?php /*echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); */?>
		<?php /*echo $form->error($model,'subject'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'body'); */?>
		<?php /*echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); */?>
		<?php /*echo $form->error($model,'body'); */?>
	</div>

	<?php /*if(CCaptcha::checkRequirements()): */?>
	<div class="row">
		<?php /*echo $form->labelEx($model,'verifyCode'); */?>
		<div>
		<?php /*$this->widget('CCaptcha'); */?>
		<?php /*echo $form->textField($model,'verifyCode'); */?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php /*echo $form->error($model,'verifyCode'); */?>
	</div>
	<?php /*endif; */?>

	<div class="row buttons">
		<?php /*echo CHtml::submitButton('Submit'); */?>
	</div>

<?php /*$this->endWidget(); */?>

</div><!-- form -->

<?php /*endif; */?>

<div id="page-content-wrapper">

	<div class="col-sm-offset-3 col-sm-6">
		<div class="alert alert-info">
			<p>Si tiene alguna pregunta, rellene el siguiente formulario para ponerse en contacto con nosotros. Gracias.</p>
		</div>
		<fieldset class="login-border">
			<legend class="login-border"><b>CONTACTO</b></legend>

	<?php if(Yii::app()->user->hasFlash('contact')): ?>

<!--		<div class="flash-success">-->
			<?php echo Yii::app()->user->getFlash('contact'); ?>
<!--		</div>-->

	<?php else: ?>

	<?php
	$form = $this->beginWidget('booster.widgets.TbActiveForm',
		array('id' => 'contact-form', 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true),
			//'type' => 'horizontal',
			//'htmlOptions' => array('style'=>'aling:center'),
			//'htmlOptions' => array('class' => 'well'),
		));
	?>
	
	<div>
		<?php echo $form->textFieldGroup($model,'name',array('prepend' => '<i class="glyphicon glyphicon-user"></i>', 'widgetOptions' => array())); ?>
	</div>

	<div>
		<?php echo $form->textFieldGroup($model,'email',array('prepend' => '<i class="glyphicon glyphicon-envelope"></i>', 'widgetOptions' => array())); ?>
	</div>

	<div>
		<?php echo $form->textFieldGroup($model,'subject',array('prepend' => '<i class="glyphicon glyphicon-pencil"></i>', 'widgetOptions' => array())); ?>
	</div>

	<div>
		<?php echo $form->textAreaGroup(
			$model,
			'body',
			array(
				'widgetOptions' => array(
					'htmlOptions' => array('rows' => 6, 'cols' => 50)
				)
			)
		); ?>
	</div>
	
	<div>
		<?php if(CCaptcha::checkRequirements()): ?>
			<div>
				<?php

				$this->widget('CCaptcha');
				echo $form->textFieldGroup($model,'verifyCode', array('widgetOptions' => array('options' => array('placeholder' => 'Por favor, introduzca el resultado')), 'hint' => 'Por favor, coloque el resultado de la operaci&oacute;n matem&aacute;tica que se muestra en la imagen de arriba.'));
				?>
			</div>
		<?php endif; ?>
	</div>

	<div style="text-align: center;">
		<?php
		$this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'success', 'label' => 'Enviar', 'size' => 'medium'));
		?>
	</div>

	<?php $this->endWidget(); ?>
		</fieldset>
	<?php endif; ?>
</div>

