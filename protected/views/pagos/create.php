<?php
/* @var $this PagosController */
/* @var $model Pagos */

$this->breadcrumbs=array(
	'Pagoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pagos', 'url'=>array('index')),
	array('label'=>'Manage Pagos', 'url'=>array('admin')),
);
?>

<h1>Create Pagos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>