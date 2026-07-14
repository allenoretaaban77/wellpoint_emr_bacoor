<?php
$this->breadcrumbs=array(
	'HIV Antibodies'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DiagHiv', 'url'=>array('index')),
	array('label'=>'Manage DiagHiv', 'url'=>array('admin')),
);
?>

<h2>Create Patient's Diagnostic for HIV Antibodies</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>