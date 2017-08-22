<?php
/* @var $this CategoriasContenidoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categorias Contenidos',
);

$this->menu=array(
	array('label'=>'Create CategoriasContenido', 'url'=>array('create')),
	array('label'=>'Manage CategoriasContenido', 'url'=>array('admin')),
);
?>

<h1>Categorias Contenidos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
