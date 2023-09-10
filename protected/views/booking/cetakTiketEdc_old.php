<style>
    .qrCode img{
    border: 1px solid #000;
    padding: 5px;
}
.label_penumpang {
    border: 1px solid #000;
    padding: 5px;
}
</style>

<?php
foreach ($datas as $data) {
    ?>
<div style="page-break-inside: avoid;"></div>

<div style="padding: 10px;">
<table class="table table-content border-none" style="border: 1px solid #000;page-break-inside: avoid;">
    <thead>
        <tr>
            <td colspan="2">
                <label class="label_penumpang">Untuk Penumpang</label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <img src="<?= Constant::newLogoIcon(); ?>" style="width: 80px;"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>EFISIENSI</p>
                <h5><?= $data['nama_group'] ?> / <?= $data['kelas_bus'] ?> <br/> <?= $data['nama_template'] ?></h5>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">
                <div class="ln_solid"></div>
            </td>
        </tr>
        <tr>
            <td width="60%">
                <p class="mb-0">PENUMPANG</p>
            </td>
            <td width="40%" rowspan="3" class="text-center qrCode" >
                <h5><?= $data['booking_id'] ?></h5>
                <?php
                        $qr_data = $this->encode($data['booking_id']);
                        try{
                            $qr_widget = $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
                                'data' => $qr_data,
                                'filename' => $data['nama_penumpang'].".png",
                                'subfolderVar' => false,
                                'matrixPointSize' => 3,
                                'displayImage'=>true,
                                'errorCorrectionLevel'=>'L',
                            ));
                        }
                        catch (Exception $e){
                                echo json_encode($e->getMessage());// error here
                        }
                    ?>
            </td>
        </tr>
        <tr>
            <td>
                <label class="mt-0"><?= $data['nama_penumpang'] ?> <br/><?= $data['no_telp'] ?></label>
            </td>
        </tr>
        <tr>
            <td>
                <p>Cap & Tanda tangan disini</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="ln_solid"></div>
            </td>
        </tr>
        <tr>
            <td>
                <p>RUTE PERJALANAN</p>
                <label><?= $data['nama_kota_asal'] . ' - ' . $data['nama_kota_tujuan'] ?></label>
                <p><?= $data['titik_keberangkatan'] ?></p>
                <p><?= $data['hari'] . ', ' . $this->IndonesiaTgl($data['tanggal']) . ' ' . $data['jam']; ?></p>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>
                <p>RP</p>
                <h4>Rp <?= Helper::getInstance()->getRupiah($data['harga']); ?></h4>
            </td>
            <td>
                <p>NO. KURSI</p>
                <h4><?= $data['seat'] ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="ln_solid"></div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <ol>
                    <li>Tiket ini adalah tiket sah dan hanya berlaku untuk 1 (satu) penumpang dan 1 (satu) kali perjalanan.</li>
                    <li>Harga yang tertera sudah termasuk biaya administrasi dan biaya peron pada tanggal keberangkatan</li>
                    <li>Wajib menunjukkan bukti identitas asli pada saat boarding dan pemeriksaan. Mohon melakukan check-in 1 (satu) jam sebelum keberangkatan</li>
                    <li>Nomor Kursi tidak mengikat, bergantung pada kebijakan operator</li>
                    <li>Pembatalan tiket minimal 24 jam sebelum keberangkatan, dengan syarat dan ketentuan yang berlaku</li>
                </ol>
            </td>
        </tr>
    </tbody>
</table>
</div>
<div class="page-break"></div> 
    <?php
}
?>