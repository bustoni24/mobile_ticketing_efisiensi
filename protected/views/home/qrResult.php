<div class="row mt-20">
    <div class="col-sm-12 none">
        <div class="x_title">
            <h4><i class="fa fa-info-circle"></i> Konfirmasi Data Penumpang dengan kode Booking <?= (isset($data['booking_id']) ? $data['booking_id'] : '-') ?></h4>
            <h5><?= $data['nama_kota_asal'] .' - '. $data['nama_kota_tujuan']; ?></h5>
            <h5><?= "Tanggal Keberangkatan: ". $data['tanggal']; ?></h5>
            <h5><?= 'Jam Keberangkatan: '. $data['jam'] ?></h5>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php 
// Helper::getInstance()->dump($data);
$this->widget('zii.widgets.CListView', array(
    'id'=>'listViewBooking',
    'dataProvider'=>$model->searchBooking(),
    'itemView'=>'_view_list_booking',
    'emptyText' => 'Tidak ditemukan penugasan',
    'viewData' => array(
        'data_origin' => $data
    ),
));
?>

<script>
     $("body").on("change", '.opsi_pengantaran', function(e){
        e.preventDefault();

        var parents = $(this).parent().parent().parent().parent().parent().parent();
        if ($(this).val() === 'ya') {
            parents.find('.opsi_pengantaran_form').removeClass('none');
        } else {
            parents.find('.opsi_pengantaran_form').addClass('none');
        }
    });
    $("body").on("change", '.extra_bagasi', function(e){
        e.preventDefault();

        if ($(this).is(":checked")) {
            $('.nominal_bagasi').attr('readonly', false);
        } else {
            $('.nominal_bagasi').attr('readonly', true);
        }
    });

    var trip_id =  "<?= isset($data['trip_id']) ? $data['trip_id'] : ''; ?>";
    var startdate = "<?= isset($data['tanggal']) ? $data['tanggal'] : date('Y-m-d'); ?>";
    var armada_ke = "<?= $data['armada_ke']; ?>";
    var tujuan = <?= json_encode($data['tujuan_id']) ?>;
    function confirmSubmitTrip()
    {
        if ($('#statusPnp').val() === "") {
            Swal.fire({
                html: '<h5>Mohon pilih status penumpang</h5>',
                icon: 'warning',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'OK'
                });
            return false;
        }
        var seat = $("input[name='FormSeat[kursi][]']")
              .map(function(){return $(this).val();}).get();
        var kode_booking = $("input[name='FormSeat[kode_booking][]']")
              .map(function(){return $(this).val();}).get();
        
        let data = {trip_id:trip_id, startdate:startdate, armada_ke:armada_ke, seat:seat, kode_booking:kode_booking, status:1};
        //check available booking
    // console.log(data);
        $.ajax({
                type : "POST",
                url : "<?= Constant::baseUrl() . '/booking/checkAvailableBooking' ?>",
                dataType : "JSON",
                data: data,
                success : function(data) {
                    console.log(data);
                    if (data.success) {
                        Swal.fire({
                            title: 'Informasi Kursi Terisi',
                            html: data.data,
                            icon: 'info',
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                            });
                            // reloadSeat();
                    } else {
                        console.log(data);
                        $('#submitHide').trigger('click');
                    }
                },
                error : function(data){
                    if (typeof(data.responseText) !== "undefined")
                        console.log(data.responseText);
                }
            });
    }

    function reloadSeat()
    {
        var dataSent = {};
        dataSent['startdate'] = startdate;
        dataSent['rit'] = "<?= isset($data['rit']) ? $data['rit'] : '' ?>";
        dataSent['penjadwalan_id'] = "<?= isset($data['penjadwalan_id']) ? $data['penjadwalan_id'] : '' ?>";
        dataSent['tujuan'] = tujuan;
        dataSent['data'] = '<?= $_GET['data'] ?>';
        
        updateListView(dataSent);
    }

    function updateListView(data)
    {
        if (typeof data === "undefined" || data === null || data === "")
            return false;

        $.fn.yiiListView.update('listViewBooking', {data:data,
        complete: function(){
        
        },
        error : function(data){
            if (typeof(data.responseText) !== "undefined")
                console.log(data.responseText);
        }});
    }

    $("body").on('change', '.checkSeat', function(e){
        e.preventDefault();

        $(this).attr('checked', false);
    });
    /* 

    $('.opsi_pengantaran').on('change', function() {
        var parent = $(this).parent().parent().parent().find('.pengantaran_field');
        if ($(this).val() === 'ya') {
            if (typeof parent !== "undefined") {
                parent.removeClass('none');
            }
        } else {
            if (typeof parent !== "undefined") {
                parent.addClass('none');
            }
        }
    });

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
    $("body").on("change", '.extra_bagasi', function(e){
        e.preventDefault();

        if ($(this).is(":checked")) {
            $('.nominal_bagasi').attr('readonly', false);
        } else {
            $('.nominal_bagasi').attr('readonly', true);
        }
    }); */
    $("body").on('keyup', 'input.number', function(e){
        e.preventDefault();
        var value = $(this).val();
        value = value.replace(".", "");
        value = value.replace(".", "");
        $(this).val(accounting.formatNumber(value, 0, "."));
    });
</script>