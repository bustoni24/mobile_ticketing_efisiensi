<?php 
$post = isset($data['data']['post']['post']) ? $data['data']['post']['post'] : [];
$modelTrip = isset($data['data']['modelTrip']) ? (object)$data['data']['modelTrip'] : [];
$modelTripAgen = isset($data['data']['modelTripAgen']) ? (object)$data['data']['modelTripAgen'] : [];
$layoutDeck = isset($data['data']['layoutDeck']) ? $data['data']['layoutDeck'] : [];
$seatBooked = isset($data['data']['seatBooked']) ? $data['data']['seatBooked'] : [];
$subTripSelected = isset($data['data']['subTripSelected']) ? (object)$data['data']['subTripSelected'] : [];
// Helper::getInstance()->dump($data['data']);
$isCrew = in_array(Yii::app()->user->role, ['Cabin Crew','Checker']);
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