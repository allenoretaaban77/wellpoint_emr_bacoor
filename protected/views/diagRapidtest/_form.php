<style>
h3{
    color:#008000;
}
</style>
<div class="form">

<?php 

    $diagTemp="";
    $patientid="";

    if(!$_POST["patientval"]){    
        $patientid = $_POST["DiagRapidtest"]['patient_id'];
    }else{       
        list($patientname, $patientno) = explode("|",$_POST["patientval"]);
        list($dum, $patientid) = explode(":",$patientno);
    }
    
    $diagTemp = Yii::app()->db->createCommand()
        ->select('*')
        ->from('patient')    
        ->where('id=:id', array(':id'=>$patientid))
        ->queryRow();
    
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'diag-rapidtest-form',
        'enableAjaxValidation'=>false,
    ));
    
    //fullpatient name
    $fullpatientname = $diagTemp['lastname'].',';
    $fullpatientname .= ' '.trim($diagTemp['firstname']);
    if(trim($diagTemp['middleinitial']) != ''){$fullpatientname .= ' '.trim($diagTemp['middleinitial']);}
    
    $birthday_timestamp = strtotime($diagTemp["birthdate"]);  
    $age = date('md', $birthday_timestamp) > date('md') ? date('Y') - date('Y', $birthday_timestamp) - 1 : date('Y') - date('Y', $birthday_timestamp);
    $sex = "";
    if (trim($diagTemp['gender']) == "M") {
        $sex = "MALE";
    } else if (trim($diagTemp['gender']) == "F") {
        $sex = "FEMALE";
    } else {
        $sex = "";
    }
    $patient_birthdate = $diagTemp["birthdate"];

    $profile=Yii::app()->getModule('user')->user()->profile;
    $model->licenseno = $profile->licenseno;
    $created_by = $profile->first_name.' '.$profile->last_name;
    $created_by_userid = $profile->user_id;
?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
    <?php echo $form->errorSummary($model); ?>
    
    <hr>

    <div class="row">
        <?php echo $form->labelEx($model,'patient_id'); ?>
        <?php echo $form->textField($model,'patient_id',array('value'=>$patientid,'readonly'=>'readonly')); ?>
        <?php echo $form->error($model,'patient_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250,'value'=>strtoupper($fullpatientname),'readonly'=>'readonly')); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'age'); ?>
        <?php echo $form->textField($model,'age',array('value'=>$age,'readonly'=>'readonly')); ?>
        <?php echo $form->error($model,'age'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sex'); ?>
        <input value="<?=$sex ?>" readonly="readonly" type="text">
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'patient_birthdate'); ?>
        <input value="<?=$patient_birthdate ?>" readonly="readonly" type="text">
    </div>

    <hr>

    <div class="row">
        <?php echo $form->labelEx($model,'requesting_physician'); ?>
        <?php echo $form->textField($model,'requesting_physician',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'requesting_physician'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'date_ordered'); ?>
            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                array(
                    'model'=>$model,
                    'attribute'=>'date_ordered',
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                        'showButtonPanel'=>false,
                        'changeYear'=>true,
                        'changeMonth'=>true,
                        'yearRange'=>'1900'
                    )
                ),
                true);
            ?>
        <?php echo $form->error($model,'date_ordered'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'date_received'); ?>
            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                array(
                    'model'=>$model,
                    'attribute'=>'date_received',
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                        'showButtonPanel'=>false,
                        'changeYear'=>true,
                        'changeMonth'=>true,
                        'yearRange'=>'1900'
                    )
                ),
                true);
            ?>
        <?php echo $form->error($model,'date_received'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'date_released'); ?>
        <?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
            'model'=>$model,
            'attribute'=>'date_released',
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showPeriod'=>true,
            ),
            'htmlOptions'=>array('size'=>20,'maxlength'=>20 ),
        )); ?>
        <?php echo $form->error($model,'date_released'); ?>
    </div>

    <hr>

    <div class="row">
        <?php echo $form->labelEx($model,'igg_con'); ?>
        <?php echo $form->textField($model,'igg_con',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'igg_con'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'igm_con'); ?>
        <?php echo $form->textField($model,'igm_con',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'igm_con'); ?>
    </div>

    <hr >   

    <div class="row">
        <?php echo $form->labelEx($model,'igg_si'); ?>
        <?php echo $form->textField($model,'igg_si',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'igg_si'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'igm_si'); ?>
        <?php echo $form->textField($model,'igm_si',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'igm_si'); ?>
    </div>

    <hr>

    <div class="row">
        <input size="60" maxlength="200" readonly="readonly" type="text" value="<?=$created_by ?>">
        <input type="hidden" name="DiagRapidtest[created_by_userid]" value="<?=$created_by_userid ?>">
    </div>       

    <div class="row">
        <?php echo $form->labelEx($model,'licenseno'); ?>
        <?php echo $form->textField($model,'licenseno',array('size'=>20,'maxlength'=>20,'readonly'=>'readonly')); ?>
        <?php echo $form->error($model,'licenseno'); ?>
    </div> 

    <hr>        

    <div class="row" style="display:none;">
        <?php echo $form->labelEx($model,'patient_id'); ?>
                <input type="hidden" name="DiagRapidtest[patient_id]" value="<?=$patientid ?>">
        <?php echo $form->textField($model,'patient_id',array('size'=>20,'maxlength'=>20,'value'=>$patientid)); ?>
        <?php echo $form->error($model,'patient_id'); ?>
    </div>
    
    <div class="row" style="display:none;">
        <input type="hidden" name="DiagRapidtest[date_created]" value="<?= date("Y-m-d h:m:s")?>">        
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::link(CHtml::button('Cancel'),array('diagRapidtest/admin'),array('style'=>'text-decoration:none;')); ?>
    </div>

<?php $this->endWidget(); ?>

</div>
<script>
submitThis = function(){
    if (confirm("Are you sure you want to save this result? \r\n You will need an Administrator to edit this once saved."))
    {           
        return true;
    }else{
        return false;
    }    
}
</script>