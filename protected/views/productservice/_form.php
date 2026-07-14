<style>select { padding:4px 2px; } option { margin:10px 0px; }</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'productservice-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array('Service'=>'Service','Product'=>'Product')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'provider'); ?>
        <?php 
        	echo CHtml::activeDropDownList(
        		$model, 
        		'provider',
                array(
                	'Ancillary'=>'Ancillary',
                    'APE Bacoor LGU'=>'APE Bacoor LGU',
                	// 'Annual Package A'=>'Annual Package A',
                	'Annual Package B'=>'Annual Package B',
                	'Annual Package C'=>'Annual Package C',
                	'Basic Priviledge'=>'Basic Priviledge',
                	'Bronze Card'=>'Bronze Card',
                	'Consultation'=>'Consultation',
                	'E.R. Use'=>'E.R. Use',
                	'Gold Card'=>'Gold Card',
                	'Laboratory'=>'Laboratory',
                	'Marketing'=>'Marketing',
                	'Medical Certificate'=>'Medical Certificate',
                	'Medicine/Vaccine'=>'Medicine/Vaccine',
                	'O.R. Use'=>'O.R. Use',
                	'Physical Medicine and Rehabilitation'=>'Physical Medicine and Rehabilitation',
                	'Premium Package'=>'Premium Package',
                	'Pre-Natal'=>'Pre-Natal',
                    'Service Fee Patient'=>'Service Fee Patient',
                    'Service Fee Companion'=>'Service Fee Companion',
                    'Service Fee Senior'=>'Service Fee Senior',
                	'Silver Card'=>'Silver Card',
                ),
                array('empty'=>'Select Option Category')
            );
        	/*echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model,
                            'attribute'=>'provider',
                            'source'=>array('Laboratory','Ancillary','Consultation','O.R. Use','E.R. Use','Medical Certificate','APE Bacoor LGU','Annual Package A','Annual Package B','Annual Package C','Gold Card','Silver Card','Bronze Card','Basic Priviledge','Premium Package','Pre-Natal','Medicine/Vaccine','Physical Medicine and Rehabilitation')
                    ),
                    true
                );*/
        ?>
        <?php echo $form->error($model,'provider'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'isvatable'); ?>
		<?php echo $form->checkBox($model,'isvatable'); ?>
		<?php echo $form->error($model,'isvatable'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->