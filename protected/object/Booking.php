<?php

class Booking
{
	public $startdate;
	public $trip_id;
	public $boarding_name;
	public $drop_off_name;
	public $jam_berangkat;
    public $titik_keberangkatan;
    public $alamat_titik_keberangkatan;
    public $route_id = null;
    public $armada_ke = null;
    public $rit = null;
    public $latitude, $longitude, $tujuan, $penjadwalan_id;
    public $id = null;

    public function searchBooking()
    {
        $data = [];
        if (!isset($this->startdate) || empty($this->startdate)){
			return new CArrayDataProvider($data, array(
				'keyField' => 'id',
				'pagination' => array(
					'pageSize' => count($data),
					),
				));	
		}

		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/listBooking',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'startdate' => $this->startdate,
                    'latitude' => isset($this->latitude) ? $this->latitude : null,
                    'longitude' => isset($this->longitude) ? $this->longitude : null,
                    'user_id' => Yii::app()->user->id,
                    'role' => Yii::app()->user->role,
                    'tujuan' => isset($this->tujuan) ? $this->tujuan : null,
                    'rit' => isset($this->rit) ? $this->rit : null,
                    'penjadwalan_id' => isset($this->penjadwalan_id) ? $this->penjadwalan_id : null //ini untuk scanner
                    ]
            ]
        ]);

        if (isset($res['data'])) {
            $data = [
                [   
                    'id' => 1,
                    'data' => $res['data']
                ]
            ];
        }

        // Helper::getInstance()->dump($res);
        
		return new CArrayDataProvider($data, array(
			'keyField' => 'id',
			'pagination' => array(
				'pageSize' => count($data),
				),
			));	
    }

    public function routeDetail()
    {
        $data = [];
        if (!isset($this->startdate, $this->route_id, $this->armada_ke) || empty($this->route_id)){
			return new CArrayDataProvider($data, array(
				'keyField' => 'id',
				'pagination' => array(
					'pageSize' => count($data),
					),
				));	
		}

		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/listBooking',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'route_id' => $this->route_id,
                    'armada_ke' => $this->armada_ke,
                    'startdate' => $this->startdate,
                    'user_id' => Yii::app()->user->id,
                    'role' => Yii::app()->user->role,
                    'penjadwalan_id' => $this->penjadwalan_id
                    ]
            ]
        ]);  

        if (isset($res['data'])) {
            $data = [
                [   
                    'id' => 1,
                    'data' => $res['data']
                ]
            ];
        }
        // Helper::getInstance()->dump($data);
        
		return new CArrayDataProvider($data, array(
			'keyField' => 'id',
			'pagination' => array(
				'pageSize' => count($data),
				),
			));	
    }

    public function dataLastBooking()
    {
        $data = [];
        if (!isset($this->id)){
			return new CArrayDataProvider($data, array(
				'keyField' => 'id',
				'pagination' => array(
					'pageSize' => count($data),
					),
				));	
		}
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/dataLastBooking',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'id' => $this->id
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

    public function getDetailPenumpang($id)
    {
        $html = "-";
        $res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getDetailPenumpang',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'id' => $id
                    ]
            ]
        ]);
        if (isset($res['data']))
            $html = $res['data'];

        return $html;
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
