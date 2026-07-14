<?php
$connection=Yii::app()->db;           
 if ($_POST){
            //validate date
            $from_date = $_POST["from_date"]; //.' 00:00:00';
            $to_date = $_POST["to_date"]; //.' 23:59:59';
            $due_date = $_POST["due_date"];
            $today = date("Y-m-d",time()); 
            $error_flag = false;
            
            session_start();    
}
 
 ?>
 
<h2>Generate Billing For Period: <span style="color:royalblue;">
<?= $from_date ?></span> to <span style="color:royalblue;"><?= $to_date ?></span></h2>

<hr/>
<div style="font-size:14px;font-weight:bold;">Processed HMO in this period:</div>
<?php
//get processed HMOs
$query = "select b.name, a.hmo_id from hmo_billing a
    left join hmo b 
    on a.hmo_id = b.id
    left join hmo_form hf
    on a.id = hf.hmo_billing_id
    where (hf.entry_date between '$from_date 00:00:00' and '$to_date 23:59:59')
    and a.is_deleted = 0 
    group by b.name
    order by b.name";
// echo $query;

$command=$connection->createCommand($query);
$dataReader=$command->query();

$done_ids = array();
if (count($dataReader) > 0){
    foreach($dataReader as $row) { 
        $done_ids[] = $row["hmo_id"];
        echo "<ul><li>".$row["name"]."";

        $query = "select hmo_billing_id
            from hmo_form
            where (entry_date between '$from_date 00:00:00' and '$to_date 23:59:59')
            and hmo_id = ".$row["hmo_id"]."
            group by hmo_billing_id asc";
        $command=$connection->createCommand($query);
        $dt=$command->query();
        $soas = [];
        if (count($dt) > 0) {
            foreach($dt as $rowhf) {
                $hmo_billing_id = $rowhf['hmo_billing_id'];
                if ($hmo_billing_id != 0) {
                    $from_entry_dt = HmoForm::model()->findBySql("select entry_date from hmo_form where hmo_billing_id = $hmo_billing_id order by entry_date asc limit 1")->attributes['entry_date'];
                    $to_entry_dt = HmoForm::model()->findBySql("select entry_date from hmo_form where hmo_billing_id = $hmo_billing_id order by entry_date desc limit 1")->attributes['entry_date'];
                    $from_dt = HmoBilling::model()->findByPk($hmo_billing_id)->from_date;
                    $to_dt = HmoBilling::model()->findByPk($hmo_billing_id)->to_date;
                    array_push($soas, "<li><b>SOA #<a href='/hmoBilling/".$hmo_billing_id."' target='_blank'>".$hmo_billing_id."</a></b> <font color=\"green\">From Date: $from_dt - To Date: $to_dt</font> | <font color=\"red\">Entry Date From: $from_entry_dt - Entry Date To: $to_entry_dt</font> </li>");
                }
            }
        }
        echo "<ul>".implode("", $soas)."</ul></li></ul>";
    }
}

///////////////////////////////////////////////////////////////// old code
// $query = "select a.hmo_id, b.name, a.is_deleted from hmo_billing a
//             left join hmo b 
//             on a.hmo_id = b.id
//             where a.from_date = '$from_date' 
//             and a.is_deleted = 'no' 
//             order by b.name";

// $command=$connection->createCommand($query);
// $dataReader=$command->query();

// $done_ids = array();
// if (count($dataReader) > 0){
//     foreach($dataReader as $row) { 
//         $done_ids[] = $row["hmo_id"];
//         echo $row["name"]." -- OK!<br/>";
//     }
// }
///////////////////////////////////////////////////////////////// old code

if (count($done_ids)==0){
    echo "<p>No processed HMO yet in this period</p>";
}
  
?>

<hr/>
<form action="<?= Yii::app()->createAbsoluteUrl('HmoWeekBill/Generate/Process',array()) ?>" onsubmit="return submitThis();" method="post">
<input type="hidden" name="from_date" value="<?= $from_date?>" />
<input type="hidden" name="to_date" value="<?= $to_date?>" />
<input type="hidden" name="due_date" value="<?= $due_date?>" />

<div style="color:royalblue;font-size:14px;font-weight:bold;">Available not yet processed HMOs</div><br/>
<?php
//get processed HMOs     
if (count($done_ids)>0){                                            
        $done_ids = implode(",",$done_ids);
        $query = "SELECT a.id, a.name FROM hmo a WHERE a.id not in ($done_ids) order by a.name ASC";
}else{
    $query = "SELECT a.id, a.name FROM hmo a order by a.name ASC";    
}
$command=$connection->createCommand($query);
$dataReader=$command->query();
?>
<table>
    <tr>
        <th>Check</th>
        <th>HMO Name</th>
    </tr>
<?php
$avail_ids = array();
foreach($dataReader as $row) { 
        $avail_ids[] = $row["id"];
        echo "<tr>
                <td>
                    <input type='checkbox' name='procids[]' value='".$row["id"]."' />
                </td>
                <td>
                    ".$row["name"]."
                </td>               
            </tr>    
              ";
        
}
?>
</table>
<?php
if (count($avail_ids )==0){
    echo "<p>No more HMO to process in this period</p>";
}
?>                                                               

<input type="submit" value="   CONFIRM GENERATE BILLING   "  />
</form>