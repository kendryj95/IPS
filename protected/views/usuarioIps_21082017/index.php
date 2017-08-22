<?php
/* @var $this UsuarioIpsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuario Ips',
);

$this->menu=array(
	array('label'=>'Create UsuarioIps', 'url'=>array('create')),
	array('label'=>'Manage UsuarioIps', 'url'=>array('admin')),
);
?>

<h1>Usuario Ips</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
