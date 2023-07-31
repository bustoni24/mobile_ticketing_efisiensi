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
      <div class="row height-75 d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Pilih Tanggal Penugasan</label>
              <?= CHtml::textField('startdate',(isset($_GET['startdate']) ? $_GET['startdate'] : date('Y-m-d')),['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off']); ?>
        </div>
      </div>

      <div class="col-sm-12 pl-0 mb-0">
            <button type="button" class="btn btn-warning pull-right" id="filter">Cari</button>
        </div>

        <div class="col-sm-12 pl-0 mb-0 text-center">
        <?php $this->endWidget(); ?>
            <?php
            if (isset($post['data']['penjadwalan_id'])) :
                $qr_data = $this->encode(json_encode($post['data']));
                try{
                    $qr_widget = $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
                        'data' => $qr_data,
                        'filename' => Yii::app()->user->nama.".png",
                        'subfolderVar' => false,
                        'matrixPointSize' => 8,
                        'displayImage'=>true,
                        'errorCorrectionLevel'=>'L',
                    ));
                }
                catch (Exception $e){
                        echo json_encode($e->getMessage());// error here
                }
                ?>
                <h5>Nama: <?= Yii::app()->user->nama; ?></h5>
                <h5>Level Akses: <?= Yii::app()->user->role; ?></h5>
                <?php
                else :
                    echo '<h5>Tidak ditemukan penugasan</h5>';
                endif;
            ?>
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
        location.href="<?= Constant::baseUrl() . '/home/index?startdate=' ?>" + $('#startdate').val();
    });
</script>