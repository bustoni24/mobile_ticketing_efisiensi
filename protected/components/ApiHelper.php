<?php

class ApiHelper {

    public function getUrl()
    {
        if (SERVER_SEGMENT == "PROD") {
            return "https://efisiensi.id/";
        } else if (SERVER_SEGMENT == "STG") {
            return "https://efisiensi.web.id/staging/";
        } else {
            return "http://localhost/efisiensi/";
        }
    }

    public function getKey()
    {
        return "h3n5r5w5q584g4r4a4a356g4m5i484b4o4e4t5p5u5t4e4w2";
    }

    public function apiCall($data){
        $result = array('success' => 0);
        if(!isset($data['url'], $data['parameter']['method']))
            return $result;

        if(isset($data['parameter']['postfields']) && $data['parameter']['method'] == "POST"){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL =>  $this->getUrl() . $data['url'] . "?id=" . $this->getKey(),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data['parameter']['postfields']),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'cache-control: no-cache',
                ),
            ));

            $result = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

        }else if($data['parameter']['method'] == "GET"){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL =>$this->getUrl() . $data['url'] . "&id=" . $this->getKey(),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    'cache-control: no-cache',
                ),
            ));

            $result = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        }
        
        if($err)
            return "cURL Error #:" . $err;

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