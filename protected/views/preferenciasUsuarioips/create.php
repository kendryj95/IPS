<?php
/* @var $this PreferenciasUsuarioipsController */
/* @var $model PreferenciasUsuarioips */

$this->breadcrumbs=array(
	'Preferencias Usuarioips'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PreferenciasUsuarioips', 'url'=>array('index')),
	array('label'=>'Manage PreferenciasUsuarioips', 'url'=>array('admin')),
);
?>

<h1>Create PreferenciasUsuarioips</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>