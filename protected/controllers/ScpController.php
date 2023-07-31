<?php

class ScpController extends Controller
{
	public function actionIndex()
	{
		$model=new LoginForm;
  
  		// if it is ajax validation request
  		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
  		{
  			echo CActiveForm::validate($model);
  			Yii::app()->end();
  		}
  
  		// collect user input data
  		if(isset($_POST['LoginForm']))
  		{
  			$model->attributes=$_POST['LoginForm'];
  			// validate user input and redirect to the previous page if valid
  			if($model->validate() && $model->login())
  				$this->redirect(Yii::app()->request->baseUrl."/front");
  		}
  		// display the login form
  		$this->render('/site/login',array('model'=>$model));	
	}
}