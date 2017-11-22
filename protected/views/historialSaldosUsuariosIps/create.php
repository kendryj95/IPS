<?php
/* @var $this HistorialSaldosUsuariosIpsController */
/* @var $model HistorialSaldosUsuariosIps */

$this->breadcrumbs=array(
	'Historial Saldos Usuarios Ips'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistorialSaldosUsuariosIps', 'url'=>array('index')),
	array('label'=>'Manage HistorialSaldosUsuariosIps', 'url'=>array('admin')),
);
?>

<h1>Create HistorialSaldosUsuariosIps</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>