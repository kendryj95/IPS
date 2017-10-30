<?php
/* @var $this PaquetesSaldosController */
/* @var $model PaquetesSaldos */

$this->breadcrumbs=array(
	'Paquetes Saldoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaquetesSaldos', 'url'=>array('index')),
	array('label'=>'Manage PaquetesSaldos', 'url'=>array('admin')),
);
?>

<h1>Create PaquetesSaldos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>