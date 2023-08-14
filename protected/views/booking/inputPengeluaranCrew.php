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
                <?= CHtml::textField('startdate',(isset($_GET['startdate']) ? $_GET['startdate'] : date('Y-m-d')),['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off']); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <button type="button" class="btn btn-warning pull-right" id="filter">Cari</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>


<div class="row">

<?php if (isset($post['data']) && !empty($post['data'])): ?>
<div class="card-booking card-book border-none">
        <div class="x_title grey-dark mb-0">
            <h4><?= $post['data']['boarding_nama'] . ' - ' . $post['data']['destination_nama'] . ', ' . $this->getDay($post['startdate']) . ', ' . $this->IndonesiaTgl($post['startdate']); ?></h4>
            <?php echo (isset($post['data']['nomor_lambung']) && !empty($post['data']['nomor_lambung']) ? '<h5>Nomor Lambung: '. $post['data']['nomor_lambung'].'</h5>' : ''); ?>
            <div class="clearfix"></div>
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

    <?php if (!empty($post['pengeluaran_data'])): ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title">
                <h5 class="title">Data Pengeluaran</h5>
                <div class="clearfix"></div>
            </div>
        </div>
    
        <div class="col-md-12 col-sm-12 col-xs-12 overflowX">
            <table class="table table-striped table-bordered">
                <tbody>
                <?php 
                $no = 1;
                foreach ($post['pengeluaran_data'] as $d) {
                ?>
                    <tr>
                        <th><?= $no++; ?></th>
                        <th width="50%">
                            <?= $d['deskripsi_pengeluaran']; ?>
                        </th>
                        <td width="40%">
                            <?= $d['nominal'] > 0 ? Helper::getInstance()->getRupiah($d['nominal']) : $d['nominal']; ?>
                        </td>
                        <td width="5%">
                            <span class="btn btn-danger" onclick="return confirmDelete('<?= $d['id']; ?>')"><i class="fa fa-trash"></i></span>
                        </td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
   
    <div class="row d-relative">
        <table class="table border-none">
            <tbody id="contentFormAddition_">
            <tr id="elementAddition_">
                <td class="p-0">
                    <table class="table border-none mb-0">
                        <tr>
                            <td width="50%">
                                <label>Deskripsi Pengeluaran</label>
                                <input class="form-control" name="pengeluaran[deskripsi][]" placeholder="bbm, parkir, dll" required="required"/>
                            </td>
                            <td width="50%">
                                <label>Nominal</label>
                                <input class="form-control number" name="pengeluaran[nominal][]" placeholder="Rp..." required="required"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="d-flex w-100 justify-between">
                                    <label>Lampiran</label>
                                    <span class="btn btn-danger none removeField" onclick="deleteFormAddition(this)"><i class="fa fa-trash"></i></span>
                                </div>
                                
                                <input type="file" name="pengeluaran[file][]" class="form-control" accept="image/png, image/gif, image/jpeg"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </tbody>
            <tfoot>
                <tr>
                <td class="text-left"><button type="button" class="btn btn-info" id="addFormAddition"><i class="fa fa-plus-circle"></i> Tambah Form</button></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="container-button-float">
    <div class="row-0">
        <div class="button-float">
            <input type="submit" name="submit" class="none" value="1" id="submitHide"/>
            <button type="button" class="float-btn btn-submit" id="beliTiket" onclick="return confirmSubmitPengeluaran();">
                Tambah Pengeluaran
            </button>
        </div>
    </div>
    </div>
<?php $this->endWidget(); ?>

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

    $('#filter').on('click', function(){
        location.href = "<?= Constant::baseUrl() . '/' . $this->route . '?startdate=' ?>"+$('#startdate').val();
    });

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
</script>