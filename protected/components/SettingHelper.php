<?php

class SettingHelper {

    public static function getValue($name, $default = null) {
        $result = $default;
        $res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getEnvironmentValue',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'name' => $name,
                    'default' => $default
                    ]
            ]
        ]);
        if (isset($res['data']))
            $result = $res['data'];

        return $result;
    }

    public function callUrl($data) {

        $result = self::apiCall($data);
        if (!isset($result)){
            $result = self::apiCall($data);

            if (!isset($result))
                return null;
        }

        return json_decode($result, true);
    }

    private static $instance;

    private function __construct()
    {
        // Hide the constructor
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}