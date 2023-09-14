<div class="row mt-20">

    <div class="x_title">
        <h3>Selamat Datang, <?= Yii::app()->user->nama; ?></h3>
        <div class="clearfix"></div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <h4>Silahkan input tanggal penugasan</h4>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'pembelian-tiket-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.,
            'method'=>'get',
            'enableAjaxValidation'=>false,
        )); 
        ?>
      <div class="row d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12 mb-0">
            <label>Pilih Tanggal Penugasan</label>
              <?= CHtml::textField('startdate',(isset($_GET['startdate']) ? $_GET['startdate'] : date('Y-m-d')),['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off']); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Pilih RIT</label>
              <?= CHtml::dropDownList('rit', isset($post['data']['rit']) && !empty($post['data']['rit']) ? $post['data']['rit'] : (isset($_GET['rit']) ? $_GET['rit'] : 1), [
                1 => 'RIT 1',
                2 => 'RIT 2',
              ],['class' => 'form-control']); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-warning pull-right" id="filter">Cari</button>
        </div>
      </div>

      <?php $this->endWidget(); ?>
        
      <div class="row mt-10">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <?php
                if (isset($post['data']['penjadwalan_id'])) :
                    $qr_data = $this->encode(json_encode($post['data']));
                    try{
                        $qr_widget = $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
                            'data' => $qr_data,
                            'filename' => Yii::app()->user->nama."_".$post['data']['rit'].".png",
                            'subfolderVar' => false,
                            'matrixPointSize' => 3,
                            'displayImage'=>true,
                            'errorCorrectionLevel'=>'L',
                        ));
                    }
                    catch (Exception $e){
                            echo json_encode($e->getMessage());// error here
                    }

                    // Helper::getInstance()->dump($post);
                    ?>
                    <h5>Nama: <?= Yii::app()->user->nama; ?></h5>
                    <h5>Level Akses: <?= Yii::app()->user->role; ?></h5>
                    <h5>Trip: <?= $post['data']['boarding_nama'] . ' - ' . $post['data']['destination_nama'] ?></h5>

                    <?php
                    else :
                        echo '<h5>Tidak ditemukan penugasan</h5>';
                    endif;
                ?>
            </div>
      </div>
    </div>
</div>

<script>
    $('#startdate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		header: true
	});

    $('#filter').on('click', function(){
        location.href="<?= Constant::baseUrl() . '/home/index?startdate=' ?>" + $('#startdate').val() + "&rit=" + $('#rit').val();
    });

    var latitude = null;
    var longitude = null;
    var penjadwalan_id = "<?= isset($post['data']['penjadwalan_id']) ? $post['data']['penjadwalan_id'] : null ?>";
    document.addEventListener("DOMContentLoaded", function() {
      getLatLong();
    });

    function getLatLong()
      {
          if ("geolocation" in navigator) {
                  navigator.geolocation.getCurrentPosition(
                      function(position) {
                          latitude = position.coords.latitude;
                          longitude = position.coords.longitude;
                          // alert('latitude: ' + latitude + ', longitude: ' + longitude);
                          saveLatlong(latitude, longitude);
                      },
                      function(error) {
                          switch (error.code) {
                              case error.PERMISSION_DENIED:
                                  console.log("Izin akses lokasi ditolak oleh pengguna.");
                                  break;
                              case error.POSITION_UNAVAILABLE:
                                  console.log("Informasi lokasi tidak tersedia.");
                                  break;
                              case error.TIMEOUT:
                                  console.log("Permintaan waktu untuk akses lokasi habis.");
                                  break;
                              case error.UNKNOWN_ERROR:
                                  console.log("Terjadi kesalahan yang tidak diketahui.");
                                  break;
                          }
                      }
                  );
              } else {
                  console.log("Geolocation tidak didukung oleh browser Anda.");
              }
      }

    function saveLatlong(latitude, longitude)
    {
      if (penjadwalan_id !== null) {
        $.ajax({
              type : "POST",
              url : "<?= Constant::baseUrl() . '/booking/saveLatlong' ?>",
              dataType : "JSON",
              data: {penjadwalan_id:penjadwalan_id, latitude:latitude, longitude:longitude},
              success : function(data) {
                console.log(data);
              },
              error : function(data){
                  if (typeof(data.responseText) !== "undefined")
                      console.log(data.responseText);
              }
          });
      }
    }
</script>