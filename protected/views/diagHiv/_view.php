<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('age')); ?>:</b>
	<?php echo CHtml::encode($data->age); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referred_by')); ?>:</b>
	<?php echo CHtml::encode($data->referred_by); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sample_type')); ?>:</b>
	<?php echo CHtml::encode($data->sample_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('method_used')); ?>:</b>
	<?php echo CHtml::encode($data->method_used); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('result')); ?>:</b>
	<?php echo CHtml::encode($data->result); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_requested')); ?>:</b>
	<?php echo CHtml::encode($data->date_requested); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_sample_collection')); ?>:</b>
	<?php echo CHtml::encode($data->date_sample_collection); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_received')); ?>:</b>
	<?php echo CHtml::encode($data->date_received); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_released')); ?>:</b>
	<?php echo CHtml::encode($data->date_released); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_updated')); ?>:</b>
	<?php echo CHtml::encode($data->date_updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by_userid')); ?>:</b>
	<?php echo CHtml::encode($data->created_by_userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('licenseno')); ?>:</b>
	<?php echo CHtml::encode($data->licenseno); ?>
	<br />

	*/ ?>

</div>