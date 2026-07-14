<?php
$this->breadcrumbs=array(
	'Rapid COVID-19 Test'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),'View '.$model->id
);

$this->menu=array(
    array('label'=>'Manage Records List', 'url'=>array('admin')),
    array('label'=>'Edit This Record', 'url'=>array('diagRapidtest/update/'.$model->id)),
    array('label'=>'Delete This Record', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h2>View Patient's Diagnostics for Rapid COVID-19 Test</h2>
<div style="float:left;margin:0px 0px 5px 0px;">
<?php echo CHtml::link('[Edit This Result]',array('diagRapidtest/update/'.$model->id)); ?>
&nbsp;&nbsp;
<a target="_blank" href="<?= Yii::app()->createUrl("PrintDiagResult/FormRapidtest/Print/?resultid=".$model->id, array()) ?>">[Print This Result]</a>
&nbsp;&nbsp;
<a id="yt0" href="#">[Delete This Record]</a>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'age',
		//sex,
		'result_no',
		// birthdate,
		'patient_id',
		'requesting_physician',
		'date_ordered',
		'date_received',
		'date_released',
		'igg_con',
		'igm_con',
		'igg_si',
		'igm_si',
		'date_created',
		'date_updated',
        array(  
            'label'=>'Created By',
            'type'=>'raw',
            'value'=>getCreatorName($model)
        ),
		'licenseno'
	),
)); 

function getCreatorName($model) {
    $prf = Yii::app()->db->createCommand()->select('*')->from('auth_profiles')->where('user_id=:id', array(':id'=>$model->created_by_userid))->queryRow();
    $namearr = array(trim($prf['first_name']), trim($prf['middle_initial']), trim($prf['last_name']));
	return implode(" ", $namearr);
}

?>
<div style="float:left;width:100%;margin:10px 0px 0px 0px;"></div>
