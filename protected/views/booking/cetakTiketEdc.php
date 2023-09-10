<style>
    .qrCode img{
    border: 1px solid #000;
    padding: 5px;
}
.label_penumpang {
    border: 1px solid #000;
    padding: 5px;
}
.container_logo {
    vertical-align: middle;
    text-align: right;
}
body, html {
    font-size: 11px;
}
h5 {
    font-size: 12px;
    margin-bottom: 0;
    margin-top: 5px;
}
label {
    margin-bottom: 0;
}
.table>thead>tr>td, .table>tbody>tr>td{
    padding: 5px;
}
</style>

<?php
foreach ($datas as $data) {
    ?>
<div style="page-break-inside: avoid;"></div>

<div style="padding: 10px;">
<table class="table table-content border-none" style="border: 1px solid #000;">
    <thead>
        <tr>
            <td>
                <label class="label_penumpang">Untuk Penumpang</label>
            </td>
            <td class="container_logo"><img src="<?= Constant::newLogoIcon(); ?>" style="width: 60px;"/></td>
        </tr>
        <tr>
            <td colspan="2">
                <h5><?= $data['nama_group'] ?> / <?= $data['kelas_bus'] ?> <?= $data['nama_template'] ?></h5>
                <label><?= $data['nama_kota_asal'] . ' - ' . $data['nama_kota_tujuan'] ?></label>
                <p style="font-size: 10px;"><?= $data['titik_keberangkatan'] ?></p>
                <p style="font-size: 10px;"><?= $data['hari'] . ', ' . $this->IndonesiaTgl($data['tanggal']) . ' ' . $data['jam']; ?></p>
            </td>
        </tr>
    </thead>
    <tbody>
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
                                'matrixPointSize' => 2,
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
            <td>
                <p>RP</p>
                <h5>Rp <?= Helper::getInstance()->getRupiah($data['harga']); ?></h5>
            </td>
            <td>
                <p>NO. KURSI</p>
                <h5><?= $data['seat'] ?></h5>
            </td>
        </tr>
    </tbody>
</table>
</div>
<div class="page-break"></div> 
    <?php
}
?>