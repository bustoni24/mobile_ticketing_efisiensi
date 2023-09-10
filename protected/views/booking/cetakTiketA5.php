<style>
.qrCode img{
    border: 1px solid #000;
    padding: 5px;
}
.tiket>tr>td p{
    margin-bottom: 5px;
}
.tiket>tr>td p, .tiket>tr>td label {
    padding-left: 15px;
}
</style>
<div style="padding: 10px;">
<table class="table table-content border-none" style="border: 1px solid #000;">
    <thead>
        <tr style="border-bottom: 1px solid #000;">
            <td class="text-center" width="50%" style="vertical-align: middle;">
                <img src="<?= Constant::newLogoIcon(); ?>" style="width: 150px;"/>
            </td>
            <td class="text-center" width="50%">
                <p><?= $data['hari'] . ', ' . $this->IndonesiaTgl($data['tanggal']); ?></p>
                <p>TIKET PERJALANAN</p>
                <h4>EFISIENSI</h4>
            </td>
        </tr>
    </thead>
    <tbody class="tiket">
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td rowspan="4" class="text-center qrCode" style="border-right: 1px solid #000!important;">
                <?php
                    $qr_data = $this->encode($data['booking_id']);
                    try{
                        $qr_widget = $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
                            'data' => $qr_data,
                            'filename' => (isset($data['penumpang'][0]['nama_penumpang']) ? $data['penumpang'][0]['nama_penumpang'] : $data['booking_id']).".png",
                            'subfolderVar' => false,
                            'matrixPointSize' => 6,
                            'displayImage'=>true,
                            'errorCorrectionLevel'=>'L',
                        ));
                    }
                    catch (Exception $e){
                            echo json_encode($e->getMessage());// error here
                    }
                ?>
                <h5><?= $data['booking_id'] ?></h5>
                <br/>
                <h4><?= 'Rp ' . Helper::getInstance()->getRupiah($data['total_harga']) ?></h4>
            </td>
            <td>
                <p>PENUMPANG</p>
                <?php foreach ($data['penumpang'] as $pnp) {
                    echo '<label class="mt-0 mb-0">'.$pnp['nama_penumpang'].' / '.$pnp['no_telp'].'</label>';
                } ?>
            </td>
        </tr>
        
        <tr>
            <td>
                <p>ARMADA</p>
                <label class="mt-0 mb-0"><?= $data['kelas_bus'] . ' ' . $data['nama_template'] ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <p>KEBERANGKATAN</p>
                <label class="mt-0 mb-0"><?= strtoupper($data['nama_kota_asal']); ?><br/><span style="font-weight: 400;"><?= $data['penumpang'][0]['titik_keberangkatan'] . ' ' . $data['penumpang'][0]['kota_keberangkatan'] ?></span></label>
            </td>
        </tr>

        <tr>
            <td>
                <p>TUJUAN</p>
                <label class="mt-0"><?= strtoupper($data['nama_kota_tujuan']) ?></label>
            </td>
        </tr>

        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">
                <div style="display: flex;justify-content: center;width: 100%;">
                    <table class="table table-bordered mb-0" style="width:80%;">
                        <tr>
                            <td colspan="4" style="font-size: 16px;"><?= $data['hari'] . ', ' . $this->IndonesiaTgl($data['tanggal']); ?></td>
                        </tr>
                        <?php foreach ($data['penumpang'] as $pnp) {
                        ?>
                            <tr style="font-size: 20px;">
                                <td><?= $data['jam'] ?></td>
                                <td><?= $pnp['seat'] ?></td>
                                <td><?= $data['trip_label'] ?></td>
                                <td><?= substr($pnp['harga'], 0, -3).'K' ?></td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center pt-0" colspan="2">
            <p style="font-size: 11px;">Tiket hanya berlaku untuk 1 (satu) kali keberangkatan. Mohon Penumpang wajib datang ke titik keberangkatan 1 (satu) jam sebelum keberangkatan</p>
            </td>
        </tr>
    </tbody>
</table>
</div>