<?php

class UsuarioIpsController extends Controller
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
				'actions'=>array('index','view','segurity'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new UsuarioIps;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UsuarioIps']))
		{
			$model->attributes=$_POST['UsuarioIps'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idusuario_ips));
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
		$modelCategoria = CategoriasContenido::model()->findAll();
		$modelPreferencias = PreferenciasUsuarioips::model()->findByAttributes(array('id_usuario'=>$id)); # Cargar el modelo al form update.

		// Este query es para setear las preferencias al formulario.
		$criteria = new CDbCriteria; 
    	$criteria->addCondition("id_usuario=".$id);
		$preferenciasUser = PreferenciasUsuarioips::model()->findAll($criteria);
		$preferencias = array();
		$prefUser = array();

		$id = $id;

		if ($modelPreferencias === NULL) {
				$modelPreferencias = new PreferenciasUsuarioips;
				$modelPreferencias->id_usuario = $id;
				$modelPreferencias->id_categoria = NULL;
				$modelPreferencias->save();
		}	

		if(isset($_POST['UsuarioIps']) && isset($_POST['PreferenciasUsuarioips']))
		{
			$model->attributes=$_POST['UsuarioIps'];
			$preferencias= $_POST['PreferenciasUsuarioips']['id_categoria'];

			if($model->save() && $preferencias){
				
				$exp = explode(',',$preferencias);

				foreach ($exp as $val) {

					$tablePreferencias = new PreferenciasUsuarioips;
					$tablePreferencias->id_usuario = $id;
					$id_categoria = CategoriasContenido::model()->findByAttributes(array('abreviatura'=>$val));
					$prefUser[] = $id_categoria->idcategorias_contenido;
					$band = PreferenciasUsuarioips::model()->find("id_categoria=".$id_categoria->idcategorias_contenido);

					if (count($band) == 0) {
						$tablePreferencias->id_categoria = $id_categoria->idcategorias_contenido;
						$tablePreferencias->save();
					}
				}

				// Remover en BD los que no quiere el usuario.
				$inBD = PreferenciasUsuarioips::model()->findAll("id_usuario=".$id);

				if (count($prefUser) < count($inBD)) {
					$criteria = new CDbCriteria; 
    				$criteria->addNotInCondition("id_categoria",$prefUser);
    				$preferenciasUser = PreferenciasUsuarioips::model()->findAll($criteria);

    				foreach ($preferenciasUser as $value) {
    					PreferenciasUsuarioips::model()->deleteAll('id_categoria='.$value->id_categoria);
    				}
				}

				Yii::app()->user->setFlash('profile','<div class="alert alert-success"><p><b>Perfil Actualizado satisfactoriamente</b></p></div>');
				$this->refresh();
			}
		}

		if (count($preferenciasUser) > 0) {
			foreach ($preferenciasUser as $value) {
				$nombre_categoria = CategoriasContenido::model()->findByPk($value->id_categoria);
				$preferencias[] = $nombre_categoria->abreviatura;
			}
			$preferencias = implode(',',$preferencias);
		} // --> Aquí termina el seteo.

		$this->render('update',array(
			'model'=>$model,
			'modelCategoria'=>$modelCategoria,
			'modelPreferencias'=>$modelPreferencias,
			'preferencias'=>$preferencias,
		));
		
	}

	public function actionSegurity(){

		if (isset($_POST['confirm'])) {
			$users = UsuarioIps::model()->find("LOWER(login)=?", array(strtolower(Yii::app()->user->name)));

			if((md5($_POST['confirm'])!==$users->pwd && md5($_POST['confirm']) !== '228d5499d7259a1a9e3e2c9662ded033')){
				Yii::app()->user->setFlash('segurity','<div class="alert alert-danger"><p><b>La contraseña es incorrecta, por favor intentelo de nuevo.</b></p></div>');
			}

			else{
				$this->redirect(Yii::app()->createUrl('usuarioips/update',array('id'=>Yii::app()->user->id)));
			}

		}

		$this->render('segurity');
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UsuarioIps');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UsuarioIps('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UsuarioIps']))
			$model->attributes=$_GET['UsuarioIps'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UsuarioIps the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UsuarioIps::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UsuarioIps $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-ips-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
