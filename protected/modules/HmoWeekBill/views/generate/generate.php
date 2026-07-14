<?php
session_start();
if (isset($_SESSION['errmsg']))
{
    if (count($_SESSION['errmsg']) > 0){
        foreach ($_SESSION["errmsg"] as $errmsg){
            echo '<div class="error">'.$errmsg.'</div>';

        }
        $_SESSION["errmsg"] = null;
    }
}
?>

<style>
#tempid{
    padding:10px;font-size:14px;
}
.error{
    border:1px solid red;padding:10px;    width:650px;    margin-top:3px;color:red;font-weight: bold;
}
.results li{
    padding:5px;
}
</style>

<h1>Generate Weekly Billing</h1>

<script>
function submitThis(){
    if ($('#from_date').val() == ''){
        alert('Please enter the From date')   ;
        return false;
    }
    if ($('#to_date').val() == ''){
        alert('Please enter the To date')   ;
        return false ;
    }
    if ($('#due_date').val() == ''){
        alert('Please enter the Due date')   ;
        return false ;
    }
    return;

}
</script>

<form method="post" action="<?= Yii::app()->createAbsoluteUrl('HmoWeekBill/generate/Submit',array()) ?>" onsubmit="return submitThis();">

    <table cellpadding="5" style="width:400px;">
        <!--tr>
            <td colspan="2">
                <div><b>Override selections:</b><br><div style="font-size:10px;color:red;text-align:justify;"> *** This selection will override the automated generation of Billing ID per HMO. Please leave the Billing ID blank to proceed on normal generation.</div></div> 
            </td>
        </tr>
        <tr>
            <td style="width:200px;">Billing ID:</td>
            <td>    
                <input type="text" name="billing_id" size="50">  
            </td>
        </tr-->
        <tr>
            <td>HMO:</td>
            <td>                
                <?php 
                    echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                            array(
                                    'model'=>$model, 
                                    'id'=>'HmoForm_hmo_id',
                                    'name'=>'HmoForm[hmo_name]',
                                    'attribute'=>'hmo_name',
                                    'sourceUrl'=>Yii::app()->createAbsoluteUrl('hmo/lookupbilling', array()),
                                    'htmlOptions' => array("size"=>'50'),  
                                    'options'=>array(
                                            'select'=>'js:function(event,ui){
                                                    close();
                                                    term=ui.item.value.split(":");
                                                    document.getElementById("HmoForm_hmo_id").value=term[0];                                        
                                                    ui.item.value=term[1];
                                            }'
                                    ),

                            ),
                            true
                    );
                ?> 
            </td>
        </tr>    
        <tr>
            <td colspan="2">
                <hr>
                <div><b>Specify the week period</b></div>  
            </td>
        </tr>
        <tr>
            <td>From Date:</td>
            <td>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                                array(     
                                    'id'=>'from_date' ,
                                    'name'=>'from_date',   
                                    'value'=>$_GET["from_date"],          
                                    'htmlOptions' => array("size"=>'25'),                                           
                                    'options'=>array(
                                        'dateFormat'=>'yy-mm-dd',
                                        'showButtonPanel'=>false,
                                        'changeYear'=>true,
                                        'changeMonth'=>true,
    							'maxDate'=>'+25Y',
    							'minDate'=>'-20Y'
                                    )
                                ),
                                true
                            );
                ?>        
            </td>
        </tr>
        <tr>
            <td>To Date:</td>
            <td>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                                array(     
                                    'id'=>'to_date' ,
                                    'name'=>'to_date',       
                                    'value'=>$_GET["to_date"],                                                
                                    'htmlOptions' => array("size"=>'25'),                                           
                                    'options'=>array(
                                        'dateFormat'=>'yy-mm-dd',
                                        'showButtonPanel'=>false,
                                        'changeYear'=>true,
                                        'changeMonth'=>true,
    							'maxDate'=>'+25Y',
    							'minDate'=>'-20Y'                                )
                                ),
                                true
                            );
                    ?>        
            </td>
        </tr>   
        <tr>
            <td colspan="2">
                <hr>
                <div><b>Specify the bill's payment due date</b></div> 
            </td>
        </tr>  
        <tr>
            <td>Due Date:</td>
            <td>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                                array(     
                                    'id'=>'due_date' ,
                                    'name'=>'due_date', 
                                    'value'=>$_GET["due_date"], 
                                    'htmlOptions' => array("size"=>'25'),                                           
                                    'options'=>array(
                                        'dateFormat'=>'yy-mm-dd',
                                        'showButtonPanel'=>false,
                                        'changeYear'=>true,
                                        'changeMonth'=>true,
                                        	'maxDate'=>'+25Y',
    							'minDate'=>'-20Y'
                                    )
                                ),
                                true
                            );
                    ?>        
            </td>
        </tr>  
        <tr>
            <td colspan="2"><input type="submit" value="  Submit  " /></td>
        </tr>
    </table>        
    
</form>
