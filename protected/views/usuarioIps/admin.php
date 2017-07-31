<?php
/* @var $this UsuarioIpsController */
/* @var $model UsuarioIps */

$this->breadcrumbs=array(
	'Usuario Ips'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UsuarioIps', 'url'=>array('index')),
	array('label'=>'Create UsuarioIps', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-ips-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Usuario Ips</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-ips-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idusuario_ips',
		'email',
		'telefono',
		'login',
		'pwd',
		'estatus',
		/*
		'fecha_creado',
		'hora_creado',
		'fecha_expiracion',
		'hora_expiracion',
		'tipo_usuario',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
