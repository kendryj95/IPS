<?php
/* @var $this HistorialSaldosUsuariosIpsController */
/* @var $model HistorialSaldosUsuariosIps */

$this->breadcrumbs=array(
	'Historial Saldos Usuarios Ips'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List HistorialSaldosUsuariosIps', 'url'=>array('index')),
	array('label'=>'Create HistorialSaldosUsuariosIps', 'url'=>array('create')),
	array('label'=>'Update HistorialSaldosUsuariosIps', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HistorialSaldosUsuariosIps', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HistorialSaldosUsuariosIps', 'url'=>array('admin')),
);
?>

<h1>View HistorialSaldosUsuariosIps #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_usuario',
		'saldo_ips',
		'cambios',
		'fecha_actualizacion',
	),
)); ?>
