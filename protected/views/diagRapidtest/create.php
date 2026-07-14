<?php
    $this->breadcrumbs=array(
	    'Rapidtest'=>array('admin'),
	    'Create',
    );
?>

<h2>Create Patient's Diagnostic for Rapid COVID-19 Test</h2>
<?php         
    echo $this->renderPartial('_form', array('model'=>$model)); 
?>