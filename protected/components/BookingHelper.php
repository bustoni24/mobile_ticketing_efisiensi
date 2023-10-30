<?php

class BookingHelper {

    public function checkAvailableBooking($post = [])
    {
        $result = new Returner;
        if (!isset($post['trip_id'],$post['startdate'],$post['armada_ke'],$post['seat'])) {
            return $result->dump('invalid parameter');
        }
        $check = ApiHelper::getInstance()->callUrl([
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

    public function exportBookingDataUser($model)
    {
        Yii::app()->controller->layout = false;
        header_remove();

        if (!isset($model))
            Helper::getInstance()->dump("Data model tidak valid");

        $title = "Report_booking_per_user";
        $titleSheet = "REPORT PENJUALAN PER USER";

        $columnField = [
            ['Kursi','Jam Keberangkatan','Penumpang','Jml Penumpang','Naik','Penurunan','Kota Tujuan','Total Harga','Dijual Oleh','Group Trip','Kelas','Tgl Input','Tgl Keberangkatan']
        ];
        $columns = [];$i = 0;
        foreach(range('A','Z') as $v){
            if (!isset($columnField[0][$i]))
                break;
            $columns_ = ['column' => $v, 'value' => strtolower(str_replace(' ','_',$columnField[0][$i])), 'text' => $columnField[0][$i]];
            array_push($columns, $columns_);
            $i++;
        }

        $fieldRaw = [];
        $i = 1;

        $totalPenjualan = 0;
        foreach ($model->searchDataBookingUser(false)->getData() as $data){
            // Helper::getInstance()->dump($data);
            array_push($fieldRaw, [
                $data['kursi'],
                $data['booking_trip_label'],
                $data['nama_penumpang'],
                $data['jml_penumpang'],
                $data['naik'],
                $data['turun'],
                $data['nama_kota_tujuan'],
                $data['total_harga'],
                $data['user_jual'],
                $data['nama_group'],
                $data['kelas_bus'],
                $data['created_date'],
                $data['tanggal']
            ]);

            $totalPenjualan += (int)$data['total_harga'];
        }

        array_push($fieldRaw, ['Total Penjualan','','','','','','',$totalPenjualan,'','','','','']);
        
        $dataExcel = [];
            //tambah row summary
            array_push($fieldRaw, ['','','','','','','','','','','','','']);
            $j=0;
            foreach ($fieldRaw as $val) {
                $k = 0;
                $data_ = [];
                foreach ($columns as $column_) {
                    $data_[$column_['value']] = $val[$k];
                    $k++;
                }
                array_push($dataExcel, $data_);
                $j++;
            }

            $countColumn = count($columns);
            $firstColumn = $columns[0]['column'];
            $lastColumn = $columns[$countColumn - 1]['column'];

            Helper::getInstance()->exportExcelRaw([
                'title' => $title,
                'titleSheet' => $titleSheet,
                'firstColumn' => $firstColumn,
                'lastColumn' => $lastColumn,
                'columns' => $columns,
                'dataExcel' => $dataExcel
                ]);
        exit;
    }

    public function searchTujuan($post)
    {
        $check = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/searchTujuan',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $post
            ]
        ]);
        return $check;
    }

    public function updateStatus($post)
    {
        $post['role'] = Yii::app()->user->role;
        $post['source_naik'] = 'manifest';
        $check = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/updateStatus',
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