<div class="row mt-20">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'search-pengeluaran-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.,
                'method'=>'get',
                'enableAjaxValidation'=>false,
            )); 
            ?>
        <div class="row d-relative">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Pilih Tanggal Penugasan</label>
                <?= CHtml::textField('startdate',(isset($post['startdate']) ? $post['startdate'] : date('Y-m-d')),['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off']); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <button type="button" class="btn btn-warning pull-right" id="filter">Pilih</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="row">
<?php if (isset($post['data']['data']) && !empty($post['data']['data'])): ?>
    <div class="card-booking card-book border-none">
        <div class="x_title grey-dark mb-0">
            <h4><?php
            $displayRit = "";
            $displayLabel = "";
            $displayJmlPnp = "";
            $ritEnd = 2;
            $displayRitComplete = ['biaya_operasional' => 0];
            foreach ($post['data']['data'] as $rit => $d_) {
                if (!isset($d_['kota_asal'], $d_['kota_tujuan']))
                    continue;

                $displayRit .= (!empty($displayRit) ? ' | ' : '') . $d_['kota_asal'] . ' - ' . $d_['kota_tujuan'];
                $displayLabel .= (!empty($displayLabel) ? ' - ' : '') . $d_['label'];
                $displayJmlPnp .= "<h5>Jumlah Pnp RIT ". $rit ." : ". (isset($post['data']['ops']['penumpang_rit'][$rit]) ? $post['data']['ops']['penumpang_rit'][$rit] : 0) ."</h5>";
                $displayRitComplete['biaya_operasional'] += isset($post['data']['ops']['rit'][$rit]) ? $post['data']['ops']['rit'][$rit] : 0;

                $ritEnd = $rit;
            }
              $displayRit .= '<br/><br/>' . $this->getDay($post['startdate']) . ', ' . $this->IndonesiaTgl($post['startdate']);
            
              echo $displayRit;
            ?></h4>


            <h5>Driver: <?= $post['data']['driver']; ?></h5>
            <h5>Cabin Crew: <?= $post['data']['cabin_crew']; ?></h5>
            <?php echo (isset($post['data']['nomor_lambung']) && !empty($post['data']['nomor_lambung']) ? '<h5>Nomor Lambung: '. $post['data']['nomor_lambung'].'</h5>' : ''); ?>


            <h5>Trayek: <?= $displayLabel; ?></h5>
            <div class="clearfix"></div>

            <?= $displayJmlPnp ?>
        </div>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'inputPengeluaran-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.,
        'method'=>'post',
        'enableAjaxValidation'=>false,
        'htmlOptions' => ['enctype'=>"multipart/form-data"]
    )); 
    ?>

<div class="row d-relative">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_title">
        <h4 class="title">Input Pendapatan Lain</h4>
        <div class="clearfix"></div>
    </div>
</div>
        <table class="table border-none">
            <?php 
                if (isset($post['data']['pendapatan_save']) && !empty($post['data']['pendapatan_save'])):
                    ?>
                    <tr>
                        <td colspan="2"><h4>Pendapatan Tersimpan</h4></td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid!important;">Nominal</th>
                        <th style="border: 1px solid!important;">Keterangan</th>
                    </tr>
                    <?php                
                foreach ($post['data']['pendapatan_save'] as $pendapatan) {
                    ?>
                    <tr>
                        <td width="50%" style="border: 1px solid!important;"><?= Helper::getInstance()->getRupiah($pendapatan['nominal']) ?></td>
                        <td width="50%" style="border: 1px solid!important;"><?= $pendapatan['deskripsi'] ?></td>
                    </tr>
                    
                    <?php
                } 
                ?>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid!important;"></td>
                    </tr>
                <?php
                    endif;
                ?>
            <tr>
                <td width="50%">
                <input class="form-control number" name="nominal[]" placeholder="Nominal Pendapatan" 
                value="<?= isset($post['pendapatan_data']['value']) ? Helper::getInstance()->getRupiah($post['pendapatan_data']['value']) : ''; ?>"/>
                </td>
                <td width="50%">
                    <input type="text" name="keterangan[]" placeholder="Keterangan" class="form-control"/>
                </td>
            </tr>
        </table>
</div>

<div class="container-button-float">
    <div class="row-0">
        <div class="button-float">
                <input type="submit" name="submit" class="none" value="1" id="submitHide"/>
                <button type="button" class="float-btn btn-submit" id="beliTiket" onclick="return confirmSubmitPendapatan();">
                    Tambah Pendapatan
                </button>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php else: ?>
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <h4>Tidak ditemukan penugasan yang sedang aktif</h4>
    </div>
<?php endif; ?>

</div>

<script>
    $('#startdate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		header: true
	});
    $("body").on('keyup', 'input.number', function(e){
        e.preventDefault();
        var value = $(this).val();
        value = value.replace(".", "");
        value = value.replace(".", "");
        $(this).val(accounting.formatNumber(value, 0, "."));
    });

    $('#filter').on('click', function(){
        location.href = "<?= Constant::baseUrl() . '/' . $this->route . '?startdate=' ?>"+$('#startdate').val();
    });

    function confirmSubmitPendapatan()
    {
        var rit = $('select#rit').val();
        if (confirm("Apa Anda yakin akan menambahkan pendapatan lain?") == true) {
            $('#submitHide').trigger('click');
        }
    }
</script>