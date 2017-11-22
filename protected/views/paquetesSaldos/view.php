<?php
/* @var $this PaquetesSaldosController */
/* @var $model PaquetesSaldos */

$this->breadcrumbs=array(
	'Paquetes Saldoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PaquetesSaldos', 'url'=>array('index')),
	array('label'=>'Create PaquetesSaldos', 'url'=>array('create')),
	array('label'=>'Update PaquetesSaldos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaquetesSaldos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PaquetesSaldos', 'url'=>array('admin')),
);
?>

<h1>View PaquetesSaldos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'saldo',
	),
)); ?>
