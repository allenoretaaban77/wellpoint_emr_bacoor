<?php

class DiagHivController extends RController
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
        $model=new DiagHiv;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['DiagHiv']))
        {
            $model->attributes=$_POST['DiagHiv'];
            $model->date_created=date('Y-m-d');
            if($model->save()) {
                $model->save();
                $this->redirect(array('view','id'=>$model->id));
            }
        } else {
            $profile=Yii::app()->getModule('user')->user()->profile;
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

        if(isset($_POST['DiagHiv']))
        {
            $model->attributes=$_POST['DiagHiv'];
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
        $model=new DiagHiv('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['DiagHiv']))
            $model->attributes=$_GET['DiagHiv'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }
    
    public function loadModel($id)
    {
        $model=DiagHiv::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='diaghiv-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}