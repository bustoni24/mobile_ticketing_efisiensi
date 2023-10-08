<?php

class Report
{
	public $startdate;
	public $enddate;
	public $agen_id;
    public $type_date;
    public $is_export = false;

    public function searchReportDeposit()
    {
        /* $data = [];
        if (!isset($this->startdate, $this->enddate) || empty($this->startdate) || empty($this->enddate)){
			return new CArrayDataProvider($data, array(
				'keyField' => 'id',
				'pagination' => array(
					'pageSize' => count($data),
					),
				));	
		} */
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/sumSaldoAgen',
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
				'pageSize' => 5,
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
				'pageSize' => 10,
				),
			));	
    }

    public function searchDataBookingUser($pagination = true, $params = [])
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
            'url' => 'apiMobile/dataBookingUser',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'startdate' => $this->startdate,
                    'enddate' => $this->enddate,
                    'agen_id' => Yii::app()->user->sdm_id,
                    'role' => Yii::app()->user->role,
                    'type_date' => isset($this->type_date) ? $this->type_date : null,
                    'is_export' => $this->is_export
                    ]
            ]
        ]);

        // Helper::getInstance()->dump($res);

        $keyField = "id";
        if (isset($res['data'])) {
            $data = $res['data'];
            $keyField = isset($res['key_field']) ? $res['key_field'] : "id";
        }

        if (isset($params['get_total']) && $params['get_total'] == 1) {
            return isset($res['total_penjualan']) ? $res['total_penjualan'] : 0;
        }
        
		return new CArrayDataProvider($data, array(
			'keyField' => $keyField,
			'pagination' => array(
				'pageSize' => $pagination ? 10 : count($data),
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