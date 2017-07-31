<?php
/* @var $this PublicidadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Publicidads',
);

$this->menu=array(
	array('label'=>'Create Publicidad', 'url'=>array('create')),
	array('label'=>'Manage Publicidad', 'url'=>array('admin')),
);
?>

<h1>Publicidads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
