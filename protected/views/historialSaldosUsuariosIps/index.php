<?php
/* @var $this HistorialSaldosUsuariosIpsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historial Saldos Usuarios Ips',
);

$this->menu=array(
	array('label'=>'Create HistorialSaldosUsuariosIps', 'url'=>array('create')),
	array('label'=>'Manage HistorialSaldosUsuariosIps', 'url'=>array('admin')),
);
?>

<h1>Historial Saldos Usuarios Ips</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
