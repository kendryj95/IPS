<?php
/* @var $this CategoriasContenidoController */
/* @var $model CategoriasContenido */

$this->breadcrumbs=array(
	'Categorias Contenidos'=>array('index'),
	$model->idcategorias_contenido=>array('view','id'=>$model->idcategorias_contenido),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoriasContenido', 'url'=>array('index')),
	array('label'=>'Create CategoriasContenido', 'url'=>array('create')),
	array('label'=>'View CategoriasContenido', 'url'=>array('view', 'id'=>$model->idcategorias_contenido)),
	array('label'=>'Manage CategoriasContenido', 'url'=>array('admin')),
);
?>

<h1>Update CategoriasContenido <?php echo $model->idcategorias_contenido; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>