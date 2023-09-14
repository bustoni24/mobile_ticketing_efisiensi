<?php

class Report
{
	public $startdate;
	public $enddate;
	public $agen_id;

    public function searchReportDeposit()
    {
        $data = [];
        if (!isset($this->startdate, $this->enddate) || empty($this->startdate) || empty($this->enddate)){
			return new CArrayDataProvider($data, array(
				'keyField' => 'id',
				'pagination' => array(
					'pageSize' => count($data),
					),
				));	
		}
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/reportDeposit',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'startdate' => $this->startdate,
                    'enddate' => $this->enddate,
                    'user_id' => Yii::app()->user->id,
                    'role' => Yii::app()->user->role
                    ]
            ]
        ]);

        $keyField = "id";
        if (isset($res['data'])) {
            $data = $res['data'];
            $keyField = isset($res['key_field']) ? $res['key_field'] : "id";
        }

        // Helper::getInstance()->dump($res);
        
		return new CArrayDataProvider($data, array(
			'keyField' => $keyField,
			'pagination' => array(
				'pageSize' => count($data),
				),
			));	
    }

    public function searchDataBooking()
    {
        $data = [];
        if (!isset($this->startdate, $this->enddate) || empty($this->startdate) || empty($this->enddate)){
			return new CArrayDataProvider($data, array(
				'keyField' => 'id',
				'pagination' => array(
					'pageSize' => count($data),
					),
				));	
		}
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/dataBooking',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'startdate' => $this->startdate,
                    'enddate' => $this->enddate,
                    'agen_id' => Yii::app()->user->sdm_id,
                    'role' => Yii::app()->user->role
                    ]
            ]
        ]);

        $keyField = "id";
        if (isset($res['data'])) {
            $data = $res['data'];
            $keyField = isset($res['key_field']) ? $res['key_field'] : "id";
        }

        // Helper::getInstance()->dump($res);
        
		return new CArrayDataProvider($data, array(
			'keyField' => $keyField,
			'pagination' => array(
				'pageSize' => count($data),
				),
			));	
    }

    private static $instance;

    public static function object()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}