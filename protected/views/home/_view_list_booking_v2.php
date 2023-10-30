<?php 
$post = isset($data['data']['post']['post']) ? $data['data']['post']['post'] : [];
$routeId = isset($data['data']['post']['routeId']) ? $data['data']['post']['routeId'] : '';
$modelTrip = isset($data['data']['modelTrip']) ? (object)$data['data']['modelTrip'] : [];
$modelTripAgen = isset($data['data']['modelTripAgen']) ? (object)$data['data']['modelTripAgen'] : [];
$modelBookingExist = !empty($data['data']['modelBookingExist']) ? (object)$data['data']['modelBookingExist'] : [];
$layoutDeck = isset($data['data']['layoutDeck']) ? $data['data']['layoutDeck'] : [];
$seatBooked = isset($data['data']['seatBooked']) ? $data['data']['seatBooked'] : [];
$dataRawSeatBooked = isset($data['data']['dataRawSeatBooked']) ? $data['data']['dataRawSeatBooked'] : [];
$listTerdekat = isset($data['data']['listTitikTerdekat']) ? $data['data']['listTitikTerdekat'] : [];
$isCrew = in_array(Yii::app()->user->role, ['Cabin Crew','Checker']);
$isOnlyCrew = in_array(Yii::app()->user->role, ['Cabin Crew']);
$countSeatBooked = isset($data['data']['seatBooked']) ? count($data['data']['seatBooked']) : 0;
$subTripSelected = isset($data['data']['subTripSelected']) ? (object)$data['data']['subTripSelected'] : [];
$from_scanner = isset($data['data']['from_scanner']) ? $data['data']['from_scanner'] : false;
$data_origin = isset($data_origin) ? $data_origin : [];
$status_trip = isset($data['data']['post']['post']['status_trip']) ? $data['data']['post']['post']['status_trip'] : null;
$resumePassenger = isset($data['data']['resumePassenger']) ? $data['data']['resumePassenger'] : [];
$status_rit = isset($data['data']['post']['post']['status_rit']) ? $data['data']['post']['post']['status_rit'] : 0;
$trip_label = isset($data['data']['post']['post']['trip_label']) ? $data['data']['post']['post']['trip_label'] : null;
$agen_id_tujuan = isset($data['data']['subTripSelected']['agen_id_tujuan']) ? $data['data']['subTripSelected']['agen_id_tujuan'] : null;
$tujuan_text = isset($data['data']['subTripSelected']['tujuan_text']) ? $data['data']['subTripSelected']['tujuan_text'] : '';
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
        <h4 class="text-center mt-0"><?= $trip_label . (isset($post['nomor_lambung']) && !empty($post['nomor_lambung']) ? ' - ' . $post['nomor_lambung'] : ''); ?></h4>
        <h4><?= $post['group']. ' - ' . $post['kelas']; ?></h4>
        <h5><?= $subTripSelected->kota_asal . ' - ' . $subTripSelected->kota_tujuan . '<br/>' . $this->getDay($post['startdate']) . ', ' . $this->IndonesiaTgl($post['startdate']) ?></h5>
        <div class="clearfix"></div>
        <?php 
        if ($status_trip == Constant::STATUS_TRIP_CLOSE) {
            echo '<span class="red">(Pembelian Tiket telah ditutup karena Trip sudah berakhir)</span>';
        } else if (in_array($status_rit, [Constant::STATUS_RIT_SKIP, Constant::STATUS_RIT_CLOSE])) {
            echo '<span class="red">(Pembelian Tiket telah ditutup karena jadwal RIT sudah berakhir)</span>';
        }
        ?>
    </div>
    
    <div class="card-booking b-radius-none">
        <div class="x_title grey-dark mb-0 b-radius-none text-center">
            <h5>KOMPOSISI KURSI ARMADA</h5>
            <p>Untuk membatalkan, klik kembali kursi yang dipilih</p>
            <div class="clearfix"></div>
        </div>
        <div class="p-5">
            <div class="layout-deck">
                <div class="header-deck">
                    <span>DECK 1</span>
                    <p class="mb-0" style="font-weight: 700;font-size: 2rem;">Harga: Rp. <?= ($post['tarif'] > 0 ? Helper::getInstance()->getRupiah($post['tarif']) : $post['tarif']); ?></p>
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
        'enableAjaxValidation'=>false,
        'htmlOptions' => ['enctype'=>"multipart/form-data"]
    )); 
    ?>

<?php if (in_array(Yii::app()->user->role, ['Agen','Cabin Crew','Sub Agen']) && !$from_scanner): ?>

    <?php if (in_array(Yii::app()->user->role, ['Cabin Crew'])): ?>
    <div class="row height-75 d-relative none">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Titik Terdekat</label>
            <?= CHtml::hiddenField('BookingTrip[titik_id]', (isset($listTerdekat['titik_id']) ? $listTerdekat['titik_id'] : '')) ?>
            <?= CHtml::textField('BookingTrip[titik_keberangkatan]',(isset($listTerdekat['titik_keberangkatan']) ? $listTerdekat['titik_keberangkatan'] : ''),['placeholder' => 'Titik Terdekat', 'readonly' => isset($listTerdekat['titik_keberangkatan'])]); ?>
            <span><?= 'Alamat: ' . (isset($listTerdekat['alamat']) ? $listTerdekat['alamat'] : '') ?></span>
        </div>
    </div>

    <div class="row height-75 d-relative none">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Jam Keberangkatan Terdekat</label>
            <label>( Keberangkatan Ke <?= isset($listTerdekat['armada_ke']) ? $listTerdekat['armada_ke'] : '-' ?> )</label>
            <?= CHtml::textField('BookingTrip[jam_keberangkatan]',(isset($listTerdekat['jam']) ? $listTerdekat['jam'] : ''),['placeholder' => 'Jam Keberangkatan Terdekat', 'readonly' => isset($listTerdekat['jam'])]); ?>
        </div>
    </div>

    <div class="row height-75 d-relativ none">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= CHtml::textField('BookingTrip[daerah_titik_keberangkatan]',(isset($subTripSelected->kota_asal) ? $subTripSelected->kota_asal : ''),['autocomplete' => 'off', 'placeholder' => 'Ketik Titik Naik Keberangkatan']); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Form untuk agen dan crew -->
    <div class="row height-75 d-relative none">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <label>Titik Turun</label>
            <?= CHtml::dropDownList('BookingTrip[type_turun]', '', [
                'agen' => 'Titik Agen',
                'bebas' => 'Ketik Bebas',
            ], ['prompt'=>'Pilih Tipe Info Turun (pakai data titik agen atau ketik bebas']); ?>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 none" id="infoTurunSelect">
            <?= CHtml::dropDownList('BookingTrip[info_turun]','',[],['prompt' => 'Pilih Titik Turun','class'=>'form-control']); ?>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 none" id="infoTurunText">
            <?= CHtml::textField('BookingTrip[info_turun_text]',$tujuan_text,['autocomplete' => 'off', 'placeholder' => 'Ketik Titik Turun']); ?>
        </div>
    </div>

<?php endif; ?>

<?php if (in_array(Yii::app()->user->role, ['Agen', 'Cabin Crew', 'Sub Agen'])): ?>
    <div class="layout-form-deck" id="layoutPenumpang">
        <h5>DATA PENUMPANG</h5>
        <p>Masukan data penumpang (Nama dan No Telp) sebagai data manifest. Jika tidak input maka akan menggunakan nama agen / crew yang melakukan pembelian</p>

        <?= CHtml::hiddenField('BookingTrip[total_harga]', ''); ?>
        <?= CHtml::hiddenField('BookingTrip[label_trip]', $trip_label); ?>
        <?= CHtml::hiddenField('BookingTrip[route_id]', (isset($listTerdekat['route_id']) ? $listTerdekat['route_id'] : (isset($modelTripAgen->route_id) ? $modelTripAgen->route_id : ''))); ?>
        <?= CHtml::hiddenField('BookingTrip[armada_ke]',  isset($listTerdekat['armada_ke']) ? $listTerdekat['armada_ke'] : (isset($post['armada_ke']) ? $post['armada_ke'] : '')); ?>
        <?= CHtml::hiddenField('BookingTrip[startdate]', isset($post['startdate']) ? $post['startdate'] : ''); ?>
        <?= CHtml::hiddenField('BookingTrip[penjadwalan_id]', isset($post['penjadwalan_id']) ? $post['penjadwalan_id'] : ''); ?>
        <?= CHtml::hiddenField('BookingTrip[latitude]', (isset($data['data']['latitude']) ? $data['data']['latitude'] : '')) ?>
        <?= CHtml::hiddenField('BookingTrip[longitude]', (isset($data['data']['longitude']) ? $data['data']['longitude'] : '')) ?>
        <?= CHtml::hiddenField('BookingTrip[jarak]', (isset($listTerdekat['distance']) ? $listTerdekat['distance'] : '')); ?>

        <?php if ($from_scanner && isset($data_origin['list'])): 
        echo CHtml::hiddenField('BookingTrip[status]', (isset($data_origin['status']) && $data_origin['status'] == Constant::STATUS_PENUMPANG_NAIK ? 2 : 2));
            ?>
            <table class="table">
                <tbody id="table-form-passenger">
                <?php foreach ($data_origin['list'] as $list) {
                    ?>
                    <tr id="form-passenger0" class="form-passenger">
                        <td>
                            <table class="table border-none">
                                <tr>
                                    <th>Nama</th>
                                    <th>No Telp</th>
                                </tr>
                                <tr>
                                    <td>
                                        <?= CHtml::hiddenField('FormSeat[kode_booking][]', $list['kode_booking']) ?>
                                        <?= CHtml::textField('FormSeat[name][]', $list['nama'], ['placeholder'=>'Penumpang' ,'autocomplete'=>'off', 'class'=>'inputSeat', 'required' => true]); ?>
                                    </td>
                                    <td>
                                        <?= CHtml::textField('FormSeat[telp][]', $list['no_hp'], ['placeholder'=>'Telepon' ,'autocomplete'=>'off', 'class'=>'inputSeat', 'required' => true]); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kursi</th>
                                    <th>Gender</th>
                                </tr>
                                <tr>
                                    <td>
                                        <?= CHtml::textField('FormSeat[kursi][]', $list['no_kursi'], ['class'=>'inputSeat seatForm','required'=>true]); ?>
                                    </td>
                                    <td>
                                        <?= CHtml::dropDownList('FormSeat[gender][]', $list['jenis_kelamin'], [
                                            'L' => 'Pria',
                                            'P' => 'Wanita'
                                        ],['class'=>'inputSeat']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select name="FormSeat[status][]" id="statusPnp" class="form-control" required="required">
                                            <option value="">- Pilih Status -</option>
                                            <option <?= $list['status'] == Constant::STATUS_PENUMPANG_NAIK ? 'selected="selected"' : '' ?> value="<?= Constant::STATUS_PENUMPANG_NAIK ?>">Naik</option>
                                            <option <?= $list['status'] == Constant::STATUS_PENUMPANG_TURUN ? 'selected="selected"' : '' ?> value="<?= Constant::STATUS_PENUMPANG_TURUN ?>">Turun</option>
                                            <option <?= $list['status'] == Constant::STATUS_PENUMPANG_HANGUS ? 'selected="selected"' : '' ?> value="<?= Constant::STATUS_PENUMPANG_HANGUS ?>">Hangus</option>
                                        </select>
                                    </td>
                                </tr>
                                <?php if (in_array(Yii::app()->user->role, ['Cabin Crew'])): ?>
                                    <tr>
                                        <th>Opsi Pengantaran</th>
                                        <th>Daerah Pengantaran</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?= CHtml::dropDownList("FormSeat[opsi_pengantaran][]", $list['opsi_pengantaran'], [
                                                    Constant::PENGANTARAN_TIDAK => ucwords(Constant::PENGANTARAN_TIDAK),
                                                    Constant::PENGANTARAN_YA => ucwords(Constant::PENGANTARAN_YA)
                                                ], ['class'=>'inputSeat opsi_pengantaran']); 
                                            ?>
                                        </td>
                                        <td>
                                            <?= CHtml::textField("FormSeat[daerah_pengantaran][]", $list['daerah_pengantaran'], ['class'=>'inputSeat opsi_pengantaran_form ' . ($list['opsi_pengantaran'] == 'ya' ? '' : 'none')]); ?>
                                        </td>
                                    </tr>
                                    <tr class="opsi_pengantaran_form <?= ($list['opsi_pengantaran'] == 'ya' ? '' : 'none') ?>">
                                        <th>Zona Pengantaran</th>
                                        <th></th>
                                    </tr>
                                    <tr class="opsi_pengantaran_form <?= ($list['opsi_pengantaran'] == 'ya' ? '' : 'none') ?>">
                                        <td colspan="2">
                                        <?= CHtml::dropDownList('FormSeat[zona_pengantaran][]', $list['zona_pengantaran'], Helper::getInstance()->getZonaPengantaran(),['class'=>'inputSeat','prompt'=>'Pilih Zona Pengantaran']); ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table">
                <tbody id="table-form-passenger">
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" id="allCheck"/>
                                Samakan semua
                            </label>
                        </td>
                    </tr>
                    <tr id="form-passenger0" class="form-passenger">
                        <td>
                            <table class="table border-none">
                                <tr>
                                    <th>Nama</th>
                                    <th>No Telp</th>
                                </tr>
                                <tr>
                                    <td>
                                        <?= CHtml::textField('FormSeat[name][]', '', ['placeholder'=>'Penumpang' ,'autocomplete'=>'off', 'class'=>'inputSeat namaPenumpang', 'data-name'=>'nama', 'required' => true]); ?>
                                    </td>
                                    <td>
                                        <?= CHtml::numberField('FormSeat[telp][]', '', ['placeholder'=>'Telepon' ,'autocomplete'=>'off', 'class'=>'inputSeat teleponPenumpang', 'data-name'=>'no_hp' ,'required' => true]); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kursi</th>
                                    <th>Gender</th>
                                </tr>
                                <tr>
                                    <td>
                                        <?= CHtml::textField('FormSeat[kursi][]', '', ['readonly'=>true, 'class'=>'inputSeat seatForm kursiPenumpang', 'data-name'=>'kursi','required'=>true]); ?>
                                    </td>
                                    <td>
                                        <?= CHtml::dropDownList('FormSeat[gender][]', '', [
                                            'L' => 'Pria',
                                            'P' => 'Wanita'
                                        ],['class'=>'inputSeat genderPenumpang', 'data-name' => 'gender']); ?>
                                    </td>
                                </tr>
                                <?php if (in_array(Yii::app()->user->role, ['Cabin Crew'])): ?>
                                    <tr>
                                        <th>Opsi Pengantaran</th>
                                        <th>Daerah Pengantaran</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?= CHtml::dropDownList("FormSeat[opsi_pengantaran][]", '', [
                                                    Constant::PENGANTARAN_TIDAK => ucwords(Constant::PENGANTARAN_TIDAK),
                                                    Constant::PENGANTARAN_YA => ucwords(Constant::PENGANTARAN_YA)
                                                ], ['class'=>'inputSeat opsi_pengantaran']); 
                                            ?>
                                        </td>
                                        <td>
                                            <?= CHtml::textField("FormSeat[daerah_pengantaran][]", '', ['class'=>'inputSeat opsi_pengantaran_form none']); ?>
                                        </td>
                                    </tr>
                                    <tr class="opsi_pengantaran_form none">
                                        <th>Zona Pengantaran</th>
                                        <th></th>
                                    </tr>
                                    <tr class="opsi_pengantaran_form none">
                                        <td colspan="2">
                                        <?= CHtml::dropDownList('FormSeat[zona_pengantaran][]', '', Helper::getInstance()->getZonaPengantaran(),['class'=>'inputSeat','prompt'=>'Pilih Zona Pengantaran']); ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
            <?php if (in_array(Yii::app()->user->role, ['Cabin Crew'])): ?>
            <table class="table">
                <tbody>
                    <tr>
                        <td width="40%">
                        <div class="checkbox">
                            <label>
                            <?= CHtml::checkBox('BookingTrip[extra_bagasi]', (isset($data_origin['extra_bagasi']) ? $data_origin['extra_bagasi'] : false), ['class' => 'extra_bagasi']); ?> Extra Bagasi
                            </label>
                        </div>
                        </td>
                        <td>
                        <div class="row">
                            <label class="mt-0">Nominal Bagasi</label>
                            <?= CHtml::textField('BookingTrip[nominal_bagasi]', (isset($data_origin['nominal_bagasi']) && $data_origin['nominal_bagasi'] > 0 ? Helper::getInstance()->getRupiah($data_origin['nominal_bagasi']) : ''),['class'=>'form-control number nominal_bagasi', 'readonly' => true]); ?>
                        </div>
                        </td>
                    </tr>
                    <tr class="<?= $from_scanner ? 'none' : '' ?>">
                        <td>
                            <div class="row">
                                <label class="mt-0">Tipe Pembayaran</label>
                                <?= CHtml::dropDownList('BookingTrip[tipe_pembayaran]', '', [
                                    Constant::TIPE_PEMBAYARAN_TUNAI => ucwords(Constant::TIPE_PEMBAYARAN_TUNAI),
                                    Constant::TIPE_PEMBAYARAN_TRANSFER => ucwords(Constant::TIPE_PEMBAYARAN_TRANSFER)
                                ],['class'=>'form-control']); ?>
                            </div>
                        </td>
                        <td>
                            <div class="row none" id="formBuktiBayar">
                                <label class="mt-0">Bukti Pembayaran</label>
                                <input type="file" name="BookingTrip[bukti_pembayaran]" id="BookingTrip_bukti_pembayaran" class="form-control" accept="image/png, image/gif, image/jpeg"/>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php endif; ?>
            
    </div>

    <div class="container-button-float <?= ($status_trip == Constant::STATUS_TRIP_CLOSE || in_array($status_rit, [Constant::STATUS_RIT_SKIP, Constant::STATUS_RIT_CLOSE])) ? 'none' : '' ?>">
    <div class="row-0">
        <div class="button-float">
            <input type="submit" name="submit" class="none" value="1" id="submitHide"/>
            <button type="button" class="float-btn btn-submit" id="beliTiket" onclick="return confirmSubmitTrip();">
                <?= (!$from_scanner ? 'Rp &nbsp;<span id="total_price">0</span> &nbsp;| Beli Tiket' : 'Konfirmasi') ?> 
            </button>
        </div>
    </div>
    </div>
    <?php endif; ?>

    <?php if (in_array(Yii::app()->user->role, ['Checker','Cabin Crew','Agen','Sub Agen'])): ?>
    <?php if (!empty($resumePassenger)): ?>
    <div class="row">
        <div class="col-sm-12">
            <?php if (isset($resumePassenger['naik'])): ?>
            <table class="table table-condensed">
                <tr>
                    <th colspan="3">Naik:</th>
                </tr>
                <?php 
                    foreach ($resumePassenger['naik'] as $naik => $row) {
                    ?>
                    <tr>
                        <td><?= $naik . ' ('. $row['jam'] .'): ' ?></td>
                        <td style="width: 150px;" class="text-right"><?= $row['jml'] . ' Seat(s)' ?></td>
                        <!-- <td <?= $isOnlyCrew ? 'style="width: 150px;"' : 'none' ?>><?= CHtml::dropDownList('Booking[ganti_status]', '', [
                            Constant::STATUS_PENUMPANG_NAIK => 'Naik',
                            Constant::STATUS_PENUMPANG_TURUN => 'Turun',
                            Constant::STATUS_PENUMPANG_HANGUS => 'Hangus'
                        ], ['prompt' => '-- Pilih --', 'data-ids' => $row['ids']]) ?></td> -->
                    </tr>
                    <?php
                    }
                ?>
            </table>
            <?php endif; ?>
        </div>
        <div class="col-sm-12">
            <?php if (isset($resumePassenger['drop_off'])): ?>
            <table class="table table-condensed">
                <tr>
                    <th colspan="3">Drop Off:</th>
                </tr>
                <?php 
                    foreach ($resumePassenger['drop_off'] as $drop_off => $row) {
                    ?>
                    <tr>
                        <td><?= $drop_off . ': ' ?></td>
                        <td style="width: 150px;" class="text-right"><?= $row['jml'] . ' Seat(s)' ?></td>
                        <!-- <td <?= $isOnlyCrew ? 'style="width: 150px;"' : 'none' ?>><?= CHtml::dropDownList('Booking[ganti_status]', '', [
                            Constant::STATUS_PENUMPANG_NAIK => 'Naik',
                            Constant::STATUS_PENUMPANG_TURUN => 'Turun',
                            Constant::STATUS_PENUMPANG_HANGUS => 'Hangus'
                        ], ['prompt' => '-- Pilih --', 'data-ids' => $row['ids']]) ?></td> -->
                    </tr>
                    <?php
                    }
                ?>
            </table>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="row" style="overflow: auto;">
        <table class="table table-bordered manifest-pnp">
            <tr>
                <th>Nomor Kursi</th>
                <th>Data Penumpang</th>
                <th>Status</th>
            </tr>
            <?php 
            // $dataSeatBoooked = isset($data['data']['seatBooked']) ? $data['data']['seatBooked'] : [];
            foreach ($dataRawSeatBooked as $dataSeat) {
                /* if (!isset($seatBooked['id']))
                    continue;

                $dataSeat = $seatBooked[$seatBooked['id']]; */
                ?>
                <tr>
                    <td><?= $dataSeat['no_kursi']; ?></td>
                    <td>
                    <?= 
                    "<label>".$dataSeat['nama']."</label>" . 
                    "<p>No. Tiket: ".$dataSeat['no_tiket']."</p>".
                    "<p>Kode Booking: ". $dataSeat['kode_booking'] ."</p>" . 
                    "<p>No. HP: ".$dataSeat['no_hp']."</p>" . 
                    "<p>Jenis Kelamin: ".($dataSeat['jenis_kelamin'] == 'L' ? 'Pria' : 'Wanita')."</p>" .
                    "<p>Naik: ".$dataSeat['titik_naik']."</p>" .
                    "<p>Turun: ".$dataSeat['titik_turun']."</p>".
                    "<p>Harga: ". Helper::getInstance()->getRupiah($dataSeat['harga'])."</p>"; 
                    ?>  
                    </td>
                    <td style="width: 150px;"><?php 
                    
                    if ($isOnlyCrew) {
                        if (in_array($dataSeat['status_id'], [Constant::STATUS_PENUMPANG_TURUN, Constant::STATUS_PENUMPANG_HANGUS])) {
                            echo $dataSeat['status'];
                        } else {
                            echo CHtml::dropDownList('Booking[change_status]['.$dataSeat['id'].']', $dataSeat['status_id'], [
                                // Constant::STATUS_PENUMPANG_BOOKED => 'Pemesanan Baru',
                                Constant::STATUS_PENUMPANG_NAIK => 'Naik',
                                Constant::STATUS_PENUMPANG_TURUN => 'Turun',
                                // Constant::STATUS_PENUMPANG_HANGUS => 'Hangus'
                            ], ['prompt' => 'Belum Dinaikkan', 'style'=>'padding:2px;', 'class'=>'changeStatusPnp', 'data-penjadwalan_id' => (isset($post['penjadwalan_id']) ? $post['penjadwalan_id'] : ''), 'data-id'=>$dataSeat['id']]);
                        }
                        
                    } else if (in_array(Yii::app()->user->role, ['Checker'])) {
                        echo CHtml::dropDownList('Booking[change_status]['.$dataSeat['id'].']', $dataSeat['status_id'], [
                            // Constant::STATUS_PENUMPANG_BOOKED => 'Pemesanan Baru',
                            Constant::STATUS_PENUMPANG_NAIK => 'Naik',
                            Constant::STATUS_PENUMPANG_TURUN => 'Turun',
                            Constant::STATUS_PENUMPANG_HANGUS => 'Hangus'
                        ], ['prompt' => 'Belum Dinaikkan', 'style'=>'padding:2px;', 'class'=>'changeStatusPnp', 'data-penjadwalan_id' => (isset($post['penjadwalan_id']) ? $post['penjadwalan_id'] : ''), 'data-id'=>$dataSeat['id'], 'data-startdate' => $post['startdate']]);
                    } else {
                        echo $dataSeat['status'];
                    }
                    
                    ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <?php if (in_array(Yii::app()->user->role, ['Checker'])): ?>
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

    <?php endif; ?>

    <?php $this->endWidget(); ?>
</div>