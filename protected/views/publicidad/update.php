<?php
/* @var $this PublicidadController */
/* @var $model Publicidad */

$this->breadcrumbs=array(
	'Publicidads'=>array('index'),
	$model->idpublicidad=>array('view','id'=>$model->idpublicidad),
	'Update',
);

$this->menu=array(
	array('label'=>'List Publicidad', 'url'=>array('index')),
	array('label'=>'Create Publicidad', 'url'=>array('create')),
	array('label'=>'View Publicidad', 'url'=>array('view', 'id'=>$model->idpublicidad)),
	array('label'=>'Manage Publicidad', 'url'=>array('admin')),
);
?>

<h1>Update Publicidad <?php echo $model->idpublicidad; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>