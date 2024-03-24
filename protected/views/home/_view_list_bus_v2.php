<?php if (isset($data['route_id'])): ?>
<div class="card-booking card-book" data-route_id="<?= $data['route_id']; ?>" data-armada_ke="<?= $data['armada_ke'] ?>" data-penjadwalan_id="<?= (isset($data['penjadwalan_id']) ? $data['penjadwalan_id'] : '') ?>" data-label_trip="<?= (isset($data['booking_trip_label']) ? $data['booking_trip_label'] : $data['trip_label']) ?>" data-agen_id_asal="<?= $data['agen_id_asal'] ?>" data-agen_id_tujuan="<?= $data['agen_id_tujuan'] ?>">
    <div class="x_title grey-dark mb-0 d-flex" style="width: 100%;justify-content: space-between;">
        <h5 class="mt-5 mb-5 d-flex"><?= $data['kelas_bus']; ?> <ul style="padding-left: 20px;margin-bottom: 0;">
	<li><span class="red" style="font-size: 11px;"><?= $data['seats_left']; ?> Seats Left</span></li>
    </ul></h5>
    <h5 class="mb-0"><span class="highlight"><?= $data['no_lambung']; ?></span></h5>
    </div>

    <table class="table border-none mb-0 content-card">
        <tr>
            <td style="width: 70%;">
            <div style="display: flex;">
                <?= ($data['jam'] . ' - ' . $data['estimasi']) ?>
                <ul style="padding-left: 20px;margin-bottom: 0;">
                <li><?= $data['lama_perjalanan'] ?></li>
                </ul>
            </div>
            
            </td>
            <td style="text-align: right;"><h5 class="mt-0 mb-0" style="font-size: 16px;">Rp <?= Helper::getInstance()->getRupiah($data['price']); ?></h5></td>
        </tr>
        <tr>
            <td colspan="2">
            <div style="display: flex;">
                <?= (isset($data['transit_city_name']) && !empty($data['transit_city_name']) ? ' <span class="text-bold">[TRANSIT '.$data['transit_city_name'].']</span>' : '') ?>
            </div>
            </td>
        </tr>
        <tr>
            <td style="width: 70%;vertical-align: middle;">
            <div style="display: flex;">
                <h5 class="mt-0 mb-0" style="font-size: 13px;"><?= (isset($data['booking_trip_label']) ? $data['booking_trip_label'] : $data['trip_label']) ?></h5>
            </div>
            </td>
            <td style="text-align: right;"><button type="button" class="btn btn-warning" style="padding: 2px 10px;">BELI</button></td>
        </tr>
    </table>
    
</div>

<?php elseif (isset($data['message'])): ?>
    <div class="card-booking card-book">
    <div class="x_title grey-dark mb-0 d-flex" style="width: 100%;justify-content: space-between;">
        <h5 class="mt-5 mb-5 d-flex"><?= $data['message']; ?> </h5>
    </div>
    
</div>
<?php endif; ?>