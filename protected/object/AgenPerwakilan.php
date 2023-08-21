<?php

class AgenPerwakilan
{
    public function getListAgenDeposit()
    {
        $result = ['self' => 'Deposit Pribadi'];
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getListAgenDeposit?1=1',
            'parameter' => [
                'method' => 'GET'
            ]
        ]);
        if (isset($res['data'])) {
            $result = $result + $res['data'];
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
