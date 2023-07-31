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
		<div class="col-sm-12 pl-0 mb-0">
            <?= CHtml::dropDownList('Manifest[trip_id]',(isset($post['trip_id']) ? $post['trip_id'] : ''), Armada::object()->getOptionsArmada(),['prompt' => 'Pilih Armada', 'required'=>true]); ?>
		</div>
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
			
			<?php 
			if (isset($post['data'])):
				foreach ($post['data'] as $key => $postData) {
					echo '<h4 class="header">Armada ke '. $key .'</h4>';
					?>
					<table class="table table-bordered">
						<?php if (isset($postData['kuota'])): ?>
							<tr>
								<th colspan="4">
									<h4>Kuota: <?= $postData['kuota'] ?></h4>
								</th>
								<th colspan="6">
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
											<td colspan="10">
												<h5><?= $m['header']['titik_keberangkatan'] ?></h5>
												<p><?= $m['header']['alamat'] ?></p>
											</td>
										</tr>
										<tr>
											<th>Kode Booking</th>
											<th>Penumpang</th>
											<th>Telp</th>
											<th>Keberangkatan</th>
											<th>Tujuan</th>
											<th>Harga</th>
											<th>No Kursi</th>
											<th>Terjual Oleh</th>
											<!-- <th>Lunas?</th>
											<th>Discount</th> -->
										</tr>
										<?php foreach ($m['data'] as $manifest) {
											?>
											<tr>
												<td><?= $manifest['kode_booking'] ?></td>
												<td><?= $manifest['nama_penumpang'] ?></td>
												<td><?= $manifest['no_telp'] ?></td>
												<td><?= $manifest['tanggal'] . '<br/>' . $manifest['jam'] ?></td>
												<td><?= $manifest['kota_tujuan'] ?></td>
												<td><?= $manifest['harga'] > 0 ? Helper::getInstance()->getRupiah($manifest['harga']) : $manifest['harga']; ?></td>
												<td><?= $manifest['kursi'] ?></td>
												<td><?= $manifest['agen_nama'] ?></td>
												
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