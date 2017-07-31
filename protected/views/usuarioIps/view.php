<?php
/* @var $this UsuarioIpsController */
/* @var $model UsuarioIps */

$this->breadcrumbs=array(
	'Usuario Ips'=>array('index'),
	$model->idusuario_ips,
);

$this->menu=array(
	array('label'=>'List UsuarioIps', 'url'=>array('index')),
	array('label'=>'Create UsuarioIps', 'url'=>array('create')),
	array('label'=>'Update UsuarioIps', 'url'=>array('update', 'id'=>$model->idusuario_ips)),
	array('label'=>'Delete UsuarioIps', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idusuario_ips),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsuarioIps', 'url'=>array('admin')),
);
?>

<h1>View UsuarioIps #<?php echo $model->idusuario_ips; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idusuario_ips',
		'email',
		'telefono',
		'login',
		'pwd',
		'estatus',
		'fecha_creado',
		'hora_creado',
		'fecha_expiracion',
		'hora_expiracion',
		'tipo_usuario',
	),
)); ?>
