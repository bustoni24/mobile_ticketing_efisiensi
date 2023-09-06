<div class="row mt-20">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_title">
        <h4 class="title">Input Pengeluaran</h4>
        <div class="clearfix"></div>
    </div>
</div>
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

    <div class="row d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Pilih RIT</label>
              <?= CHtml::dropDownList('rit',(isset($post['rit']) ? $post['rit'] : 1), [
                1 => 'RIT 1',
                2 => 'RIT 2',
              ],['class' => 'form-control']); ?>
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

<?php if (isset($post['data']) && !empty($post['data'])): 
    $isTripClose = $post['data']['status_trip'] == Constant::STATUS_TRIP_CLOSE;
    $isRitClose = $post['status_rit_close'];
    ?>
<div class="card-booking card-book border-none">
        <div class="x_title grey-dark mb-0">
            <h4><?= 
            (isset($post['data'][1]) ? $post['data'][1]['kota_asal'] . ' - ' . $post['data'][1]['kota_tujuan'] : '???') .
            (isset($post['data'][2]) ?  ' | ' . $post['data'][2]['kota_asal'] . ' - ' . $post['data'][2]['kota_tujuan'] : '')
              . '<br/>' . $this->getDay($post['startdate']) . ', ' . $this->IndonesiaTgl($post['startdate']); ?></h4>
            <h5>Driver: <?= $post['data']['driver']; ?></h5>
            <h5>Cabin Crew: <?= $post['data']['cabin_crew']; ?></h5>
            <?php echo (isset($post['data']['nomor_lambung']) && !empty($post['data']['nomor_lambung']) ? '<h5>Nomor Lambung: '. $post['data']['nomor_lambung'].'</h5>' : ''); ?>

            <h5>Trayek: <?= (isset($post['data'][1]['label']) ? $post['data'][1]['label'] : '') . (isset($post['data'][2]['label']) ? ' - ' . $post['data'][2]['label'] : ''); ?></h5>
            <div class="clearfix"></div>

            <h5>
                Jumlah Pnp RIT 1 : <?= (isset($post['data']['ops']['penumpang_rit1']) ? $post['data']['ops']['penumpang_rit1'] : 0); ?>
            </h5>
            <h5>
                Jumlah Pnp RIT 2 : <?= (isset($post['data']['ops']['penumpang_rit2']) ? $post['data']['ops']['penumpang_rit2'] : 0); ?>
            </h5>
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

    <?php if (isset($post['data']['ops']['rit1'], $post['data']['ops']['rit2'])): ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title">
                <h5 class="title">Data Pengeluaran <?= $isTripClose ? '(<span class="red">Input Pengeluaran telah ditutup karena Trip sudah berakhir</span>)' : ''; ?></h5>
                <div class="clearfix"></div>
            </div>
        </div>
    
        <div class="col-md-12 col-sm-12 col-xs-12 overflowX none">
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th width="50%">
                            <label>Biaya Operasional</label>
                        </th>
                        <td width="50%">
                            <label>
                                <?= ($post['data']['ops']['rit1'] + $post['data']['ops']['rit2']) > 0 ? Helper::getInstance()->getRupiah(($post['data']['ops']['rit1'] + $post['data']['ops']['rit2'])) : ($post['data']['ops']['rit1'] + $post['data']['ops']['rit2']); ?>
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
   
    <?php
    // Helper::getInstance()->dump($post['data']);
    $deskripsiPengeluaran = Helper::getInstance()->getPengeluaranItem($post['data']);
    ?>
    <div class="row d-relative">
        <table class="table border-none">
            <tbody id="contentFormAddition_">
            <tr id="elementAddition_">
                <td class="p-0">
                    <table class="table border-none mb-0">
                        <tbody>
                            <?php foreach ($deskripsiPengeluaran as $key => $value) {
                                ?>
                                <tr class="<?= !in_array($key, ['solar']) ? 'inputLain ' . (isset($post['pengeluaran_data'][$key]['value']) || (isset($value['label']['value']) && !empty($value['label']['value'])) ? '' : 'none') : '' ?>">
                                    <?php foreach ($value as $l => $dt) {
                                        
                                        if ($l == 'label'):
                                        ?>
                                        <td width="50%">
                                            <label><?= ucwords(str_replace("_", " ", $key)); ?></label>
                                            <?php if (in_array($key, ['solar'])): ?>

                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="<?= $key ?>" placeholder="Solar (liter)"
                                                    value="<?= isset($post['pengeluaran_data'][$key]['value']) ? $post['pengeluaran_data'][$key]['value'] : ''; ?>" required="required">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-secondary h-100x" type="button">Liter</button>
                                                    </span>
                                                </div>

                                                <?php
                                                if (isset($value['refund'])): ?>
                                                    <div class="row"><a href="javascript:void(0)" onclick="pengajuanRefundSolar('<?= $value['refund'] ?>')">Pengajuan refund solar</a></div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <input class="form-control number" name="<?= $key ?>" placeholder="<?= str_replace("_", " ", $key) ?>" 
                                                <?= isset($dt['readonly']) && $dt['readonly'] ? 'readonly="readonly"' : ''; ?>
                                                value="<?= isset($post['pengeluaran_data'][$key]['value']) ? Helper::getInstance()->getRupiah($post['pengeluaran_data'][$key]['value']) : Helper::getInstance()->getRupiah($dt['value']); ?>"
                                                />
                                            <?php endif; ?>
                                        </td>
                                        <?php
                                        elseif ($l == 'attach'):
                                            ?>
                                        <td>
                                            <label>Lampiran</label>
                                            <?php if (isset($post['pengeluaran_data'][$key]['lampiran'])): ?>
                                                <div class="col-md-12 col-sm-12 col-xs-12 "> 
                                            <div class="col-md-12 col-sm-12 col-xs-12 "> 
                                                <div class="col-md-12 col-sm-12 col-xs-12 "> 
                                                <img src="<?= $post['pengeluaran_data'][$key]['lampiran']; ?>" class="icon-img"/>
                                                </div>
                                            <?php else: ?>
                                                <input type="file" name="attach_<?= $key ?>" class="form-control" accept="image/png, image/gif, image/jpeg"/>
                                            <?php endif; ?>
                                        </td>
                                            <?php
                                        endif;
                                    } ?>
                                </tr>
                               <?php
                            } ?>
                            <tr>
                                <td colspan="2">
                                    <span id="showLainnya" class="btn btn-info ">Tampilkan Pengeluaran Lain</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
           <!--  <tfoot>
                <tr>
                <td class="text-left"><button type="button" class="btn btn-info" id="addFormAddition"><i class="fa fa-plus-circle"></i> Tambah Form</button></td>
                </tr>
            </tfoot> -->
        </table>
    </div>

    <div class="container-button-float <?= $isTripClose ? 'none' : '' ?>">
        <div class="row-0">
            <div class="button-float">
                <?php if ($isRitClose): ?>
                    <button type="button" class="float-btn btn-danger" >
                        Rit sudah berakhir
                    </button>
                <?php else: ?>
                    <input type="submit" name="submit" class="none" value="1" id="submitHide"/>
                    <button type="button" class="float-btn btn-submit" id="beliTiket" onclick="return confirmSubmitPengeluaran();">
                        Tambah Pengeluaran
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>

<script>
    var count=1;
    $('#addFormAddition').on('click', function(e){
      e.preventDefault();

    //   count = document.querySelectorAll('#elementAddition .number').length;
      var $contentElement = $('#elementAddition_')
      .clone()
      .find("input")
      .val("")
      .end()
      .find("span.removeField")
      .removeClass("none")
      .end();
    //   return false;
      $('#contentFormAddition_').append($contentElement);
    });

    var countEl = 1;
    function deleteFormAddition(el)
    {
      countEl = document.querySelectorAll('#elementAddition_ .number').length;
      var parentLv2 = el.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;

    //   console.log(countEl);
      /* console.log(parentLv2.innerHTML);
      return false; */
      if (countEl > 1) {
        parentLv2.remove();
      }
    }

    function confirmDelete(id) {
        if (confirm("Apakah yakin untuk menghapus data pengeluaran ini?") == true) {
            $.ajax({
                type : "POST",
                url : "<?= Constant::baseUrl() . '/booking/deletePengeluaran' ?>",
                dataType : "JSON",
                data: {id:id},
                success : function(data) {
                    if (data.success) {
                        location.reload();
                    } else {
                        console.log(data);
                        var message = typeof data.message !== "undefined" ? data.message : 'Data gagal dihapus';
                        Swal.fire({
                            html: message,
                            icon: 'error',
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                            });
                    }
                },
                error : function(data){
                    if (typeof(data.responseText) !== "undefined")
                        console.log(data.responseText);
                }
            });
        }
    }

$('#showLainnya').on('click', function() {
    $('.inputLain').removeClass('none');
    $(this).addClass('none');
});

function pengajuanRefundSolar(maks) {
    var penjadwalan_id = "<?= $post['data']['penjadwalan_id'] ?>";
    Swal.fire({
                title: 'Pengajuan Refund Kupon Solar',
                html: `
                <div class="row">
                    <div class="form-group">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <th>Besar refund (maksimal ${maks} Liter)</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" id="refund" class="form-control" placeholder="- Besaran refund dalam liter -" value="" min="1" max="10">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                `,
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Ajukan',
                confirmButtonColor: '#F58220',
                focusConfirm: false,
                preConfirm: () => {
                    const refund = Swal.getPopup().querySelector('#refund').value;
                    if (!refund) {
                        Swal.showValidationMessage(`Silahkan isi besaran refund`);
                    }

                    return { refund: refund }
                }
            }).then((result) => {
            if (result.isConfirmed) {

                    var data = {refund: result.value.refund, penjadwalan_id: penjadwalan_id};
                    
                    $.ajax({
                        type : "POST",
                        url : "<?= Constant::baseUrl() . '/booking/refundSolar' ?>",
                        dataType : "JSON",
                        data: data,
                        success : function(data) {
                            if (data.success) {
                                Swal.fire({
                                    html: `Pengajuan refund berhasil`,
                                    icon: 'info',
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'OK'
                                    });
                            } else {
                                console.log(data);
                                var message = typeof data.message !== "undefined" ? data.message : 'Data gagal konfirmasi';
                                Swal.fire({
                                    html: message,
                                    icon: 'error',
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'OK'
                                    });
                            }
                        },
                        error : function(data){
                            if (typeof(data.responseText) !== "undefined")
                                console.log(data.responseText);
                        }
                    });
                }
            });
}

$("body").on("keyup", '#refund', function(e){
    e.preventDefault();

    if (typeof $(this).val() !== "undefined" && $(this).val() !== 'NaN' && $(this).val() !== "") {
        var value = parseInt($(this).val());
        if (value > 10) {
            value = 10;
        }
        $(this).val(value);
    }
});
</script>

<?php else: ?>
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <h4>Tidak ditemukan penugasan</h4>
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

    function confirmSubmitPengeluaran()
    {
        $('#submitHide').trigger('click');
    }

    $('#filter').on('click', function(){
        location.href = "<?= Constant::baseUrl() . '/' . $this->route . '?startdate=' ?>"+$('#startdate').val()+"&rit="+$('#rit').val();
    });
</script>