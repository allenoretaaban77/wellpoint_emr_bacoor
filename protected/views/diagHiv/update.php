<?php
$this->breadcrumbs=array(
	'HIV Antibodies'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

// $this->menu=array(
// 	array('label'=>'List DiagHiv', 'url'=>array('index')),
// 	array('label'=>'Create DiagHiv', 'url'=>array('create')),
// 	array('label'=>'View DiagHiv', 'url'=>array('view', 'id'=>$model->id)),
// 	array('label'=>'Manage DiagHiv', 'url'=>array('admin')),
// );
?>

<h2>Update Patient's Diagnostic for HIV Antibodies</h2>
<?php echo CHtml::link('[View This Result]',array('diagHiv/'.$model->id)); ?>
<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>