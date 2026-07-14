<?php
$url = Yii::app()->createAbsoluteUrl('AddDiagResult/Addresult/BloodChemAddsi',array());
$this->breadcrumbs=array(
	'Select a Patient'=>"$url",
	'Create',
);

/*$this->menu=array(
	array('label'=>'List DiagResBloodchem', 'url'=>array('index')),
	array('label'=>'Manage DiagResBloodchem', 'url'=>array('admin')),
);*/
?>

<h2>Create Blood Chemistry Result (SI)</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>