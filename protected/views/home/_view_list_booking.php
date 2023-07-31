<?php 
$post = $data['data']['post']['post'];
$routeId = $data['data']['post']['routeId'];
$modelTrip = (object)$data['data']['modelTrip'];
$modelTripAgen = (object)$data['data']['modelTripAgen'];
$modelBookingExist = !empty($data['data']['modelBookingExist']) ? (object)$data['data']['modelBookingExist'] : [];
$layoutDeck = $data['data']['layoutDeck'];
$seatBooked = $data['data']['seatBooked'];
$listTerdekat = $data['data']['listTitikTerdekat'];
// Helper::getInstance()->dump($data['data']['latitude']);
$isCrew = Yii::app()->user->role == 'Cabin Crew';
?>
<div class="col-sm-12">

    <div class="x_title">
        <h5><i class="fa fa-minus-circle"></i> <b>Perhatian:</b> Mohon perhatikan tanggal keberangkatan, Kota keberangkatan dan tujuan!</h5>
        <div class="clearfix"></div>
    </div>
</div>

<div class="card-booking card-book">
    <div class="x_title grey-dark mb-0">
        <h4><?= $post['group']. ' - ' . $post['kelas']; ?></h4>
        <h4><?= $modelTrip->boarding_kota_nama . ' - ' . $modelTrip->destination_kota_nama . ', ' . $this->getDay($post['startdate']) . ', ' . $this->IndonesiaTgl($post['startdate']) . ' ' . (!$isCrew ? $post['jam'] : ''); ?></h4>
        <?php if (!$isCrew){
            ?>
            <h5><?= '<i class="fa fa-user"></i> ' . $modelTripAgen->agen_nama . ', ' .  '<i class="fa fa-map-marker"></i> ' . $post['titik_keberangkatan'] . ', ' . $post['alamat_titik']; ?></h5>
            <?php
        } ?>
        <div class="clearfix"></div>
        <?php echo (isset($post['nomor_lambung']) && !empty($post['nomor_lambung']) ? '<h5>Nomor Lambung: '. $post['nomor_lambung'].'</h5>' : ''); ?>
    </div>
    
    <div class="card-booking b-radius-none">
        <div class="x_title grey-dark mb-0 b-radius-none">
            <h5>KOMPOSISI KURSI ARMADA</h5>
            <p>Untuk membatalkan, klik kembali kursi yang dipilih</p>
            <div class="clearfix"></div>
        </div>
        <div class="p-5">
            <div class="layout-deck">
                <div class="header-deck">
                    <span>DECK 1</span>
                    Harga: Rp. <?= ($post['tarif'] > 0 ? Helper::getInstance()->getRupiah($post['tarif']) : $post['tarif']); ?>
                </div>
                <div class="body-deck">
                    <table class="table border-none text-center table-deck">
                        <tbody>
                            <?php 
                                foreach ($layoutDeck as $key => $deck) {
                                    if ($key == 'steer') {
                                        ?>
                                        <tr>
                                            <?php
                                                foreach ($deck as $k => $steer) {
                                                    if (in_array($k, ['item_image']) && !is_numeric($k)) {
                                                        echo '<td style="width:22.5%"><img src="'. $steer  .'" class="img-icon" alt="steer"/></td>';
                                                    } elseif (in_array($k, ['separator']) && !is_numeric($k)) {
                                                        echo '<td style="width:10%;">'. $steer .'</td>';
                                                    } else if (!empty($k) && $k=='TL'){
                                                        $indexed = (isset($seatBooked[$k]['id']) ? $seatBooked[$k]['id'] : '');
                                                        $subIndexed = (isset($seatBooked[$k][$indexed]) ? json_encode($seatBooked[$k][$indexed]) : '' );
                                                        $seatValue = $k;
                                                        echo '<td style="width:22.5%">
                                                            <div class="checkbox">
                                                            <label class="checkbox-wrapper">
                                                                '. CHtml::checkBox('SeatBus[seat][99]', (isset($post['seat_bus'][99]['value'])), ['class' => 'none checkSeat', 'style' => 'display: contents;', 'value'=>$k, 'data-index' => 99, 'data-tarif'=>$post['tarif'], 'data-tlActive'=>$post['seatTl_active'], 'disabled' => isset($seatBooked[$k]) ] )
                                                                .' <span class="checkmark '. (isset($seatBooked[$k]) ? 'booked' : '') .'" 
                                                                data-passengerId="'.$indexed.'"
                                                                data-passengerData=\''. $subIndexed .'\'
                                                                data-seat="'. $seatValue .'"
                                                                data-startdate="'.$post['startdate'].'"
                                                                data-penjadwalan_id="'.$post['penjadwalan_id'].'"
                                                                data-tujuan="'.($modelTrip->daerah_tujuan . '<br/>' . $modelTrip->destination_kota_nama).'"
                                                                ></span> 
                                                                <span class="text-checkmark" 
                                                                data-passengerId="'.$indexed.'"
                                                                data-passengerData=\''. $subIndexed .'\'
                                                                data-seat="'. $seatValue .'"
                                                                data-startdate="'.$post['startdate'].'"
                                                                data-penjadwalan_id="'.$post['penjadwalan_id'].'"
                                                                data-tujuan="'.($modelTrip->daerah_tujuan . '<br/>' . $modelTrip->destination_kota_nama).'"
                                                                >'. $k .'</span>
                                                            </label>
                                                            </div>
                                                        </td>';
                                                    } else {
                                                        echo '<td style="width:22.5%">'. $steer .'</td>';
                                                    }
                                                    
                                                }
                                            ?>
                                        </tr>
                                        <?php
                                    } else if (in_array($key, ['seat','seat_left'])) {
                                        foreach ($deck as $seat) {
                                            echo '<tr>';
                                                foreach ($seat as $i => $seat_) {
                                                    if (!empty($seat_)):
                                                        $indexed = (isset($seatBooked[$seat_]['id']) ? $seatBooked[$seat_]['id'] : '');
                                                        $subIndexed = (isset($seatBooked[$seat_][$indexed]) ? json_encode($seatBooked[$seat_][$indexed]) : '' );
                                                        $seatValue = $seat_;
                                                    echo '<td>
                                                        <div class="checkbox">
                                                            <label class="checkbox-wrapper">
                                                                '. CHtml::checkBox('SeatBus[seat]['. $i .']', (isset($post['seat_bus'][$i]['value'])), ['class' => 'none checkSeat', 'style' => 'display: contents;', 'value'=>$seat_, 'data-tarif'=>$post['tarif'], 'data-tlActive'=>$post['seatTl_active'],'data-index' => $i, 'disabled' => isset($seatBooked[$seat_]) ] )
                                                                .' <span class="checkmark '. (isset($seatBooked[$seat_]) ? 'booked' : '') .'" 
                                                                data-passengerId="'.$indexed.'"
                                                                data-passengerData=\''. $subIndexed .'\'
                                                                data-seat="'. $seatValue .'"
                                                                data-startdate="'.$post['startdate'].'"
                                                                data-penjadwalan_id="'.$post['penjadwalan_id'].'"
                                                                data-tujuan="'.($modelTrip->daerah_tujuan . '<br/>' . $modelTrip->destination_kota_nama).'"
                                                                ></span> 
                                                                <span class="text-checkmark" 
                                                                data-passengerId="'.$indexed.'"
                                                                data-passengerData=\''. $subIndexed .'\'
                                                                data-seat="'. $seatValue .'"
                                                                data-startdate="'.$post['startdate'].'"
                                                                data-penjadwalan_id="'.$post['penjadwalan_id'].'"
                                                                data-tujuan="'.($modelTrip->daerah_tujuan . '<br/>' . $modelTrip->destination_kota_nama).'"
                                                                >'. $seat_ .'</span>
                                                            </label>
                                                        </div>
                                                        </td>';
                                                    else:
                                                        echo '<td></td>';
                                                    endif;
                                                }
                                            echo '</tr>';
                                        }
                                    } else if (in_array($key, ['toilet','pintu'])) {
                                        foreach ($deck as $seat) {
                                            echo '<tr>';
                                                foreach ($seat as $i => $seat_) {
                                                    if (!empty($seat_)):
                                                        if (!is_numeric($i)) {
                                                            echo '<td><img src="'. $seat_  .'" class="img-icon" alt="toilet" '. ($i == 'item_image_2' ? 'style="width:60%;margin-top: 10px;"' : '') .'/></td>';
                                                        } else {
                                                            $indexed = (isset($seatBooked[$seat_]['id']) ? $seatBooked[$seat_]['id'] : '');
                                                            $subIndexed = (isset($seatBooked[$seat_][$indexed]) ? json_encode($seatBooked[$seat_][$indexed]) : '' );
                                                            $seatValue = $seat_;
                                                            echo '<td>
                                                            <div class="checkbox">
                                                                <label class="checkbox-wrapper">
                                                                '. CHtml::checkBox('SeatBus[seat]['. $i .']', (isset($post['seat_bus'][$i]['value'])), ['class' => 'none checkSeat', 'style' => 'display: contents;', 'value'=>$seat_, 'data-tarif'=>$post['tarif'],'data-tlActive'=>$post['seatTl_active'],'data-index' => $i, 'disabled' => isset($seatBooked[$seat_]) ] )
                                                                .' <span class="checkmark '. (isset($seatBooked[$seat_]) ? 'booked' : '') .'" 
                                                                data-passengerId="'.$indexed.'"
                                                                data-passengerData=\''. $subIndexed .'\'
                                                                data-seat="'. $seatValue .'"
                                                                data-startdate="'.$post['startdate'].'"
                                                                data-penjadwalan_id="'.$post['penjadwalan_id'].'"
                                                                data-tujuan="'.($modelTrip->daerah_tujuan . '<br/>' . $modelTrip->destination_kota_nama).'"
                                                                ></span> 
                                                                <span class="text-checkmark" 
                                                                data-passengerId="'.$indexed.'"
                                                                data-passengerData=\''. $subIndexed .'\'
                                                                data-seat="'. $seatValue .'"
                                                                data-startdate="'.$post['startdate'].'"
                                                                data-penjadwalan_id="'.$post['penjadwalan_id'].'"
                                                                data-tujuan="'.($modelTrip->daerah_tujuan . '<br/>' . $modelTrip->destination_kota_nama).'"
                                                                >'. $seat_ .'</span>
                                                            </label>
                                                            </div>
                                                            </td>';
                                                        }
                                                    else:
                                                        if ($key == 'pintu') {
                                                            echo '<td colspan="2" class="door">
                                                            Pintu Belakang
                                                            </td>';
                                                            echo '<td></td>';
                                                        } else {
                                                            echo '<td></td>';
                                                        }
                                                    endif;
                                                }
                                            echo '</tr>';
                                        }
                                    } else if (in_array($key, ['seat2','seat_full'])) {
                                        foreach ($deck as $seat) {
                                            echo '<tr>';
                                                foreach ($seat as $i => $seat_) {
                                                    if (!empty($seat_)):
                                                        $indexed = (isset($seatBooked[$seat_]['id']) ? $seatBooked[$seat_]['id'] : '');
                                                        $subIndexed = (isset($seatBooked[$seat_][$indexed]) ? json_encode($seatBooked[$seat_][$indexed]) : '' );
                                                        $seatValue = $seat_;
                                                    echo '<td style="width:22.5%">
                                                        <div class="checkbox">
                                                            <label class="checkbox-wrapper">
                                                                '. CHtml::checkBox('SeatBus[seat]['. $i .']', (isset($post['seat_bus'][$i]['value'])), ['class' => 'none checkSeat', 'style' => 'display: contents;', 'value'=>$seat_,'data-tarif'=>$post['tarif'], 'data-tlActive'=>$post['seatTl_active'],'data-index' => $i, 'disabled' => isset($seatBooked[$seat_]) ] )
                                                                .' <span class="checkmark '. (isset($seatBooked[$seat_]) ? 'booked' : '') .'" 
                                                                data-passengerId="'.$indexed.'"
                                                                data-passengerData=\''. $subIndexed .'\'
                                                                data-seat="'. $seatValue .'"
                                                                data-startdate="'.$post['startdate'].'"
                                                                data-penjadwalan_id="'.$post['penjadwalan_id'].'"
                                                                data-tujuan="'.($modelTrip->daerah_tujuan . '<br/>' . $modelTrip->destination_kota_nama).'"
                                                                ></span> 
                                                                <span class="text-checkmark" 
                                                                data-passengerId="'.$indexed.'"
                                                                data-passengerData=\''. $subIndexed .'\'
                                                                data-seat="'. $seatValue .'"
                                                                data-startdate="'.$post['startdate'].'"
                                                                data-penjadwalan_id="'.$post['penjadwalan_id'].'"
                                                                data-tujuan="'.($modelTrip->daerah_tujuan . '<br/>' . $modelTrip->destination_kota_nama).'"
                                                                >'. $seat_ .'</span>
                                                            </label>
                                                        </div>
                                                        </td>';
                                                    else:
                                                        echo '<td></td>';
                                                    endif;
                                                }
                                            echo '</tr>';
                                        }
                                    }
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
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

<?php if (in_array(Yii::app()->user->role, ['Cabin Crew'])): ?>

    <div class="row height-75 d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Titik Terdekat</label>
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

    <div class="layout-form-deck" id="layoutPenumpang">
        <h5>DATA PENUMPANG</h5>
        <p>Masukan data penumpang (Nama dan No Telp) sebagai data manifest</p>

        <?= CHtml::hiddenField('BookingTrip[total_harga]', ''); ?>
        <?= CHtml::hiddenField('BookingTrip[route_id]', $modelTripAgen->route_id); ?>
        <?= CHtml::hiddenField('BookingTrip[armada_ke]', $post['armada_ke']); ?>
        <?= CHtml::hiddenField('BookingTrip[startdate]', $post['startdate']); ?>
        <?= CHtml::hiddenField('BookingTrip[penjadwalan_id]', $post['penjadwalan_id']); ?>
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
                                    <?= CHtml::textField('FormSeat[name][]', '', ['placeholder'=>'Penumpang' ,'autocomplete'=>'off', 'required' => true]); ?>
                                </td>
                                <td>
                                    <?= CHtml::textField('FormSeat[telp][]', '', ['placeholder'=>'Telepon' ,'autocomplete'=>'off', 'required' => true]); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Kursi</th>
                                <th>Gender</th>
                            </tr>
                            <tr>
                                <td>
                                    <?= CHtml::textField('FormSeat[kursi][]', '', ['readonly'=>true, 'class'=>'seatForm']); ?>
                                </td>
                                <td>
                                    <?= CHtml::dropDownList('FormSeat[gender][]', '', [
                                        'L' => 'Pria',
                                        'P' => 'Wanita'
                                    ]); ?>
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
            <button class="float-btn btn-submit" id="beliTiket">
                Rp &nbsp;<span id="total_price">0</span> &nbsp;| Beli Tiket
            </button>
        </div>
    </div>
    </div>

    <?php $this->endWidget(); ?>

</div>

<script>
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
</script>