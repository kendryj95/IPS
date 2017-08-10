<?php
/* @var $this PreferenciasUsuarioipsController */
/* @var $model PreferenciasUsuarioips */

$this->breadcrumbs=array(
	'Preferencias Usuarioips'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PreferenciasUsuarioips', 'url'=>array('index')),
	array('label'=>'Create PreferenciasUsuarioips', 'url'=>array('create')),
	array('label'=>'View PreferenciasUsuarioips', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PreferenciasUsuarioips', 'url'=>array('admin')),
);
?>

<h1>Update PreferenciasUsuarioips <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>