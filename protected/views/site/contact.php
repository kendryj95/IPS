<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contáctanos';

?>

<div id="page-content-wrapper">

	<div class="col-sm-offset-3 col-sm-6">


		<?php if(Yii::app()->user->hasFlash('contact')): ?>
		<fieldset class="login-border">
			<legend class="login-border"><b>ENVIADO...!!</b></legend>
			<!--		<div class="flash-success">-->
			<?php echo Yii::app()->user->getFlash('contact'); ?>
			<!--		</div>-->

			<?php else: ?>
				<div class="alert alert-info">
					<p>Si tiene alguna pregunta, rellene el siguiente formulario para ponerse en contacto con nosotros. Gracias.</p>
				</div>
				<fieldset class="login-border">
					<legend class="login-border"><b>CONTACTO</b></legend>
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

