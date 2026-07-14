<?php
$this->breadcrumbs=array(
	'HIV Antibodies'=>array('admin'),
	'Manage',
);

$this->menu=array(
    array('label'=>'Add New', 'url'=>array('index'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('diag-urinalysis-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>HIV Antibodies Diagnotice Results</h2>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'diag-hiv-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'patient_id',
		'name',
		'age',
		'sex',
		// 'address',
		'date_requested',
		'date_sample_collection',
		'date_received',
		'date_released',
		/*
		'referred_by',
		'result_no',
		'date_received',
		'date_released',
		'date_created',
		'date_updated',
		'created_by_userid',
		'licenseno',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
