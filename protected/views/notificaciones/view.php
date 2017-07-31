<?php
/* @var $this NotificacionesController */
/* @var $model Notificaciones */

$this->breadcrumbs=array(
	'Notificaciones'=>array('index'),
	$model->id_notificacion,
);

$this->menu=array(
	array('label'=>'List Notificaciones', 'url'=>array('index')),
	array('label'=>'Create Notificaciones', 'url'=>array('create')),
	array('label'=>'Update Notificaciones', 'url'=>array('update', 'id'=>$model->id_notificacion)),
	array('label'=>'Delete Notificaciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_notificacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Notificaciones', 'url'=>array('admin')),
);
?>

<h1>View Notificaciones #<?php echo $model->id_notificacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_notificacion',
		'idusuario_ips',
		'id_cliente',
		'asunto',
		'mensaje',
		'fecha',
		'hora',
		'estado',
	),
)); ?>
