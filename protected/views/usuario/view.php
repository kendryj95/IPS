<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id_usuario,
);

$this->menu=array(
	array('label'=>'List Usuario', 'url'=>array('index')),
	array('label'=>'Create Usuario', 'url'=>array('create')),
	array('label'=>'Update Usuario', 'url'=>array('update', 'id'=>$model->id_usuario)),
	array('label'=>'Delete Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_usuario),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Usuario', 'url'=>array('admin')),
);
?>

<h1>View Usuario #<?php echo $model->id_usuario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_usuario',
		'login',
		'pwd',
		'id_perfil',
		'id_cliente',
		'id_integ',
		'email_u',
		'cadena_sc',
		'creado',
		'cadena_serv',
		'acceso_masivo',
		'acceso_triviaweb',
		'cadena_promo',
		'edicion_clasificados',
		'reportes_clasificados',
		'acceso_digitelstats',
		'cadena_cintillo',
		'acceso_admin',
		'acceso_analisis',
		'ver_numero',
	),
)); ?>
