<?php
$this->breadcrumbs = array(
  'Home'
);
?>

<div class="row mt-20">
    <div class="col-md-12 col-sm-12 col-xs-12">
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
        <div class="col-sm-12 pl-0 mb-0">
              <?= CHtml::textField('PembelianTiket[startdate]',$model->startdate,['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off']); ?>
        </div>
      </div>
        <?php $this->endWidget(); ?>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 mainList">
        <div class="row" style="margin-bottom: 3px!important;">
                <?= CHtml::dropDownList("Armada[kelas]", "", Armada::object()->getKelasArmada(), ['prompt' => 'Pilih Kelas Armada']); ?>
        </div>
        <div class="row" style="margin-bottom: 3px!important;">
            <?= CHtml::dropDownList("Armada[group_trip]", "", Armada::object()->getGroupTrip(), ['prompt' => 'Pilih Group Trip']); ?>
        </div>
        <div class="row" style="margin-bottom: 3px!important;">
            <div class="input-group">
                <?= CHtml::textField("Boarding[search]", "", ['class'=>'form-control','placeholder'=>'Cari Kota, Seat', 'autocomplete' => 'off']) ?>
                <span class="input-group-btn">
                <button class="btn btn-secondary h-100x" type="button">Cari</button>
                </span>
            </div>
        </div>
    </div>

    <?php $this->widget('zii.widgets.CListView', array(
        'id'=>'listViewTrip',
        'dataProvider'=>$model->searchListBus(),
        'itemView'=>'_view_list_bus',
    )); ?>
</div>

<script>
   $(document).on('ready', function(){
        $('select').select2();

        $('.mainList').find('select').on('change', function(){
            var name = $(this).attr('name');
            var value = $(this).val();
            var data = {};
            data[name] = value;
            
            updateListView(data);
        });

        $('#Boarding_search').on('keyup', function(){
            var data = {filter:$(this).val()};
            updateListView(data);
        });
   });
  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  $('#PembelianTiket_startdate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
    minDate: today,
		header: true
	});

  $("body").on("click", ".card-book", function(e){
        e.preventDefault();

        var tripId = $(this).attr('data-tripId');
        var group = $(this).attr('data-group');
        var kelas = $(this).attr('data-kelas');
        var groupId = $(this).attr('data-groupId');
        var armadaId = $(this).attr('data-armadaId');
        var tripLabel = $(this).attr('data-label');

       //redirect to bookint trip
       $.form("<?= Constant::baseUrl() . '/home/bookingTrip/'; ?>"+tripId+"?startdate="+$('#PembelianTiket_startdate').val(), {group:group,kelas:kelas,groupId:groupId,armadaId:armadaId,tripLabel:tripLabel}).submit();
    });

  $('#PembelianTiket_startdate').on('change', function(){
      var data = {startdate:$(this).val()};            
      updateListView(data);
  });

  function updateListView(data)
  {
      if (typeof data === "undefined" || data === null || data === "")
          return false;

      $.fn.yiiListView.update('listViewTrip', {data:data,
      complete: function(){

      },
      error : function(data){
          if (typeof(data.responseText) !== "undefined")
              console.log(data.responseText);
      }});
  }
</script>