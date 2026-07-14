<?php

class FormRapidtestController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionPrint(){
        $resultid = $_GET["resultid"];
        $model=DiagRapidtest::model()->findByPk((int)$resultid); 
        $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'/modules/PrintDiagResult/includes/PrintFormRapidtest.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';

        $settings = Settings::model()->findByPk(1);   
        $print = str_replace("[bacoor_address_html]",$settings->bacoor_address_html,$print);
        $print = str_replace("[dasma_address_html]",$settings->dasma_address_html,$print);
        $print = str_replace("[address]",$settings->address,$print);
        $print = str_replace("[logopath]",$logo,$print);

        $patient = Yii::app()->db->createCommand()->select('*')->from('patient')->where('id=:id', array(':id'=>$model->patient_id))->queryRow();
        $patientname = $patient['lastname'].", ".$patient['firstname']." ".$patient['middleinitial'];
        
        $print = str_replace("[name]",strtoupper($patientname),$print);  
        $print = str_replace("[age]",strtoupper($model->age),$print);  

        $gender = "";
        if ($patient['gender'] == "M") { $gender = "MALE"; }
        else if ($patient['gender'] == "F") { $gender = "FEMALE"; }
        else { $gender = strtoupper($patient['gender']); }
        $print = str_replace("[sex]", $gender, $print);  

        $print = str_replace("[requesting_physician]",strtoupper($model->requesting_physician),$print); 
        $print = str_replace("[result_no]",strtoupper($model->id),$print); 

        $print = str_replace("[birthdate]",strtoupper($patient['birthdate']),$print); 
        $print = str_replace("[patient_id]",strtoupper($patient['id']),$print); 

        $print = str_replace("[date_ordered]",trim($model->date_ordered) == "" ? "-" : $model->date_ordered ,$print); 
        $print = str_replace("[date_received]",trim($model->date_received) == "" ? "-" : $model->date_received ,$print); 
        $print = str_replace("[date_released]",trim($model->date_released) == "" ? "-" : $model->date_released ,$print); 

        $print = str_replace("[igg_con]",trim($model->igg_con) == "" ? "-" : $model->igg_con ,$print); 
        $print = str_replace("[igm_con]",trim($model->igm_con) == "" ? "-" : $model->igm_con ,$print); 

        $print = str_replace("[igg_si]",trim($model->igg_si) == "" ? "-" : $model->igg_si ,$print); 
        $print = str_replace("[igm_si]",trim($model->igm_si) == "" ? "-" : $model->igm_si ,$print); 

        $profile = Yii::app()->db->createCommand()->select('*')->from('auth_profiles')->where('user_id=:id', array(':id'=>$model->created_by_userid))->queryRow();
        $namearr = array(trim($profile['first_name']), trim($profile['middle_initial']), trim($profile['last_name']));
        $created_by = implode(" ", $namearr);
        $created_by_userid = $profile['user_id'];
        $print = str_replace("[medtech]",strtoupper($created_by),$print); 
        $print = str_replace("[licenseno]",strtoupper($model->licenseno),$print); 
        // $print = str_replace("[pathologist]",strtoupper($model->pathologist),$print); 
        // $print = str_replace("[patlicenseno]","0076484",$print);  
        // $print = str_replace("[patientid]",$model->patient_id,$print);   
        
        echo $print;
        exit;
    }
}