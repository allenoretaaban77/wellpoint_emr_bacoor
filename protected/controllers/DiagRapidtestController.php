<?php

class DiagRapidtestController extends RController
{
    //for menu
    public $layout='//layouts/column2';
    
	public function actionIndex()
	{
		$this->render('index');
	}
    
    public function filters()
    {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }
    
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('view','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }
    
    
    public function actionCreate()
    {
        $model=new DiagRapidtest;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['DiagRapidtest']))
        {
            $model->attributes=$_POST['DiagRapidtest'];
            //$model->datecreated=date('Y-m-d');
            //$model->datereleased=date('Y-m-d');
            if($model->save()) {
                $model->result_no = $model->id;
                $model->save();
                $this->redirect(array('view','id'=>$model->id));
            }
        } else {
            $profile=Yii::app()->getModule('user')->user()->profile;
            // $model->licenseno=$profile->licenseno;
            // $model->med_tech=$profile->first_name.' '.$profile->last_name;
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['DiagRapidtest']))
        {
            $model->attributes=$_POST['DiagRapidtest'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }
    
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    
    public function actionAdmin()
    {
        $model=new DiagRapidtest('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['DiagRapidtest']))
            $model->attributes=$_GET['DiagRapidtest'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }
    
    public function loadModel($id)
    {
        $model=DiagRapidtest::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='diagrapidtest-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*public function actionProcess() { 
        // $connection = Yii::app()->db;
        // $command = $connection->createCommand("delete from diag_rapidtest");
        // $dataReaderIns = $command->query();

        $data=DiagTempsResults::model()->findAllBySql("select * from diag_temps_results where diagtemptitle = 'RAPID COVID-19 TEST'");
        foreach($data as $row){

            // $x = new DiagRapidtest;
            // $x->id = $row['resultno'];
            // $x->result_no = $row['resultno'];
            // $x->patient_id = $row['patient_id'];
            // $x->name = $row['patient_name'];
            // $x->age = $row['age'];
            // $x->requesting_physician = "DR";
            // $x->date_ordered = "";
            // $x->date_received = "";
            // $x->date_released = "";
            // $x->date_created = $row['createdate'];
            // if (substr_count($row['result_content'], 'NEGATIVE') == 2) {
            //     $x->igg_con = "NEGATIVE";
            //     $x->igm_con = "NEGATIVE";
            // } 
            // if (substr_count($row['result_content'], 'NEGATIVE') == 1 && substr_count($row['result_content'], 'NEGATIVE') == 1) {
            //     $x->igg_con = "NEGATIVE";
            //     $x->igm_con = "NEGATIVE";
            // }
            // if($x->save()) {
            // }

            // $model=$this->loadModel($row['resultno']);
            // $model->date_released = "2020-07-22";
            // $model->save();

            // echo $row['resultno']." | ".strpos($row['result_content'], 'NEGATIVE')."<br>";
            // echo substr_count($row['result_content'], 'NEGATIVE')."<br>";
            $result_content = str_replace("\r\n", "", $row['result_content']);
            $str_ref = htmlentities(str_replace("\r\n", "", $result_content));
            $str_dt = substr($str_ref, strpos($str_ref, 'Released') + 89, 10);
            if (substr($str_dt, 0, 4) == "2020") {
                $model=$this->loadModel($row['resultno']);
                $model->date_released = $str_dt;
                $model->save();
                echo $str_dt."<br>";
            }

        }
        echo "DONE";
    }*/
}