<?php  
$post = isset($data['data']['post']['post']) ? $data['data']['post']['post'] : [];
$modelTrip = isset($data['data']['modelTrip']) ? (object)$data['data']['modelTrip'] : [];
$modelBookingExist = !empty($data['data']['modelBookingExist']) ? (object)$data['data']['modelBookingExist'] : [];
$countSeatBooked = isset($data['data']['seatBooked']) ? count($data['data']['seatBooked']) : 0;
?>

<script>
    function confirmSubmitTrip()
    {
        var trip_id =  "<?= isset($modelTrip->id) ? $modelTrip->id : ''; ?>";
        var startdate = $('#Booking_startdate').val();
        var armada_ke = "<?= isset($post['armada_ke']) ? $post['armada_ke'] : ''; ?>";
        var seat = $("input[name='FormSeat[kursi][]']")
              .map(function(){return $(this).val();}).get();

        let data = {trip_id:trip_id, startdate:startdate, armada_ke:armada_ke, seat:seat};
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

    function reloadSeat()
    {
        var startdate = $('#Booking_startdate').val();
        var dataSent = {};
        dataSent['startdate'] = startdate;
        dataSent['latitude'] = "<?= isset($_GET['latitude']) ? $_GET['latitude'] : '' ?>";
        dataSent['longitude'] = "<?= isset($_GET['longitude']) ? $_GET['longitude'] : '' ?>";
        dataSent['tujuan'] = $('#Booking_tujuan').val();
        
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
                        window.open("<?= Constant::baseUrl().'/booking/itinerary?id=' . (isset($modelBookingExist->id) ? $modelBookingExist->id : '')  ?>",'_blank');
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
        if (inputSeatCount === 0) {
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
        }

        repeater = setTimeout(doRefresh, 3000);
    }

    $(window).bind('load', function() {
        doRefresh();
    });
    // setInterval(doRefresh, 10000*60); //10 menit
</script>