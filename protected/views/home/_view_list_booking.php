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
$subTripSelected = isset($data['data']['subTripSelected']) ? (object)$data['data']['subTripSelected'] : [];
// Helper::getInstance()->dump($data['data']);
?>
<div class="col-sm-12">

    <div class="x_title">
        <h5><i class="fa fa-minus-circle"></i> <b>Perhatian:</b> Mohon perhatikan tanggal keberangkatan, Kota keberangkatan dan tujuan!</h5>
        <div class="clearfix"></div>
    </div>
</div>

<div class="card-booking card-book border-none">
    <div class="x_title grey-dark mb-0">
        <h4><?= $post['group']. ' - ' . $post['kelas']; ?></h4>
        <h4><?= $modelTrip->boarding_kota_nama . ' - ' . $modelTrip->destination_kota_nama . ', ' . $this->getDay($post['startdate']) . ', ' . $this->IndonesiaTgl($post['startdate']) . ' ' . (!$isCrew ? $post['jam'] : ''); ?></h4>
        <h4><?= $subTripSelected->kota_asal . ' - ' . $subTripSelected->kota_tujuan ?></h4>
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
                                                                .' <span class="checkmark '. (isset($seatBooked[$k]['jk']) ? $seatBooked[$k]['jk'] : '') .'" 
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
                                                                '. CHtml::checkBox('SeatBus[seat]['. $i .']', (isset($post['seat_bus'][$i]['value'])), ['class' => 'none checkSeat', 'style' => 'display: contents;', 'value'=>$seat_, 'data-tarif'=>$post['tarif'], 'data-tlActive'=>$post['seatTl_active'],'data-index' => $seat_, 'disabled' => isset($seatBooked[$seat_]) ] )
                                                                .' <span class="checkmark '. (isset($seatBooked[$seat_]['jk']) ? $seatBooked[$seat_]['jk'] : '') .'" 
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
                                                                '. CHtml::checkBox('SeatBus[seat]['. $i .']', (isset($post['seat_bus'][$i]['value'])), ['class' => 'none checkSeat', 'style' => 'display: contents;', 'value'=>$seat_, 'data-tarif'=>$post['tarif'],'data-tlActive'=>$post['seatTl_active'],'data-index' => $seat_, 'disabled' => isset($seatBooked[$seat_]) ] )
                                                                .' <span class="checkmark '. (isset($seatBooked[$seat_]['jk']) ? $seatBooked[$seat_]['jk'] : '') .'" 
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
                                                                '. CHtml::checkBox('SeatBus[seat]['. $i .']', (isset($post['seat_bus'][$i]['value'])), ['class' => 'none checkSeat', 'style' => 'display: contents;', 'value'=>$seat_,'data-tarif'=>$post['tarif'], 'data-tlActive'=>$post['seatTl_active'],'data-index' => $seat_, 'disabled' => isset($seatBooked[$seat_]) ] )
                                                                .' <span class="checkmark '. (isset($seatBooked[$seat_]['jk']) ? $seatBooked[$seat_]['jk'] : '') .'" 
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
</div>

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
            <label>( Keberangkatan Ke <?= isset($listTerdekat['armada_ke']) ? $listTerdekat['armada_ke'] : '-' ?> )</label>
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