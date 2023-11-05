<?php

class ApiController extends Controller
{
	public function init() {
		header("Cache-Control: no-cache");
        header("Content-Type: application/json");

        Yii::app()->clientScript->reset();
        $this->layout = false;

		function doPrintResult($result = [])
		{
			echo json_encode($result);
			Yii::app()->end();
		}

		if (!isset(Yii::app()->user->id)){
			doPrintResult(['success'=>2, 'message' => 'No Authorized']);
		}
	}

	public function actionGetCrew()
	{
		if (!isset($_GET['id'])) {
			doPrintResult(['success' => 0, 'message' => 'Invalid Request', 'code' => '400']);
		}
		$id = $_GET['id'];
		$id = Helper::getInstance()->decode($id, "efisiens");
		if (sha1($id) != "763234db53a842f83839c7441c30ec9c8cc277d5") {
			doPrintResult(['success' => 0, 'message' => 'Invalid ID', 'code' => '401']);
		}
		$result = ApiHelper::getInstance()->getCrew($_GET);
		if (!isset($result['data']))
			doPrintResult(['hasil' => '']);
		
		doPrintResult(['hasil' => $result['data']]);
	}

	public function actionGetUpdateSaldo()
	{
		if (!isset($_GET['user_id'])) {
			doPrintResult(['success' => 0, 'message' => 'Invalid User ID', 'code' => '400']);
		}

		$user_id = $_GET['user_id'];
		$data = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getInfoSaldo',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'user_id' => $user_id,
					'role' => Yii::app()->user->role
                ]
            ]
        ]);

        if (!isset($data['data']['saldo'])) {
			doPrintResult(['success' => 0, 'message' => 'invalid data :: ' . json_encode($data), 'code' => '400']);
        }

		//set state
		Helper::getInstance()->setState(Constant::AGEN_SALDO, $data['data']['saldo']);

		doPrintResult(['success'=>1,'saldo'=>$data['data']['saldo']]);
	}
	
	public function actionGetAjaxJam()
	{
		$_POST['gtype'] = 'all';
		$option = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getAjaxJam',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $_POST
            ]
        ]);
		$data = [];
		if (isset($option['data']))
			$data = $option['data'];

		doPrintResult($data);
	}

	public function actionGetAjaxDropOff()
	{
		/* $parentId = isset($_POST['Booking_tujuan']) ? $_POST['Booking_tujuan'] : null;
		if (isset($parentId)){
			$_POST['tujuan_id'] = $parentId;
		} */
		$option = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getAjaxDropOff',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $_POST
            ]
        ]);
		$data = $_POST;
		if (isset($option['data']))
			$data = $option['data'];

		doPrintResult($data);
	}

	public function actionGetTujuanKeberangkatan()
    {
		$option = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getTujuanKeberangkatan',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $_POST
            ]
        ]);
        $data = ['0' => 'Pilih Tujuan'];
		if (isset($option['data']))
			$data = $data + $option['data'];

		doPrintResult($data);
    }

	public function actionGetTujuanKota()
	{
		$option = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getTujuanKota',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $_POST
            ]
        ]);
        $data = ['0' => 'Pilih Tujuan'];
		if (isset($option['data']['turun']))
			$data = $data + $option['data']['turun'];

		doPrintResult($data);
	}
}