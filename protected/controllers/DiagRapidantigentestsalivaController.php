<?php

class DiagRapidantigentestsalivaController extends RController
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
        $model=new DiagRapidantigentestsaliva;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['DiagRapidantigentestsaliva']))
        {
            $model->attributes=$_POST['DiagRapidantigentestsaliva'];
            if($model->save()) {
                // var_dump($model); exit();
                $model->result_no = $model->id;
                $model->save();
                $this->redirect(array('view','id'=>$model->id));
            }
        } 

        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        
        if(isset($_POST['DiagRapidantigentestsaliva']))
        {
            $model->attributes=$_POST['DiagRapidantigentestsaliva'];
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
        $model=new DiagRapidantigentestsaliva('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['DiagRapidantigentestsaliva']))
            $model->attributes=$_GET['DiagRapidantigentestsaliva'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }
    
    public function loadModel($id)
    {
        $model=DiagRapidantigentestsaliva::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='diagrapidantigentestsaliva-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}