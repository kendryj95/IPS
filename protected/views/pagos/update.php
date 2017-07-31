<?php
/* @var $this PagosController */
/* @var $model Pagos */

$this->breadcrumbs=array(
	'Pagoses'=>array('index'),
	$model->id_pago=>array('view','id'=>$model->id_pago),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pagos', 'url'=>array('index')),
	array('label'=>'Create Pagos', 'url'=>array('create')),
	array('label'=>'View Pagos', 'url'=>array('view', 'id'=>$model->id_pago)),
	array('label'=>'Manage Pagos', 'url'=>array('admin')),
);
?>

<h1>Update Pagos <?php echo $model->id_pago; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>