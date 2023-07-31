<?php

class BookingHelper {

    public function scannerResult($post = [])
    {
        $result = new Returner;
        if (!isset($post['id'])) 
            return $result->dump('invalid ID');

        //search data booking
        
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