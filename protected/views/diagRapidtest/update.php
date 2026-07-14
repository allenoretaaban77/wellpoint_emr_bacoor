<?php
$this->breadcrumbs=array(
	'Rapid COVID-19 Test'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update '.$model->id,
);
?>

<h2>Update Patient's Diagnostic for Rapid COVID-19 Test</h2>
<?php echo CHtml::link('[View This Result]',array('diagRapidtest/'.$model->id)); ?>
<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>