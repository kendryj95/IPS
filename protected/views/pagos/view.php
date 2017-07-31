<?php
/* @var $this PagosController */
/* @var $model Pagos */

$this->breadcrumbs=array(
	'Pagoses'=>array('index'),
	$model->id_pago,
);

$this->menu=array(
	array('label'=>'List Pagos', 'url'=>array('index')),
	array('label'=>'Create Pagos', 'url'=>array('create')),
	array('label'=>'Update Pagos', 'url'=>array('update', 'id'=>$model->id_pago)),
	array('label'=>'Delete Pagos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_pago),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pagos', 'url'=>array('admin')),
);
?>

<h1>View Pagos #<?php echo $model->id_pago; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_pago',
		'id_metodo_pago',
		'fecha_pago',
		'hora_pago',
		'estado_compra',
		'estado_pago',
		'moneda',
		'monto',
		'payer_info_email',
		'payer_id',
		'id_compra',
		'id_api_call',
		'id_producto',
		'sms_id',
		'sms_sc',
		'sms_contenido',
		'sms_key_name',
		'redirect_url',
	),
)); ?>
