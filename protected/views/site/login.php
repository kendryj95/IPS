<div  id="page-content-wrapper">

	<?php
	/* @var $this SiteController */
	/* @var $model LoginForm */
	/* @var $form CActiveForm  */

	$this->pageTitle=Yii::app()->name . ' - Acceso';
	?>

	<?php 
		$error = false;
		if($error == true): ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span class="glyphicon glyphicon-ban-circle"></span> <?php echo "Acceso Denegado"; ?>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</div>
	<?php endif; ?>
	
	<div class="col-sm-4"></div>

	<div class="col-sm-4">
		<fieldset class="login-border">
			<legend class="login-border"><strong>ACCESO</strong></legend>
			<?php 
				$form = $this->beginWidget('booster.widgets.TbActiveForm',
							array('id' => 'login-form', 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true),
								//'type' => 'horizontal',
								//'htmlOptions' => array('style'=>'aling:center'),
								//'htmlOptions' => array('class' => 'well'),
						));
			?>	
			
			<div>
				<?php echo $form->textFieldGroup($model,'username',array('prepend' => '<i class="glyphicon glyphicon-user"></i>', 'widgetOptions' => array())); ?>
			</div>

			<div>
				<?php echo $form->passwordFieldGroup($model,'password',array('prepend' => '<i class="glyphicon glyphicon-lock"></i>','widgetOptions' => array())); ?>
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

			<div>
				<?php echo $form->checkboxGroup($model, 'rememberMe', array()); ?>
				<?php echo $form->error($model,'rememberMe'); ?>	
			</div>

			<div style="text-align: center;">
				<?php 
					$this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'default','label' => 'Acceder', 'size' => 'medium')); 
					echo "<strong> o </strong>";
					echo CHtml::link('Registrarme', Yii::app()->createUrl('/site/signup'), array('class' => 'btn  btn-primaryIPS'));
				?>	
			</div>
			
			
			<?php $this->endWidget(); ?>	
		</fieldset>
	</div><!-- form -->
		

	<div class="col-sm-4"></div>

</div>