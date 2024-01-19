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
              <?= CHtml::dropDownList('rit',(isset($post['rit']) ? $post['rit'] : 1), Helper::getInstance()->getRitDisplay(),['class' => 'form-control']); ?>
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

<?php if (isset($post['data']['data']) && !empty($post['data']['data'])): 
    $isTripClose = $post['data']['status_trip'] == Constant::STATUS_TRIP_CLOSE;
    $isRitClose = $post['status_rit_close'];
    // Helper::getInstance()->dump($post['data']['ops']['rit']);
    ?>
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
            
            <?= (isset($post['rit']) && $post['rit'] == $ritEnd ? '<h5 class="red">Mohon Driver segera melakukan Input Daily Check Setelah Mengemudi jika Rit '. $ritEnd .' telah berakhir</h5>' : '') ?>
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

<?php 
$skipField = [];
    if (isset($post['pengeluaran_data']) && !empty($post['pengeluaran_data'])):
        ?>
        <table class="table table-bordered">
            <tbody>
                    <tr>
                        <td colspan="2"><h4>Pengeluaran Tersimpan</h4></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <th>Lampiran</th>
                    </tr>
                    <?php                
                    foreach ($post['pengeluaran_data'] as $pengeluaran) {
                        $skipField[$pengeluaran['deskripsi']] = ['value' => $pengeluaran['value'], 'rit' => $pengeluaran['rit']];
                        ?>
                        <tr>
                            <td width="30%"><?= ucwords(str_replace("_", " ", $pengeluaran['deskripsi'])) . ' RIT ' . $pengeluaran['rit'] . '<br/>' . 
                                'Nominal: ' . Helper::getInstance()->getRupiah($pengeluaran['value']);
                            ?></td>
                            <td>
                            <?php if (isset($pengeluaran['lampiran']) && !empty($pengeluaran['lampiran'])) {
                                ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <img src="<?= $pengeluaran['lampiran']; ?>" class="icon-img"/>
                                </div>
                                <?php
                            } ?>
                            </td>
                        </tr>
                        <?php
                    } 
                ?>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid!important;"></td>
                    </tr>
            </tbody>
        </table>
        <?php
            endif;
        ?>

    <?php if (isset($displayRitComplete['biaya_operasional'])): ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title">
                <h4 class="title">Input Pengeluaran <?= $isTripClose ? '(<span class="red">Input Pengeluaran telah ditutup karena Trip sudah berakhir</span>)' : ''; ?></h4>
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
                                <?= Helper::getInstance()->getRupiah($displayRitComplete['biaya_operasional']); ?>
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
   
    <?php
    $deskripsiPengeluaran = Helper::getInstance()->getPengeluaranItem($post['data']);
    // Helper::getInstance()->dump($post);
    ?>
    <div class="row d-relative">
        <table class="table border-none">
            <tbody id="contentFormAddition_">
            <tr id="elementAddition_">
                <td class="p-0">
                    <table class="table border-none mb-0">
                        <tbody>
                            <?php 
                            $i = 1;
                            foreach ($deskripsiPengeluaran as $key => $value) {
                                ?>
                                <tr class="<?= !in_array($key, ['solar']) ? 'inputLain ' . (isset($skipField[$key]['value']) || (isset($value['label']['value']) && !empty($value['label']['value'])) ? '' : '') : '' ?>">
                                    <?php foreach ($value as $l => $dt) {
                                        if ($l == 'label'):
                                        ?>
                                        <td width="50%">
                                            <?php if (in_array($key, ['terminal'])): 
                                            ?>
                                                <label class="mb-0">Pengeluaran Lain <span class="red">(diisi jika perlu)</span></label>
                                                <hr class="mb-0 mt-0"/>
                                            <?php
                                                if (isset($skipField[$key]['value'], $skipField[$key]['rit']) && isset($post['rit']) && $post['rit'] != $skipField[$key]['rit'])
                                                    continue;
                                                ?>
                                            <?php endif; ?>
                                            <?php if (isset($skipField[$key]['value'], $skipField[$key]['rit']) && isset($post['rit']) && $post['rit'] != $skipField[$key]['rit'] && $key == 'parkir_bandara')
                                                    continue; ?>
                                            <label><?= ucwords(str_replace("_", " ", $key)) . (in_array($key, ['solar']) ? ' <span class="red">(jika belum mohon diisi 0)</span>' : '' ); ?></label>
                                            <?php if (in_array($key, ['solar'])): ?>

                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="<?= $key ?>" placeholder="Solar (liter)"
                                                    value="" <?= !isset($skipField[$key]['value']) ? 'required="required"' : '' ?>>
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
                                                value="<?= isset($skipField[$key]['value']) ? Helper::getInstance()->getRupiah($skipField[$key]['value']) : Helper::getInstance()->getRupiah($dt['value']); ?>"
                                                />
                                            <?php endif; ?>
                                        </td>
                                        <?php
                                        elseif ($l == 'attach'):
                                            ?>
                                        <td>
                                            <label>Lampiran</label>
                                            <input type="file" name="attach_<?= $key ?>" class="form-control" accept="image/png, image/gif, image/jpeg"/>
                                        </td>
                                            <?php
                                        endif;
                                    } ?>
                                </tr>
                               <?php
                               $i++;
                            } ?>
                           <!--  <tr>
                                <td colspan="2">
                                    <span id="showLainnya" class="btn btn-info ">Tampilkan Pengeluaran Lain</span>
                                </td>
                            </tr> -->
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

    function confirmSubmitPengeluaran()
    {
        var rit = $('select#rit').val();
        if (confirm("Apa Anda yakin sudah sesuai dan ingin mengakhiri RIT "+rit+" ini?") == true) {
            $('#submitHide').trigger('click');
        }
    }

    $('#filter').on('click', function(){
        location.href = "<?= Constant::baseUrl() . '/' . $this->route . '?startdate=' ?>"+$('#startdate').val()+"&rit="+$('#rit').val();
    });
</script>