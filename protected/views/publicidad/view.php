<?php
/* @var $this PublicidadController */
/* @var $model Publicidad */

$this->breadcrumbs=array(
	'Publicidads'=>array('index'),
	$model->idpublicidad,
);

$this->menu=array(
	array('label'=>'List Publicidad', 'url'=>array('index')),
	array('label'=>'Create Publicidad', 'url'=>array('create')),
	array('label'=>'Update Publicidad', 'url'=>array('update', 'id'=>$model->idpublicidad)),
	array('label'=>'Delete Publicidad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idpublicidad),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Publicidad', 'url'=>array('admin')),
);
?>

<h1>View Publicidad #<?php echo $model->idpublicidad; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idpublicidad',
		'idtipo_publicidad',
		'nombre_de_archivo',
		'titulo',
		'descripcion',
		'status',
	),
)); ?>
