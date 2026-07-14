<?php

class FormHivController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionPrint(){
        $resultid = $_GET["resultid"];
        $model=DiagHiv::model()->findByPk((int)$resultid); 
        $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'/modules/PrintDiagResult/includes/PrintFormHiv.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wp_logo.png';

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

        $print = str_replace("[result_no]",strtoupper($model->id),$print); 

        $print = str_replace("[birthdate]",strtoupper($patient['birthdate']),$print); 
        $print = str_replace("[patient_id]",strtoupper($patient['id']),$print); 

        $print = str_replace("[date_sample_collection]",trim($model->date_sample_collection) == "" ? "-" : date('m/d/Y', strtotime($model->date_sample_collection)),$print); 
        $print = str_replace("[date_requested]",trim($model->date_requested) == "" ? "-" : date('m/d/Y', strtotime($model->date_requested)),$print); 
        $print = str_replace("[sample_type]",trim($model->sample_type) == "" ? "-" : $model->sample_type ,$print); 
        $print = str_replace("[referred_by]",trim($model->referred_by) == "" ? "-" : $model->referred_by ,$print); 
        $print = str_replace("[patient_address]",trim($model->address) == "" ? "-" : $model->address ,$print); 
        $print = str_replace("[date_received]",trim($model->date_received) == "" ? "-" : $model->date_received ,$print); 
        $print = str_replace("[date_released]",trim($model->date_released) == "" ? "-" : $model->date_released ,$print);
        $print = str_replace("[remarks]",trim($model->remarks) == "" ? "-" : $model->remarks ,$print); 

        $print = str_replace("[result]",trim($model->result) == "" ? "-" : $model->result ,$print);
        $print = str_replace("[method_used]",trim($model->method_used) == "" ? "-" : $model->method_used ,$print);

        $profile = Yii::app()->db->createCommand()->select('*')->from('auth_profiles')->where('user_id=:id', array(':id'=>$model->created_by_userid))->queryRow();
        $namearr = array(trim($profile['first_name']), trim($profile['middle_initial']), trim($profile['last_name']));
        $created_by = implode(" ", $namearr);
        $created_by_userid = $profile['user_id'];
        $print = str_replace("[medtech]",strtoupper($created_by),$print); 
        $print = str_replace("[licenseno]",strtoupper($model->licenseno),$print); 
        
        echo $print;
        exit;
    }
}