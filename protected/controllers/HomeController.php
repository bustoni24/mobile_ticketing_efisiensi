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
		switch (Yii::app()->user->role) {			
			case 'Cabin Crew':
				if (isset($_GET['startdate'])) {
					$post['startdate'] = $_GET['startdate'];
				}
				if (isset($post['startdate'])) {
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
				}
				break;
			case 'Agen':
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
		$model = new Armada('searchListBus');
		if (isset($_GET['startdate']) && !empty($_GET['startdate'])) {
			$model->startdate = $_GET['startdate'];
		} else {
			$model->startdate = date('Y-m-d');
		}
		if (isset($_GET['Armada'])) {
			$model->get = $_GET;
		}
		if (isset($_GET['filter']) && !empty($_GET['filter'])) {
			$model->filter = $_GET['filter'];
		}

		$this->render('index', [
			'model' => $model
		]);
	}

	public function actionHomeCrew()
	{
		$model = new Booking;
		$model->startdate = (isset($_GET['Booking']['startdate']) && !empty($_GET['Booking']['startdate']) ? date('Y-m-d', strtotime($_GET['Booking']['startdate'])) : date('Y-m-d'));
		$model->latitude = isset($_GET['latitude']) ? $_GET['latitude'] : null;
		$model->longitude = isset($_GET['longitude']) ? $_GET['longitude'] : null;

		if (isset($_POST['BookingTrip'], $_POST['FormSeat']) && !empty($_POST['BookingTrip'])) {
			// Helper::getInstance()->dump($_POST);
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
				$last_id_booking = isset($saveTransaction['last_id_booking']) ? $saveTransaction['last_id_booking'] : '';
				Yii::app()->user->setFlash('success', 'Pembelian Tiket Berhasil Dibuat');
				return $this->redirect(Constant::baseUrl().'/home/index?Booking[startdate]=' . $model->startdate . '&last_id_booking=' . $last_id_booking);
			} else {
				Helper::getInstance()->dump($saveTransaction);
			}
		}

		$this->render('homeCrew', [
			'model' => $model
		]);
	}

	public function actionBookingTrip($id)
	{
		if (!isset($id, $_GET['startdate'])) {
			echo json_encode('ID atau tanggal tidak valid');
			exit;
		}
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

		return $this->render('booking_trip', [
			'id'=>$id,
			'data'=>$data,
			'post'=>$_POST
		]);
	}

	public function actionAjaxBookingTrip()
	{
		$result = ['html' => ''];
		$result['html'] = "Tidak ditemukan data";
		if (isset($_POST['trip_id'], $_POST['keyword'])) {
			$res = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/listTripAgen',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'id_trip' => $_POST['trip_id'],
						'keyword' => $_POST['keyword']
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
						'titik_id' => $_POST['titik_id']
					]
				]
			]);
			if (isset($res['data']) && !empty($res['data'])) {
				$result['html'] = '<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">';
				$i = 0;
				foreach ($res['data'] as $d) {
					$result['html'] .= '
						<div class="panel">
						<a class="panel-heading d-flex align-space-between" role="tab" id="headingPanel'. $d['id'] .'" data-toggle="collapse" data-parent="#accordion" href="#collapsPanel'. $d['id'] .'" aria-expanded="true" aria-controls="collapsPanel'. $d['id'] .'">
							<table class="table border-none mb-0">
							<tr>
								<td><h4 class="panel-title">Armada ke '. $d['armada_ke'] .'</h4></td>
								<td><h4 class="panel-title">'. $d['jam'] .'</h4></td>
							</tr>
							</table>
						</a>
						<div id="collapsPanel'. $d['id'] .'" class="panel-collapse collapse '. ($i == 0 ? 'in' : '') .'" role="tabpanel" aria-labelledby="headingPanel'. $d['id'] .'">
							<div class="panel-body">';
							foreach ($d['data'] as $d_) {
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
										<span class="btn btn-info card-trip" data-route_id="'. $d_['route_id'] .'" data-armada_ke="'. $d['armada_ke'] .'">Beli Tiket</span>
									</div>
								</div>';
							}
						$result['html'] .= '</div>
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

	public function actionQrResult()
	{
		if (!isset($_GET['data'])) {
			throw new CHttpException(401,'invalid data');
		}
		$data = base64_decode($_GET['data']);
		$data = json_decode($data, true);
		if (isset($_POST['Booking']['kode_booking'])) {
			$res = ApiHelper::getInstance()->callUrl([
				'url' => 'apiMobile/confirmBooking',
				'parameter' => [
					'method' => 'POST',
					'postfields' => [
						'booking_id' => $data['booking_id'],
						'user_id' => Yii::app()->user->id,
						'role' => Yii::app()->user->role,
						'postArray' => $_POST['Booking']
					]
				]
			]);

			if (!$res['success']) {
				Helper::getInstance()->dump($res['message']);
			}
			Yii::app()->user->setFlash('success', 'Konfirmasi Booking berhasil');
			$this->redirect(array('index'));
		}
		// Helper::getInstance()->dump($data);
		return $this->render('qrResult', [
			'data' => $data
		]);
	}

	public function actionTopUpSaldo()
	{
		$post = [];
		if (isset($_POST['Deposit'])) {
			$post = $_POST['Deposit'];
			if (!isset($_FILES['Deposit']['name']['file'], $_FILES["Deposit"]["tmp_name"]["file"])) {
				Yii::app()->user->setFlash('error', 'Mohon lampirkan bukti transfer');
				return $this->render('topUpSaldo', [
					'post' => $post
				]);
			}
			// Helper::getInstance()->dump($post);
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

			if (move_uploaded_file($_FILES["Deposit"]["tmp_name"]["file"], $targetFile)) {
				Yii::import('application.extensions.image.Image');
				$image = new Image('uploads/' . $fileName);
				$image->resize(800, 0);
				$image->save('uploads/' . $fileName);

				//upload to API
				$res = ApiHelper::getInstance()->callUrl([
					'url' => 'apiMobile/topUpSaldo',
					'parameter' => [
						'method' => 'POST',
						'postfields' => [
							'nominal' => str_replace(".", "", $post['nominal']),
							'file_name' => $fileName,
							'url' => SERVER . '/' . $fileName,
							'user_id' => Yii::app()->user->id,
							'role' => Yii::app()->user->role
						]
					]
				]);

				if (!$res['success']) {
					Helper::getInstance()->dump($res['message']);
				}

				unlink($targetFile);
				Yii::app()->user->setFlash('success', "Permintaan Top Up Saldo sudah terkirim. Mohon tunggu sampai admin konfirmasi");
				return $this->redirect(Constant::baseUrl().'/home/index');
			} else {
				Helper::getInstance()->dump('Terjadi kesalahan');
			}
		}
		return $this->render('topUpSaldo', [
			'post' => $post
		]);
	}
}