<div class="col-sm-12">

<div class="x_title">
	<h2>Table Last Booking Trip View</h2>
	<div class="clearfix"></div>
</div>

	<div class="card-box table-responsive">

		<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'ticketing-booking-grid',
		'dataProvider'=>$model->dataLastBooking(),
		'filter'=>null,
		'columns'=>array(
			[
				'header' => 'Penumpang | Kursi',
				'name' => 'jml_penumpang',
				'type' => 'raw',
				'value' => function($data) {
					return Booking::object()->getDetailPenumpang($data['id']);
				}
			],
			[
				'header' => 'Info Detail',
				'name' => 'naik',
				'type' => 'raw',
				'value' => function($data) {
					$res = Booking::object()->getInfoPenumpang($data['id']);
					$html = "<span style='font-weight: 700;'>No. Tiket: </span>" . $data['booking_id'];
					$html .= '<br/><br/>Naik: ' . (isset($res['agen_boarding_nama']) ? $res['agen_boarding_nama'] . ' ('. $data['nama_kota_asal'] .')' : '-');
					$html .= '<br/>Penurunan: ' . (isset($res['info_turun']) ? $res['info_turun'] : (isset($data['nama_kota_tujuan']) ? $data['nama_kota_tujuan'] : '-'));
					$html .= "<br/><br/>Group Trip: " . $data['nama_group'];
					$html .= "<br/>Kelas: " . $data['kelas_bus'];
					$html .= "<br/>Tanggal: " . $data['tanggal'];
					$html .= "<br/>Jam Keberangkatan: " . $data['jam'];
					return $html;
				}
			],
			[
				'header' => 'Total Harga',
				'name' => 'total_harga'
			],
			[
                'header' => 'Aksi',
                'name' => 'aksi',
				'type' => 'raw',
                'value' => function($data) {
                    $etiket = "<a class='btn btn-warning' href='". Constant::baseUrl().'/booking/itinerary?id=' . $data['id'] ."' target='_blank'>Cetak eTicket</a>";
					$termal = "<a class='btn btn-success' href='". Constant::baseUrl().'/booking/printTiketEdc?id=' . $data['id'] ."' target='_blank'>Cetak EDC (80mm)</a>";
					$termal58 = "<a class='btn btn-primary' href='". Constant::baseUrl().'/booking/printTiketEdc58?id=' . $data['id'] ."' target='_blank'>Cetak EDC (58mm)</a>";
					$kertas = "<a class='btn btn-info' href='". Constant::baseUrl().'/booking/printTiketA5?id=' . $data['id'] ."' target='_blank'>Cetak A5</a>";
					return "$etiket <br/>$termal <br/>$termal58 <br/>$kertas";
                }
            ]
			),
			)); ?>

		</div>
	</div>