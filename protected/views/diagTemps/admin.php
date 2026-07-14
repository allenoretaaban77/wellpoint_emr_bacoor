<?php
$this->breadcrumbs=array(	
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List DiagTemps', 'url'=>array('index')),
	array('label'=>'Create DiagTemps', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('diag-temps-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

if (trim($model->temp_title) != '') {
	echo "<h1>Diagnostic Templates List for ".ucwords(strtolower($model->temp_title))."</h1>";
} else {
	echo "<h1>Diagnostic Templates List</h1>";
}
?>

<form>
<?
$command = Yii::app()->db->createCommand("
    SELECT DISTINCT TRIM(UPPER(SUBSTRING_INDEX(temp_title, '-', 1))) AS doctor_name
    FROM diag_temps 
    WHERE temp_title LIKE 'DR.%' 
    HAVING doctor_name <> 'DR.' 
    ORDER BY doctor_name ASC
");

$diag_templates = $command->queryAll();
$listData = CHtml::listData($diag_templates, 'doctor_name', 'doctor_name');
echo "<span>Select doctor to filter:</span><br>";
echo CHtml::dropDownList('doctor_name', null, $listData, array(
	'empty' => 'Select...',
	'style' => 'width:250px;margin-top:5px;',
	'onchange' => 'if(this.value) { window.location.href = "/diagTemps/admin?doctor_name=" + encodeURIComponent(this.value); }'
));
?>
</form>

<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'diag-temps-grid',
	'dataProvider'=>$model->search(),    
	'filter'=>$model,
	'columns'=>array(
		'id',
		'createdate',
		/*'createby',
		'updateby',*/
		'temp_title',
        'diag_type',  
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<div class="form">
	<form>
		<div id="sidebar">
			<div class="portlet" id="yw0">
				<?php echo CHtml::button('Add New Template', array('submit' => array('create'), 'class'=>'wp_button')); ?>
			</div>
		</div>
	</form>
</div>
