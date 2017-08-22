<?php
/* @var $this PreferenciasUsuarioipsController */
/* @var $model PreferenciasUsuarioips */

$this->breadcrumbs=array(
	'Preferencias Usuarioips'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PreferenciasUsuarioips', 'url'=>array('index')),
	array('label'=>'Create PreferenciasUsuarioips', 'url'=>array('create')),
	array('label'=>'Update PreferenciasUsuarioips', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PreferenciasUsuarioips', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PreferenciasUsuarioips', 'url'=>array('admin')),
);
?>

<h1>View PreferenciasUsuarioips #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_usuario',
		'id_categoria',
	),
)); ?>
