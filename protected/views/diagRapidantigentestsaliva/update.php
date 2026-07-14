<?php
$this->breadcrumbs=array(
	'Rapid Antigen Test (SALIVA)'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update '.$model->id,
);
?>

<h2>Update Patient's Diagnostic for Rapid Antigen Test (SALIVA)</h2>
<?php echo CHtml::link('[View This Result]',array('diagRapidantigentestsaliva/'.$model->id)); ?>
<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>