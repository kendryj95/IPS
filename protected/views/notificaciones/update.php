<?php
/* @var $this NotificacionesController */
/* @var $model Notificaciones */

$this->breadcrumbs=array(
	'Notificaciones'=>array('index'),
	$model->id_notificacion=>array('view','id'=>$model->id_notificacion),
	'Update',
);

$this->menu=array(
	array('label'=>'List Notificaciones', 'url'=>array('index')),
	array('label'=>'Create Notificaciones', 'url'=>array('create')),
	array('label'=>'View Notificaciones', 'url'=>array('view', 'id'=>$model->id_notificacion)),
	array('label'=>'Manage Notificaciones', 'url'=>array('admin')),
);
?>

<h1>Update Notificaciones <?php echo $model->id_notificacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>