<?php

class Constant {

    const PROJECT_NAME = "Mobile Efisiensi";
    const KETERANGAN_NEW_ORDER = "NEW ORDER";
    const TYPE_BOOKING = "BOOKING";

    const TARIF_NORMAL = 1;
    const TARIF_PROMO = 2;
    const TARIF_HIGH_SEASON = 3;

    const KELAS_BUSSINESS = 1;
    const KELAS_GOLD = 2;
    const KELAS_BANDARA = 3;

    const LEVEL_AKSES_ADMIN = 1;
    const LEVEL_AKSES_AGEN = 2;
    const LEVEL_AKSES_CREW = 3;
    const LEVEL_AKSES_CHECKER = 4;
    const LEVEL_AKSES_KJ = 5;
    const LEVEL_AKSES_DRIVER = 6;
    const LEVEL_AKSES_KEUANGAN = 7;

    public static function iconSeat($type = "") {
        switch ($type) {
            case 'selected':
                return self::baseUrl() . '/images/icon/seat_car_green.png';
                break;

            case 'booked':
                return self::baseUrl() . '/images/icon/seat_car_red.png';
                break;

            case 'temporary':
                return self::baseUrl() . '/images/icon/seat_car_blue.png';
                break;
            
            default:
                return self::baseUrl() . '/images/icon/seat_car_default.png';
                break;
        }
    }

    public static function steeringWheelIcon() {
        return self::baseUrl() . '/images/icon/steering_wheel.png';
    }

    public static function toiletIcon() {
        return self::baseUrl() . '/images/icon/toilet.png';
    }

    public static function toiletSignIcon() {
        return self::baseUrl() . '/images/icon/toilet_sign.png';
    }

    public static function newLogoIcon() {
        return self::baseUrl() . '/images/new_logo_efisiensii.png';
    }

    public static function baseUrl() {
        return Yii::app()->request->baseUrl;
    }

    public static function baseAdminUrl() {
        return Yii::app()->request->baseUrl.'/home';
    }

    public static function getImageUrl() {
        return Yii::app()->request->baseUrl . "/images";
    }

    public static function baseUploadsPath() {
        return Yii::app()->request->baseUrl . "/uploads";
    }

    public static function baseUrlFront() {
        return Yii::app()->request->baseUrl.'/';
    }

    public static function baseLogin() {
        return Yii::app()->request->baseUrl.'/loginadmin';
    }

    public static function baseJsUrl() {
    	return Yii::app()->assetManager->publish('./js');
    }

    public static function baseCssUrl() {
    	return Yii::app()->assetManager->publish('./css');
    }

    public static function frontAssetUrl() {
        return Yii::app()->assetManager->publish('./themes/nice');
    }

    public static function frontAsset() {
        return Yii::app()->assetManager->publish('./app');
    }

    public static function assetsUrl() {
        return Yii::app()->assetManager->publish('./themes/gentelella');
    }

    public static function defaultAction() {
    	return ['admin','index','create','view','update','delete'];
    }
}