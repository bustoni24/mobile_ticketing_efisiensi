<?php
class HomeController extends Controller
{
	public $layout='//layouts/column_mobile';

	public function init() {
		if (isset(Yii::app()->user->id, Yii::app()->user->role)){

		} else {
			$this->redirect(Constant::baseLogin());
		}
	}

    public function actionIndex()
	{
		$post = [];
		$post['startdate'] = date('Y-m-d');
		$post['message'] = "Tidak ditemukan penugasan";
		switch (Yii::app()->user->role) {			
			case 'Cabin Crew':
				if (isset($_GET['startdate'])) {
					$post['startdate'] = $_GET['startdate'];
				}
				if (isset($_GET['rit'])) {
					$post['rit'] = $_GET['rit'];
				}
				if (isset($post['startdate'])) {
					//cari penugasan
					$res = ApiHelper::getInstance()->callUrl([
						'url' => 'apiMobile/penugasanCrew',
						'parameter' => [
							'method' => 'POST',
							'postfields' => [
								'startdate' => $post['startdate'],
								'rit' => isset($post['rit']) ? $post['rit'] : null,
								'user_id' => Yii::app()->user->id,
								'role' => Yii::app()->user->role
								]
						]
					]);
					// Helper::getInstance()->dump($res);
					if (isset($res['data']))
						$post['data'] = $res['data'];

					if (isset($res['message']))
						$post['message'] = $res['message'];
				}
				break;
			case 'Agen':
			case 'Sub Agen':
				return $this->actionListBus();
				break;
			case 'Checker':
				return $this->actionHomeChecker();
				break;
		}

		$this->render('homeindex', ['post'=>$post]);
	}

	public function actionHomeChecker()
	{
		$post = [];
		$this->render('homechecker', ['post'=>$post]);
	}

	public function actionListBus()
	{
		return $this->actionListBusV2();
	}

	public function actionListBusV2()
	{
		$model = new Armada('searchListBusV2');
		if (isset($_GET['startdate']) && !empty($_GET['startdate'])) {
			$model->startdate = $_GET['startdate'];
		} else {
			$model->startdate = date('Y-m-d');
		}
		if (isset($_GET['titik_id'])) {
			$model->titik_id = $_GET['titik_id'];
		}
		if (isset($_GET['agen_id'])) {
			$model->agen_id = $_GET['agen_id'];
		}
		if (isset($_GET['filter']) && !empty($_GET['filter'])) {
			$model->filter = $_GET['filter'];
		}
		// Helper::getInstance()->dump(Yii::app()->user->titik_id);
		if (!isset($model->titik_id) && isset(Yii::app()->user->agen_id, Yii::app()->user->titik_id) && !empty(Yii::app()->user->agen_id)) {
			$model->titik_id = Yii::app()->user->titik_id;
			/* if (!isset($model->agen_id)) {
				$model->agen_id = Yii::app()->user->agen_id;
			} */
		}

		$arrTujuan = [];
		if (isset($model->startdate, $model->titik_id)) {
			$option = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/getTujuanKeberangkatan',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'startdate' => $model->startdate,
						'titik_id' => $model->titik_id,
						'agen_id' => isset($model->agen_id) ? $model->agen_id : Yii::app()->user->agen_id,
						'filter' => $model->filter,
						'Armada_kota_asal' => $model->titik_id
					]
				]
			]);

			if (isset($option['data']))
				$arrTujuan = $option['data'];
		}

		$this->render('new_index', [
			'model' => $model,
			'arrTujuan' => $arrTujuan
		]);
	}

	public function actionHomeCrew()
	{
		return $this->actionHomeCrewV2();
	}

	public function actionHomeCrewV2()
	{
		$model = new Booking;
		$model->startdate = (isset($_GET['startdate']) && !empty($_GET['startdate']) ? date('Y-m-d', strtotime($_GET['startdate'])) : date('Y-m-d'));
		$model->latitude = isset($_GET['latitude']) ? $_GET['latitude'] : null;
		$model->longitude = isset($_GET['longitude']) ? $_GET['longitude'] : null;
		$model->rit = isset($_GET['rit']) ? $_GET['rit'] : null;
		$model->tujuan = isset($_GET['tujuan']) && !empty($_GET['tujuan']) ? $_GET['tujuan'] : null;

		//cari penugasan
		$penugasan = ApiHelper::getInstance()->callUrl([
			'url' => 'apiMobile/penugasanCrew',
			'parameter' => [
				'method' => 'POST',
				'postfields' => [
					'startdate' => $model->startdate,
					'rit' => $model->rit,
					'user_id' => Yii::app()->user->id,
					'role' => Yii::app()->user->role,
					'latitude' => $model->latitude,
            		'longitude' => $model->longitude
					]
			]
		]);
		// Helper::getInstance()->dump($penugasan);
		if (isset($penugasan['data']['rit']))
			$model->rit = $penugasan['data']['rit'];

		if (!isset($model->tujuan) && isset($penugasan['data']['tujuan_id']) && !empty($penugasan['data']['tujuan_id']))
			$model->tujuan = $penugasan['data']['tujuan_id'];
		if (isset($penugasan['data']['trip_id'])) {
			$model->trip_id = $penugasan['data']['trip_id'];
		}

		$model->penjadwalan_id_fake = isset($penugasan['data']['penjadwalan_id']) ? $penugasan['data']['penjadwalan_id'] : null;

		$arrayTujuan = Armada::object()->getTujuan($model);
		if (isset($arrayTujuan['dataSelected']['drop_off_city'])) {
			$arrayTujuan['dataSelected']['drop_off_city'] = isset($_GET['turun']) && !empty($_GET['turun']) ? $_GET['turun'] : $arrayTujuan['dataSelected']['drop_off_city'];
		}
		if (isset($arrayTujuan['dataSelected']['boarding_city'])) {
			$arrayTujuan['dataSelected']['boarding_city'] = isset($_GET['naik']) && !empty($_GET['naik']) ? $_GET['naik'] : $arrayTujuan['dataSelected']['boarding_city'];
		}

		//latitude=-7.7705021&longitude=110.3899462
		// Helper::getInstance()->dump($arrayTujuan);
		if (isset($_POST['BookingTrip'], $_POST['FormSeat']) && !empty($_POST['BookingTrip'])) {
			if (!isset($_POST['FormSeat']['kursi'][0]) || empty($_POST['FormSeat']['kursi'][0])) {
				throw new CHttpException(401,'Mohon untuk memilih kursi terlebih dahulu');
			}
			$urlFile = null;
			$fileName = null;
			if (isset($_POST['BookingTrip']['tipe_pembayaran']) && in_array($_POST['BookingTrip']['tipe_pembayaran'], ['transfer'])) {
				//harus melampirkan bukti bayar
				if (!isset($_FILES['BookingTrip']['tmp_name']['bukti_pembayaran']) || empty($_FILES['BookingTrip']['tmp_name']['bukti_pembayaran'])) {
					throw new CHttpException(401,'Mohon untuk melampirkan bukti pembayaran jika memilih pembayaran transfer');
				}

				$targetDirectory = Yii::getPathOfAlias('webroot') . "/uploads/";
				$fileSource = basename($_FILES['BookingTrip']['name']['bukti_pembayaran']);
			    $imageFileType = strtolower(pathinfo($fileSource,PATHINFO_EXTENSION));
                if(!in_array($imageFileType, ["jpg","png","jpeg","gif"])) {
                    throw new CHttpException(401,'Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.');
                }
                $fileName = 'bukti_pembayaran_booking_' . Yii::app()->user->id . '_' . date('YmdHis') . '.' . $imageFileType;
                $targetFile = $targetDirectory . $fileName;

                if (move_uploaded_file($_FILES["BookingTrip"]["tmp_name"]["bukti_pembayaran"], $targetFile)) {
                    Yii::import('application.extensions.image.Image');
                    $image = new Image('uploads/' . $fileName);
                    $image->resize(800, 0);
                    $image->save('uploads/' . $fileName);

                    $urlFile = SERVER . '/uploads/' . $fileName;
                }

			}

			$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null);
        	$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] . ', IP: ' . $ip : $ip;
			// Helper::getInstance()->dump($_POST);
			$saveTransaction = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/transactionBooking',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'route_id' => isset($_POST['BookingTrip']['route_id']) ? $_POST['BookingTrip']['route_id'] : null,
						'startdate' => isset($_POST['BookingTrip']['startdate']) ? $_POST['BookingTrip']['startdate'] : null,
						'armada_ke' => isset($penugasan['data']['armada_ke']) ? $penugasan['data']['armada_ke'] : null,
						'penjadwalan_id' => isset($_POST['BookingTrip']['penjadwalan_id']) ? $_POST['BookingTrip']['penjadwalan_id'] : null,
						'BookingTrip' => $_POST['BookingTrip'],
						'FormSeat' => $_POST['FormSeat'],
						'user_id' => Yii::app()->user->id,
						'crew_id' => Yii::app()->user->id,
						'role' => Yii::app()->user->role,
						'tujuan_id' => $model->tujuan,
						'rit' => $model->rit,
						'filename' => $fileName,
                		'url_file' => $urlFile,
						'trip_label' => isset($penugasan['data']['trip_label']) ? $penugasan['data']['trip_label'] : null,
						'user_agent' => $userAgent
					]
				]
			]);
			// Helper::getInstance()->dump($saveTransaction);
			if (isset($targetFile) && !empty($targetFile)) {
				if (file_exists($targetFile)) {
					unlink($targetFile);	
				}
			}
			if ($saveTransaction['success']) {			
				$last_id_booking = isset($saveTransaction['last_id_booking']) ? $saveTransaction['last_id_booking'] : '';
				Yii::app()->user->setFlash('success', 'Pembelian Tiket Berhasil Dibuat');
				return $this->redirect(Constant::baseUrl().'/home/homeCrew?startdate=' . $model->startdate .'&latitude=' . $model->latitude .'&longitude=' . $model->longitude .'&tujuan=' . $model->tujuan . '&last_id_booking=' . $last_id_booking . '&rit=' . $model->rit);
			} else {
				Helper::getInstance()->dump($saveTransaction);
			}
		}

		$this->render('homeCrewV2', [
			'model' => $model,
			'penugasan' => $penugasan,
			'arrayTujuan' => $arrayTujuan
		]);
	}

	public function actionBookingTrip($id)
	{
		if (!isset($id, $_GET['startdate'])) {
			echo json_encode('ID atau tanggal tidak valid');
			exit;
		}
		// Helper::getInstance()->dump($_POST['tripLabel']);
		$data = [];
		$res = ApiHelper::getInstance()->callUrl([
            'url' => 'apiMobile/listTripAgen',
            'parameter' => [
                'method' => 'POST',
                'postfields' => [
					'id_trip' => $id,
					'group' => isset($_POST['group']) ? $_POST['group'] : null,
					'kelas' => isset($_POST['kelas']) ? $_POST['kelas'] : null,
					'groupId' => isset($_POST['groupId']) ? $_POST['groupId'] : null,
					'armadaId' => isset($_POST['armadaId']) ? $_POST['armadaId'] : null,
				]
            ]
        ]);
		if (isset($res['data'])) {
			$data = $res['data'];
		}
		// Helper::getInstance()->dump($data['label_data']);

		return $this->render('booking_trip', [
			'id'=>$id,
			'data'=>$data,
			'post'=>$_POST
		]);
	}

	public function actionAjaxBookingTrip()
	{
		$result = ['html' => ''];
		$result['html'] = "Belum ada penjadwalan dari Manager Jalur";
		if (isset($_POST['trip_id'], $_POST['keyword'])) {
			$res = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/listTripAgen',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'id_trip' => $_POST['trip_id'],
						'keyword' => $_POST['keyword'],
						'startdate' => isset($_POST['startdate']) ? $_POST['startdate'] : date('Y-m-d')
					]
				]
			]);
			if (isset($res['data']['data_agen']) && !empty($res['data']['data_agen'])) {
				$resData = $res['data']['data_agen'];
				$result['html'] = "";
				foreach ($resData as $agen) {
					$result['html'] .= '<div class="card-booking card-agen" data-trip_id="'. $_POST['trip_id'] .'" data-titik_id="'. $agen['titik_keberangkatan_id'] .'">
							<div class="x_title grey-dark mb-0 border-all">
								<table class="w-100">
									<tr class="va-baseline">
										<td style="width: 400px;">
											<h5 class="mt-5 mb-5">'. $agen['titik_keberangkatan'] .'</h5>
											<p>'. $agen['alamat'] .'</p>
										</td>
										<td style="width: 80px;" class="text-center"><h5 class="mt-5 mb-5">'. $agen['jml_trip'] .'</h5></td>
									</tr>
								</table>                                
								<div class="clearfix"></div>
							</div>
						</div>
						<div id="content-agen'. $agen['titik_keberangkatan_id'] .'"></div>';
				}
			}
		} else if (isset($_POST['trip_id'], $_POST['titik_id']) && !empty($_POST['trip_id'])) {
			$res = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/listTripBooking',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'id_trip' => $_POST['trip_id'],
						'titik_id' => $_POST['titik_id'],
						'startdate' => isset($_POST['startdate']) ? $_POST['startdate'] : date('Y-m-d')
					]
				]
			]);
			if (isset($res['data']) && !empty($res['data'])) {
				// ksort($res['data']);
				$result['html'] = '<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">';
				$i = 0;
				$dataJam = isset($_POST['data_label']) ? $_POST['data_label'] : '???';
				$arrLabel = json_decode(base64_decode($dataJam), true);
				foreach ($res['data'] as $d) {
					//Keberangkatan '. $d['armada_ke'] .' ('. $d['jam'] .')
					if (!isset($arrLabel[$d['armada_ke']]))
						continue;

					$jamKeberangkatan = $arrLabel[$d['armada_ke']];
					$result['html'] .= '
					<div class="panel">
					<a class="panel-heading d-flex align-space-between" role="tab" id="headingPanel'. $d['id'] .'" data-toggle="collapse" data-parent="#accordion" href="#collapsPanel'. $d['id'] .'" aria-expanded="true" aria-controls="collapsPanel'. $d['id'] .'">
						<table class="table border-none mb-0">
						<tr>
							<td><h4 class="panel-title color-primary">'. $jamKeberangkatan .'</h4></td>
							<td style="text-align:right;"><h5 class="m-0">'. $d['no_lambung'] .'</h5></td>
						</tr>
						</table>
					</a>
					<div id="collapsPanel'. $d['id'] .'" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingPanel'. $d['id'] .'">
						<div class="panel-body">';
						$result['html'] .= '<div class="accordion" id="subaccordion'.$d['id'].'" role="tablist" aria-multiselectable="true">';
						$ii = 0;
						foreach ($d['data'] as $jam => $dat) {
							$result['html'] .= '
								<div class="panel">
									<a class="panel-heading d-flex align-space-between" role="tab" id="subHeadingPanel'. $d['id'].$ii .'" data-toggle="collapse" data-parent="#subaccordion'.$d['id'].'" href="#subCollapsPanel'. $d['id'].$ii .'" aria-expanded="true" aria-controls="subCollapsPanel'. $d['id'].$ii .'">
										<table class="table border-none mb-0">
										<tr>
											<td><h4 class="panel-title">Armada Utama</h4></td>
										</tr>
										</table>
									</a>
									<div id="subCollapsPanel'. $d['id'].$ii .'" class="panel-collapse collapse '. ($ii == 0 ? 'in' : '') .'" role="tabpanel" aria-labelledby="subHeadingPanel'. $d['id'].$ii .'">
										<div class="panel-body">';
								foreach ($dat as $d_) {
									$result['html'] .= '<div class="card-booking">
										<div class="x_title grey-dark mb-0 border-all">
											<table class="w-100">
												<tr class="va-baseline">
													<td class="col-md-8">
														<h5 class="mt-5 mb-5">'. $d_['trip'] .'</h5>
													</td>
													<td class="col-md-4">
														<h5 class="mt-5 mb-5">'. $d_['tarif'] .'</h5>
													</td>
												</tr>
											</table>
											<div class="clearfix"></div>
										</div>

										<div class="content-card">
											<span class="btn btn-info card-trip" data-route_id="'. $d_['route_id'] .'" data-armada_ke="'. $d['armada_ke'] .'" data-penjadwalan_id="'. $d['penjadwalan_id'] .'" data-label="'.$jamKeberangkatan.'">Beli Tiket</span>
										</div>
									</div>';
								}
								$result['html'] .= '</div>
									</div>
								</div>';
							$ii++;
						}
					$result['html'] .= '</div>
						</div>
					</div>
					</div>';
					$i++;
				}
				$result['html'] .= '</div>';
			}
		}
		echo json_encode($result);
		Yii::app()->end();
	}

	public function actionAkunSaya()
	{
		$this->render('akunSaya');
	}

	public function actionProfile()
	{
		$data = [
			'nama' => Yii::app()->user->nama,
			'email' => Yii::app()->user->username,
			'no_hp' => Yii::app()->user->no_hp,
			'alamat' => Yii::app()->user->alamat
		];
		if (isset($_POST['User'])) {
			$post = $_POST['User'];
			if (!empty($post['old_password']) && !empty($post['new_password'])) {
				$post['user_id'] = Yii::app()->user->id;
				$updateProfile = UserHelper::getInstance()->updateProfile($post);
				if (!$updateProfile['success']) {
					Yii::app()->user->setFlash('error', $updateProfile['message']);
					return $this->render('profile', $data);
				}
			}
			Yii::app()->user->setFlash('success', $updateProfile['message']);
			return $this->redirect(Constant::baseUrl() . '/home/akunSaya');
		}

		$this->render('profile', $data);
	}

	public function actionRiwayat()
	{
		$this->render('riwayat');
	}

	public function actionQrscan()
	{
		$this->render('qrscan');
	}

	public function actionQrCrew()
	{
		$this->render('qrCrew');
	}

	public function actionQrResult()
	{
		if (!isset($_GET['data'])) {
			throw new CHttpException(401,'invalid data');
		}
		switch (Yii::app()->user->role) {
			case 'Checker':
				return $this->redirect(Constant::baseUrl() . '/home/qrResultChecker?data=' . $_GET['data']);
				break;
		}
		$dataRaw = base64_decode($_GET['data']);
		$data = json_decode($dataRaw, true);
		// Helper::getInstance()->dump($data);

		$model = new Booking;
		$model->startdate = (isset($data['tanggal']) && !empty($data['tanggal']) ? date('Y-m-d', strtotime($data['tanggal'])) : (isset($_GET['startdate']) ? $_GET['startdate'] : date('Y-m-d')));
		$model->rit = isset($data['rit']) ? $data['rit'] : (isset($_GET['rit']) ? $_GET['rit'] : null);
		$model->tujuan = isset($data['tujuan_id']) && !empty($data['tujuan_id']) ? $data['tujuan_id'] : (isset($_GET['tujuan']) ? $_GET['tujuan'] : null);
		$model->penjadwalan_id = isset($data['penjadwalan_id']) && !empty($data['penjadwalan_id']) ? $data['penjadwalan_id'] : (isset($_GET['penjadwalan_id']) ? $_GET['penjadwalan_id'] : null);

		if (isset($_POST['FormSeat'])) {
			// Helper::getInstance()->dump($_POST);
			$res = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/confirmBooking',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'booking_id' => $data['booking_id'],
						'user_id' => Yii::app()->user->id,
						'status' => isset($_POST['BookingTrip']['status']) && $_POST['BookingTrip']['status'] ? Constant::STATUS_PENUMPANG_TURUN : Constant::STATUS_PENUMPANG_NAIK,
						'role' => Yii::app()->user->role,
						'extra_bagasi' => isset($_POST['BookingTrip']['extra_bagasi']) ? $_POST['BookingTrip']['extra_bagasi'] : 0,
						'nominal_bagasi' => isset($_POST['BookingTrip']['nominal_bagasi']) ? $_POST['BookingTrip']['nominal_bagasi'] : null,
						'postArray' => $_POST['FormSeat'],
						'armada_ke' => isset($_POST['BookingTrip']['armada_ke']) ? $_POST['BookingTrip']['armada_ke'] : null,
						'penjadwalan_id' => isset($_POST['BookingTrip']['penjadwalan_id']) ? $_POST['BookingTrip']['penjadwalan_id'] : null,
						'real_titik_id' => isset($data['real_titik_id']) ? $data['real_titik_id'] : null,
						'real_armada_ke' => isset($data['real_armada_ke']) ? $data['real_armada_ke'] : null,
						'rit' => $model->rit
					]
				]
			]);
			// Helper::getInstance()->dump($res);

			if (!$res['success']) {
				Helper::getInstance()->dump($res['message']);
			}
			Yii::app()->user->setFlash('success', 'Konfirmasi Booking berhasil');
			$this->redirect(array('index'));
			// $this->redirect(Constant::baseUrl() . '/home/homeCrew?startdate=' . $data['tanggal']);
		}
		// Helper::getInstance()->dump($data);
		return $this->render('qrResult', [
			'data' => $data,
			'model' => $model,
			'dataRaw' => $dataRaw
		]);
	}

	public function actionQrResultCrew()
	{
		if (!isset($_GET['data'])) {
			throw new CHttpException(401,'invalid data');
		}
		$data = base64_decode($_GET['data']);
		$data = json_decode($data, true);
		if (!isset($data['rit'], $data['penjadwalan_id'])) {
			throw new CHttpException(401,'invalid parameter');
		}
// 		Helper::getInstance()->dump($data);
		$model = new Booking('routeDetail');
		$model->startdate = $data['startdate'];
		$model->route_id = $data['route_id'];
		$model->rit = $data['rit'];
		$model->penjadwalan_id = $data['penjadwalan_id'];

		if (isset($_POST['Booking']['jumlah_sesuai'])) {
			$_POST = array_merge([
				'user_id' => Yii::app()->user->id,
				'role' => Yii::app()->user->role,
				'status' => 1,
				'penjadwalan_id' => $data['penjadwalan_id']
			], $_POST);
			// Helper::getInstance()->dump($_POST);
			$reject = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/confirmTrip',
				'parameter' => [
					'method' => 'POST',
					'postfields' => $_POST
				]
			]);
			if (!$reject['success']) {
				Helper::getInstance()->dump($reject);
			}

			Yii::app()->user->setFlash('success', 'Konfirmasi Kesesuaian Trip berhasil');
			return $this->redirect(array('index'));
		}

		return $this->render('qrResultCrew', [
			'model' => $model,
			'post' => $data
		]);
	}

	public function actionQrResultChecker()
	{
		if (!isset($_GET['data'])) {
			throw new CHttpException(401,'invalid data');
		}
		$data = base64_decode($_GET['data']);
		$data = json_decode($data, true);

		// Helper::getInstance()->dump($data);
		if (isset($_POST['Booking']['kode_booking'])) {
			$_POST = array_merge([
				'user_id' => Yii::app()->user->id,
				'role' => Yii::app()->user->role,
				'status' => 1,
				'penjadwalan_id' => $data['penjadwalan_id']
			], $_POST);
			// Helper::getInstance()->dump($_POST);
			$reject = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/confirmTrip',
				'parameter' => [
					'method' => 'POST',
					'postfields' => $_POST
				]
			]);
			if (!$reject['success']) {
				Helper::getInstance()->dump($reject);
			}

			Yii::app()->user->setFlash('success', 'Konfirmasi Kesesuaian Trip berhasil');
			return $this->redirect(array('index'));
		}

		return $this->render('qrResultChecker', [
			'data' => $data
		]);
	}

	public function actionTopUpSaldo()
	{
		$post = [];
		if (isset($_POST['Deposit'])) {
			$post = $_POST['Deposit'];
			$post['agen_id'] = isset($post['agen_id']) ? $post['agen_id'] : Yii::app()->user->sdm_id;

			switch (Yii::app()->user->tipe_agen) {
				case 'internal':
					$post['type'] = "internal";
					break;
				
				default:
					$post['metode_pembayaran'] = "transfer";
					$post['type'] = "eksternal";
					$post['agen_id'] = Yii::app()->user->sdm_id;
					break;
			}

			switch ($post['metode_pembayaran']) {
				case 'tunai':
					# tidak wajib transfer
					break;
				
				default:
					if (!isset($_FILES['Deposit']['name']['file'], $_FILES["Deposit"]["tmp_name"]["file"]) || empty($_FILES['Deposit']['name']['file'])) {
						Yii::app()->user->setFlash('error', 'Mohon lampirkan bukti transfer');
						return $this->render('topUpSaldo', [
							'post' => $post
						]);
					}
					if (!isset($post['rekening']) || empty($post['rekening'])) {
						Yii::app()->user->setFlash('error', 'Jika transfer mohon untuk pilih rekening');
						return $this->render('topUpSaldo', [
							'post' => $post
						]);
					}
					break;
			}

			$fileName = null;
			$post['url'] = null;
			if (isset($_FILES['Deposit']['name']['file'], $_FILES["Deposit"]["tmp_name"]["file"]) && !empty($_FILES['Deposit']['name']['file'])) {
				$targetDirectory = Yii::getPathOfAlias('webroot') . "/uploads/"; // Direktori tujuan untuk menyimpan file (pastikan direktori sudah dibuat)
				$fileSource = basename($_FILES['Deposit']['name']['file']);
				$imageFileType = strtolower(pathinfo($fileSource,PATHINFO_EXTENSION));
				$fileName = 'deposit_' . Yii::app()->user->id . '_' . date('YmdHis') . '.' . $imageFileType;
				$targetFile = $targetDirectory . $fileName;
				// Izinkan tipe file tertentu (misalnya, hanya izinkan gambar)
				if(!in_array($imageFileType, ["jpg","png","jpeg","gif","pdf"])) {
					Yii::app()->user->setFlash('error', 'Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.');
					return $this->render('topUpSaldo', [
						'post' => $post
					]);
				}

				if (!move_uploaded_file($_FILES["Deposit"]["tmp_name"]["file"], $targetFile)) {
					Helper::getInstance()->dump('Terjadi kesalahan');
				}

				$post['url'] = SERVER . '/uploads/' . $fileName;
			}

			if (isset($fileName) && !empty($fileName)) {
				Yii::import('application.extensions.image.Image');
				$image = new Image('uploads/' . $fileName);
				$image->resize(400, 0);
				$image->save('uploads/' . $fileName);
			}

			if (isset($post['agen_id']) && in_array($post['agen_id'], ['self'])) {
				$post['agen_id'] = Yii::app()->user->sdm_id;
			}

			$nominal = str_replace(".", "", $post['nominal']);
			$bayar = str_replace(".", "", $post['bayar']);
			$bonus = null;

			$post['file_name'] = $fileName;
			$post['nominal'] = $nominal;
			$post['bayar'] = $bayar;
			$post['bonus'] = $bonus;
			$post['user_id'] = Yii::app()->user->id;
			$post['role'] = Yii::app()->user->role;

			$res = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/topUpSaldo',
				'parameter' => [
					'method' => 'POST',
					'postfields' => $post
				]
			]);

			if (!$res['success']) {
				Helper::getInstance()->dump($res['message']);
			}

			if (isset($targetFile) && file_exists($targetFile))
				unlink($targetFile);
			Yii::app()->user->setFlash('success', "Permintaan Top Up Saldo sudah terkirim. Mohon tunggu sampai admin konfirmasi");
			return $this->redirect(Constant::baseUrl().'/home/index');

		}
		return $this->render('topUpSaldo', [
			'post' => $post
		]);
	}

	public function actionTestQr()
	{
		return $this->render('testQr');
	}

	public function actionPrintBluetooth()
	{
		$this->layout = "raw";
		return $this->render('printBluetoothV2', []);
	}
}