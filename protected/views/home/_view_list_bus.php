<div class="card-booking card-book" data-tripId="<?= $data['trip_id']; ?>" data-group="<?= $data['nama_group'] ?>" data-kelas="<?= $data['kelas_bus'] ?>" data-groupId="<?= $data['group_trip_id'] ?>" data-armadaId="<?= $data['id']; ?>" data-label="<?= $data['trip_label'] ?>">
    <div class="x_title grey-dark mb-0">
        <h5 class="mt-5 mb-5"><?= $data['nama_group'] . ' ' . (isset($data['no_lambung']) ? $data['no_lambung'] : '') . ' ' . $data['kelas_bus'] . ' (' . (isset($data['nama_template']) ? $data['nama_template'] : '')  . ')' ?></h5>
        <div class="clearfix"></div>
    </div>

    <div class="content-card">
        <span class="badge-booking"><?= $data['pola_operasi'] == 'reguler' ? 'R' : 'T'; ?></span>
        <span class="ml-10"><?= $data['nama_kota_asal'] . ' - ' . $data['nama_kota_tujuan'] . (isset($data['trip_label']) && !empty($data['trip_label']) ? ' ('. $data['trip_label'] .')' : ''); ?></span>

        <span class="btn btn-warning pull-right" style="margin-top: -8px;">Pilih</span>
    </div>
</div>