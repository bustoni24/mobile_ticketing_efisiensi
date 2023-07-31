<?php

class Armada
{
	public $startdate, $filter = null, $get = null;
	public $id_trip,$group,$kelas,$groupId,$armadaId;
    public function searchListBus()
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
            'url' => 'apiMobile/listBus',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
					'startdate' => $this->startdate,
					'get' => $this->get,
					'filter' => $this->filter
					]
            ]
        ]);
        if (isset($res['data'])) {
            $data = $res['data'];
        }
        
		return new CArrayDataProvider($data, array(
			'keyField' => 'id',
			'pagination' => array(
				'pageSize' => count($data),
				),
			));	
    }

	public function getKelasArmada()
	{
		$result = [];
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getKelasArmada?1=1',
            'parameter' => [
                'method' => 'GET'
            ]
        ]);
        if (isset($res['data'])) {
            $result = $res['data'];
        }

		return $result;
	}

	public function getGroupTrip()
	{
		$result = [];
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getGroupTrip?1=1',
            'parameter' => [
                'method' => 'GET'
            ]
        ]);
        if (isset($res['data'])) {
            $result = $res['data'];
        }
		return $result;
	}

    public function getOptionsArmada()
    {
        $result = [];
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getOptionsArmada?1=1',
            'parameter' => [
                'method' => 'GET'
            ]
        ]);
        if (isset($res['data'])) {
            $result = $res['data'];
        }
		return $result;
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
