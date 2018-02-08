<?php
Yii::import('application.extensions.shoppingCart.ECartPositionBehaviour');

class NotificacionesController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','admin','agregarNotificacion','entregarContenido'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Notificaciones;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Notificaciones']))
		{
			$model->attributes=$_POST['Notificaciones'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_notificacion));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Notificaciones']))
		{
			$model->attributes=$_POST['Notificaciones'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_notificacion));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionAgregarNotificacion(){
		$model = new Notificaciones;
		$purchase_id = $_POST['purchase_id'];
		$payment_id = $_POST['payment_id'];

		$criteria = new CDbCriteria;
		$criteria->condition = 'id_compra = "'.$purchase_id.'" AND id_api_call = "'.$payment_id.'" AND estado_compra = "completed" AND estado_pago = "approved"';
		$compra_realizada = Pagos::model()->findAll($criteria);

		/*echo "<pre>";
		print_r($compra_realizada);
		echo "</pre>";*/

		$model->idusuario_ips = 8;
		$model->id_cliente = 32;
		$model->asunto = 'Gracias por su compra';
		$model->mensaje = 'Haga click en el ticket para disfrutar de su contenido';
		$model->fecha = date("Y-m-d");
		$model->hora = date("H:i:s");
		$model->estado = 0;
		$model->id_compra = $purchase_id;

		if(!$model->save()){
			$registrado = false;
		}else{
			$registrado = true;
			Yii::app()->shoppingCart->clear();
		}
		
		header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('registrado' => $registrado, 'error'=>$model->getErrors()));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		$model=new Notificaciones('search');
		$model->unsetAttributes();

		if (isset($_REQUEST['tkn'])) {
			
			$token = $_REQUEST['tkn'];

			// if ($token != null && $token != '') {
				$criteria = new CDbCriteria;
				$criteria->condition = 'id_usuario='.Yii::app()->user->id.' AND token="'.$token.'" AND consumido=0';

				$consumirSaldo = SaldosUsuariosIps::model()->find($criteria);

				if ($consumirSaldo) {

					$newSaldo = floatval(Yii::app()->user->getState('saldo_ips')) + floatval($consumirSaldo->saldo_ips);
					Yii::app()->user->setState('saldo_ips', number_format($newSaldo,2,'.',''));

					$update=Yii::app()->db->createCommand()
					->update('saldos_usuarios_ips', array(
						'saldo_ips'=>floatval($newSaldo),
					    'consumido'=>1
					), 'id_usuario=:id', array(':id'=>Yii::app()->user->id));
				}
			// }
		}

		if (isset($_REQUEST["paymentId"]) && isset($_REQUEST["idCompra"])) {
			Yii::app()->shoppingCart->clear();
		}


		if(isset($_REQUEST['Notificaciones']))
			$model->attributes=$_REQUEST['Notificaciones'];

		$this->render('index',array('model'=>$model));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Notificaciones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Notificaciones']))
			$model->attributes=$_GET['Notificaciones'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Notificaciones the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Notificaciones::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Notificaciones $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='notificaciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionEntregarContenido(){
	    $id_compra = "";

	    if (isset($_GET['id_compra'])) {
	    	$id_compra = $_GET['id_compra'];
	    }

	    $notificacion_compras = Notificaciones::model()->detalle_compra($id_compra);

		$notificacion_leida = Notificaciones::model()->findByAttributes(array('id_compra' => $id_compra));
		$notificacion_leida->estado = 1;
		$notificacion_leida->save();

	    header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('id_compra' => "<strong>".$id_compra."</strong>", 'notificacion_compras' => $notificacion_compras));
	}
}
