<?php 
	$this->widget('ext.dropDownChain.VDropDownChain', array(
		'parentId' => 'Manifest_trip_id',
		'childId' => 'Manifest_jam',
		'url' => 'api/getAjaxJam?id=h3n5r5w5q584g4r4a4a356g4m5i484b4o4e4t5p5u5t4e4w2',
		'valueField' => 'id',
		'textField' => 'trip',
	));
?>
<div class="row mt-20">

    <div class="x_title">
        <h2>MANIFEST PENUMPANG</h2>
        <div class="clearfix"></div>
    </div>

	<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'pembelian-tiket-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.,
        'method'=>'get',
        'enableAjaxValidation'=>false,
    )); 
    ?>
	<div class="row height-75 d-relative">
		<div class="col-sm-12 pl-0 mb-0">
            <?= CHtml::textField('Manifest[startdate]',(isset($post['startdate']) ? $post['startdate'] : ''),['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off', 'required'=>true]); ?>
		</div>
		<div class="col-sm-12 pl-0">
            <?= CHtml::dropDownList('Manifest[trip_id]',(isset($post['trip_id']) ? $post['trip_id'] : ''), Armada::object()->getOptionsArmada(),['prompt' => 'Pilih Armada', 'required'=>true]); ?>
		</div>
	</div>

	<div class="row height-75 d-relative">
		<div class="col-sm-12 pl-0">
			<?= CHtml::dropDownList('Manifest[jam]',(isset($post['jam']) ? $post['jam'] : ''), (isset($post['jamArray']) ? $post['jamArray'] : []),['prompt' => 'Pilih Jam Keberangkatan']); ?>
		</div>
		<div class="col-sm-12 pl-0 mb-0">
            <?= CHtml::textField('Manifest[kode_booking]',(isset($post['kode_booking']) ? $post['kode_booking'] : ''),['placeholder' => 'Ketik kode booking / No. Tiket', 'autocomplete'=>'off']); ?>
		</div>
	</div>
	<div class="row height-75 d-relative">
		<div class="col-sm-12 pl-0 mb-0 mt-10">
            <button type="submit" class="btn btn-warning pull-right" id="filter">Lihat Manifest</button>
        </div>
	</div>
    <?php $this->endWidget(); ?>

	<div class="row">
        <div class="col-md-12" style="max-width: 100%;">
			<div class="layout-form-deck mt-10">
			<h3>Manifest Penumpang <?= (isset($post['trip_tour']['trip_tour']) ? $post['trip_tour']['trip_tour'] : '-') ?></h3>
			<div class="ln_solid_grey"></div>

			<!-- resume passenger -->
			<?php if (!empty($post['resume_passenger'])): ?>
			<div class="row">
				<div class="col-sm-12">
					<label>Drop Off: </label> <?= $post['resume_passenger']['drop_off'] ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<label>Naik: </label> <?= $post['resume_passenger']['naik'] ?>
				</div>
			</div>
			<?php endif; ?>
			
			<?php 
			if (isset($post['data'])):
				foreach ($post['data'] as $key => $postData) {
					echo '<h4 class="header">Keberangkatan '. $key .' '. (isset($postData['no_lambung']) ? ', Nomor Lambung: ' . $postData['no_lambung'] : '') .'</h4>';
					?>
					<table class="table table-bordered">
						<?php if (isset($postData['kuota'])): ?>
							<tr>
								<th colspan="4">
									<h4>Kuota: <?= $postData['kuota'] ?></h4>
								</th>
								<th colspan="10">
									<h4>Terjual: <?= $postData['kursi_terjual'] ?></h4>
								</th>
							</tr>
							<?php
								if (isset($postData['manifest'])): 
									foreach ($postData['manifest'] as $m) {
										if (!isset($m['header'], $m['data']))
											continue;
										?>
										<tr>
											<td colspan="14">
												<h5><?= $m['header']['titik_keberangkatan'] ?></h5>
												<p><?= $m['header']['alamat'] ?></p>
											</td>
										</tr>
										<tr>
											<th>No Kursi</th>
											<th>No.Tiket</th>
											<th>Kode Booking</th>
											<th>Penumpang</th>
											<th>Telp</th>
											<th>Naik</th>
											<th>Penurunan</th>
											<th>Harga</th>
											<th>Tgl. Input</th>
											<th>Keberangkatan</th>
											<th>Tujuan</th>
											<th>Terjual Oleh</th>
											<th>Status</th>
											<th>Pengantaran</th>
										</tr>
										<?php foreach ($m['data'] as $manifest) {
											?>
											<tr>
												<td><?= $manifest['kursi'] ?></td>
												<td><?= $manifest['booking_id'] ?></td>
												<td><?= $manifest['kode_booking'] ?></td>
												<td><?= $manifest['nama_penumpang'] ?></td>
												<td><?= $manifest['no_telp'] ?></td>
												<td><?= $manifest['titik_naik'] ?></td>
												<td><?= $manifest['info_turun'] ?></td>
												<td><?= $manifest['harga'] > 0 ? Helper::getInstance()->getRupiah($manifest['harga']) : $manifest['harga']; ?></td>
												<td><?= $manifest['created_date'] ?></td>
												<td><?= $manifest['tanggal'] . '<br/>' . $manifest['jam'] ?></td>
												<td><?= $manifest['kota_tujuan'] ?></td>
												<td><?= $manifest['agen_nama'] ?></td>
												<td><?= ($manifest['status'] == Constant::STATUS_PENUMPANG_TURUN ? 'Konfirmasi turun' : 
													($manifest['status'] == Constant::STATUS_PENUMPANG_RESCHEDULING ? 'Reschedule' : 
													($manifest['status'] == Constant::STATUS_PENUMPANG_REJECT ? 'Ditolak' : 
													($manifest['status'] == Constant::STATUS_PENUMPANG_REFUND ? 'Refund' : 
														($manifest['status'] == Constant::STATUS_PENUMPANG_NAIK ? 'Konfirmasi Naik' : 'Pemesanan Baru')
													)	
													)
													)) ?></td>
												<td>
													<?= $manifest['pengantaran'] ?>
												</td>
											</tr>
											<?php
										} ?>
										<?php
									}
								endif;
							?>
						<?php else: ?>
							<tr>
								<td colspan="10">
									Tidak ditemukan data
								</td>
							</tr>	
						<?php endif; ?>
					</table>
					<?php
				}
			endif;
			?>

			</div>
		</div>
	</div>

</div>

<script>
    $('#Manifest_startdate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		header: true
	});

	$(document).on('ready', function(){
        $('select').select2();
    });
</script>