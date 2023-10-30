<?php

class Helper {

    public function resizer($photo)
    {
        // Get the image info from the photo
        $image_info = getimagesize($photo);
        $width = $new_width = $image_info[0];
        $height = $new_height = $image_info[1];
        $type = $image_info[2];

        // Load the image
        switch ($type)
        {
            case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($photo);
            break;
            case IMAGETYPE_GIF:
            $image = imagecreatefromgif($photo);
            break;
            case IMAGETYPE_PNG:
            $image = imagecreatefrompng($photo);
            break;
            default:
            die('Error loading '.$photo.' - File type '.$type.' not supported');
        }

// Create a new, resized image
        $new_width = 500;
        $new_height = $height / ($width / $new_width);
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Save the new image over the top of the original photo
        switch ($type)
        {
            case IMAGETYPE_JPEG:
            imagejpeg($new_image, $photo, 500);
            break;
            case IMAGETYPE_GIF:
            imagegif($new_image, $photo);         
            break;
            case IMAGETYPE_PNG:
            imagepng($new_image, $photo);
            break;
            default:
            die('Error saving image: '.$photo);
        }

    }

    public function resize($namafile){
        try {
            $key = "";
            // $input = "logotest.png";
            // $output = "Output.png";
            $input = $namafile;
            $output = $namafile;
            $url = "https://api.tinify.com/shrink";
            $options = array(
              "http" => array(
                "method" => "POST",
                "header" => array(
                  "Content-type: image/png",
                  "Authorization: Basic " . base64_encode("api:$key")
                ),
                "content" => file_get_contents($input)
              ),
              "ssl" => array(
                /* Uncomment below if you have trouble validating our SSL certificate.
                   Download cacert.pem from: http://curl.haxx.se/ca/cacert.pem */
                 "cafile" => dirname(__FILE__) ."/../../cacert.pem",
                "verify_peer" => false
              )
            );

            $result = @fopen($url, "r", false, stream_context_create($options));
            if ($result) {
              /* Compression was successful, retrieve output from Location header. */
              foreach ($http_response_header as $header) {
                if (substr($header, 0, 10) === "Location: ") {
                  file_put_contents($output, fopen(substr($header, 10), "rb", false));
                  // print("Compression success");
                }
              }
            } else {
              /* Something went wrong! */
              // print("Compression failed");
            }
        } catch (Exception $e) {
            // print("Compression failed");
        }
    }

    public function getQuestion()
    {
      return [
        [
          'id' => '10',
          'name' => 'pekerjaan',
          'value' => 'Apakah Anda menjalankan Usaha atau Pekerjaan bebas?',
        ],
        [
          'id' => '11',
          'name' => 'jenis_pajak',
          'value' => 'Apakah Anda seorang Suami atau Istri yang menjalankan kewajiban perpajakan terpisah (MT) atau Pisah Harta (PH)?',
        ],
        [
          'id' => '12',
          'name' => 'form_pajak',
          'value' => 'Anda dapat menggunakan Formulir 1770 S, pilihlah form yang akan digunakan'
        ],
        [
          'id' => '13',
          'name' => 'bruto',
          'value' => 'Anda penghasilan Bruto yang anda peroleh selama setahun kurang dari 60 Juta rupiah?'
        ],
      ];
    }

    public function getOptions()
    {
      return [
        [
          'id' => '1',
          'value' => 'Ya',
        ],
        [
          'id' => '2',
          'value' => 'Tidak',
        ],
        [
          'id' => '3',
          'value' => 'Dengan bentuk formulir',
        ],
        [
          'id' => '4',
          'value' => 'Dengan panduan',
        ],
        [
          'id' => '5',
          'value' => 'Dengan upload SPT',
        ],
      ];
    }

    public function getInitData()
    {
      return [
        [
          'id_question' => '10',
          'id_option' => '1',
          'type' => 'button',
          'value' => [
            'text' => 'Upload SPT', 'url' => '#'
          ]
        ],
        [
          'id_question' => '10',
          'id_option' => '2',
          'type' => 'option',
          'value' => [
            'id' => '11'
          ]
        ],
        [
          'id_question' => '11',
          'id_option' => '1',
          'type' => 'option',
          'value' => [
            'id' => '12'
          ]
        ],
        [
          'id_question' => '11',
          'id_option' => '2',
          'type' => 'option',
          'value' => [
            'id' => '13'
          ]
        ],
        [
          'id_question' => '12',
          'id_option' => '3',
          'type' => 'button',
          'value' => [
            'text' => 'SPT 1770 S dengan formulir', 'url' => '#'
          ]
        ],
        [
          'id_question' => '12',
          'id_option' => '4',
          'type' => 'button',
          'value' => [
            'text' => 'SPT 1770 S dengan panduan', 'url' => '#'
          ]
        ],
        [
          'id_question' => '12',
          'id_option' => '5',
          'type' => 'button',
          'value' => [
            'text' => 'Upload SPT', 'url' => '#'
          ]
        ],
        [
          'id_question' => '13',
          'id_option' => '1',
          'type' => 'button',
          'value' => [
            'text' => 'SPT 1770 SS', 'url' => Constant::baseUrl().'/home/formSPT'
          ]
        ],
        [
          'id_question' => '13',
          'id_option' => '2',
          'type' => 'option',
          'value' => [
            'id' => '12'
          ]
        ],
      ];
    }

    public function searchForQuestion($data = []) {
      if (isset($data['array'], $data['type'], $data['value'])){
        $array = $data['array'];
        $type = $data['type'];
        $value = $data['value'];

        foreach ($array as $key => $val) {
          if ($type === 'id') {
            if ($val['id'] === $value) {
              return $val;
            }
          } else if ($type === 'name'){
            if ($val['name'] === $value) {
              return $val;
            }
          }
      }
      }
      return null;
   }

   public function searchByQuestion($data = [])
   {
     $result = [];
     if (isset($data['array'], $data['id_question'])) {
       $array = $data['array'];
       $id_question = $data['id_question'];
       foreach ($array as $key => $val) {
         if ($val['id_question'] === $id_question){
           $result[] = $val;
         }
       }
     }
     return $result;
   }

   public function searchOption($data = [])
   {
     $result = null;
     if (isset($data['array'], $data['id_option'])){
      $array = $data['array'];
      $id_option = $data['id_option'];
      foreach ($array as $key => $val) {
        if ($val['id'] === $id_option){
          $result = $val['value'];
          break;
        }
      }
     }
     return $result;
   }

   public function getID($model = null, $prefix = null, $length = 3)
   {
      if (!isset($model, $prefix))
        return null;
      
        $data = $model::model()->find(['order' => 'id DESC']);
        $lastID = 0;
        if (isset($data)) {
          $lastID = $data->id;
        }
        $nextNoUrut = $lastID + 1;
        return $prefix.".".sprintf("%0". $length ."s",$nextNoUrut);
   }

   public function generateSuratJalan($model)
   {
      if (!isset($model))
        return null;

        $count = FormSebelumMengemudi::model()->count('no_surat_jalan IS NOT NULL AND no_surat_jalan != ""');
        $count += 1;
        if ($count < 10)
          $count = "0".$count;

        return $count.'/STJ/EFI/'.date('m/Y', strtotime($model->confirm_date));
   }

   public function getJabatan()
   {
     return [
              'Komisaris' => 'Komisaris',
              'Direktur' => 'Direktur',
              'SMKPAU' => 'SMKPAU',
              'Manager Operasional' => 'Manager Operasional',
              'Manager HRGA' => 'Manager HRGA',
              'Manager Finance' => 'Manager Finance',
              'Manager Sales & Marketing' => 'Manager Sales & Marketing',
              'IT' => 'IT',
              'General Affair' => 'General Affair',
              'Staff Finance' => 'Finance & Admin',
              'Customer Service' => 'Customer Service',
              'Tiketing' => 'Tiketing',
              'Pariwisata' => 'Pariwisata',
              'SPV e-EX' => 'SPV e-EX',
              'Manager Jalur' => 'Kepala Jalur',
              'Kepala Mekanik' => 'Kepala Bengkel',
              'Kepala Logistik' => 'Kepala Logistik',
              'Manager HRD' => 'Manager HRD',
              'Legal' => 'Legal OPS',
              'Admin HRGA' => 'Admin HRGA',
              'Teller' => 'Teller',
              'Agen' => 'Agen',
              'Checker' => 'Checker',
              'Staff Operasional' => 'Admin Operasional',
              'Mekanik' => 'Mekanik',
              'Logistic' => 'Staff Logistik',
              'Tranning' => 'Tranning', 
              'Staff HRD' => 'Staff HRD',
              'Staff Accounting' => 'Staff Accounting',
              'Pengemudi' => 'Pengemudi',
              'Cabin Crew' => 'Cabin Crew', 
              'Office Boy' => 'Office Boy',
              'Security' => 'Security',
              'Kurir' => 'Kurir',
            ];
   }

   public function workingHour2()
   {
      return [
        'MASUK_START' => '09:00',
        'MASUK_END' => '12:00',
        'PULANG_START' => '12:01',
        'PULANG_END' => '17:00'
      ];
   }

   public function workingHour()
   {
      return [
        'MASUK_START' => '08:00',
        'MASUK_END' => '12:00',
        'PULANG_START' => '12:01',
        'PULANG_END' => '16:00'
      ];
   }

   public function scanHour($scan_date = '', $type = '', $print = false, $params = [])
   {
      if (empty($scan_date) && empty($type) || !isset($scan_date) || !isset($params['jabatan'], $params['sdm_id']))
        return "-";

      $addCond = " AND t.sdm_id = '". $params['sdm_id'] ."' AND t.scan_date = '" . $scan_date . "'";
      $sql = "SELECT t.*, s.id_sdm, s.nama, masuk.scan_masuk as scan_masuk, keluar.scan_keluar as scan_keluar, s.jabatan
      FROM `presensi` t 
      LEFT JOIN (SELECT sdm_id, scan_date, min(scan_date) as scan_masuk FROM presensi GROUP By sdm_id, date(scan_date)) masuk ON masuk.sdm_id = t.sdm_id AND date(masuk.scan_date) = date(t.scan_date)
      LEFT JOIN (SELECT sdm_id, scan_date, max(scan_date) as scan_keluar FROM presensi GROUP By sdm_id, date(scan_date)) keluar ON keluar.sdm_id = t.sdm_id AND date(keluar.scan_date) = date(t.scan_date)
      LEFT JOIN sdm s ON s.id = t.sdm_id
      WHERE 1=1 $addCond
      GROUP By t.sdm_id, date(t.scan_date) ORDER By t.scan_date DESC";
      $modelPresensi = Yii::app()->db->createCommand($sql)->queryRow();
      if (!isset($modelPresensi))
        return "-";

      $hour = date('H:i', strtotime($scan_date));
      switch ($params['jabatan']) {
        case 'Customer Service':
          $startMasuk = '06:00';
          $endMasuk = '10:00';
          $startPulang = '10:01';
          $endPulang = '14:00';
          if ($scan_date == $modelPresensi['scan_masuk'] && strtotime($hour) > strtotime($startPulang)) {
            $startMasuk = '14:00';
            $endMasuk = '18:00';
            $startPulang = '18:01';
            $endPulang = '22:00';
          }
          break;

        case 'Teller':
          $startMasuk = '08:00';
          $endMasuk = '12:00';
          $startPulang = '12:01';
          $endPulang = '16:00';
          if ($scan_date == $modelPresensi['scan_masuk'] && strtotime($hour) > strtotime($startPulang)) {
            $startMasuk = '15:00';
            $endMasuk = '18:00';
            $startPulang = '18:01';
            $endPulang = '22:00';
          }
          if ($scan_date == $modelPresensi['scan_masuk'] && strtotime($hour) > strtotime('15:00')) {
            $startMasuk = '16:00';
            $endMasuk = '19:00';
            $startPulang = '19:01';
            $endPulang = '00:00';
          }
          //handle lebih dari jam 00
          /* if ($scan_date == $modelPresensi['scan_masuk'] && strtotime($hour) > strtotime('00:00' && strtotime($hour) < strtotime('05:00'))) {
            // $type = 'pulang';
            $startMasuk = '16:00';
            $endMasuk = '19:00';
            $startPulang = '19:01';
            $endPulang = '00:00';
          } */
          break;
        
        default:
        //office hour;
          $startMasuk = $this->workingHour()['MASUK_START'];
          $endMasuk = $this->workingHour()['MASUK_END'];
          $startPulang = $this->workingHour()['PULANG_START'];
          $endPulang = $this->workingHour()['PULANG_END'];
          $scanType = 1;
          if (strtotime(date('H:i', strtotime($modelPresensi['scan_masuk']))) > strtotime($startMasuk)) {
            $scanType = 2;
          }
          if ($scanType == 2) {
            $startMasuk = $this->workingHour2()['MASUK_START'];
            $endMasuk = $this->workingHour2()['MASUK_END'];
            $startPulang = $this->workingHour2()['PULANG_START'];
            $endPulang = $this->workingHour2()['PULANG_END'];
          }
          break;
      }
     
      if (strtotime($hour) <= strtotime($endMasuk) && strtotime($hour) >= strtotime('00:00') && $type == 'masuk') {
        $addDesc = "";
        if (strtotime($hour) > strtotime($startMasuk)) {
          $hourdiff = round((strtotime($hour) - strtotime($startMasuk))/3600, 2);
          if ($print) {
            $addDesc .= " +$hourdiff jam";
          } else {
            $addDesc .= "<span class='red'> +$hourdiff jam</span>";
          }
        }
        return $hour . $addDesc;
      } else if (strtotime($hour) >= strtotime($startPulang) && strtotime($hour) <= strtotime('23:59') && $type == 'pulang') {
        $addDesc = "";
        if (strtotime($hour) >= strtotime($endPulang)) {
          $hourdiff = round((strtotime($hour) - strtotime($endPulang))/3600, 2);
          if ($hourdiff >= 1) {
            if ($print) {
              $addDesc .= " +$hourdiff jam";
            } else {
              $addDesc .= "<span class='green'> +$hourdiff jam</span>";
            }
          }
        } else if (strtotime($hour) < strtotime($endPulang)) {
          $hourdiff = round((strtotime($endPulang) - strtotime($hour))/3600, 2);
          if ($print) {
            $addDesc .= " -$hourdiff jam";
          } else {
            $addDesc .= "<span class='red'> -$hourdiff jam</span>";
          }
        }
        return $hour . $addDesc;
      }
      return '';
   }

   public function getUnit()
   {
    return CHtml::listData(Unit::model()->findAll(array('order'=>'nama_unit')), 'id', 'nama_unit');
    /* return [
      'Pool Kebumen' => 'Pool Kebumen',
      'Pool Yogyakarta' => 'Pool Yogyakarta',
      'Pool Cilacap' => 'Pool Cilacap'
    ]; */
   }

   public function getSIM()
   {
     return [
      'SIM A' => 'SIM A',
      'SIM C' => 'SIM C',
      'SIM BI Umum' => 'SIM BI Umum',
      'SIM BII Umum' => 'SIM BII Umum',
     ];
   }

   public function getNomorLambung($excludeId = [])
   {
    $addCond = "";
    if (!empty($excludeId))
      $addCond = "AND id NOT IN(".implode(",",$excludeId).")";

    return CHtml::listData(Kendaraan::model()->findAll(array('select'=>'t.*','condition'=>'t.unit='.Yii::app()->user->unit_id.' OR t.unit="'.Yii::app()->user->unit.'" '.$addCond,'order'=>'t.nomor_lambung ASC')), 'nomor_lambung', 'nomor_lambung');

   /*  SELECT * FROM kendaraan t JOIN (select * from penjadwalan_bus where unit_id=2 and DATE(tanggal)=DATE(now())) pb ON pb.kendaraan_id=t.id WHERE t.unit=2 OR t.unit="Yogyakarta" */
   }

   public function getBengkel($exclude_id = null, $id = null, $only_primary = false)
   {
    $addCond = "";
    if (isset($exclude_id) && !empty($exclude_id))
      $addCond = " AND id!=$exclude_id";
    if (isset($id) && !empty($id)) 
      $addCond = " AND id=$id";
    if ($only_primary)
      $addCond .= " AND unit_id IS NOT NULL";
    return CHtml::listData(Bengkel::model()->findAll(array('condition'=>'1=1 '.$addCond,'order'=>'id ASC')), 'id', 'nama');
   }

   public function getBengkelLuar()
   {
    return CHtml::listData(Bengkel::model()->findAll(array('condition'=>'unit_id IS NULL','order'=>'id ASC')), 'id', 'nama');
   }

   public function getJenisServis($jenis_perbaikan = null)
   {
    $addCond = "";
    if (isset($jenis_perbaikan) && !empty($jenis_perbaikan))
      $addCond = " AND jenis_perbaikan='$jenis_perbaikan'";
    return CHtml::listData(JenisServis::model()->findAll(array('condition' => "1=1 $addCond",'order'=>'id_servis ASC')), 'id_servis', 'jenis_servis');
   }

   public function getBarang()
   {
    return CHtml::listData(Barang::model()->findAll(array('order'=>'id_barang ASC')), 'id_barang', 'nama_barang');
   }

   public function getSparepart($jenis_perbaikan = "")
   {
    $addCond = "";
    if (!empty($jenis_perbaikan))
      $addCond = " AND js.jenis_perbaikan='$jenis_perbaikan'";

    return CHtml::listData(Barang::model()->findAll(array(
      'join' => "JOIN (select ss.barang_id from sparepart_service ss join jenis_servis js ON js.id = ss.service_id where 1=1 $addCond group by ss.barang_id) js ON js.barang_id=t.id",
      'order'=>'t.nama_barang ASC'
    )), 'id_barang', 'nama_barang');
   }

   public function getJenisServisRutin()
   {
    return CHtml::listData(JenisServis::model()->findAll(array('condition'=>'type="Rutin"','order'=>'id_servis ASC')), 'id_servis', 'jenis_servis');
   }

   public function getSdm()
   {
      return CHtml::listData(Sdm::model()->findAll(array('select' => '*, CONCAT(nama," - ",jabatan) as displayDropdown', 'condition' => 'jabatan <> "Superadmin"','order'=>'id_sdm ASC')), 'id', 'displayDropdown');
   }

   public function getMekanik()
   {
      return CHtml::listData(Sdm::model()->findAll(array('select' => '*', 'condition' => 'jabatan IN ("Mekanik","Kepala Mekanik")','order'=>'id_sdm ASC')), 'id', 'nama');
   }

   public function getJenisKendaraan()
   {
     return [
       'Hino Rk8 R260' => 'Hino Rk8 R260',
       'RM280 ABS' => 'RM280 ABS',
       'Scania K360IB' => 'Scania K360IB'
     ];
   }

   public function getJenisTrayek()
   {
    return [
      'AKAP' => 'AKAP',
      'AKDP' => 'AKDP'
    ];
   }

   public function getRuteTrayek()
   {  
    return [
      'Ajibarang - Jogja' => 'Ajibarang - Jogja',
      'Bobotsari - Jogja' => 'Bobotsari - Jogja',
      'Cilacap - Jogja' => 'Cilacap - Jogja',
      'Cilacap - Semarang' => 'Cilacap - Semarang',
      'Majenang - Jogja' => 'Majenang - Jogja',
      'Purwokerto - Jogja' => 'Purwokerto - Jogja',
      'Cilacap - Jepara' => 'Cilacap - Jepara',
      'Purwokerto - Malang' => 'Purwokerto - Malang',
      'Cilacap - Malang' => 'Cilacap - Malang',
      'Pekanbaru - Tulungagung' => 'Pekanbaru - Tulungagung'
    ];
   }

   public function getSatuan()
   {
     return [
       'pcs' => 'pcs'
     ];
   }

   public function getSpesifikasi($id = null)
   {
      $spesifikasi = [
                      'A' => 'Kelas A',
                      'B' => 'Kelas B',
                      'C' => 'Kelas C'
                    ];
      if (isset($id) && !empty($id)) {
        foreach ($spesifikasi as $key => $value) {
          if ($id == $key)
            return $value;
        }
      }
      return $spesifikasi;
   }

   public function getRakPenyimpanan($id = null)
   {
      $no_rak = [];
      $spesifikasi = $this->getSpesifikasi();
      if (!isset($id))
        return $no_rak;
      foreach ($spesifikasi as $key => $spek) {
        if (!empty($id) && $id != $key)
          continue;

        for ($i=1; $i < 6; $i++) { 
          for ($j=1; $j < 6; $j++) { 
            $no_rak[$key . '.' . sprintf("%03s",$i). '.' . sprintf("%03s",$j)] = $key . '.' . sprintf("%03s",$i). '.' . sprintf("%03s",$j);
          }
        }
      }

     return $no_rak;
   }

   public function getNamaBank()
   {
     return [
      'Bank BCA' => 'Bank BCA',
      'Bank Mandiri' => 'Bank Mandiri',
      'Bank BRI' => 'Bank BRI',
      'Maybank' => 'Maybank',
     ];
   }

   public function getOrderIdKeluar($date)
   {  
      if(!isset($date))
        return "-";

      $date = date('d-m-Y', strtotime($date));
      $dateArr = explode('-', $date);
      if (!isset($dateArr[0], $dateArr[1]))
        return "-";

      return $dateArr[0].'.'.$dateArr[1];
   }

   public function getPengirim()
   {
    return [
      'Pembelian' => 'Pembelian'
     ];
   }

   public function getKondisiBarang()
   {
    return [
      'Baik' => 'Baik'
     ];
   }

   public function getLevel()
   {
    return [
      '0' => 'Biasa',
      '1' => 'Segera',
      '2' => 'Mendesak'
    ];
   }

   public function getSpbu()
   {
    return [
      'Ambarketawang' => 'Ambarketawang',
      'Tamanwinangun' => 'Tamanwinangun',
      'Sokaraja' => 'Sokaraja',
      'Lainnya' => 'Lainnya'
    ];
   }

   public function getRupiah($number) {
      if (is_numeric($number) && $number > 0)
        return number_format($number, 0, ",", ".");
      else 
        return $number;
    }

   public function kriteriaPenilaian($id = "")
   {
    switch ($id) {
      case 'BODY_KENDARAAN':
        $data = [
          'title' => 'Body',
          'kriteria' => [
            'Baik / Lengkap' => 'Apabila body luar kendaraan tidak ada yang lecet/ rusak',
            'Cacat' => 'Apabila body luar kendaraan ada yang lecet dan pecah',
            'Rusak' => 'Apabila body luar kendaraan ada kerusakan yang harus segera diganti'
          ]
        ];
        break;

      case 'AC_KENDARAAN':
        $data = [
          'title' => 'A/C',
          'kriteria' => [
            'Dingin' => 'Apabila pengoperasian AC normal ( Dingin )',
            'Kurang Dingin' => 'Apabila pengoperasian AC kurang normal ( Blower saja )',
            'Panas' => 'Apabila AC tidak dapat bekerja dengan baik'
          ]
        ];
        break;

      case 'SISTEM_AUDIO':
        $data = [
          'title' => 'Sistem Audio',
          'kriteria' => [
            'Normal' => 'Apabila sistem audio berfungsi dengan normal',
            'Rusak' => 'Apabila sistem audio tidak dapat berfungsi dengan baik'
          ]
        ];
        break;

      case 'PANEL_DASHBOARD':
        $data = [
          'title' => 'Lampu Panel Dashboard',
          'kriteria' => [
            'Normal' => 'Apabila tombol panel dan lampu menyala dengan normal',
            'Rusak' => 'Apabila tombol panel dan lampu ada yang mati atau rusak'
          ]
        ];
        break;

      case 'BAN':
        $data = [
          'title' => 'Ban',
          'kriteria' => [
            'Tebal' => 'Apabila Ban semua ban masih tebal',
            'Cacat' => 'Apabila ada Ban yang tidak normal ( makan sebelah, dll )',
            'Tipis' => 'Apabila Ban sudah limit dan harus segera diganti'
          ]
        ];
        break;

      case 'LAMPU_LUAR':
        $data = [
          'title' => 'Lampu-lampu body luar',
          'kriteria' => [
            'Lengkap/Normal' => 'Apabila Lampu kendaraan berfungsi dengan normal dan tidak ada yang pecah',
            'Tidak Lengkap' => 'Apabila lampu kendaraan ada salah satu yang mati atau pecah',
            'Rusak' => 'Apabila lampu kendaaraan mati dan harus segera diperbaiki'
          ]
        ];
        break;

      case 'WIPER':
        $data = [
          'title' => 'Wiper',
          'kriteria' => [
            'Lengkap/Normal' => 'Apabila Wiper berfungsi dengan baik dan tidak bunyi',
            'Tidak Lengkap' => 'Apabila Wiper saat pengoperasian ada kendala ( air wiper tidak keluar )',
            'Rusak' => 'Apabila Wiper tidak dapat berfungsi'
          ]
        ];
        break;

      case 'AREA_MESIN':
        $data = [
          'title' => 'Area Mesin',
          'kriteria' => [
            'Kering/Bersih' => 'Apabila tidak ditemukan kebocoran Oli, Solar, Air, udara pada area Mesin',
            'Ada Kebocoran' => 'Apabila ditemukan kebocoran Oli, Solar, Air, udara pada area Mesin'
          ],
          'images' => [
            'data' => [
              'area_mesin1.jpg',
              'area_mesin2.png',
            ],
            'notes' => 'cek area kompresor engine, injection pump dan carter serta bagian yang lain'
          ]
        ];
        break;

      case 'LEVEL_OLI_MESIN':
        $data = [
          'title' => 'Level Oli Mesin',
          'kriteria' => [
            'Cukup' => 'Apabila Level Oli ada pada stik oli berada di titik atas',
            'Kurang' => 'Apabila Level Oli ada pada stik oli berada di titik tengah',
            'Sangat Kurang' => 'Apabila Level Oli ada pada stik oli berada di titik bawah'
          ],
          'images' => [
            'data' => [
              'level_oli1.png',
              'level_oli2.png',
            ]
          ]
        ];
        break;

      case 'V_BELT':
        $data = [
          'title' => 'V-Belt Mesin',
          'kriteria' => [
            'Bagus' => 'Apabila kondisi v-belt dalam kondisi bagus ( tidak ada retak )',
            'Retak Ringan' => 'Apabila kondisi v-belt ada retak retak sedikit',
            'Tidak Bagus' => 'Apabila kondisi v-belt retak banyak dan miring'
          ],
          'images' => [
            'data' => [
              'vbelt1.png',
              'vbelt2.png',
              'vbelt3.png',
            ]
          ]
        ];
        break;

      case 'OLI_POWERSTERING':
        $data = [
          'title' => 'Level Oli Power Steering',
          'kriteria' => [
            'Cukup' => 'Apabila Level Oli berada di titik atas',
            'Kurang' => 'Apabila Level Oli berada di titik tengah',
            'Sangat Kurang' => 'Apabila Level Oli berada di titik bawah'
          ],
          'images' => [
            'data' => [
              'steering1.png',
              'steering2.png',
            ],
            'notes'=>'INDIKATOR OIL LEVEL POWER STEERING'
          ]
        ];
        break;

      case 'RADIATOR':
        $data = [
          'title' => 'Level Air Radiator',
          'kriteria' => [
            'Cukup' => 'Apabila Level air pada tangki air berada di titik atas',
            'Kurang' => 'Apabila Level air pada tangki air berada di titik tengah',
            'Sangat Kurang' => 'Apabila Level air pada tangki air berada di titik bawah'
          ],
          'images' => [
            'data' => [
              'radiator1.png',
              'radiator2.png'
            ]
          ]
        ];
        break;

      case 'BATERAI':
        $data = [
          'title' => 'Baterai',
          'kriteria' => [
            'Baik' => 'Apabila saat melakukan stater unit bisa langsung menyala',
            'Kurang' => 'Apabila pada saat melakukan stater agak lama/ lemah',
            'Jelek' => 'Apabila batere tidak bisa melakukan stater'
          ],
        ];
        break;

      case 'LEVEL_BATERAI':
        $data = [
          'title' => 'Level Air Baterai',
          'kriteria' => [
            'Cukup' => 'Apabila Level air pada batere berada di titik atas',
            'Kurang' => 'Apabila Level air pada batere berada di titik tengah',
            'Sangat Kurang' => 'Apabila Level air pada batere berada di titik bawah'
          ],
          'images' => [
            'data' => [
              'level_baterai1.png',
              'level_baterai2.png',
              'level_baterai3.png',
            ]
          ]
        ];
        break;

      case 'KOPLING':
        $data = [
          'title' => 'Kopling',
          'kriteria' => [
            'Bagus' => 'Apabila pengoperasion kopling tidak ada kendala',
            'Tidak Bagus' => 'Apabila ada kendala saat pengoperasion kopling dam sisa ulir kopling sudah tipis',
          ],
          'images' => [
            'data' => [
              'kopling1.png',
              'kopling2.png',
            ],
            'notes'=>'limit 31 mm, jika kurang sudah tipis'
          ]
        ];
        break;

      case 'REM_DEPAN':
        $data = [
          'title' => 'Kanvas Rem Depan',
          'kriteria' => [
            'Tebal' => 'Apabila pada saat dicek kanvas rem dalam kondisi 75 % keatas',
            'Sedang' => 'Apabila pada saat dicek kanvas rem dalam kondisi 40% - 70%',
            'Tipis' => 'Apabila pada saat dicek kanvas rem dalam kondisi 35% ke bawah',
          ],
          'images' => [
            'data' => [
              'rem_depan1.png',
              'rem_depan2.png',
            ],
            'notes'=>'periksa bagian luar kanvas serta cek kondisi tromol'
          ]
        ];
        break;

      case 'REM_BELAKANG':
        $data = [
          'title' => 'Kanvas Rem Belakang',
          'kriteria' => [
            'Tebal' => 'Apabila pada saat dicek kanvas rem dalam kondisi 75 % keatas',
            'Sedang' => 'Apabila pada saat dicek kanvas rem dalam kondisi 40% - 70%',
            'Tipis' => 'Apabila pada saat dicek kanvas rem dalam kondisi 35% ke bawah',
          ],
          'images' => [
            'data' => [
              'rem_depan1.png',
              'rem_depan2.png',
            ],
            'notes'=>'periksa bagian luar kanvas serta cek kondisi tromol'
          ]
        ];
        break;

      case 'KURAS_TANGKI_ANGIN':
        $data = [
          'title' => 'Kuras Tanki Angin/Kompresor',
          'kriteria' => [
            'Kering' => 'Apabila pada saat melakukan buang angin tangki yang keluar hanya angin',
            'Banyak Air' => 'Apabila pada saat melakukan buang angin tangki yang keluar dari tangki adalah air',
          ]
        ];
        break;

      case 'DURASI_ISI_TANGKI':
        $data = [
          'title' => 'Durasi Pengisian Tanki Angin',
          'kriteria' => [
            '< 8 menit' => 'Apabila pada saat mesin dihidupkan pengisian tangki angin langsung naik',
            '8 - 12 menit' => 'Apabila pada saat mesin dihidupkan, pengisian tangki naik tetapi agak lama',
            '> 12 menit' => 'Apabila pada saat mesin dihidupkan tetapi tangki angin tidak naik ',
          ]
        ];
        break;
      
      default:
        $data = [];
        break;
    }

    return Yii::app()->controller->renderPartial('/dailyCheck/templatePenilaian', $data, true);
   }

   public function getVerifyFingerprint($id)
   {
    // 1: finger, 2: password, 3: card, 4: face, 5: gps, 6:vein
    if (!isset($id))
      return 'undefined';

      $arrVerify = [
        '1' => 'FINGER',
        '2' => 'PASSWORD',
        '3' => 'CARD',
        '4' => 'FACE',
        '5' => 'GPS',
        '6' => 'VEIN',
      ];
      if (isset($arrVerify[$id])) {
        return $arrVerify[$id];
      } else {
        return "undefined";
      }
   }

   public function getStatusScan($id)
   {
    //	0: scan in, 1: scan out, 2: break in, 3: break out, 4: overtime in, 5: overtime out, 6: rapat in, 7: rapat out, 8: custome1, 9: custome2
      if (!isset($id))
        return 'undefined';

      $arrStatusScan = [
          '0' => 'SCAN MASUK',
          '1' => 'SCAN KELUAR',
          '2' => 'MULAI ISTIRAHAT',
          '3' => 'SELESAI ISTIRAHAT',
          '4' => 'MULAI LEMBUR',
          '5' => 'SELESAI LEMBUR',
          '6' => 'MULAI RAPAT',
          '7' => 'SELESAI RAPAT',
          '8' => 'KUSTOM 1',
          '9' => 'KUSTOM 2',
        ];
      if (isset($arrStatusScan[$id])) {
        return $arrStatusScan[$id];
      } else {
        return "undefined";
      }
   }

   public function exportExcelRaw($data = [])
    {
        if(!empty($data) && isset($data['dataExcel']) && isset($data['columns'])){
            Yii::import("ext.phpexcelv2.XPHPExcel");
            $title = $data['title'];
            $titleSheet = $data['titleSheet'];
            $firstColumn = $data['firstColumn'];
            $lastColumn = $data['lastColumn'];
            $columns = $data['columns'];
            $dataExcel = $data['dataExcel'];
            $addText = (isset($data['addText']) ? $data['addText'] : '');
            $excelAdditional = (isset($data['excelAdditional']) ? $data['excelAdditional'] : null);
            $addSubTitle = (isset($data['addSubTitle']) ? $data['addSubTitle'] : []);
            $columnsAbove = (isset($data['columnsAbove']) ? $data['columnsAbove'] : null);

            $objPHPExcel= XPHPExcel::createPHPExcel();
            $objPHPExcel->getProperties()->setCreator("Admin efisiensi")
            ->setLastModifiedBy("Admin efisiensi")
            ->setTitle($title)
            ->setSubject("Office 2007 XLSX ".$title)
            ->setDescription($title." for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory($title);

            $objPHPExcel->getActiveSheet()->setTitle($title);
            $objPHPExcel->setActiveSheetIndex(0);

            $no = 2;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($firstColumn.$no, $titleSheet)->mergeCells($firstColumn.$no.':'.$lastColumn.$no);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle($firstColumn.$no.':'.$lastColumn.$no)->applyFromArray(array(
                'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)));
            $objPHPExcel->getActiveSheet()->getStyle($firstColumn.$no.':'.$lastColumn.$no)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => 'dddddd'),
                ));
            $objPHPExcel->setActiveSheetIndex(0)->getStyle($firstColumn.$no.':'.$lastColumn.$no)->applyFromArray(array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )));

            $no = 3;
            $no++;
            //single add row
            if (!empty($addText)){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$no, $addText);
            $no++;
            }
            //multiple add row
            if (!empty($addSubTitle)) {
                foreach ($addSubTitle as $key => $subtitle_) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$no, $subtitle_);

                    if (strpos($key, 'color') !== false){
                        $color = explode(':', $key);
                        $color = $color[1];
                        $objPHPExcel->getActiveSheet()->getStyle($firstColumn.$no.':'.$lastColumn.$no)->getFill()->applyFromArray(array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'startcolor' => array('rgb' => $color),
                            ));
                    }

                $no++;
                }
            }
            
            if (isset($columnsAbove) && !empty($columnsAbove)) {
              $no++;
              foreach ($columnsAbove as $key) {
                  $objPHPExcel->setActiveSheetIndex(0)->setCellValue($key['column'].$no, $key['text']);
              }

              $objPHPExcel->getActiveSheet()->getStyle($firstColumn.$no.':'.$lastColumn.$no)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => 'dddddd'),
                ));

            }
            
            $no++;
            foreach ($columns as $key) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($key['column'].$no, $key['text']);
                $objPHPExcel->getActiveSheet()->getColumnDimension($key['column'])
                ->setAutoSize(true);
            }

            $objPHPExcel->getActiveSheet()->getStyle($firstColumn.$no.':'.$lastColumn.$no)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => 'dddddd'),
                ));

            $objPHPExcel->setActiveSheetIndex(0)->getStyle($firstColumn.$no.':'.$lastColumn.$no)->applyFromArray(array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )));

            //isi kolom
            if(!empty($dataExcel)){
                foreach($dataExcel as $row){
                    $no++;
                    foreach ($columns as $key) {
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($key['column'].$no, $row[$key['value']]);
                    }
                }
            }
            //jika ada tambahan data
            if (isset($excelAdditional)) {
                if (isset($data['excelAdditionalVersion']) && $data['excelAdditionalVersion'] >= 2)
                    $excelAdditionals = $excelAdditional;
                else
                    $excelAdditionals = [$excelAdditional];

                foreach ($excelAdditionals as $excelAdditional) {
                    if (isset($excelAdditional['firstColumnAdd'], $excelAdditional['lastColumnAdd'], $excelAdditional['columnsAdd'], $excelAdditional['dataExcelAdd'])) {
                        $no += (isset($excelAdditional['no_space_top']) && $excelAdditional['no_space_top'] == true ? 1 : 2);
                        $withHeader = !isset($excelAdditional['no_header']) || !$excelAdditional['no_header'];
                        if ($withHeader && isset($excelAdditional['sub_title'])) {
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $no, $excelAdditional['sub_title']);
                            $no++;
                        }

                        foreach ($excelAdditional['columnsAdd'] as $add) {
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($add['column'] . $no, $add['text']);
                        }
                        if ($withHeader) {
                            $objPHPExcel->getActiveSheet()->getStyle($excelAdditional['firstColumnAdd'] . $no . ':' . $excelAdditional['lastColumnAdd'] . $no)->getFill()->applyFromArray(array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'startcolor' => array('rgb' => 'dddddd'),
                            ));
                            $objPHPExcel->setActiveSheetIndex(0)->getStyle($excelAdditional['firstColumnAdd'] . $no . ':' . $excelAdditional['lastColumnAdd'] . $no)->applyFromArray(array(
                                'alignment' => array(
                                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                )));
                        }

                        //isi kolom tambahan
                        if (!empty($excelAdditional['dataExcelAdd'])) {
                            foreach ($excelAdditional['dataExcelAdd'] as $rows) {
                                $no++;
                                foreach ($excelAdditional['columnsAdd'] as $keys) {
                                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($keys['column'] . $no, $rows[$keys['value']]);
                                }
                            }
                        }
                    }
                }
            }

            $no++;

            $no += 2;

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($firstColumn.$no, 'Export By : ' .(isset(Yii::app()->user->name)?Yii::app()->user->name:'Admin') .' At : ' .date("d/m/Y H:i:s") .'  -  Copyright ' .date('Y'))->mergeCells($firstColumn.$no.':'.$lastColumn.$no);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle($firstColumn.$no.':'.$lastColumn.$no)->applyFromArray(array(
                'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT)));


            ob_end_clean();
            ob_start();

            if (isset($data['attach']) && $data['attach']) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('./protected/views/report/csv/'.$title.'.xlsx');
            } else {
                header('Content-Type:application/vnd.ms-excel;');
                header('Content-Disposition:attachment; filename="'.$title.'.xls";');
                header('Cache-Control:max-age=0;');

                // $excelType = 'Excel2007';
                // if (SERVER_SEGMENT == 'LOCAL') {
                  $excelType = 'Excel5';
                // }
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $excelType);
                $objWriter->save('php://output');

                Yii::app()->end();
            }
        }else{
            echo 'Data tidak valid';
            Yii::app()->end();
        }
    }

    public function encode($value, $k="") {
      if (!$value) {
          return false;
      }

      $keySource = 'EnCRypT10nK#Y!RiSRNn';
      if (!empty($k))
          $keySource .= "-".$k;  
         
      $key = sha1($keySource);
      $strLen = strlen($value);
      $keyLen = strlen($key);
      $j = 0;
      $crypttext = '';
 
      for ($i = 0; $i < $strLen; $i++) {
          $ordStr = ord(substr($value, $i, 1));
          if ($j == $keyLen) {
              $j = 0;
          }
          $ordKey = ord(substr($key, $j, 1));
          $j++;
          $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
      }
 
      return $crypttext;
  }
 
 
  public function decode($value, $k="") {
      if (!$value) {
          return false;
      }
     
      $keySource = 'EnCRypT10nK#Y!RiSRNn';
      if (!empty($k))
          $keySource .= "-".$k;
      $key = sha1($keySource);
      $strLen = strlen($value);
      $keyLen = strlen($key);
      $j = 0;
      $decrypttext = '';
 
      for ($i = 0; $i < $strLen; $i += 2) {
          $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
          if ($j == $keyLen) {
              $j = 0;
          }
          $ordKey = ord(substr($key, $j, 1));
          $j++;
          $decrypttext .= chr($ordStr - $ordKey);
      }
 
      return $decrypttext;
  }

  public function getServis()
  {
    return [
              'insidental'=>'Insidental',
              'rutin'=>'Rutin',
              'surat-surat'=>'Surat-surat',
              'lainnya'=>'Lainnya'
          ];
  }

  public function getJenisPerbaikan($bengkelId = null)
  {
    $type = ['pusat','cabang'];
    if (in_array($bengkelId, ['1'])) {
      $type = ['pusat'];
    }
    return CHtml::listData(JenisServis::model()->findAll(array(
      'join' => 'JOIN (select * from servis_mekanik where type IN("'. implode('","', $type)  .'")) sm ON sm.service_id=t.id',
      'condition' => 't.jenis_perbaikan IS NOT NULL AND t.jenis_perbaikan!=""',
      'group' => 't.jenis_perbaikan',
      'order'=>'t.jenis_perbaikan ASC')), 'jenis_perbaikan', 'jenis_perbaikan');
  }

  public function getItemPerbaikan($parent_perbaikan)
  {
    if (!isset($parent_perbaikan))
      return [];

    return CHtml::listData(JenisServis::model()->findAll(array('condition' => 'jenis_perbaikan="'. $parent_perbaikan .'" AND item_perbaikan IS NOT NULL AND item_perbaikan!=""','order'=>'item_perbaikan ASC')), 'item_perbaikan', 'item_perbaikan');
  }

  public function getSupplier()
  {
    return CHtml::listData(Supplier::model()->findAll(array('order'=>'nama_supplier ASC')), 'id', 'nama_supplier');
  }

  public function getListMekanikService($params = [])
  { 
    $res = [];
    if (!isset($params['jenis_perbaikan'], $params['bengkel_id']))
      return $res;

      $listUserMessage = [];
      $modelJenisServises = JenisServis::model()->findAllByAttributes([
        'jenis_perbaikan' => $params['jenis_perbaikan']
      ], '1=1 ');
      foreach ($modelJenisServises as $modelJenisServis) {
        if (isset($modelJenisServis->mekanikService) && !empty($modelJenisServis->mekanikService)) {
          foreach ($modelJenisServis->mekanikService as $mekanik) {
            if (in_array($mekanik->sdm_id, ['all_mekanik','all_mekanik_cabang'])) {
              if ($mekanik->type == 'pusat') {
                if (isset($listUserMessage[$mekanik->type.'_1']))
                  continue;
                if ($params['bengkel_id'] == 1) //buat batasin bengkel yg dipilih aja
                  $listUserMessage[$mekanik->type.'_1'] = 1;
              } else {
                if (!in_array($params['bengkel_id'], ['1'])) { //buat batasin bengkel yg dipilih aja
                  $bengkelModel = Bengkel::model()->findAll("unit_id != 1");
                  foreach ($bengkelModel as $bengkel_) {
                    if (isset($listUserMessage[$mekanik->type.'_'.$bengkel_->id]))
                      continue;
                    $listUserMessage[$mekanik->type.'_'.$bengkel_->id] = $bengkel_->id;
                  }
                }
              }
            } else if (isset($mekanik->sdm)){
              if (isset($listUserMessage[$mekanik->sdm_id]))
                continue;
              $sdm = $mekanik->sdm;
              $listUserMessage[$mekanik->sdm_id] = [
                'nama' => $sdm->nama,
                'unit_id' => $sdm->unit,
                'user_id' => $sdm->id,
              ];
            }
          }
        }
      }
      if (empty($listUserMessage)) {
        if ($params['bengkel_id'] == 1)
          $listUserMessage['pusat_1'] = 1;
        else if (!in_array($params['bengkel_id'], ['1'])) {
          $bengkelModel = Bengkel::model()->findAll("unit_id != 1");
          foreach ($bengkelModel as $bengkel_) {
            $listUserMessage['cabang_'.$bengkel_->id] = $bengkel_->id;
          }
        }
      }

      return $listUserMessage;
  }

  public function saveTransaction($post = [])
  {
    $result = new Returner;

    $transaction = Yii::app()->db->beginTransaction();
			try { 
          //action & throw error
        
          $transaction->commit();
					
          if (!isset($post['redirect']))
              return $result->success();

          //redirect
				} catch (Exception $e) {
					$transaction->rollBack();
          return $result->dumpV2($e->getMessage(), null, 401);
				}
  }

  public function getZonaPengantaran()
  {
    $result = [];
    for ($i=1; $i <= 2; $i++) { 
      $result[$i] = "Zona " . $i;
    }
    return $result;
  }

  public function getPengeluaranItem($data)
  {
    $result = [
      'solar' => [
        'label' => ['value' => ''], 
        'attach' => true,
        'refund' => 10
      ],
      'terminal' => [
        'label' => ['value' => '','readonly'=>true]
      ],
      'parkir_bandara' => [
        'label' => ['value' => ''],
      ],
      'parkir' => [
        'label' => ['value' => ''], 
        'attach' => true
      ],
      'tol' => [
        'label' => ['value' => ''],  
        'attach' => true
      ],
      'surat-surat' => [
        'label' => ['value' => ''],  
        'attach' => true
      ],
    ];
    if (isset($data[1]['trip_label'])) {
      if (in_array($data[1]['trip_label'], ['SMG','JEP'])) {
          unset($result['parkir_bandara']);
      }
    }

    if (isset($data['trayek'])) {
        if (in_array('cilacap-bobotsari', $data['trayek']) || (in_array('cilacap-ajibarang', $data['trayek'])) || (in_array('bobotsari-ajibarang', $data['trayek'])) || (in_array('bobotsari-cilacap', $data['trayek'])) || (in_array('ajibarang-cilacap', $data['trayek'])) || (in_array('yogyakarta-cilacap', $data['trayek'])) || 
        (in_array('cilacap-yogyakarta', $data['trayek'])) || (in_array('ajibarang-yogyakarta', $data['trayek'])) ||
        (in_array('bobotsari-yogyakarta', $data['trayek'])) || (in_array('yogyakarta-bobotsari', $data['trayek'])) ||
        (in_array('yogyakarta-ajibarang', $data['trayek'])) ) {
          $result['terminal']['label']['value'] = 80000;
          unset($result['solar']['refund']);
        } else if (in_array('cilacap-solo', $data['trayek']) || in_array('solo-cilacap', $data['trayek'])) {
          $result['terminal']['label']['value'] = 100000;
          unset($result['solar']['refund']);
        } else if (in_array('semarang-jepara', $data['trayek']) || in_array('jepara-semarang', $data['trayek']) || in_array('cilacap-semarang', $data['trayek']) || in_array('semarang-cilacap', $data['trayek']) || in_array('cilacap-jepara', $data['trayek']) || in_array('jepara-cilacap', $data['trayek'])) {
          $result['terminal']['label']['value'] = 110000;
        } else {
          unset($result['terminal']);
          if (in_array('cilacap-semarang', $data['trayek']) || in_array('semarang-cilacap', $data['trayek']) || in_array('cilacap-jepara', $data['trayek']) || in_array('jepara-cilacap', $data['trayek'])) {
            
          } else {
            unset($result['solar']['refund']);
          }
        }
    } else {
      unset($result['terminal']);
    }
    return $result;
  }

  public function hashSha1($body = [])
    {
        $encode_data = json_encode($body, JSON_UNESCAPED_SLASHES);
        $encode_data = preg_replace('/\s+/S', "", $encode_data);
        return strtolower(hash("sha1", $encode_data));
    }

  public function setState($name = null, $value = null)
  {
    $result = null;
    if (!isset($name)) {
      return $result;
    }
    Yii::app()->user->setState($name, $value);
  }

  public function getState($name = null)
  {
    $result = [];
    if (!isset($name)) {
      return $result;
    }
      if (Yii::app()->user->getState($name) !== null) {
        $result = Yii::app()->user->getState($name);
      }
    return $result;
  }

   public function dump($data = [])
   {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit;
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