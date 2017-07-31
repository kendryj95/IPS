<?php
/* @var $this UsuarioIpsController */
/* @var $model UsuarioIps */

$this->breadcrumbs=array(
	'Usuario Ips'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsuarioIps', 'url'=>array('index')),
	array('label'=>'Manage UsuarioIps', 'url'=>array('admin')),
);
?>

<h1>Create UsuarioIps</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>