<?php
$this->breadcrumbs=array(
	'Rapid Antigen Test (SWAB)'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update '.$model->id,
);
?>

<h2>Update Patient's Diagnostic for Rapid Antigen Test (SWAB)</h2>
<?php echo CHtml::link('[View This Result]',array('diagRapidantigentest/'.$model->id)); ?>
<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>