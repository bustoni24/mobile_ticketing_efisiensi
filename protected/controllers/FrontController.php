<?php

class FrontController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public function init() {
		if (isset(Yii::app()->user->id, Yii::app()->user->role)){
			$this->redirect(Constant::baseUrl()."/home/index");
		} else {
			$this->redirect(Constant::baseLogin());
		}
	}
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function actionIndex()
	{
		$this->render('index', [
			
		]);
	}

	public function actionVerifikasiEmail() {
		$result = false;
		if (isset($_GET['id'])){
			$id = $this->decode($_GET['id']);
			$idArr = explode('|', $id);
			
			if (isset($idArr[1])){
				$model = User::model()->findByPk($idArr[0]);
				if (isset($model)){
					$result = true;
				}
			} else {
				$modelArmada = DataArmada::model()->findByPk($id);
				if (isset($modelArmada)){
					$result = true;
				}
			}
			if ($result) {
				$this->render('verifikasiEmail', ['id' => $id, 'type' => (isset($model) ? 'petugas' : 'member')]);
				return;
			}
		}
		if (!$result){
			throw new CHttpException(404,'Oops... Halaman yang diminta tidak ditemukan.');
			return;
		}

	}

	public function actionResendVerification() {
		$result = ['success' => 0];
		if (isset($_GET['id'], $_GET['type'])){
			if ($_GET['type'] == 'petugas'){
				$modelUser = User::model()->findByPk($_GET['id']);
				if (isset($modelUser)) {
					$result['success'] = 1;
					//send email
					SendEmail::getInstance()->sendRegisterPetugas(['model_user' => $modelUser]);
				}
			} else {
				$modelArmada = DataArmada::model()->findByPk($_GET['id']);
				if (isset($modelArmada)) {
					$modelUser = User::model()->findByPk($modelArmada->user_id);
					if (isset($modelUser)) {
						$result['success'] = 1;
						//send email
						SendEmail::getInstance()->sendRegisterMember(['model_user' => $modelUser, 'model_armada' => $modelArmada]);
					}
				}
			}
		}
		echo json_encode($result);
		exit;
	}

	public function actionVerify() {
		$result = ['success' => 0];
		if (isset($_POST['id'], $_POST['code'], $_POST['type'])) {
			$code = $_POST['code'];
			$type = $_POST['type'];

			if ($type == "petugas"){
				$modelUser = User::model()->findByPk($_POST['id']);
			} else {
				$modelArmada = DataArmada::model()->findByPk($_POST['id']);
				if (isset($modelArmada)) {
					$modelUser = User::model()->findByPk($modelArmada->user_id);
				}
			}

			if (isset($modelUser)) {
				//verify email
				$kode_verifikasi = $modelUser->kode_verifikasi;
				if ($code == $kode_verifikasi) {
					$modelUser->email_verified = 1;
					$modelUser->active = 1;
					if ($modelUser->save()){
						$login = new LoginForm;
						$login->username = $modelUser->username;
						$login->password = $modelUser->password;
						if ($login->loginForSystem()){
							$result['success'] = 1;
						}
					}
				}
			}
		}
		echo json_encode($result);
		exit;
	}

	public function actionGetCityName(){
        if (isset($_GET['key']) && strlen($_GET['key']) >= 0) {
            $key = $_GET['key'];
			if (!empty($key)) {
				$listCity = City::model()->findAll('name like :key ', array(':key' => "%$key%"));
			} else {
				$listCity = City::model()->findAll(['limit'=>50]);
			}

			$result = [];
				foreach ($listCity as $key) {
					$result[] = ['label' => $key->name, 'value' => $key->id];
				}

				echo json_encode(array("hasil" => $result));

			} else{
				echo json_encode(array("hasil" => ""));
			}
			Yii::app()->end();
    }

	public function actionValidCity() {
		$result = ['success' => 0];
		if (isset($_POST['label'])) {
			$city = City::model()->findByAttributes(['name' => $_POST['label']]);
			if (isset($city->id)){
				$result['success'] = 1;
			}
		}
		echo json_encode($result);
		exit;
	}

	public function actionHomepage() {
		$this->render('homePage',[]);
	}

	public function actionScanQR() {
		$this->render('scanQR', []);
	}

	public function actionTermsOfUse()
	{
		$this->topTitle = "Terms Of Use";
		$this->render('/site/termsOfUse', []);
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && ($_POST['ajax']==='register-form' || $_POST['ajax'] === 'register-checkpoint'))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}