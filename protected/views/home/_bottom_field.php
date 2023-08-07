<?php  
$post = isset($data['data']['post']['post']) ? $data['data']['post']['post'] : [];
$routeId = isset($data['data']['post']['routeId']) ? $data['data']['post']['routeId'] : '';
$modelTrip = isset($data['data']['modelTrip']) ? (object)$data['data']['modelTrip'] : [];
$modelTripAgen = isset($data['data']['modelTripAgen']) ? (object)$data['data']['modelTripAgen'] : [];
$modelBookingExist = !empty($data['data']['modelBookingExist']) ? (object)$data['data']['modelBookingExist'] : [];
$layoutDeck = isset($data['data']['layoutDeck']) ? $data['data']['layoutDeck'] : [];
$seatBooked = isset($data['data']['seatBooked']) ? $data['data']['seatBooked'] : [];
$listTerdekat = isset($data['data']['listTitikTerdekat']) ? $data['data']['listTitikTerdekat'] : [];
$isCrew = in_array(Yii::app()->user->role, ['Cabin Crew','Checker']);
$countSeatBooked = isset($data['data']['seatBooked']) ? count($data['data']['seatBooked']) : 0;
?>

<div class="card-booking card-book">
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'pembelian-tiket-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.,
        'enableAjaxValidation'=>false
    )); 
    ?>

<?php if (in_array(Yii::app()->user->role, ['Cabin Crew'])): ?>

    <div class="row height-75 d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Titik Terdekat</label>
            <?= CHtml::hiddenField('BookingTrip[titik_id]', (isset($listTerdekat['titik_id']) ? $listTerdekat['titik_id'] : '')) ?>
            <?= CHtml::textField('BookingTrip[titik_keberangkatan]',(isset($listTerdekat['titik_keberangkatan']) ? $listTerdekat['titik_keberangkatan'] : ''),['placeholder' => 'Titik Terdekat', 'readonly' => isset($listTerdekat['titik_keberangkatan'])]); ?>
            <span><?= 'Alamat: ' . (isset($listTerdekat['alamat']) ? $listTerdekat['alamat'] : '') ?></span>
        </div>
    </div>

    <div class="row height-75 d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Jam Keberangkatan Terdekat</label>
            <?= CHtml::textField('BookingTrip[jam_keberangkatan]',(isset($listTerdekat['jam']) ? $listTerdekat['jam'] : ''),['placeholder' => 'Jam Keberangkatan Terdekat', 'readonly' => isset($listTerdekat['jam'])]); ?>
        </div>
    </div>

    <div class="row height-75 d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= CHtml::textField('BookingTrip[daerah_titik_keberangkatan]','',['autocomplete' => 'off', 'placeholder' => 'Ketik Nama Dearah Keberangkatan','required'=>true]); ?>
        </div>
    </div>

<?php endif; ?>

<?php if (in_array(Yii::app()->user->role, ['Agen', 'Cabin Crew'])): ?>
    <div class="layout-form-deck" id="layoutPenumpang">
        <h5>DATA PENUMPANG</h5>
        <p>Masukan data penumpang (Nama dan No Telp) sebagai data manifest</p>

        <?= CHtml::hiddenField('BookingTrip[total_harga]', ''); ?>
        <?= CHtml::hiddenField('BookingTrip[route_id]', (isset($listTerdekat['route_id']) ? $listTerdekat['route_id'] : (isset($modelTripAgen->route_id) ? $modelTripAgen->route_id : ''))); ?>
        <?= CHtml::hiddenField('BookingTrip[armada_ke]', isset($post['armada_ke']) ? $post['armada_ke'] : ''); ?>
        <?= CHtml::hiddenField('BookingTrip[startdate]', isset($post['startdate']) ? $post['startdate'] : ''); ?>
        <?= CHtml::hiddenField('BookingTrip[penjadwalan_id]', isset($post['penjadwalan_id']) ? $post['penjadwalan_id'] : ''); ?>
        <?= CHtml::hiddenField('BookingTrip[latitude]', (isset($data['data']['latitude']) ? $data['data']['latitude'] : '')) ?>
        <?= CHtml::hiddenField('BookingTrip[longitude]', (isset($data['data']['longitude']) ? $data['data']['longitude'] : '')) ?>
        <?= CHtml::hiddenField('BookingTrip[jarak]', (isset($listTerdekat['distance']) ? $listTerdekat['distance'] : '')); ?>
        <table class="table">
            <tbody id="table-form-passenger">
                <tr id="form-passenger0" class="form-passenger">
                    <td>
                        <table class="table border-none">
                            <tr>
                                <th>Nama</th>
                                <th>No Telp</th>
                            </tr>
                            <tr>
                                <td>
                                    <?= CHtml::textField('FormSeat[name][]', '', ['placeholder'=>'Penumpang' ,'autocomplete'=>'off', 'class'=>'inputSeat', 'required' => true]); ?>
                                </td>
                                <td>
                                    <?= CHtml::textField('FormSeat[telp][]', '', ['placeholder'=>'Telepon' ,'autocomplete'=>'off', 'class'=>'inputSeat', 'required' => true]); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Kursi</th>
                                <th>Gender</th>
                            </tr>
                            <tr>
                                <td>
                                    <?= CHtml::textField('FormSeat[kursi][]', '', ['readonly'=>true, 'class'=>'inputSeat seatForm','required'=>true]); ?>
                                </td>
                                <td>
                                    <?= CHtml::dropDownList('FormSeat[gender][]', '', [
                                        'L' => 'Pria',
                                        'P' => 'Wanita'
                                    ],['class'=>'inputSeat']); ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container-button-float">
    <div class="row-0">
        <div class="button-float">
            <input type="submit" name="submit" class="none" value="1" id="submitHide"/>
            <button type="button" class="float-btn btn-submit" id="beliTiket" onclick="return confirmSubmitTrip();">
                Rp &nbsp;<span id="total_price">0</span> &nbsp;| Beli Tiket
            </button>
        </div>
    </div>
    </div>
    <?php endif; ?>

    <?php if (in_array(Yii::app()->user->role, ['Checker'])): ?>
    <div class="row" style="overflow: auto;">
        <table class="table">
            <tr>
                <th>Kode Booking</th>
                <th>Nama Penumpang</th>
                <th>Nomor HP</th>
                <th>Jenis Kelamin</th>
                <th>Nomor Kursi</th>
            </tr>
            <?php 
            $dataSeatBoooked = isset($data['data']['seatBooked']) ? $data['data']['seatBooked'] : [];
            foreach ($dataSeatBoooked as $seatBooked) {
                if (!isset($seatBooked['id']))
                    continue;

                $dataSeat = $seatBooked[$seatBooked['id']];
                ?>
                <tr>
                    <td><?= $dataSeat['kode_booking']; ?></td>
                    <td><?= $dataSeat['nama']; ?></td>
                    <td><?= $dataSeat['no_hp']; ?></td>
                    <td><?= $dataSeat['jenis_kelamin'] == 'L' ? 'Pria' : 'Wanita'; ?></td>
                    <td><?= $dataSeat['no_kursi']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <div class="row">
        <table class="table table-bordered">
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
    <?php endif; ?>

    <?php $this->endWidget(); ?>
</div>

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
                            doRefresh();
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
        var existingCountSeatBooked = parseInt("<?= $countSeatBooked ?>");
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
                        var dataSent = {};
                        dataSent['startdate'] = startdate;
                        dataSent['latitude'] = "<?= isset($_GET['latitude']) ? $_GET['latitude'] : '' ?>";
                        dataSent['longitude'] = "<?= isset($_GET['longitude']) ? $_GET['longitude'] : '' ?>";
                        dataSent['tujuan'] = "<?= isset($_GET['tujuan']) ? $_GET['tujuan'] : '' ?>";
                        
                        updateListView(dataSent);
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
    setInterval(doRefresh, 10000*60); //10 menit
</script>