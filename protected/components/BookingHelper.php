<?php

class BookingHelper {

    public function checkAvailableBooking($post = [])
    {
        $result = new Returner;
        if (!isset($post['trip_id'],$post['startdate'],$post['armada_ke'],$post['seat'])) {
            return $result->dump('invalid parameter');
        }
        return $check = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/checkAvailableBooking',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $post
            ]
        ]);
        $html = "";
        $seatBooked = [];
        if (isset($check['data'])) {
            $html = "<table class='table'><tbody>";
            foreach ($check['data'] as $key => $value) {
                $html .= "<tr>
                    <td>Kursi nomor $key sudah terisi</td>
                    <td>Kode booking: $value</td>
                </tr>";

                $seatBooked[] = $key;
            }
            $html .= "<tr>
                    <td colspan='2' class='red'>Mohon untuk mengganti nomor kursi</td>
                    </tr>";
            $html .= "</tbody></table>";

            $check['data'] = $html;
            $check['seat_booked'] = $seatBooked;
            return $check;
        }
        return $check;
    }

    public function checkBeforeAfterSeat($post = [])
    {
        $result = new Returner;
        if (!isset($post['trip_id'],$post['startdate'],$post['armada_ke'],$post['seatCount'])) {
            return $result->dump('invalid parameter');
        }
        $check = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/checkBeforeAfterSeat',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $post
            ]
        ]);
        return $check;
    }

    public function deletePengeluaran($post = [])
    {
        $result = new Returner;
        if (!isset($post['id'])) {
            return $result->dump('invalid parameter');
        }
        $check = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/deletePengeluaran',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $post
            ]
        ]);
        return $check;
    }

    public function refundSolar($post = [])
    {
        $result = new Returner;
        if (!isset($post['refund'], $post['penjadwalan_id'])) {
            return $result->dump('invalid parameter');
        }
        $post['user_id'] = Yii::app()->user->id;
        $post['role'] = Yii::app()->user->role;
        $check = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/refundSolar',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $post
            ]
        ]);
        return $check;
    }

    public function saveLatlong($post = [])
    {
        $result = new Returner;
        if (!isset($post['latitude'], $post['longitude'], $post['penjadwalan_id'])) {
            return $result->dump('invalid parameters');
        }
        $post['user_id'] = Yii::app()->user->id;
        $post['role'] = Yii::app()->user->role;
        $check = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/saveLatlong',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $post
            ]
        ]);
        return $check;
    }

    public function getCrewLocations($get)
    {
        $post['user_id'] = Yii::app()->user->id;
        $post['role'] = Yii::app()->user->role;
        $post['startdate'] = date('Y-m-d');
        $post['trip_id'] = isset($get['trip_id']) ? $get['trip_id'] : null;
        $check = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getCrewLocations',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $post
            ]
        ]);
        return $check;
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