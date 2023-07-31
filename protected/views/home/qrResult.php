<div class="row mt-20">
    <div class="col-sm-12">
        <div class="x_title">
            <h4><i class="fa fa-info-circle"></i> Konfirmasi Data Penumpang dengan kode Booking <?= (isset($data['booking_id']) ? $data['booking_id'] : '-') ?></h4>
            <h5><?= $data['nama_kota_asal'] .' - '. $data['nama_kota_tujuan']; ?></h5>
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
        'htmlOptions' => ['onsubmit'=>'return onSubmitForm(event)']
    )); 
    ?>

    <?php foreach ($data['list'] as $list) {
        ?>
        <div class="card-booking card-book mb-50">
        <?php
        foreach ($list as $key => $value) {
            if (in_array($key, ['tanggal', 'jam', 'jenis_kelamin']))
                continue;
            ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?= ucwords(str_replace("_", " ", $key)); ?></label>
                    <?php if (in_array($key, ['no_hp'])) {
                        echo CHtml::numberField("Booking[$key][]", $list[$key], ['class'=>'form-control', 'readonly' => in_array($key, ['kode_booking'])]);
                    } else if (in_array($key, ['jenis_kelamin'])) {
                        echo CHtml::dropDownList("Booking[$key][]", $list[$key], [
                            'L' => 'Pria',
                            'P' => 'Wanita'
                        ], ['class'=>'form-control']);
                    } else {
                        echo CHtml::textField("Booking[$key][]", $list[$key], ['class'=>'form-control', 'readonly' => in_array($key, ['kode_booking'])]);
                    } ?>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
        <?php
    }
    ?>

<div class="container-button-float">
    <div class="row-0">
        <div class="float-div">
            <button class="btn btn-warning">Konfirmasi</button>
            <button type="button" class="btn btn-danger" id="tolak">Tolak</button>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>


<script>
    function onSubmitForm(ev) {
        Swal.fire({
                    title: 'Konfirmasi Booking',
                    icon: 'info',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    denyButtonText: `Cancel`,
            }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        return true;
                    } else if (result.isDenied) {
                        return false;
                    }
            });
    }

    $('#tolak').on('click', function(){
        let booking_id = "<?= $data['booking_id']; ?>";
        
        Swal.fire({
        title: 'Penolakan Booking ID '+booking_id,
        html: ` <div class="row">
                    <div class="form-group">
                        <label class="col-md-4">Alasan Penolakan</label>
                        <div class="col-md-6">
                            <textarea id="alasan" class="swal2-input form-control" placeholder="- Ketik Alasan Penolakan -"></textarea>
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
                        url : "<?= Constant::baseUrl() . '/booking/rejectBooking' ?>",
                        dataType : "JSON",
                        data: {alasan:result.value.alasan,booking_id:booking_id},
                        success : function(data) {
                            if (data.success) {
                                Swal.fire(
                                    `Penolakan berhasil <br/>
                                    Alasan: ${result.value.alasan}
                                    `.trim());
                                    setTimeout(function() {
                                        location.href="<?= Constant::baseUrl().'/home/index'; ?>";
                                    }, 2000);
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