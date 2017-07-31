<div  id="page-content-wrapper">

	<?php
	/* @var $this SiteController */
	/* @var $model LoginForm */
	/* @var $form CActiveForm  */

	$this->pageTitle=Yii::app()->name . ' - Registro';
	?>

	<div class="col-sm-4"></div>

	<div class="col-sm-4">
		<fieldset class="login-border">
			<legend class="login-border"><strong>REGISTRO</strong></legend>
			<?php 
				$form = $this->beginWidget(
					'booster.widgets.TbActiveForm',
					array(
						'id' => 'signup-form',
						'enableClientValidation'=>true,
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),
						//'type' => 'horizontal',
						//'htmlOptions' => array('style'=>'aling:center'),
						//'htmlOptions' => array('class' => 'well'),
					)
				);
			?>	

			<div>
				<?php echo $form->textFieldGroup($model, 'email', array('prepend' => '<i class="glyphicon glyphicon-envelope"></i>', 'widgetOptions' => array())); ?>
			</div>

			<div>
				<?php echo $form->textFieldGroup($model, 'phone_number', array('prepend' => '<i class="glyphicon glyphicon-phone"></i>', 'widgetOptions' => array())); ?>
			</div>

			<div>
				<?php echo $form->textFieldGroup($model,'login', array('prepend' => '<i class="glyphicon glyphicon-user"></i>', 'widgetOptions' => array())); ?>
			</div>

			<div>
				<?php echo $form->passwordFieldGroup($model, 'password', array('prepend' => '<i class="glyphicon glyphicon-lock"></i>','widgetOptions' => array())); ?>
			</div>

			<div>
				<?php echo $form->passwordFieldGroup($model, 'confirm_password', array('prepend' => '<i class="glyphicon glyphicon-lock"></i>','widgetOptions' => array())); ?>
			</div>

			<div style="text-align: center;">
				<?php 
					$this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'success', 'label' => 'Registrarme', 'size' => 'medium'));
				?>	
			</div>
			<?php $this->endWidget(); ?>
		</fieldset>
	</div><!-- form -->
		

	<div class="col-sm-4"></div>

</div>