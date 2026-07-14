<?php
    $this->breadcrumbs=array(
	    'Rapid Antigen Test (SALIVA)'=>array('admin'),
	    'Create',
    );
?>

<h2>Create Patient's Diagnostic for Rapid Antigen Test (SALIVA)</h2>
<?php         
    echo $this->renderPartial('_form', array('model'=>$model)); 
?>