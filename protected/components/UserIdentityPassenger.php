<?php

date_default_timezone_set("Asia/Jakarta");

class UserIdentityPassenger extends CUserIdentity {
    private $_id; //set id untuk unique identifier
    public $role;

    public function authenticate() {
        $user = $this->username;
        $pass = $this->password;
        
        $parameters = [
            'url' => 'apiMobile/login',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'username' => $user,
                    'password' => md5($pass),
                    'type' => 'member'
                ]
            ]
        ];
        $login = ApiHelper::getInstance()->callUrl($parameters);
        if (isset($login['data'])) {
            $this->_id = $login['data']['id'];
            $this->setState('username', $login['data']['username']);
            $this->setState('role', $login['data']['role']);
            $this->setState('nama', $login['data']['name']);
            $this->setState('no_hp', $login['data']['no_hp']);
            $this->setState('alamat', $login['data']['alamat']);

            $this->errorCode = self::ERROR_NONE;

            return !$this->errorCode;
        } else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return !$this->errorCode;
        }
    }

    public function getId() {
        return $this->_id;
    }

}