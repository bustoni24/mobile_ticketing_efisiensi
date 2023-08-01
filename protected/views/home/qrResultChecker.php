<div class="row mt-20">
    <div class="col-sm-12">
        <div class="x_title">
            <h4><i class="fa fa-info-circle"></i> Konfirmasi Data Penumpang dengan kode Booking <?= (isset($data['booking_id']) ? $data['booking_id'] : '-') ?></h4>
            <h5>Tujuan: <?= $data['nama_kota_asal'] .' - '. $data['nama_kota_tujuan']; ?></h5>
            <h5><?= "Tanggal Keberangkatan: ". $data['tanggal']; ?></h5>
            <h5><?= 'Jam Keberangkatan: '. $data['jam'] ?></h5>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'pembelian-tiket-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.,
        'enableAjaxValidation'=>false,
        // 'htmlOptions' => ['onsubmit'=>'return onSubmitForm(event)']
    )); 
    ?>

<?php 
$i=1;
foreach ($data['list'] as $list) {
        ?>
        <div class="card-booking card-book mb-50">
            <h5>Data Penumpang ke-<?= $i ?></h5>
        <?php
        foreach ($list as $key => $value) {
            if (in_array($key, ['tanggal', 'jam', 'jenis_kelamin']))
                continue;
            ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?= ucwords(str_replace("_", " ", $key)); ?></label>
                    <?php if (in_array($key, ['no_hp'])) {
                        echo CHtml::numberField("Booking[$key][]", $list[$key], ['class'=>'form-control', 'readonly' => true]);
                    } else {
                        echo CHtml::textField("Booking[$key][]", $list[$key], ['class'=>'form-control', 'readonly' => true]);
                    }  ?>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
        <?php
        $i++;
    }
    ?>

<div class="row ">
        <table class="table table-bordered mb-50">
            <tr>
                <th width="60%">Apakah jumlah dan data penumpang sudah sesuai?</th>
                <td width="40%">
                    <?= CHtml::radioButtonList("Booking[jumlah_sesuai]", "", [
                        '0' => 'Tidak',
                        '1' => 'Ya'
                    ], [
                        'separator' => "&nbsp;&nbsp;",
                        'required' => true
                    ]) ?>
                </td>
            </tr>
            <tr>
                <th width="60%">Apakah data crew dan perjalanan sudah sesuai?</th>
                <td width="40%">
                    <?= CHtml::radioButtonList("Booking[crew_sesuai]", "", [
                        '0' => 'Tidak',
                        '1' => 'Ya'
                    ], [
                        'separator' => "&nbsp;&nbsp;"
                    ]) ?>
                </td>
            </tr>
        </table>
    </div>

<div class="container-button-float">
    <div class="row-0">
        <div class="float-div">
            <button class="btn btn-warning">Sesuai</button>
            <button type="button" class="btn btn-danger" id="tolak">Tidak Sesuai</button>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>


<script>

    $('#tolak').on('click', function(){
        let penjadwalan_id = "<?= $data['penjadwalan_id']; ?>";
        
        Swal.fire({
        title: 'Konfirmasi Ketidaksesuaian Data',
        html: ` <div class="row">
                    <div class="form-group">
                        <label class="col-md-4">Alasan Tidak Sesuai</label>
                        <div class="col-md-6">
                            <textarea id="alasan" class="swal2-input form-control" placeholder="- Ketik Alasan Tidak Sesuai -"></textarea>
                        </div>
                    </div>
                </div>
                `,
        showDenyButton: true,
        denyButtonText: `Cancel`,
        confirmButtonText: 'OK',
        confirmButtonColor: '#F58220',
        focusConfirm: false,
        preConfirm: () => {
            const alasan = Swal.getPopup().querySelector('#alasan').value
            if (!alasan) {
            Swal.showValidationMessage(`Silakan masukkan alasan pembatalan`)
            }
            return { alasan: alasan }
        }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                        type : "POST",
                        url : "<?= Constant::baseUrl() . '/booking/rejectTrip' ?>",
                        dataType : "JSON",
                        data: {alasan:result.value.alasan,penjadwalan_id:penjadwalan_id},
                        success : function(data) {
                            if (data.success) {
                                Swal.fire(
                                    `Konfirmasi ketidaksesuaian berhasil <br/>
                                    Alasan: ${result.value.alasan}
                                    `.trim());
                                    setTimeout(function() {
                                        location.href="<?= Constant::baseUrl().'/home/index'; ?>";
                                    }, 1000);
                            } else {
                                console.log(data);
                            }
                        },
                        error : function(data){
                            if (typeof(data.responseText) !== "undefined")
                                console.log(data.responseText);
                        }
                    });
            }
        });
    });
</script>