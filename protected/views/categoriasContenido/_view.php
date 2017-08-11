<?php
/* @var $this CategoriasContenidoController */
/* @var $data CategoriasContenido */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcategorias_contenido')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcategorias_contenido), array('view', 'id'=>$data->idcategorias_contenido)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deporte')); ?>:</b>
	<?php echo CHtml::encode($data->deporte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abreviatura')); ?>:</b>
	<?php echo CHtml::encode($data->abreviatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pais')); ?>:</b>
	<?php echo CHtml::encode($data->pais); ?>
	<br />


</div>