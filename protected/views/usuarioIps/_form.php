<script type="text/javascript">
	
	$(document).ready(function() {
		
		$('.control-label').css('display','block'); // forzar el los label a block
		$('#UsuarioIps_email').attr('type', 'hidden'); // Me sirve para setear el verdadero campo que actualiza en BD
		$('#UsuarioIps_telefono').attr('type', 'hidden'); // Me sirve para setear el verdadero campo que actualiza en BD
		var valuesEmail = $('#UsuarioIps_email').val();
		var valuesTlf = $('#UsuarioIps_telefono').val();
		var splitEmail = valuesEmail.split(',');
		var splitTlf = valuesTlf.split(',');
		var countMailBD = splitEmail.length;
		var countTlfBD = splitTlf.length;
		var html = '';

		<?php if($preferencias != ""): ?> // Esta parte es donde se setea el widget de select multiple de Yii
			$('#PreferenciasUsuarioips_id_categoria').val("<?= $preferencias ?>");
		<?php endif; ?>

		if (countMailBD > 1) {

			for (var i = 2; i <= countMailBD; i++) { // Bucle para obtener todos los correos de Base de datos y crearlos con sus
				$('#em1').val(splitEmail[0]); 		 // respectivos input's.
				html = '<div class="parent"><input style="margin-top: 10px" type="email" name="" class="form-control correo form-actions" placeholder="Correo" value="'+splitEmail[i-1]+'">';
			html += '<button type="button" class="btn btn-danger btn-sm btn-actions removeEmail" title="Agregar otro email"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
			$('#emails').append(html);
			} 

		} else {

			$('#em1').val(splitEmail[0]);

		}

		if (countTlfBD > 1) {

			for (var i = 2; i <= countTlfBD; i++) { // Bucle para obtener todos los telefonos de Base de datos y crearlos con sus
				$('#tlf1').val(splitTlf[0]); 		 // respectivos input's.
				html = '<div class="parent"><input style="margin-top: 10px" type="text" name="" class="form-control tlf form-actions" placeholder="Telefono" value="'+splitTlf[i-1]+'">';
			html += '<button type="button" class="btn btn-danger btn-sm btn-actions removeTlf" title="Agregar otro tlf"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
			$('#telefonos').append(html);
			}

		} else {

			$('#tlf1').val(splitTlf[0]);

		}

		$('#addEmail').on('click',function(){ // Evento que agrega más campos email's.

			var countEmail = $('.correo').length + 1;
			var html = '<div class="parent"><input style="margin-top: 10px" type="email" name="" class="form-control correo form-actions" placeholder="Correo">';
			html += '<button type="button" class="btn btn-danger btn-sm btn-actions removeEmail" title="Agregar otro email"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
			$('#emails').append(html);

		});

		$('#addTlf').on('click',function(){ // Evento que agrega más campos tlfn's.

			var countTlf = $('.tlf').length + 1;
			var html = '<div class="parent"><input style="margin-top: 10px" type="text" name="" class="form-control tlf form-actions" placeholder="Telefono">';
			html += '<button type="button" class="btn btn-danger btn-sm btn-actions removeTlf" title="Agregar otro tlf"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
			$('#telefonos').append(html);

		});

		$(document).on('click','.removeEmail',function(){ // Elimina el campo email posicionado.
			
			var sel = $(this).parents().get(0);
			$(sel).remove();

		});

		$(document).on('click','.removeTlf',function(){ // Elimina el campo telefono posicionado.
			
			var sel = $(this).parents().get(0);
			$(sel).remove();

		});

		$('#update').on('click',function(){ // Btn de "actualizar".
			
			var arrayEmails = new Array;
			var arrayTlf = new Array;

			$('.correo').each(function(){
				arrayEmails.push($(this).val());
			});

			$('.tlf').each(function(){
				arrayTlf.push($(this).val());
			});
			
			$('#UsuarioIps_email').val(arrayEmails.join());
			$('#UsuarioIps_telefono').val(arrayTlf.join());

			$('#update').on('click'); // Forzar a que se envíe el formulario.
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

				<?php if(Yii::app()->user->hasFlash('profile')): ?>
					<div class="row">
						<div class="col-sm-12">
							<?php echo Yii::app()->user->getFlash('profile'); ?>
						</div>
					</div>
				<?php endif; ?>

					<div class="row">
						<div class="col-sm-6">
							<?php echo $form->textFieldGroup($model,'nombres',array('widgetOptions' => array('size'=>30, 'maxlength'=>50))) ?>
						</div>
						<div class="col-sm-6">
							<?php echo $form->textFieldGroup($model,'apellidos',array('widgetOptions' => array('size'=>30, 'maxlength'=>50))) ?>
						</div>
					</div>

					<div class="row">
						
						<div class="col-sm-6">
						<?php echo $form->textFieldGroup($model,'email',array('widgetOptions' => array('size'=>60, 'maxlength'=>250))) ?>
							<input type="email" name="" id="em1" class="form-control correo form-actions" placeholder="Correo"><button type="button" id="addEmail" class="btn btn-success btn-sm btn-actions" title="Agregar otro email"><i class="fa fa-plus" aria-hidden="true"></i></button>
							<div id="emails"></div>
						</div>
						
					

						<div class="col-sm-6">
							<?php echo $form->textFieldGroup($model,'telefono',array('widgetOptions' => array('size'=>15,'maxlength'=>15))); ?>
							<input type="text" name="" id="tlf1" class="form-control tlf form-actions" placeholder="Telefono"><button type="button" id="addTlf" class="btn btn-success btn-sm btn-actions" title="Agregar otro tlf"><i class="fa fa-plus" aria-hidden="true"></i></button>
							<div id="telefonos"></div>
						</div>
					</div><br>

					<div>
							<?php 
								$categorias = array();
								foreach ($modelCategoria as $value) {
									if ($value->abreviatura != '') {
										$categorias[] = $value->abreviatura;
									}
								}
							 ?>
						<?php echo $form->textFieldGroup($model,'direccion',array('widgetOptions' => array('size'=>60, 'maxlength'=>100))) ?>
					</div>

					<div>
						<?php echo $form->select2Group(
										$modelPreferencias,
										'id_categoria',
										array(
											'wrapperHtmlOptions' => array(
												'class' => 'col-sm-6',
											),
											'widgetOptions' => array(
												'asDropDownList' => false,
												'options' => array(
													'tags' => $categorias,
													'placeholder' => 'Preferencia Deportivas',
													/* 'width' => '40%', */
													'tokenSeparators' => array(',', ' ')
												),
											)
										)
									);?>
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