<?php
/* @var $this PreferenciasUsuarioipsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Preferencias Usuarioips',
);

$this->menu=array(
	array('label'=>'Create PreferenciasUsuarioips', 'url'=>array('create')),
	array('label'=>'Manage PreferenciasUsuarioips', 'url'=>array('admin')),
);
?>

<h1>Preferencias Usuarioips</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
