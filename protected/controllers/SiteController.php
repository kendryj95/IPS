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
		$categorias = CategoriasContenido::model()->findAll();
		$productos_promo = ProductosDigitales::model()->findallbyattr(1);
		$saldo_ips = null;
		if (!Yii::app()->user->isGuest) {
			$saldo_ips = SaldosUsuariosIps::model()->find('id_usuario='.Yii::app()->user->id);
		}
		
		$this->render('index', array('images_carousel' => $images_carousel, 'productos_promo' => $productos_promo, 'categorias' => $categorias, 'saldo_ips' => $saldo_ips));
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
		Yii::import('application.extensions.phpmailer.JPhpMailer');

        if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				/*$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";*/

                $mail = new JPhpMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "mail.insigniamobile.com.ve"; // insignia.com.ve
                $mail->Port = 465; // 995 ó 993
                $mail->Username = "notificaciones@insigniamobile.com.ve"; // mi correo
                $mail->Password = "qwe123"; // mi contraseña

                $mail->From = $model->email; // administrador
                $mail->FromName = $name;
                $mail->Subject = $subject;
                $mail->AltBody = "";
                $mail->MsgHTML("<h1>".$model->body."</h1>");
                $mail->AddAddress(Yii::app()->params['adminEmail']);
                $mail->IsHTML(true);
                $mail->Send();

               # mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);

				Yii::app()->user->setFlash('contact','<div class="alert alert-success"><b>Gracias por contactarnos!</b> Su mensaje será respondido lo más pronto posible.</div>');
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

	public function actionDetallesPD(){

		$json = array();

		$id = isset($_POST['id']) ? $_POST['id'] : '';

		$productos_promo = ProductosDigitales::model()->findallbyattr(1, 'pd.id_producto',$id);

		/*echo "<pre>";
		print_r($productos_promo);
		echo "</pre>";
		exit;*/

		$sql = "SELECT 
				    GROUP_CONCAT(p.id_producto
				        SEPARATOR ',') AS id_producto,
				    p.desc_producto,
				    p.cliente,
					c.Des_cliente
				FROM
				    sms.producto p INNER JOIN sms.cliente c ON p.cliente = c.Id_cliente
				WHERE
				    p.id_producto IN ($id)";

		$detail = Yii::app()->db_sms->createCommand($sql)->query()->read();

		if ($detail) {
			$json['fallo'] = array('msg' => 'NO');
			$json['detalle'] = array(
					'nombre_cliente' => $detail['Des_cliente'],
					'nombre_producto' => $productos_promo[0]['nombre_producto'],
					'categoria' => $productos_promo[0]['deporte'],
					'subcategoria' => $productos_promo[0]['abrev_deporte'],
					'tipo_contenido' => ucfirst($productos_promo[0]['tipo_contenido'])." (".$productos_promo[0]['abrev_tipo'].")",
					'precio' => '$ '. number_format((float)$productos_promo[0]['precio'], 2, '.', ''),

				);
		} else {
			$json['fallo'] = array(
				'msg' => 'SI'
				);
		}

		echo json_encode($json);
	}

	public function actionBusqueda(){

		define('PRODUCTO',1);
		define('PAIS',3);
		define('CLIENTE',2);
		define('SUBCATEGORIA',4);
		define('CATEGORIA',5);

		$search = isset($_POST['text_search']) ? $_POST['text_search'] : '';

		if ($search != "") {

			$tipo = $_POST['tipo_search'];

			switch ($tipo) {
				case PRODUCTO:
					$productos_promo = ProductosDigitales::model()->findallbyattr(2, 'p.desc_producto', "'%".$search."%'");
					break;
				case PAIS:
					$sql = "SELECT 
							    idcategorias_contenido AS id_cat
							FROM
							    insignia_payments_solutions.categorias_contenido WHERE pais LIKE '".$search."%'";

					$id_cat = Yii::app()->db_sms->createCommand($sql)->query()->read();

					$productos_promo = ProductosDigitales::model()->findallbyattr(1, 'pd.id_categoria',$id_cat['id_cat']);
					break;
				case CLIENTE:
					$sql = "SELECT 
					    GROUP_CONCAT(p.id_producto
					        SEPARATOR ',') AS id_producto,
					    p.desc_producto,
					    p.cliente,
						c.Des_cliente
					FROM
					    sms.producto p INNER JOIN sms.cliente c ON p.cliente = c.Id_cliente
					WHERE
					    c.Des_cliente LIKE '%".$search."%'";

					$id_productos = Yii::app()->db_sms->createCommand($sql)->query()->read();

					$productos_promo = ProductosDigitales::model()->findallbyattr('pd.id_producto',$id_productos['id_producto'],1);
					
					break;
				case SUBCATEGORIA:
					$productos_promo = ProductosDigitales::model()->findallbyattr(1, 'cc.abreviatura',"'".$search."'");
					break;
				case CATEGORIA:
					$productos_promo = ProductosDigitales::model()->findallbyattr(1, 'cc.deporte',"'".$search."'");
					break;
			}

			$this->render('search',array('productos_promo' => $productos_promo));

		} else {
			$this->redirect(Yii::app()->user->returnUrl);
		}
	}

	public function actionProd_categoria($cat)
	{

		$cat = isset($cat) ? $cat : '';

		if ($cat != "") {
			$productos_promo = ProductosDigitales::model()->findallbyattr(1, 'cc.abreviatura',"'".$cat."'");
			$this->render('search',array('productos_promo' => $productos_promo));
		} else {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		
		
	}
}