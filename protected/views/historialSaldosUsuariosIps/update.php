<?php
/* @var $this HistorialSaldosUsuariosIpsController */
/* @var $model HistorialSaldosUsuariosIps */

$this->breadcrumbs=array(
	'Historial Saldos Usuarios Ips'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistorialSaldosUsuariosIps', 'url'=>array('index')),
	array('label'=>'Create HistorialSaldosUsuariosIps', 'url'=>array('create')),
	array('label'=>'View HistorialSaldosUsuariosIps', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage HistorialSaldosUsuariosIps', 'url'=>array('admin')),
);
?>

<h1>Update HistorialSaldosUsuariosIps <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>