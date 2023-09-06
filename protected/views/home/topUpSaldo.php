<div class="row mt-20">
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'top-up-saldo-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this., enctype="multipart/form-data"
        'enableAjaxValidation'=>false,
        'htmlOptions' => ['onsubmit'=>'return onSubmitForm(event)','enctype'=>"multipart/form-data"]
    )); 
$isAgenInternal = isset(Yii::app()->user->tipe_agen) && in_array(Yii::app()->user->tipe_agen, ['internal']);
    // Helper::getInstance()->dump(Yii::app()->user->tipe_agen);
    ?>

<div class="card-booking card-book mb-50">

    <?php if ($isAgenInternal): ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label>Deposit Untuk</label>
            <?= CHtml::dropDownList('Deposit[agen_id]', (isset($post['agen_id']) ? $post['agen_id'] : ''), AgenPerwakilan::object()->getListAgenDeposit(), ['required'=>true, 'prompt' => 'Pilih Tujuan Deposit']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label>Metode Pembayaran</label>
            <?= CHtml::dropDownList('Deposit[metode_pembayaran]', (isset($post['metode_pembayaran']) ? $post['metode_pembayaran'] : ''), [
                'tunai' => 'Tunai',
                'transfer' => 'Transfer'
            ], ['required'=>true, 'prompt'=>'- Pilih Metode Pembayaran -']) ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label>Nominal</label>
            <?= CHtml::textField('Deposit[nominal]', (isset($post['nominal']) ? $post['nominal'] : ''), ['class'=>'number', 'required'=>true]) ?>
        </div>
    </div>

    <div class="row none">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label>Jumlah Bayar</label>
            <?= CHtml::textField('Deposit[bayar]', (isset($post['bayar']) ? $post['bayar'] : ''), ['required'=>true, 'readonly' => true]) ?>
            <span id="diskonText" class="red"></span>
        </div>
    </div>

    <div class="row" id="containerRekening">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label>Rekening Tujuan</label>
            <?= CHtml::dropDownList('Deposit[rekening]', (isset($post['rekening']) ? $post['rekening'] : ''), [
                'BRI' => 'BRI',
                'MANDIRI' => 'MANDIRI',
                'BCA' => 'BCA',
                'BNI' => 'BNI',
            ], ['required'=>true, 'prompt'=>'- Pilih Rekening -']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label id="bukti_tf">Bukti Transfer</label>
            <?= CHtml::fileField('Deposit[file]', '', ['class'=>'form-control', 'required'=>true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <button class="btn btn-warning pull-right">Top Up</button>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
</div>

<script>
    var minimBonus = 10000000;
    var bonusSaldo = 200000;
    $(document).on('ready', function() {
        $('select').select2();

        $('#Deposit_agen_id').on('change', function() {
            if ($(this).val() === 'self') {
                switchNonRequiredFile(false);
            } else {
                switchNonRequiredFile(true);
            }
        });

        $('#Deposit_metode_pembayaran').on('change', function() {
            if ($(this).val() === 'tunai') {
                switchNonRequiredFile(false);
            } else {
                switchNonRequiredFile(true);
            }
        });
    });

    function switchNonRequiredFile(value = true)
    {
        if (!value) {
            $('#Deposit_file').attr('required', false);
            $('#bukti_tf').html("Bukti Transfer (Tidak Wajib)");

            $('#Deposit_rekening').attr('required', false);
            $('#containerRekening').hide();
        } else {
            $('#Deposit_file').attr('required', true);
            $('#bukti_tf').html("Bukti Transfer");

            $('#Deposit_rekening').attr('required', true);
            $('#containerRekening').show();
        }
    }
    $('input.number').on('keyup', function(e){
        e.preventDefault();
        var value = $(this).val();
        value = value.replace(".", "");
        value = value.replace(".", "");
        $(this).val(accounting.formatNumber(value, 0, "."));

        calculateTotalBayar(value);
    });

    function calculateTotalBayar(value = 0)
    {
       /*  if (value >= minimBonus) {
            value -= bonusSaldo;
            $('#diskonText').html('Dapat diskon = Rp '+accounting.formatNumber(bonusSaldo, 0, "."));
        } else {
            value = value;
            $('#diskonText').html('');
        } */
        $('#Deposit_bayar').val(accounting.formatNumber(value, 0, "."));
    }
</script>