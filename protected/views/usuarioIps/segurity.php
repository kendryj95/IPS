<div  id="page-content-wrapper">
	<div class="col-sm-offset-3 col-sm-6">

	<fieldset class="login-border">
		<legend class="login-border">SEGURIDAD</legend>

		<?php
			if(Yii::app()->user->hasFlash('segurity')){
				echo Yii::app()->user->getFlash('segurity');
			}
		?>

		<div class="text-center">
			<h4>Por tu seguridad y la de tus datos, favor introducir su contraseña actual</h4>
		</div>

		<form method="post" action="<?= Yii::app()->createUrl('usuarioips/segurity') ?>">
			<div class="form-group">
				<input class="form-control" type="password" name="confirm" placeholder="Introduce tu contraseña"></input>
			</div>
		</form>
	</fieldset>
	
	</div>
</div>