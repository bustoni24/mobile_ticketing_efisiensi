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
    ?>

<div class="card-booking card-book mb-50">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label>Nominal</label>
            <?= CHtml::textField('Deposit[nominal]', (isset($post['nominal']) ? $post['nominal'] : ''), ['class'=>'number', 'required'=>true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label>Jumlah Bayar</label>
            <?= CHtml::textField('Deposit[bayar]', (isset($post['bayar']) ? $post['bayar'] : ''), ['required'=>true, 'readonly' => true]) ?>
            <span id="diskonText" class="red"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <label>Bukti Transfer</label>
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
        if (value >= minimBonus) {
            value -= bonusSaldo;
            $('#diskonText').html('Dapat diskon = Rp '+accounting.formatNumber(bonusSaldo, 0, "."));
        } else {
            value = value;
            $('#diskonText').html('');
        }
        $('#Deposit_bayar').val(accounting.formatNumber(value, 0, "."));
    }
</script>