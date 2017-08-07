<script type="text/javascript">
	
	$(document).ready(function() {
		
		//$('#emails > .form-group input[type="text"]').addClass('form-actions');
		//$('#emails > .form-group').append('<button type="button" class="btn btn-success btn-sm btn-actions" title="Agregar otro email"><i class="fa fa-plus" aria-hidden="true"></i></button>');
		$('.control-label').css('display','block');
		$('#UsuarioIps_email').attr('type', 'hidden');
		var valuesEmail = $('#UsuarioIps_email').val();
		var splitEmail = valuesEmail.split(',');

		//if (splitEmail.length > 1) {
//
		//	for (var i = 1; i <= splitEmail.length; i++) {
		//		$('#em'+i).val(splitEmail[i-1]);
		//	}
//
		//} else {

			$('#em1').val(splitEmail[0]);

		//}

		$('#addEmail').on('click',function(){

			var countEmail = $('.correo').length + 1;
			var html = '<div class="parent"><input style="margin-top: 10px" type="email" name="" id="em'+countEmail+'" class="form-control correo form-actions" placeholder="Correo">';
			html += '<button type="button" class="btn btn-danger btn-sm btn-actions removeEmail" title="Agregar otro email"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
			$('#emails').append(html);

		});

		$(document).on('click','.removeEmail',function(){
			
			var sel = $(this).parents().get(0);
			$(sel).remove();

		});

		$('#update').on('click',function(){
			
			var arrayEmails = new Array;

			$('.correo').each(function(){
				arrayEmails.push($(this).val());
			});
			
			//console.log(arrayEmails.join());
			$('#UsuarioIps_email').val(arrayEmails.join());
			$('#update').on('click');
		});


	});

</script>

<div  id="page-content-wrapper">
	<div class="col-sm-offset-3 col-sm-6">
					<fieldset class="login-border">
					<legend class="login-border"><b>DATOS DE USUARIO</b></legend>
<?php
/* @var $this UsuarioIpsController */
/* @var $model UsuarioIps */
/* @var $form CActiveForm */
?>

	<div class="form">

		<?php $form = $this->beginWidget('booster.widgets.TbActiveForm',
			array('id'=>'usuario-ips-form', 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true),
				//'type' => 'horizontal',
				//'htmlOptions' => array('style'=>'aling:center'),
				//'htmlOptions' => array('class' => 'well'),
			)); 
		?>
		<div class="row">
			
		</div>
		<!-- <p class="note"><strong>Los campos con <span class="required">*</span> son obligatorios.</strong></p> -->
		<?php //echo $form->errorSummary($model); ?>

		<?php if($model->isNewRecord){ ?>
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
		<?php } else{ ?>

					<div>
						
						<?php echo $form->textFieldGroup($model,'email',array('widgetOptions' => array('size'=>60, 'maxlength'=>250))) ?>
						<input type="email" name="" id="em1" class="form-control correo form-actions" placeholder="Correo"><button type="button" id="addEmail" class="btn btn-success btn-sm btn-actions" title="Agregar otro email"><i class="fa fa-plus" aria-hidden="true"></i></button>
						<div id="emails"></div>
					</div><br>

					<div id="telefonos">
						<?php echo $form->textFieldGroup($model,'telefono',array('widgetOptions' => array('size'=>15,'maxlength'=>15))); ?>
					</div>

					<div>
						<?php echo $form->passwordFieldGroup($model,'pwd',array('widgetOptions' => array('size'=>60,'maxlength'=>90))); ?>
					</div>
					<div>
						<?php echo $form->passwordFieldGroup($model,'confirm_password', array('widgetOptions' => array('size'=>60,'maxlength'=>90))); ?>
					</div>
					
		

		<?php } ?>
				<div style="text-align: center;">
					<?php 
						$this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'success', 'label' => 'Actualizar', 'size' => 'medium','htmlOptions' => array('id' => 'update')));
					?>	
				</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
	</fieldset>
	</div>
</div>