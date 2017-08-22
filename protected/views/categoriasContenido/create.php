<?php
/* @var $this CategoriasContenidoController */
/* @var $model CategoriasContenido */

$this->breadcrumbs=array(
	'Categorias Contenidos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoriasContenido', 'url'=>array('index')),
	array('label'=>'Manage CategoriasContenido', 'url'=>array('admin')),
);
?>

<h1>Create CategoriasContenido</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>