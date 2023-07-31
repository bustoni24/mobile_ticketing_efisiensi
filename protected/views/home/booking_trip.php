<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php 
            if (!empty($data)):
        ?>
            <div class="card-header">
                <h5><?= $data['header']; ?></h5>
                <h5><?= $data['trip']; ?></h5>
                <p><?= $data['via_info']; ?></p>
            </div>
            <div class="card-header">
                <div class="input-group">
                    <?= CHtml::textField("Boarding[search]", "", ['class'=>'form-control','placeholder'=>'Boarding', 'data-tripId' => $id, 'data-group' => (isset($post['group']) ? $post['group'] : ''), 'data-kelas' => (isset($post['kelas']) ? $post['kelas'] : ''), 'data-groupId' => (isset($post['groupId']) ? $post['groupId'] : ''), 'data-armadaId' => (isset($post['armadaId']) ? $post['armadaId'] : '')]) ?>
                    <span class="input-group-btn">
                    <button class="btn btn-secondary h-100x" type="button">Cari</button>
                    </span>
                </div>
            </div>

            <div id='listDataTrip'>
            <?php
            foreach ($data['data_agen'] as $agen) {
            ?>
            <div class="card-booking card-agen" data-trip_id="<?= $id ?>" data-titik_id="<?= $agen['titik_keberangkatan_id'] ?>">
                <div class="x_title grey-dark mb-0 border-all">
                    <table class="w-100">
                        <tr class="va-baseline">
                            <td style="width: 400px;">
                                <h5 class="mt-5 mb-5"><?= $agen['titik_keberangkatan'] ?></h5>
                                <p><?= $agen['alamat'] ?></p>
                            </td>
                            <td style="width: 80px;" class="text-center"><h5 class="mt-5 mb-5"><?= $agen['jml_trip'] ?></h5></td>
                        </tr>
                    </table>          
                    <div class="clearfix"></div>
                </div>
            </div>
            <div id="content-agen<?= $agen['titik_keberangkatan_id'] ?>"></div>
            <?php } ?>
        </div>

        <?php else:
        echo '<div class="card-header"><h5>Data Tidak Valid</h5></div>';
        endif;
        ?>

    </div>
</div>

<script>
    $('#Boarding_search').on('keyup', function(){
        var trip_id = $(this).attr('data-tripId');
        var keyword = $(this).val();
        var element = $('#listDataTrip');

        var data = {trip_id:trip_id,keyword:keyword};
        $.ajax({
            type : "POST",
            url : "<?= Constant::baseUrl() . '/home/ajaxBookingTrip' ?>",
            dataType : "JSON",
            data: data,
            success : function(data) {
                if (typeof data.html !== 'undefined' && data.html !== "") {
                element.html(data.html);
                } else {
                console.log(data);
                }
            },
            error : function(data){
                if (typeof(data.responseText) !== "undefined")
                    console.log(data.responseText);
            }
        });
    });

    $("body").on("click", ".card-agen", function(e){
        e.preventDefault();

        var trip_id = $(this).attr('data-trip_id');
        var titik_id = $(this).attr('data-titik_id');
        var element = $("#content-agen"+titik_id);
        var data = {trip_id:trip_id,titik_id:titik_id};
        // console.log(data);
        $.ajax({
            type : "POST",
            url : "<?= Constant::baseUrl() . '/home/ajaxBookingTrip' ?>",
            dataType : "JSON",
            data: data,
            success : function(data) {
                if (typeof data.html !== 'undefined' && data.html !== "") {
                    if (element.find('div').length === 0) {
                        element.html(data.html).slideDown();
                    } else {
                        element.html('').slideUp();
                    }
                } else {
                    element.html('').slideUp()
                console.log(data);
                }
            },
            error : function(data){
                if (typeof(data.responseText) !== "undefined")
                    console.log(data.responseText);
            }
        });
    });

    $("body").on("click", ".card-trip", function(e){
        e.preventDefault();

        var route_id = $(this).attr('data-route_id');
        var startdate = "<?= $_GET['startdate'] ?>";
        var armada_ke = $(this).attr('data-armada_ke');

        //redirect to bookint trip
        $.form("<?= Constant::baseUrl() . '/booking/routeDetail?id='; ?>"+route_id+"_"+startdate+"_"+armada_ke, {route_id:route_id}).submit();
    });
</script>