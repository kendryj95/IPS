<?php
/* @var $this UsuarioIpsController */
/* @var $model UsuarioIps */

$this->breadcrumbs=array(
	'Usuario Ips'=>array('index'),
	$model->idusuario_ips=>array('view','id'=>$model->idusuario_ips),
	'Update',
);
/*
$this->menu=array(
	array('label'=>'List UsuarioIps', 'url'=>array('index')),
	array('label'=>'Create UsuarioIps', 'url'=>array('create')),
	array('label'=>'View UsuarioIps', 'url'=>array('view', 'id'=>$model->idusuario_ips)),
	array('label'=>'Manage UsuarioIps', 'url'=>array('admin')),
);*/
?>
<h2 style="text-align: center;">Actualizar perfil</h2>
<hr>
<?php $this->renderPartial('_form', array('model'=>$model,'modelCategoria'=>$modelCategoria,'modelPreferencias'=>$modelPreferencias,'modelContacto'=>$modelContacto,'preferencias'=>$preferencias,'contactosEmail'=>$contactosEmail, 'contactosTlf' => $contactosTlf)); ?>