<?php
class BookingController extends Controller
{
	public $layout='//layouts/column_mobile';

	public function init() {
		if (isset(Yii::app()->user->id, Yii::app()->user->role)){

		} else {
			$this->redirect(Constant::baseLogin());
		}

        function doPrintResult($result = [])
        {
            echo json_encode($result);
            Yii::app()->end();
        }
	}

    public function actionRouteDetail()
    {
        if (!isset($_GET['id'])) {
            throw new CHttpException(401,'invalid ID');
        }

        $arrId = explode('_', $_GET['id']);
		if (!isset($arrId[0], $arrId[1], $arrId[2]))
			throw new CHttpException(400,'Invalid Parameter array ID');

		$routeID = $arrId[0];
		$startdate = $arrId[1];
		$armada_ke = $arrId[2];

        $model = new Booking('routeDetail');
        $model->route_id = $routeID;
        $model->startdate = $startdate;
        $model->armada_ke = $armada_ke;

        if (isset($_POST['BookingTrip'], $_POST['FormSeat']) && !empty($_POST['BookingTrip'])) {
			$saveTransaction = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/transactionBooking',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'route_id' => isset($_POST['BookingTrip']['route_id']) ? $_POST['BookingTrip']['route_id'] : null,
						'startdate' => isset($_POST['BookingTrip']['startdate']) ? $_POST['BookingTrip']['startdate'] : null,
						'armada_ke' => isset($_POST['BookingTrip']['armada_ke']) ? $_POST['BookingTrip']['armada_ke'] : null,
						'penjadwalan_id' => isset($_POST['BookingTrip']['penjadwalan_id']) ? $_POST['BookingTrip']['penjadwalan_id'] : null,
						'BookingTrip' => $_POST['BookingTrip'],
						'FormSeat' => $_POST['FormSeat'],
						'user_id' => Yii::app()->user->id,
						'crew_id' => Yii::app()->user->id,
						'role' => Yii::app()->user->role,
					]
				]
			]);
			if ($saveTransaction['success']) {
				Yii::app()->user->setFlash('success', 'Pembelian Tiket Berhasil Dibuat');
				return $this->redirect(Constant::baseUrl().'/booking/routeDetail?id=' . $_GET['id']);
			} else {
                Yii::app()->user->setFlash('error', $saveTransaction['message']);
				return $this->redirect(Constant::baseUrl().'/booking/routeDetail?id=' . $_GET['id']);
			}
		}
        
        return $this->render('homeAgen', [
			'model' => $model
		]);
    }

    public function actionManifest()
    {
        $post = [];
		$post['startdate'] = date('Y-m-d');
        if (isset($_GET['Manifest']['startdate']) && !empty($_GET['Manifest']['startdate'])) {
			$post['startdate'] = date('Y-m-d', strtotime($_GET['Manifest']['startdate']));
		}
		if (isset($_GET['Manifest']['trip_id']) && !empty($_GET['Manifest']['trip_id'])) {
			$post['trip_id'] = $_GET['Manifest']['trip_id'];

            $getManifest = ApiHelper::getInstance()->callUrl([
                'url' => 'apiMobile/getDataManifest',
                'parameter' => [
                    'method' => 'POST',
                    'postfields' => $post
                ]
            ]);
            if (isset($getManifest['data'])) {
                $post = $getManifest['data'];
            }

        }
        return $this->render('manifest', [
			'post' => $post
		]);
    }

    public function actionInputPengeluaranCrew()
    {
        $post['startdate'] = isset($_GET['startdate']) ? $_GET['startdate'] : date('Y-m-d');

        //cari penugasan
        $res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/penugasanCrew',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'startdate' => $post['startdate'],
                    'user_id' => Yii::app()->user->id,
                    'role' => Yii::app()->user->role
                    ]
            ]
        ]);
        if (isset($res['data']))
            $post['data'] = $res['data'];

        if (isset($_POST['submit'])) {
            $targetDirectory = Yii::getPathOfAlias('webroot') . "/uploads/"; // Direktori tujuan untuk menyimpan file (pastikan direktori sudah dibuat)
            //upload multiple
            $targetFileArray = [];
            $fileNameArray = [];
            $urlFileArray = [];
            $countFile = count($_FILES['pengeluaran']['name']['file']);
            for ($i=0; $i < $countFile; $i++) { 
                if (!isset($_FILES['pengeluaran']['name']['file'][$i], $_FILES["pengeluaran"]["tmp_name"]["file"][$i]))
                    continue;

                $fileSource = basename($_FILES['pengeluaran']['name']['file'][$i]);
			    $imageFileType = strtolower(pathinfo($fileSource,PATHINFO_EXTENSION));
                if(!in_array($imageFileType, ["jpg","png","jpeg","gif"])) {
                    Yii::app()->user->setFlash('error', 'Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.');
                    return $this->render('inputPengeluaranCrew', ['post'=>$post]);
                }
                $fileName = 'lampiran_pengeluaran_' . Yii::app()->user->id . '_' . date('YmdHis') . '.' . $imageFileType;
                $targetFile = $targetDirectory . $fileName;

                if (move_uploaded_file($_FILES["pengeluaran"]["tmp_name"]["file"][$i], $targetFile)) {
                    Yii::import('application.extensions.image.Image');
                    $image = new Image('uploads/' . $fileName);
                    $image->resize(800, 0);
                    $image->save('uploads/' . $fileName);

                    $targetFileArray[$i] = $targetFile;
                    $fileNameArray[$i] = $fileName;
                    $urlFileArray[$i] = SERVER . '/uploads/' . $fileName;
                }
            }
            $_POST = array_merge([
                'user_id' => Yii::app()->user->id,
                'role' => Yii::app()->user->role,
                'penjadwalan_id' => $post['data']['penjadwalan_id'],
                'trip_id' => $post['data']['trip_id'],
                'armada_ke' => $post['data']['armada_ke'],
                'tujuan_id' => $post['data']['tujuan_id'],
                'startdate' => $post['startdate'],
                'filename_array' => $fileNameArray,
                'url_array' => $urlFileArray,
            ], $_POST);

            // Helper::getInstance()->dump($_POST);

            $res = ApiHelper::getInstance()->callUrl([
                'url' => 'apiMobile/inputPengeluaranCrew',
                'parameter' => [
                    'method' => 'POST',
                    'postfields' => $_POST
                ]
            ]);

            if (!$res['success']) {
                Helper::getInstance()->dump($res['message']);
            }

            //unlink all image
            foreach ($targetFileArray as $targetFile_) {
                if (file_exists($targetFile_)) {
                    unlink($targetFile_);
                }
            }
            
            Yii::app()->user->setFlash('success', "Input Pengeluaran berhasil");
            return $this->redirect(array('inputPengeluaranCrew'));
        }

        if (isset($post['data'])):
            //cari pengeluaran data
            $pengeluaranDatas = ApiHelper::getInstance()->callUrl([
                'url' => 'apiMobile/getDataPengeluaran',
                'parameter' => [
                    'method' => 'POST',
                    'postfields' => [
                        'startdate' => $post['startdate'],
                        'user_id' => Yii::app()->user->id,
                        'penjadwalan_id' => $post['data']['penjadwalan_id'],
                        'trip_id' => $post['data']['trip_id']
                        ]
                ]
            ]);
        endif;
        $post['pengeluaran_data'] = isset($pengeluaranDatas['data']) ? (array)$pengeluaranDatas['data'] : [];
            // Helper::getInstance()->dump($post);
        return $this->render('inputPengeluaranCrew', ['post'=>$post]);
    }

    public function actionUpdateBooking()
    {
        $result = new Returner;
        if (!isset($_POST['kode_booking'])) {
            doPrintResult($result->dump("invalid parameter"));
        }

        $_POST = array_merge([
            'user_id' => Yii::app()->user->id,
            'role' => Yii::app()->user->role
        ], $_POST);

        $updateTransaction = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/updateTransactionBooking',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $_POST
            ]
        ]);

        if (!$updateTransaction['success']) {
            doPrintResult($result->dump($updateTransaction['message']));
        }

        doPrintResult($result->success());
    }

    public function actionScannerResult()
    {
        $result = new Returner;
        if (!isset($_POST['id'])) {
            doPrintResult($result->dump("invalid parameter"));
        }

        $_POST = array_merge([
            'startdate' => date('Y-m-d'),
            'user_id' => Yii::app()->user->id,
            'role' => Yii::app()->user->role
        ], $_POST);

        $scannerResult = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/scannerResult',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $_POST
            ]
        ]);
        // doPrintResult($result->dump(json_encode($scannerResult)));
        if (!$scannerResult['success'] || !isset($scannerResult['data'])) {
            doPrintResult($result->dump($scannerResult['message']));
        }

        $result->put('data', $scannerResult['data']);
        doPrintResult($result->success());
    }

    public function actionScannerResultCrew()
    {
        $result = new Returner;
        if (!isset($_POST['id'])) {
            doPrintResult($result->dump("invalid parameter"));
        }

        $scannerResult = Yii::app()->controller->decode($_POST['id']);
        $scannerResult = json_decode($scannerResult, true);
        if (!isset($scannerResult['route_id'], $scannerResult['startdate'], $scannerResult['armada_ke'])) {
            doPrintResult($result->dump(json_encode($scannerResult)));
        }

        $result->put('data', $scannerResult);
        doPrintResult($result->success());
    }

    public function actionRejectBooking()
    {
        $result = new Returner;
        if (!isset($_POST['alasan'], $_POST['booking_id'])) {
            doPrintResult($result->dump("invalid parameter"));
        }

        $_POST = array_merge([
            'user_id' => Yii::app()->user->id,
            'role' => Yii::app()->user->role
        ], $_POST);
        $reject = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/rejectBooking',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $_POST
            ]
        ]);
        if (!$reject['success']) {
            doPrintResult($reject['message']);
        }
        doPrintResult($result->success());
    }

    public function actionRejectTrip()
    {
        $result = new Returner;
        if (!isset($_POST['alasan'], $_POST['penjadwalan_id'])) {
            doPrintResult($result->dump("invalid parameter"));
        }

        $_POST = array_merge([
            'user_id' => Yii::app()->user->id,
            'role' => Yii::app()->user->role,
            'status' => 2
        ], $_POST);
        $reject = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/confirmTrip',
            'parameter' => [
                'method' => 'POST',
                'postfields' => $_POST
            ]
        ]);
        if (!$reject['success']) {
            doPrintResult($reject['message']);
        }
        doPrintResult($result->success());
    }

    public function actionCheckAvailableBooking()
    {
        $res = BookingHelper::getInstance()->checkAvailableBooking($_POST);
        doPrintResult($res);
    }

    public function actionCheckBeforeAfterSeat()
    {
        $res = BookingHelper::getInstance()->checkBeforeAfterSeat($_POST);
        doPrintResult($res);
    }

    public function actionDeletePengeluaran()
    {
        $res = BookingHelper::getInstance()->deletePengeluaran($_POST);
        doPrintResult($res);
    }

    public function actionItinerary()
	{
        if (!isset($_GET['id'])) {
			throw new CHttpException(401,'invalid ID');
		}

        $data = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getItinerary',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'booking_trip_id' => $_GET['id']
                ]
            ]
        ]);

        if (!isset($data['data'])) {
            Helper::getInstance()->dump('invalid data :: ' . json_encode($data));
        }

        require_once __DIR__ . '../../../vendor/autoload.php';
		$stylesheet = file_get_contents(__DIR__ . '/../../themes/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css');

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->SetTitle('e-Ticket Efisiensi');
		ob_start();
		ob_end_clean();
		$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($this->renderPartial('/home/template_e_ticket', [
			'data' => $data['data']
		], true));
		$mpdf->shrink_tables_to_fit = 2;
		$mpdf->Output('e-ticket.pdf', 'I');
		$res['success'] = 1;
		$res['message'] = '';
		return $res;
	}
}