<?php

class UserHelper {

    public function updateProfile($post = [])
    {
        $result = new Returner;
        if (!isset($post['old_password'],$post['new_password'],$post['user_id'])) {
            return $result->dump('invalid parameter');
        }
        $updateProfil = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/updateProfile',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $post
            ]
        ]);
        return $updateProfil;
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