<style>
	table.table > thead > tr > th {
		vertical-align: middle;
    	text-align: center;
	}
</style>
<div class="col-sm-12">

<div class="x_title">
	<h2>Table Data Booking View</h2>
	<div class="clearfix"></div>
</div>

	<div class="card-box">

    <div class="row">
    <div class="col-sm-12">
        <label class="mt-15">Startdate - Enddate</label>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 form-group" style="padding-left: 0;margin-top:10px;">
        <?php echo CHtml::textField('BookingData[startdate]',$model->startdate,['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off']); ?>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12 form-group" style="padding-left: 0;margin-top:10px;">
        <?php echo CHtml::textField('BookingData[enddate]',$model->enddate,['placeholder' => 'yyyy-m-dd', 'class' => 'form-control enddate', 'autocomplete' => 'off']); ?>
    </div>
        
    <div class="col-md-12">
        <button type="button" class="btn btn-warning pull-right" id="filter">Filter</button>
    </div>

        <div class="col-md-12 none">
            <a class="pull-right" href="javascript:void(0)" onclick="exportExcel()" title="Cetak EXCEL"><i class="fa fa-file-excel-o"></i></a>
        </div>
    </div>

	<div class="row none">
    <div class="col-sm-12">
		<div class="col-sm-6 pl-0 mb-0">
			<div class="dataTables_length"><label>Display <select name="BookingData[display]" aria-controls="datatable-keytable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records</label>
			</div>
		</div>
		<div class="col-sm-6 pull-right text-right pr-0 mb-0">
			<div class="dataTables_filter"><label>Search:<input type="search" name="BookingData[filter]" class="form-control input-sm" placeholder="Ketik trip label, nama group" aria-controls="datatable-keytable"></label></div>
		</div>
	</div>
    </div>

		<?php 		
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'ticketing-report-grid',
		'dataProvider'=>$model->searchDataBooking(),
		'filter'=>null,
        'htmlOptions'=>['style'=>"margin-left: -20px;"],
		'columns'=>[
				/* [
					'header' => 'No',
					'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ], */
                [
                    'header' => 'Penumpang | Kursi',
                    'name' => 'jml_penumpang',
                    'type' => 'raw',
                    'value' => function($data) {
                        return Booking::object()->getDetailPenumpang($data['nama_pnp_kursi']);
                    }
                ],
                [
                    'header' => 'Info Detail',
                    'name' => 'naik',
                    'type' => 'raw',
                    'value' => function($data) {
                        $html = "<span style='font-weight: 700;'>No. Tiket: </span>" . $data['booking_id'];
                        $html .= '<br/><br/>Naik: ' . $data['naik'];
                        $html .= '<br/>Penurunan: ' . $data['turun'];
                        $html .= "<br/><br/>Group Trip: " . $data['nama_group'];
                        $html .= "<br/>Kelas: " . $data['kelas_bus'];
                        $html .= "<br/>Tgl Input: " . $data['created_date'];
                        $html .= "<br/>Tgl Keberangkatan: " . $data['tanggal'];
                        $html .= "<br/>Jam Keberangkatan: " . $data['jam'];
                        return $html;
                    }
                ],
                [
                    'header' => 'Total Harga',
                    'name' => 'total_harga'
                ],
                [
                    'header' => 'Aksi',
                    'name' => 'aksi',
                    'type' => 'raw',
                    'value' => function($data) {
                        $etiket = "<a class='btn btn-warning' href='". Constant::baseUrl().'/booking/itinerary?id=' . $data['id'] ."' target='_blank'>Cetak eTicket</a>";
                        $termal = "<a class='btn btn-success' href='". Constant::baseUrl().'/booking/printTiketEdc?id=' . $data['id'] ."' target='_blank'>Cetak EDC (80mm)</a>";
                        $termal58 = "<a class='btn btn-primary' href='". Constant::baseUrl().'/booking/printTiketEdc58?id=' . $data['id'] ."' target='_blank'>Cetak EDC (58mm)</a>";
                        $kertas = "<a class='btn btn-info' href='". Constant::baseUrl().'/booking/printTiketA5?id=' . $data['id'] ."' target='_blank'>Cetak A5</a>";
                        return "$etiket <br/>$termal <br/>$termal58 <br/>$kertas";
                    }
                ]
			],
			)); ?>
		</div>
	</div>

    <script>
    $('#BookingData_startdate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		header: true
	});
    $('#BookingData_enddate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		header: true
	});
    
    $('#filter').on('click', function(){
        var startdate = $('#BookingData_startdate').val();
        var enddate = $('#BookingData_enddate').val();
        // var data = {startdate : startdate, enddate : enddate};
        // updateGrid(data, 'ticketing-reportPenjualan');
        location.href="<?= Constant::baseUrl() . '/' . $this->route . '?startdate=' ?>"+startdate+"&enddate="+enddate;
    });
    function exportExcel()
    {
        var startdate = $('#BookingData_startdate').val();
        var enddate = $('#BookingData_enddate').val();
        window.open("<?= Constant::baseUrl() . '/' . $this->route . '/?' ?>startdate="+startdate+"&enddate="+enddate+"&excel=true");
        return false;
    }
    </script>