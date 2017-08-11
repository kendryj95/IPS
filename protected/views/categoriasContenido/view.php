<?php
/* @var $this CategoriasContenidoController */
/* @var $model CategoriasContenido */

$this->breadcrumbs=array(
	'Categorias Contenidos'=>array('index'),
	$model->idcategorias_contenido,
);

$this->menu=array(
	array('label'=>'List CategoriasContenido', 'url'=>array('index')),
	array('label'=>'Create CategoriasContenido', 'url'=>array('create')),
	array('label'=>'Update CategoriasContenido', 'url'=>array('update', 'id'=>$model->idcategorias_contenido)),
	array('label'=>'Delete CategoriasContenido', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcategorias_contenido),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoriasContenido', 'url'=>array('admin')),
);
?>

<h1>View CategoriasContenido #<?php echo $model->idcategorias_contenido; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcategorias_contenido',
		'descripcion',
		'deporte',
		'abreviatura',
		'pais',
	),
)); ?>
