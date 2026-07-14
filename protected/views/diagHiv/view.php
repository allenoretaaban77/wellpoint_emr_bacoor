<?php
$this->breadcrumbs=array(
	'HIV Antibodies'=>array('admin'),
	$model->name,
);

$this->menu=array(
    array('label'=>'Manage Records List', 'url'=>array('admin')),
    array('label'=>'Edit This Record', 'url'=>array('diagHiv/update/'.$model->id)),
    array('label'=>'Delete This Record', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h2>View Patient's Diagnostics for HIV Antibodies</h2>
<div style="float:left;margin:0px 0px 5px 0px;">
<?php echo CHtml::link('[Edit This Result]',array('diagHiv/update/'.$model->id)); ?>
&nbsp;&nbsp;
<a target="_blank" href="<?= Yii::app()->createUrl("PrintDiagResult/FormHiv/Print/?resultid=".$model->id, array()) ?>">[Print This Result]</a>
&nbsp;&nbsp;
<a id="yt0" href="#">[Delete This Record]</a>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_id',
		'name',
		'age',
		'sex',
		'address',
		'referred_by',
		'sample_type',
		'method_used',
		'result',
		'remarks',
		'date_requested',
		'date_sample_collection',
		'date_received',
		'date_released',
		'date_created',
		'date_updated',
		'created_by_userid',
		'licenseno',
	),
)); ?>
