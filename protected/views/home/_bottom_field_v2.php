<style>
    input[type=checkbox] {
        transform: scale(1.5);
    }
</style>
<?php  
$post = isset($data['data']['post']['post']) ? $data['data']['post']['post'] : [];
$modelTrip = isset($data['data']['modelTrip']) ? (object)$data['data']['modelTrip'] : [];
$modelBookingExist = !empty($data['data']['modelBookingExist']) ? (object)$data['data']['modelBookingExist'] : [];
$countSeatBooked = isset($data['data']['seatBooked']) ? count($data['data']['seatBooked']) : 0;
$subTripSelected = isset($data['data']['subTripSelected']) ? (object)$data['data']['subTripSelected'] : [];
$startdate = isset($post['startdate']) ? $post['startdate'] : '';
// $isOnlyCrew = in_array(Yii::app()->user->role, ['Cabin Crew']);
// Helper::getInstance()->dump($data);
?>

<script>

    function confirmSubmitTrip()
    {       
        <?php if (in_array(Yii::app()->user->role, ['Cabin Crew'])): ?>
            if ($('#Booking_tujuan').val() === "" || $('#Booking_asal').val() === "") {
                Swal.fire({
                        title: 'Harap pilih Asal dan Tujuan dengan benar',
                        icon: 'warning',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                        });
                return false;
            }
        <?php endif; ?>
        var nama = "<?= isset(Yii::app()->user->nama) ? Yii::app()->user->nama : '-' ?>";
        var no_hp = "<?= isset(Yii::app()->user->no_hp) ? (int)Yii::app()->user->no_hp : '0' ?>";
        
        $('#table-form-passenger').find('input.namaPenumpang, input.teleponPenumpang').each(function(){
            if ($(this).val() === "") {
                if ($(this).attr('data-name') === 'nama')
                    $(this).val(nama);
                else if ($(this).attr('data-name') === 'no_hp')
                    $(this).val(no_hp);                
            }
        });

        var namaPenumpang = $("input.namaPenumpang")
              .map(function(){return $(this).val();}).get();
        var noHp = $("input.teleponPenumpang")
              .map(function(){return $(this).val();}).get();
        var kursi = $("input.kursiPenumpang")
              .map(function(){return $(this).val();}).get();
        var gender = $("select.genderPenumpang")
              .map(function(){return $(this).val();}).get();

        var textPnp = "";
        var j = 1;
        var i;
        for (i = 0; i < namaPenumpang.length; ++i) {
            if (kursi[i] === "") {
                Swal.fire({
                        title: 'Harap pilih kursi',
                        icon: 'warning',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                        });
                return false;
            }
            textPnp += `<tr>
                <td>${j}</td>    
                <td>Nama<br/>No. Kursi</td>    
                <td>${namaPenumpang[i] +" / "+ noHp[i]}<br/>${kursi[i] +" / "+ (gender[i] === 'L' ? 'Laki-laki' : 'Perempuan')}</td>    
            </tr>`;
            ++j;
        }

        var trip_id =  "<?= isset($modelTrip->id) ? $modelTrip->id : ''; ?>";
        var startdate = $('#Booking_startdate').val();
        var armada_ke = "<?= isset($post['armada_ke']) ? $post['armada_ke'] : ''; ?>";
        var trip_label = "<?= isset($post['trip_label']) ? $post['trip_label'] : ''; ?>";
        var seat = $("input[name='FormSeat[kursi][]']")
              .map(function(){return $(this).val();}).get();

        var tanggal = "<?= $this->getDay($startdate) . ', ' . $this->IndonesiaTgl($startdate) ?>";
        var kotaTujuan = "<?= (isset($subTripSelected->kota_asal) ? $subTripSelected->kota_asal . ' - ' . $subTripSelected->kota_tujuan : '') ?>";

        let data = {trip_id:trip_id, startdate:startdate, armada_ke:armada_ke, seat:seat};

        Swal.fire({
            html: `
            <h5 class="text-center">Konfirmasi Pesanan <br/>${trip_label}</h5>
            <table class='table border-none' style='text-align:left;width: 100%;'>
                    <tbody>
                    <tr>
                    <td style="width:10px;"></td>
                    <td style="width:25%;"></td>
                    <td style="width:70%;"></td>
                    </tr>
                        <tr>
                            <td colspan="3">${tanggal}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="pb-0">TUJUAN</th>
                        </tr>
                        <tr>
                            <td colspan="3">${kotaTujuan}</td>
                        </tr>
                        ${textPnp}
                    </tbody>
                </table>
            `,
            icon: 'info',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'OK'
        }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                   //check available booking
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
                                        reloadSeat();
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
        });
    }

    function reloadSeat()
    {
        var startdate = $('#Booking_startdate').val();
        var dataSent = {};
        dataSent['startdate'] = startdate;
        dataSent['latitude'] = "<?= isset($_GET['latitude']) ? $_GET['latitude'] : '' ?>";
        dataSent['longitude'] = "<?= isset($_GET['longitude']) ? $_GET['longitude'] : '' ?>";
        dataSent['tujuan'] = $('#Booking_tujuan_id').val();
        
        updateListView(dataSent);
    }

     $(document).on('ready', function() {        
        <?php
        //flashes
        foreach(Yii::app()->user->getFlashes() as $key => $message){
            ?>
            console.log('<?= $key ?>');
            Swal.fire({
                    title: '<?= $message ?>',
                    icon: '<?= $key ?>',
                    showDenyButton: '<?= ($key == 'success') ? true : false ?>',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    denyButtonText: `Cetak eTicket`,
                    denyButtonColor: '#F58220',
            }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                        window.open("<?= Constant::baseUrl().'/booking/itinerary?id=' . (isset($_GET['last_id_booking']) ? $_GET['last_id_booking'] : (isset($modelBookingExist->id) ? $modelBookingExist->id : ''))  ?>",'_blank');
                    }
            });

            <?php
        }
    ?>
    });

    function doRefresh() {
        var inputSeatCount = 0;
        $('input.seatForm').each(function(){
            if (typeof $(this).val() !== "undefined" && $(this).val() !== null && $(this).val() !== "")
                inputSeatCount++;
        });
        
        if (inputSeatCount === 0 && !($('.swal2-popup').css('display') === 'grid')) {
            var existingCountSeatBooked = parseInt("<?= $countSeatBooked ?>");
            // console.log(existingCountSeatBooked);
            var trip_id =  "<?= isset($modelTrip->id) ? $modelTrip->id : ''; ?>";
            var startdate = $('#Booking_startdate').val();
            var armada_ke = "<?= isset($post['armada_ke']) ? $post['armada_ke'] : ''; ?>";

            let data = {trip_id:trip_id, startdate:startdate, armada_ke:armada_ke, seatCount:existingCountSeatBooked};

            $.ajax({
                    type : "POST",
                    url : "<?= Constant::baseUrl() . '/booking/checkBeforeAfterSeat' ?>",
                    dataType : "JSON",
                    data: data,
                    success : function(data) {
                        if (data.success) {
                            reloadSeat();
                        } else {
                            console.log(data);
                        }
                    },
                    error : function(data){
                        if (typeof(data.responseText) !== "undefined")
                            console.log(data.responseText);
                    }
                });

            repeater = setTimeout(doRefresh, 10000);
        }
    }

   /*  $(window).bind('load', function() {
        doRefresh();
    }); */

    $("body").on('click', '#allCheck', function(){
        var nameField = $('tr#form-passenger0').find('input#FormSeat_name').val();
        var telpField = $('tr#form-passenger0').find('input#FormSeat_telp').val();
        var genderField = $('tr#form-passenger0').find('select#FormSeat_gender').val();

        $('tr.form-passenger').find('input#FormSeat_name').val(nameField);
        $('tr.form-passenger').find('input#FormSeat_telp').val(telpField);
        $('tr.form-passenger').find('select#FormSeat_gender').val(genderField);
    });
    // setInterval(doRefresh, 10000*60); //10 menit

    $("body").on('change', '#BookingTrip_info_turun', function(){
        var textTurun = $(this).find(":selected").text();
        // alert(textTurun);
        $('#BookingTrip_info_turun_text').val(textTurun);
    });
</script>