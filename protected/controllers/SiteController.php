<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page

			'captcha' => array(  
				'class'=>'CaptchaExtendedAction',
                'mode'=>CaptchaExtendedAction::MODE_MATH,
            ),  

			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function filters() {
	    return array(
	    	array('booster.filters.BoosterFilter')
	    );
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$images_carousel = Publicidad::model()->findallbytypeimage("Carrusel");
		$productos_promo = ProductosDigitales::model()->findallbyattr();

		$this->render('index', array('images_carousel' => $images_carousel, 'productos_promo' => $productos_promo));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		$model->scenario = 'loginNormal';

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionSignUp()
	{
		$model = new SignupForm;
		$newUser = new UsuarioIps;
		$newContact_email = new ContactoUsuario;
		$newContact_phone = new ContactoUsuario;
		$model_login = new LoginForm;
		$model_login->scenario = 'loginAutomatico';

		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['SignupForm']))
		{
			$model->attributes=$_POST['SignupForm'];

			// validate user input and redirect to the previous page if valid
			if($model->validate()){

				$transaction=Yii::app()->db->beginTransaction();
				
				$newUser->login = $model->login;
				$newUser->pwd = md5($model->password);
				$newUser->email = $model->email;
				$newUser->telefono = $model->phone_number;
				$newUser->estatus = 1;
				$newUser->fecha_creado = date("Y-m-d");
				$newUser->hora_creado = date("H:i:s");
				$newUser->tipo_usuario = 'registrado';

				if($newUser->save(false)) {
					// Everything saved, redirect
					$newContact_email->idusuario_ips = $newUser->getPrimaryKey();
					$newContact_email->valor = $model->email;
					$newContact_email->tipo_contacto = 'email';

					$newContact_phone->idusuario_ips = $newUser->getPrimaryKey();
					$newContact_phone->valor = $model->phone_number;
					$newContact_phone->tipo_contacto = 'telefono';
					
					
					if(($newContact_email->save(true)) && ($newContact_phone->save(true))){
						$transaction->commit();

						$model_login->username = $model->login;
						$model_login->password = $model->password;

						if($model_login->login()){
							$this->redirect(Yii::app()->user->returnUrl);	
						}
					}
					else {
						/*echo "<pre>";
						print_r($newContact->getErrors());
						echo "</pre>";*/
	                    $transaction->rollBack();
                	}   
				}else{
					/*echo "<pre>";
					print_r($newUser->getErrors());
					echo "</pre>";*/
				}
			}
		}

		// display the login form*/
		$this->render('signup', array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}