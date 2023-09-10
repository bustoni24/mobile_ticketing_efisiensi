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
				'header' => 'Booking ID',
				'name' => 'booking_id'
			],
			[
				'header' => 'Kota Keberangkatan',
				'name' => 'nama_kota_asal'
			],
			[
				'header' => 'Kota Tujuan',
				'name' => 'nama_kota_tujuan'
			],
			[
				'header' => 'Group Trip',
				'name' => 'nama_group'
			],
			[
				'header' => 'Kelas',
				'name' => 'kelas_bus'
			],
			[
				'header' => 'Penumpang | Kursi',
				'name' => 'jml_penumpang',
				'type' => 'raw',
				'value' => function($data) {
					return Booking::object()->getDetailPenumpang($data['id']);
				}
			],
			[
				'header' => 'Total Harga',
				'name' => 'total_harga'
			],
			[
				'header' => 'Tanggal Booking',
				'name' => 'tanggal'
			],
			[
				'header' => 'Jam Keberangkatan',
				'name' => 'jam'
			],
			[
                'header' => 'Aksi',
                'name' => 'aksi',
				'type' => 'raw',
                'value' => function($data) {
                    $etiket = "<a class='btn btn-warning' href='". Constant::baseUrl().'/booking/itinerary?id=' . $data['id'] ."' target='_blank'>Cetak eTicket</a>";
                    $termal = "<a class='btn btn-success' href='". Constant::baseUrl().'/booking/printTiketEdc?id=' . $data['id'] ."' target='_blank'>Cetak EDC (80mm)</a>";
                    $kertas = "<a class='btn btn-info' href='". Constant::baseUrl().'/booking/printTiketA5?id=' . $data['id'] ."' target='_blank'>Cetak A5</a>";
                    return "$etiket <br/>$termal <br/>$kertas";
                }
            ]
			),
			)); ?>

		</div>
	</div>