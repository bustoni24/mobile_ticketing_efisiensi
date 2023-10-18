<style>
    div.gj-datepicker{
        margin-bottom: 0;
    }
    input[type="password"], input[type="number"], input[type="text"], textarea, select{
        height: 40px;
    }
    .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group{
        height: 40px;
    }
    .mainList {
        padding: 0;
        margin-bottom: 0;
    }
    .mb-5{
        margin-bottom: 5px!important;
    }
    .pl-0 {
        padding-left: 0!important;
    }
    .pr-0 {
        padding-right: 0!important;
    }
    .select2-container{
		width: 100%!important;
	}
    span.separate{
        width: 10px!important;
    }
    #mainDestionation .select2-container--default .select2-selection--multiple, #mainDestionation .select2-container--default .select2-selection--single{
        height: auto;
        min-height: 70px;
    }
    #mainDestionation .select2-container .select2-selection--single .select2-selection__rendered{
        white-space: normal;
    }
    .display-card {
        overflow-y: auto;
        max-height: 60vh;
    }
    table.content-card>tbody>tr>td{
        padding-bottom: 0;
    }
</style>
<?php
$this->breadcrumbs = array(
  'Home'
);

$this->widget('ext.dropDownChain.VDropDownChain', array(
    'parentId' => 'Armada_kota_asal',
    'childId' => 'Armada_kota_tujuan',
    'url' => 'api/getTujuanKeberangkatan?id=h3n5r5w5q584g4r4a4a356g4m5i484b4o4e4t5p5u5t4e4w2',
    'valueField' => 'agen_id_source',
    'textField' => 'tujuan_keberangkatan',
));
?>

<div class="row mt-10">
    
    <div class="col-md-12 col-sm-12 col-xs-12 mainList">
        <div class="row" style="margin-bottom: 3px!important;">
              <?= CHtml::textField('PembelianTiket[startdate]',$model->startdate,['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off','readonly'=>true]); ?>
        </div>
        <div class="row" style="margin-bottom: 3px!important;">
            <?= CHtml::dropDownList("Armada[kota_asal]", $model->titik_id, Armada::object()->getAsalKeberangkatan(), ['prompt' => 'Pilih Asal Keberangkatan']); ?>
        </div>
        <div class="row" style="margin-bottom: 3px!important;">
            <?= CHtml::dropDownList("Armada[kota_tujuan]", $model->agen_id, $arrTujuan, ['prompt' => 'Pilih Tujuan']); ?>
        </div>
        <div class="row" style="margin-bottom: 3px!important;">
            <div class="input-group">
                <?= CHtml::textField("Boarding[search]", $model->filter, ['class'=>'form-control','placeholder'=>'Cari Jam Keberangkatan (YKC, CLP, ..)', 'autocomplete' => 'off']) ?>
                <span class="input-group-btn">
                <button class="btn btn-warning h-100x" type="button">Cari</button>
                </span>
            </div>
        </div>
    </div>
   
</div>

<div class="row display-card">
    <?php $this->widget('zii.widgets.CListView', array(
        'id'=>'listViewTrip',
        'dataProvider'=>$model->searchListBusV2(),
        'itemView'=>'_view_list_bus_v2',
        'emptyText' => 'Silahkan pilih Tujuan Anda dengan tepat',
    )); ?>
    </div>

<script>
   $(document).on('ready', function(){
        $('select').select2();

        $('#Armada_kota_tujuan').on('change', function(){
            var agen_id = $(this).val();
            var startdate = $('#PembelianTiket_startdate').val();
            var titik_id = $('#Armada_kota_asal').val();
            var filter = $('#Boarding_search').val();

            var data = {agen_id:agen_id, startdate:startdate, titik_id:titik_id, filter:filter};
            updateListView(data);
        });

        $('#Boarding_search').on('keyup', function(){
            var agen_id = $('#Armada_kota_tujuan').val();
            var startdate = $('#PembelianTiket_startdate').val();
            var titik_id = $('#Armada_kota_asal').val();
            var filter = $(this).val();

            var data = {agen_id:agen_id, startdate:startdate, titik_id:titik_id, filter:filter};
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

        var route_id = $(this).attr('data-route_id');
        var startdate = $('#PembelianTiket_startdate').val();
        var armada_ke = $(this).attr('data-armada_ke');
        var penjadwalan_id = $(this).attr('data-penjadwalan_id');
        var label_trip = $(this).attr('data-label_trip');
        var agen_id_asal = $(this).attr('data-agen_id_asal');
        var agen_id_tujuan = $(this).attr('data-agen_id_tujuan');

       //redirect to bookint trip
       $.form("<?= Constant::baseUrl() . '/booking/routeDetailV2?id='; ?>"+route_id+"_"+startdate+"_"+armada_ke+"_"+penjadwalan_id, {route_id:route_id,label_trip:label_trip,agen_id_asal:agen_id_asal,agen_id_tujuan:agen_id_tujuan}).submit();
    });

  $('#PembelianTiket_startdate').on('change', function(){
      var data = {startdate:$(this).val()};            
      updateListView(data);
  });

  function updateListView(data)
  {
      if (typeof data === "undefined" || data === null || data === "")
          return false;
// console.log(data);
      $.fn.yiiListView.update('listViewTrip', {data:data,
      complete: function(){

      },
      error : function(data){
          if (typeof(data.responseText) !== "undefined")
              console.log(data.responseText);
      }});
  }
</script>