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
        $penjadwalan_id = isset($arrId[3]) && !empty($arrId[3]) ? $arrId[3] : null;
        $label_trip = isset($_POST['label_trip']) ? $_POST['label_trip'] : null;
        $agen_id_asal = isset($_POST['agen_id_asal']) ? $_POST['agen_id_asal'] : null;
        $agen_id_tujuan = isset($_POST['agen_id_tujuan']) ? $_POST['agen_id_tujuan'] : null;

        $model = new Booking('routeDetail');
        $model->route_id = $routeID;
        $model->startdate = $startdate;
        $model->armada_ke = $armada_ke;
        $model->penjadwalan_id = $penjadwalan_id;
        $model->label_trip = $label_trip;

        if (isset($_POST['BookingTrip'], $_POST['FormSeat']) && !empty($_POST['BookingTrip'])) {
            // Helper::getInstance()->dump(Yii::app()->user->id);
			$saveTransaction = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/transactionBooking',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'route_id' => isset($_POST['BookingTrip']['route_id']) ? $_POST['BookingTrip']['route_id'] : null,
						'startdate' => isset($_POST['BookingTrip']['startdate']) ? $_POST['BookingTrip']['startdate'] : null,
						'armada_ke' => isset($_POST['BookingTrip']['armada_ke']) ? $_POST['BookingTrip']['armada_ke'] : null,
						'penjadwalan_id' => $penjadwalan_id,
						'BookingTrip' => $_POST['BookingTrip'],
						'FormSeat' => $_POST['FormSeat'],
						'user_id' => Yii::app()->user->id,
						'crew_id' => Yii::app()->user->id,
						'role' => Yii::app()->user->role,
					]
				]
			]);
            // Helper::getInstance()->dump($saveTransaction);
			if (isset($saveTransaction['success']) && $saveTransaction['success']) {
				Yii::app()->user->setFlash('success', 'Pembelian Tiket Berhasil Dibuat');
			} else {
                Yii::app()->user->setFlash('error', (isset($saveTransaction['message']) ? $saveTransaction['message'] : 'Terjadi Kesalahan'));
				return $this->redirect(Constant::baseUrl().'/booking/routeDetail?id=' . $_GET['id']);
			}

            return Yii::app()->controller->redirect(Constant::baseUrl().'/booking/cetakETiket/' . (isset($saveTransaction['last_id_booking']) ? $saveTransaction['last_id_booking'] : 'all'));
		}
        
        return $this->render('homeAgen', [
			'model' => $model
		]);
    }

    public function actionRouteDetailV2()
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
        $penjadwalan_id = isset($arrId[3]) && !empty($arrId[3]) ? $arrId[3] : null;
        $label_trip = isset($_POST['label_trip']) ? $_POST['label_trip'] : null;
        $agen_id_asal = isset($_POST['agen_id_asal']) ? $_POST['agen_id_asal'] : null;
        $agen_id_tujuan = isset($_POST['agen_id_tujuan']) ? $_POST['agen_id_tujuan'] : null;

        if (isset($arrId[4]) && !empty($arrId[4])) {
			$other_params = base64_decode($arrId[4]);
			$other_params = json_decode($other_params, true);

			$label_trip = isset($other_params['label_trip']) ? $other_params['label_trip'] : null;
			$agen_id_asal = isset($other_params['agen_id_asal']) ? $other_params['agen_id_asal'] : null;
			$agen_id_tujuan = isset($other_params['agen_id_tujuan']) ? $other_params['agen_id_tujuan'] : null;
		}

        $model = new Booking('routeDetail');
        $model->route_id = $routeID;
        $model->startdate = $startdate;
        $model->armada_ke = $armada_ke;
        $model->penjadwalan_id = $penjadwalan_id;
        $model->label_trip = $label_trip;
        $model->agen_id_asal = $agen_id_asal;
        $model->agen_id_tujuan = $agen_id_tujuan;

        if (isset($_POST['BookingTrip'], $_POST['FormSeat']) && !empty($_POST['BookingTrip'])) {
            // Helper::getInstance()->dump(Yii::app()->user->id);
			$saveTransaction = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/transactionBooking',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'route_id' => isset($_POST['BookingTrip']['route_id']) ? $_POST['BookingTrip']['route_id'] : null,
						'startdate' => isset($_POST['BookingTrip']['startdate']) ? $_POST['BookingTrip']['startdate'] : null,
						'armada_ke' => isset($_POST['BookingTrip']['armada_ke']) ? $_POST['BookingTrip']['armada_ke'] : null,
						'penjadwalan_id' => $penjadwalan_id,
						'BookingTrip' => $_POST['BookingTrip'],
						'FormSeat' => $_POST['FormSeat'],
						'user_id' => Yii::app()->user->id,
						'crew_id' => Yii::app()->user->id,
						'role' => Yii::app()->user->role,
                        'agen_id_asal' => $agen_id_asal,
				        'agen_id_tujuan' => $agen_id_tujuan
					]
				]
			]);
            // Helper::getInstance()->dump($saveTransaction);
			if (isset($saveTransaction['success']) && $saveTransaction['success']) {
				Yii::app()->user->setFlash('success', 'Pembelian Tiket Berhasil Dibuat');
			} else {
                Yii::app()->user->setFlash('error', (isset($saveTransaction['message']) ? $saveTransaction['message'] : 'Terjadi Kesalahan'));
				return $this->redirect(Constant::baseUrl().'/booking/routeDetailV2?id=' . $_GET['id'] . '_' . base64_encode(json_encode(['label_trip' => $label_trip, 'agen_id_asal' => $agen_id_asal, 'agen_id_tujuan' => $agen_id_tujuan])));
			}

            return Yii::app()->controller->redirect(Constant::baseUrl().'/booking/cetakETiket/' . (isset($saveTransaction['last_id_booking']) ? $saveTransaction['last_id_booking'] : 'all'));
		}
        
        return $this->render('homeAgenV2', [
			'model' => $model
		]);
    }

    public function actionManifest()
    {
        $post = [];
		$post['startdate'] = date('Y-m-d');
		$post['jamArray'] = [];
        $post['kode_booking'] = isset($_GET['Manifest']['kode_booking']) ? $_GET['Manifest']['kode_booking'] : null;
        $post['trip_id'] = isset($_GET['Manifest']['trip_id']) && !empty($_GET['Manifest']['trip_id']) ? $_GET['Manifest']['trip_id'] : null;
        $post['jam'] = isset($_GET['Manifest']['jam']) ? $_GET['Manifest']['jam'] : null;
        $post['type_date'] = Constant::TYPE_DATE_CREATE;
        if (isset($_GET['Manifest']['startdate']) && !empty($_GET['Manifest']['startdate'])) {
			$post['startdate'] = date('Y-m-d', strtotime($_GET['Manifest']['startdate']));
		}
        if (isset($_GET['Manifest']['type_date']) && !empty($_GET['Manifest']['type_date'])){
			$post['type_date'] = $_GET['Manifest']['type_date'];
        }

		if (isset($post['trip_id']) || isset($post['kode_booking'])) {
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

    public function actionInputCrew()
    {
        return $this->render('inputCrew');
    }

    public function actionInputPenumpangSodok()
    {
        $post = [];
        return $this->render('inputPenumpangSodok', ['post'=>$post]);
    }

    public function actionInputPengeluaranCrew()
    {
        $post['startdate'] = isset($_GET['startdate']) ? $_GET['startdate'] : date('Y-m-d');
        $post['rit'] = isset($_GET['rit']) ? $_GET['rit'] : 1;
        $post['status_rit_close'] = 0;

        //cari penugasan
        $res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/getInputPengeluaranCrew',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'startdate' => $post['startdate'],
                    'rit' => $post['rit'],
                    'user_id' => Yii::app()->user->id,
                    'role' => Yii::app()->user->role
                    ]
            ]
        ]);

        /* if (isset(Yii::app()->user->sdm_id) && Yii::app()->user->sdm_id == 449) {
            Helper::getInstance()->dump($res);
        } */
    
        if (isset($res['data']))
            $post['data'] = $res['data'];

        if (isset($res['data']['ops']['status_rit'][$post['rit']]))
            $post['status_rit_close'] = in_array($res['data']['ops']['status_rit'][$post['rit']], [Constant::STATUS_RIT_CLOSE]);

        // Helper::getInstance()->dump($post);
        if (isset($post['data'])):
            //cari pengeluaran data
            $pengeluaranDatas = ApiHelper::getInstance()->callUrl([
                'url' => 'apiMobile/getDataPengeluaran',
                'parameter' => [
                    'method' => 'POST',
                    'postfields' => [
                        'startdate' => $post['startdate'],
                        'rit' => $post['rit'],
                        'user_id' => Yii::app()->user->id,
                        'penjadwalan_id' => $post['data']['penjadwalan_id']
                        ]
                ]
            ]);
            $post['pengeluaran_data'] = isset($pengeluaranDatas['data']) ? (array)$pengeluaranDatas['data'] : [];
            // Helper::getInstance()->dump($post['pengeluaran_data']['parkir_bandara']['value']);
        endif;

        if (isset($_POST['submit'])) {
            $targetDirectory = Yii::getPathOfAlias('webroot') . "/uploads/"; // Direktori tujuan untuk menyimpan file (pastikan direktori sudah dibuat)
            //upload multiple
            $postPengeluaran = $_POST;
            if (isset($post['pengeluaran_data'])){
                $postPengeluaran = array_merge($post['pengeluaran_data'], $postPengeluaran);
            }
            // Helper::getInstance()->dump([$postPengeluaran, $_FILES]);
            if (!empty($postPengeluaran['solar']) && empty($_FILES['attach_solar']['tmp_name']) && !isset($post['pengeluaran_data']['solar']['lampiran'])) {
                Yii::app()->user->setFlash('error', 'Mohon lampirkan bukti pengeluaran parkir');
                return $this->render('inputPengeluaranCrew', ['post'=>$post]);
            }
            if (!empty($postPengeluaran['parkir']) && empty($_FILES['attach_parkir']['tmp_name']) && !isset($post['pengeluaran_data']['parkir']['lampiran'])) {
                Yii::app()->user->setFlash('error', 'Mohon lampirkan bukti pengeluaran parkir');
                return $this->render('inputPengeluaranCrew', ['post'=>$post]);
            }
            if (!empty($postPengeluaran['tol']) && empty($_FILES['attach_tol']['tmp_name']) && !isset($post['pengeluaran_data']['tol']['lampiran'])) {
                Yii::app()->user->setFlash('error', 'Mohon lampirkan bukti pengeluaran tol');
                return $this->render('inputPengeluaranCrew', ['post'=>$post]);
            }
            if (!empty($postPengeluaran['surat-surat']) && empty($_FILES['attach_surat-surat']['tmp_name']) && !isset($post['pengeluaran_data']['surat-surat']['lampiran'])) {
                Yii::app()->user->setFlash('error', 'Mohon lampirkan bukti pengeluaran surat-surat');
                return $this->render('inputPengeluaranCrew', ['post'=>$post]);
            }
            $targetFileArray = [];
            $fileNameArray = [];
            $urlFileArray = [];
            if (!empty($_FILES['attach_solar']['tmp_name'])) {
                $fileSource = basename($_FILES['attach_solar']['name']);
                $imageFileType = strtolower(pathinfo($fileSource,PATHINFO_EXTENSION));
                if(!in_array($imageFileType, ["jpg","png","jpeg","gif"])) {
                    Yii::app()->user->setFlash('error', 'Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.');
                    return $this->render('inputPengeluaranCrew', ['post'=>$post]);
                }
                $fileName = 'lampiran_pengeluaran_solar_' . Yii::app()->user->id . '_' . date('YmdHis') . '.' . $imageFileType;
                $targetFile = $targetDirectory . $fileName;
                if (move_uploaded_file($_FILES['attach_solar']['tmp_name'], $targetFile)) {
                    Yii::import('application.extensions.image.Image');
                    $image = new Image('uploads/' . $fileName);
                    $image->resize(400, 0);
                    $image->save('uploads/' . $fileName);

                    $targetFileArray['solar'] = $targetFile;
                    $fileNameArray['solar'] = $fileName;
                    $urlFileArray['solar'] = SERVER . '/uploads/' . $fileName;
                }
            }
            if (!empty($_FILES['attach_parkir']['tmp_name'])) {
                $fileSource = basename($_FILES['attach_parkir']['name']);
                $imageFileType = strtolower(pathinfo($fileSource,PATHINFO_EXTENSION));
                if(!in_array($imageFileType, ["jpg","png","jpeg","gif"])) {
                    Yii::app()->user->setFlash('error', 'Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.');
                    return $this->render('inputPengeluaranCrew', ['post'=>$post]);
                }
                $fileName = 'lampiran_pengeluaran_parkir_' . Yii::app()->user->id . '_' . date('YmdHis') . '.' . $imageFileType;
                $targetFile = $targetDirectory . $fileName;
                if (move_uploaded_file($_FILES['attach_parkir']['tmp_name'], $targetFile)) {
                    Yii::import('application.extensions.image.Image');
                    $image = new Image('uploads/' . $fileName);
                    $image->resize(400, 0);
                    $image->save('uploads/' . $fileName);

                    $targetFileArray['parkir'] = $targetFile;
                    $fileNameArray['parkir'] = $fileName;
                    $urlFileArray['parkir'] = SERVER . '/uploads/' . $fileName;
                }
            }
            if (!empty($_FILES['attach_tol']['tmp_name'])) {
                $fileSource = basename($_FILES['attach_tol']['name']);
                $imageFileType = strtolower(pathinfo($fileSource,PATHINFO_EXTENSION));
                if(!in_array($imageFileType, ["jpg","png","jpeg","gif"])) {
                    Yii::app()->user->setFlash('error', 'Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.');
                    return $this->render('inputPengeluaranCrew', ['post'=>$post]);
                }
                $fileName = 'lampiran_pengeluaran_tol_' . Yii::app()->user->id . '_' . date('YmdHis') . '.' . $imageFileType;
                $targetFile = $targetDirectory . $fileName;
                if (move_uploaded_file($_FILES['attach_tol']['tmp_name'], $targetFile)) {
                    Yii::import('application.extensions.image.Image');
                    $image = new Image('uploads/' . $fileName);
                    $image->resize(400, 0);
                    $image->save('uploads/' . $fileName);

                    $targetFileArray['tol'] = $targetFile;
                    $fileNameArray['tol'] = $fileName;
                    $urlFileArray['tol'] = SERVER . '/uploads/' . $fileName;
                }
            }
            if (!empty($_FILES['attach_surat-surat']['tmp_name'])) {
                $fileSource = basename($_FILES['attach_surat-surat']['name']);
                $imageFileType = strtolower(pathinfo($fileSource,PATHINFO_EXTENSION));
                if(!in_array($imageFileType, ["jpg","png","jpeg","gif"])) {
                    Yii::app()->user->setFlash('error', 'Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.');
                    return $this->render('inputPengeluaranCrew', ['post'=>$post]);
                }
                $fileName = 'lampiran_pengeluaran_tol_' . Yii::app()->user->id . '_' . date('YmdHis') . '.' . $imageFileType;
                $targetFile = $targetDirectory . $fileName;
                if (move_uploaded_file($_FILES['attach_surat-surat']['tmp_name'], $targetFile)) {
                    Yii::import('application.extensions.image.Image');
                    $image = new Image('uploads/' . $fileName);
                    $image->resize(400, 0);
                    $image->save('uploads/' . $fileName);

                    $targetFileArray['surat-surat'] = $targetFile;
                    $fileNameArray['surat-surat'] = $fileName;
                    $urlFileArray['surat-surat'] = SERVER . '/uploads/' . $fileName;
                }
            }
            
            $_POST = array_merge([
                'user_id' => Yii::app()->user->id,
                'role' => Yii::app()->user->role,
                'penjadwalan_id' => $post['data']['penjadwalan_id'],
                'startdate' => $post['startdate'],
                'rit' => $post['rit'],
                'filename_array' => $fileNameArray,
                'url_array' => $urlFileArray,
            ], $_POST);

            //unset parkir bandara dan terminal karena udah pernah diinput (diinput sekali saja)
            if (isset($post['pengeluaran_data']['parkir_bandara']['value']) && !empty($post['pengeluaran_data']['parkir_bandara']['value']))
                unset($_POST['parkir_bandara']);
            if (isset($post['pengeluaran_data']['terminal']['value']) && !empty($post['pengeluaran_data']['terminal']['value']))
                unset($_POST['terminal']);

            $res = ApiHelper::getInstance()->callUrl([
                'url' => 'apiMobile/inputPengeluaranCrew',
                'parameter' => [
                    'method' => 'POST',
                    'postfields' => $_POST
                ]
            ]);

            //unlink all image
            foreach ($targetFileArray as $targetFile_) {
                if (file_exists($targetFile_)) {
                    unlink($targetFile_);
                }
            }

            if (!$res['success']) {
                Helper::getInstance()->dump($res['message']);
            }
            
            Yii::app()->user->setFlash('success', "Input Pengeluaran berhasil");
            return $this->redirect(array('inputPengeluaranCrew'));
        }
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
            'role' => Yii::app()->user->role,
        ], $_POST);

        // doPrintResult($result->dump(json_encode($_POST)));

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
        if (!isset($scannerResult['penjadwalan_id'], $scannerResult['rit'])) {
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

    public function actionRefundSolar()
    {
        $res = BookingHelper::getInstance()->refundSolar($_POST);
        doPrintResult($res);
    }

    public function actionSaveLatlong()
    {
        $res = BookingHelper::getInstance()->saveLatlong($_POST);
        doPrintResult($res);
    }

    public function actionGetCrewLocations()
    {
        $res = BookingHelper::getInstance()->getCrewLocations($_GET);
        doPrintResult($res);
    }

    public function actionSearchTujuan()
    {
        $res = BookingHelper::getInstance()->searchTujuan($_POST);
        doPrintResult($res);
    }

    public function actionUpdateStatus()
    {
        $res = BookingHelper::getInstance()->updateStatus($_POST);
        doPrintResult($res);
    }

    public function actionTrackingBus()
    {
        $post = [];
        return $this->render('trackingBus', [
			'post' => $post
		]);
    }

    public function actionCetakETiket()
    {
        if (!isset($_GET['id'])) {
			throw new CHttpException(401,'invalid ID');
		}
		$id = $_GET['id'];
		$model = new Booking('dataLastBooking');
		$model->id = $id;

		return $this->render('cetakEtiket', [
			'model' => $model
		]);
    }

    public function actionPrintTiketEdc()
    {
        if (!isset($_GET['id'])) {
			throw new CHttpException(401,'invalid ID');
		}
        Yii::app()->controller->layout = 'print_edc';
		header_remove();

        $data = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/printTicketEdc',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'booking_trip_id' => $_GET['id']
                ]
            ]
        ]);
        // Helper::getInstance()->dump($data);
        if (!isset($data['data'])) {
            Helper::getInstance()->dump('invalid data :: ' . json_encode($data));
        }

        return $this->render('cetakTiketEdc', [
			'datas' => $data['data']
		]);
    }

    public function actionPrintTiketEdc58()
    {
        if (!isset($_GET['id'])) {
			throw new CHttpException(401,'invalid ID');
		}
        Yii::app()->controller->layout = 'print_edc_58';
		header_remove();

        $data = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/printTicketEdc',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'booking_trip_id' => $_GET['id']
                ]
            ]
        ]);
        // Helper::getInstance()->dump($data);
        if (!isset($data['data'])) {
            Helper::getInstance()->dump('invalid data :: ' . json_encode($data));
        }

        return $this->render('cetakTiketEdc', [
			'datas' => $data['data']
		]);
    }

    public function actionPrintTiketA5()
    {
        if (!isset($_GET['id'])) {
			throw new CHttpException(401,'invalid ID');
		}
        Yii::app()->controller->layout = 'print_a5';
		header_remove();

        $data = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/printTiketA5',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
                    'booking_trip_id' => $_GET['id']
                ]
            ]
        ]);
// Helper::getInstance()->dump($data);
        if (!isset($data['data'])) {
            Helper::getInstance()->dump('invalid data :: ' . json_encode($data));
        }

        return $this->render('cetakTiketA5', [
			'data' => $data['data']
		]);
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
// Helper::getInstance()->dump($data);
        $data = (array)$data['data']; 

        if (!isset($data) || empty($data)) {
            Helper::getInstance()->dump('invalid data :: ' . json_encode($data));
        }

        require_once __DIR__ . '../../../vendor/autoload.php';
		$stylesheet = file_get_contents(__DIR__ . '/../../themes/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css');

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->SetTitle('e-Ticket Efisiensi');
		ob_start();
		ob_end_clean();
		$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

        $i = 1;
		$count = count($data);
        foreach ($data as $data_) {
			$mpdf->WriteHTML($this->renderPartial('/home/template_e_ticket', [
				'data' => $data_
			], true));

			if ($i < $count){
				$mpdf->AddPage();
			}
			$i++;
		}

		$mpdf->shrink_tables_to_fit = 2;
		$mpdf->Output('e-ticket.pdf', 'I');
		$res['success'] = 1;
		$res['message'] = '';
		return $res;
	}
}