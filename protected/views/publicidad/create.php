<?php
/* @var $this PublicidadController */
/* @var $model Publicidad */

$this->breadcrumbs=array(
	'Publicidads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Publicidad', 'url'=>array('index')),
	array('label'=>'Manage Publicidad', 'url'=>array('admin')),
);
?>

<h1>Create Publicidad</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>