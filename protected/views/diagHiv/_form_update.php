<style>
h3 { color:#008000; }
.horizontal { display:flex; gap:20px; }
hr { margin:15px 0 15px 0; }
.readonly { background:lightgoldenrodyellow }
</style>

<div class="form">

<?php 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'diag-hiv-form',
	'enableAjaxValidation'=>false,
)); 


$diagTemp="";
$patientid="";

if(!$_GET["patient_id"]) {
    if(!$_POST["patientval"]){
        $du = Yii::app()->db->createCommand()
            ->select('*')
            ->from('diag_hiv')    
            ->where('id=:id', array(':id'=>$model->id))
            ->queryRow();
        $patientid = $du['patient_id'];
    }else{
        list($patientname, $patient_id) = explode("|",$_POST["patientval"]);
        list($dum, $patientid) = explode(":",$patient_id);
    }

    $diagTemp = Yii::app()->db->createCommand()
        ->select('*')
        ->from('patient')    
        ->where('id=:id', array(':id'=>$patientid))
        ->queryRow();
} else {
    $patientid = $_GET["patient_id"];
    $diagTemp = Patient::model()->findByPk($patientid);
}
$model['patient_id'] = $patientid;

$diagTemp = Yii::app()->db->createCommand()
    ->select('*')
    ->from('patient')    
    ->where('id=:id', array(':id'=>$patientid))
    ->queryRow();

// patient info
$fullpatientname = $diagTemp['lastname'].',';
$fullpatientname .= ' '.trim($diagTemp['firstname']);
if(trim($diagTemp['middleinitial']) != ''){$fullpatientname .= ' '.trim($diagTemp['middleinitial']);}
$model['name'] = strtoupper($fullpatientname);
    
$birthday_timestamp = strtotime($diagTemp["birthdate"]);  
$age = date('md', $birthday_timestamp) > date('md') ? date('Y') - date('Y', $birthday_timestamp) - 1 : date('Y') - date('Y', $birthday_timestamp);
$model['age'] = $age;
$sex = "";
if (trim($diagTemp['gender']) == "M") {
    $sex = "MALE";
} else if (trim($diagTemp['gender']) == "F") {
    $sex = "FEMALE";
} else {
    $sex = "";
}
$model['sex'] = $sex;
$patient_birthdate = $diagTemp["birthdate"];
// full address
$addresses = array(
    $diagTemp["street1"],
    $diagTemp["street2"],
    $diagTemp["barangay"],
    $diagTemp["city"],
    $diagTemp["province"],
);
$model['address'] = strtoupper(implode(", ", $addresses));

$profile=Yii::app()->getModule('user')->user()->profile;
$model->licenseno = $profile->licenseno;
$created_by = $profile->first_name.' '.$profile->last_name;
$created_by_userid = $profile->user_id;

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    

	<div class="horizontal">
		<div class="row">
	        <?php echo $form->labelEx($model,'date_requested'); ?>
			<?php
				$this->widget(
				    'ext.jui.EJuiDateTimePicker',
				    array(
				        'model'     => $model,
				        'attribute' => 'date_requested',
				        //'language'=> 'ru',//default Yii::app()->language
				        'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
				        'options'   => array(
				            'dateFormat' => 'yy-mm-dd',
				            //'timeFormat' => '',//'hh:mm tt' default
				        ),
					    'htmlOptions' => array(
					        'size' => 32, // Adjust input size here
					    ),
				    )
				);
			?>
	        <?php echo $form->error($model,'date_requested'); ?>
		</div>
		<div class="row">
	        <?php echo $form->labelEx($model,'date_sample_collection'); ?>
			<?php
				$this->widget(
				    'ext.jui.EJuiDateTimePicker',
				    array(
				        'model'     => $model,
				        'attribute' => 'date_sample_collection',
				        //'language'=> 'ru',//default Yii::app()->language
				        'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
				        'options'   => array(
				            'dateFormat' => 'yy-mm-dd',
				            //'timeFormat' => '',//'hh:mm tt' default
				        ),
					    'htmlOptions' => array(
					        'size' => 32, // Adjust input size here
					    ),
				    )
				);
			?>
	        <?php echo $form->error($model,'date_sample_collection'); ?>
		</div>
	</div>
    
    <hr>

	<div class="horizontal">
	    <div class="row">
	    	<label>Patient ID</label>
	        <?php echo $form->textField($model,'patient_id',array('size'=>32, 'readonly'=>'readonly', 'class'=>'readonly')); ?>
	        <?php echo $form->error($model,'patient_id'); ?>
	    </div>
	    <div class="row">
	    	<label>Full Name</label>
	        <?php echo $form->textField($model,'name',array('size'=>32, 'maxlength'=>250)); ?>
	        <?php echo $form->error($model,'name'); ?>
	    </div>
    </div>

	<div class="horizontal">
	    <div class="row">
	        <?php echo $form->labelEx($model,'age'); ?>
	        <?php echo $form->textField($model,'age',array('size'=>32)); ?>
	        <?php echo $form->error($model,'age'); ?>
	    </div>
	    <div class="row">
	        <?php echo $form->labelEx($model,'sex'); ?>
	        <?php echo $form->textField($model,'sex',array('size'=>32)); ?>
	        <?php echo $form->error($model,'sex'); ?>
	    </div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
        <?php echo $form->textArea($model,'address',array('rows'=>2, 'cols'=>75)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="horizontal">
		<div class="row">
			<?php echo $form->labelEx($model,'referred_by'); ?>
			<?php echo $form->textField($model,'referred_by',array('size'=>32,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'referred_by'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'sample_type'); ?>
			<?php echo $form->textField($model,'sample_type',array('size'=>32,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'sample_type'); ?>
		</div>
	</div>

    <hr>

	<div class="horizontal">
		<div class="row">
			<?php echo $form->labelEx($model,'method_used'); ?>
			<?php echo $form->textField($model,'method_used',array('size'=>32,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'method_used'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'result'); ?>
			<?php echo $form->textField($model,'result',array('size'=>32,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'result'); ?>
		</div>
	</div>

    <hr>

    <div class="horizontal">
		<div class="row">
	        <?php echo $form->labelEx($model,'date_received'); ?>
	            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
	                array(
	                    'model'=>$model,
	                    'attribute'=>'date_received',
	                    'options'=>array(
	                        'dateFormat'=>'yy-mm-dd',
        					'timeFormat' => 'HH:mm:ss',
	                        'showButtonPanel'=>false,
	                        'changeYear'=>true,
	                        'changeMonth'=>true,
	                        'yearRange'=>'1900'
	                    ),
					    'htmlOptions' => array(
					        'size' => 32, // Adjust input size here
					    ),
	                ),
	                true);
	            ?>
	        <?php echo $form->error($model,'date_received'); ?>
		</div>
		<div class="row">
	        <?php echo $form->labelEx($model,'date_released'); ?>
	            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
	                array(
	                    'model'=>$model,
	                    'attribute'=>'date_released',
	                    'options'=>array(
	                        'dateFormat'=>'yy-mm-dd',
        					'timeFormat' => 'HH:mm:ss',
	                        'showButtonPanel'=>false,
	                        'changeYear'=>true,
	                        'changeMonth'=>true,
	                        'yearRange'=>'1900'
	                    ),
					    'htmlOptions' => array(
					        'size' => 32, // Adjust input size here
					    ),
	                ),
	                true);
	            ?>
	        <?php echo $form->error($model,'date_released'); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
        <?php echo $form->textArea($model,'remarks',array('rows'=>2, 'cols'=>75)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<hr>

    <div class="horizontal">
	    <div class="row">
	    	<label>Created By</label>
	        <input size="32" maxlength="200" readonly="readonly" class="readonly" type="text" value="<?=$created_by ?>">
	        <input type="hidden" name="DiagHiv[created_by_userid]" value="<?=$created_by_userid ?>">
	    </div>       
	    <div class="row">
	    	<label>License Number</label>
	        <?php echo $form->textField($model,'licenseno',array('size'=>32,'maxlength'=>20,'readonly'=>'readonly', 'class'=>'readonly')); ?>
	        <?php echo $form->error($model,'licenseno'); ?>
	    </div> 
    </div> 

	<hr>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::link(CHtml::button('Cancel'),array('diagHiv/admin'),array('style'=>'text-decoration:none;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->