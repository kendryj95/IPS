<?php
/* @var $this PaquetesSaldosController */
/* @var $model PaquetesSaldos */

$this->breadcrumbs=array(
	'Paquetes Saldoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaquetesSaldos', 'url'=>array('index')),
	array('label'=>'Create PaquetesSaldos', 'url'=>array('create')),
	array('label'=>'View PaquetesSaldos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PaquetesSaldos', 'url'=>array('admin')),
);
?>

<h1>Update PaquetesSaldos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>