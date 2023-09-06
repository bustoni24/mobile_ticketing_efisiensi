<style>
	table.table > thead > tr > th {
		vertical-align: middle;
    	text-align: center;
	}
</style>
<div class="col-sm-12">

<div class="x_title">
	<h2>Table Laporan Deposit View</h2>
	<div class="clearfix"></div>
</div>

	<div class="card-box">

    <div class="row">
    <div class="col-sm-12">
        <label class="mt-15">Startdate - Enddate</label>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 form-group" style="padding-left: 0;margin-top:10px;">
        <?php echo CHtml::textField('TransactionTicketing[startdate]',$model->startdate,['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off']); ?>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12 form-group" style="padding-left: 0;margin-top:10px;">
        <?php echo CHtml::textField('TransactionTicketing[enddate]',$model->enddate,['placeholder' => 'yyyy-m-dd', 'class' => 'form-control enddate', 'autocomplete' => 'off']); ?>
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
			<div class="dataTables_length"><label>Display <select name="TransactionTicketing[display]" aria-controls="datatable-keytable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records</label>
			</div>
		</div>
		<div class="col-sm-6 pull-right text-right pr-0 mb-0">
			<div class="dataTables_filter"><label>Search:<input type="search" name="TransactionTicketing[filter]" class="form-control input-sm" placeholder="Ketik trip label, nama group" aria-controls="datatable-keytable"></label></div>
		</div>
	</div>
    </div>

		<?php 		
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'ticketing-report-grid',
		'dataProvider'=>$model->searchReportDeposit(),
		'filter'=>null,
		'columns'=>[
				[
					'header' => 'No',
					'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
				],
				[
                    'header' => 'Agen',
                    'name' => 'agen_nama',
                    'value' => function($data) {
                        return $data['agen_nama'];
                    }
                ],
                [
                    'header' => 'Saldo Awal',
                    'name' => 'saldo_awal',
                    'value' => function($data) {
                        return $data['saldo_awal'] != 0 ? Helper::getInstance()->getRupiah($data['saldo_awal']) : $data['saldo_awal'];
                    }
                ],
                [
                    'header' => 'Top Up',
                    'name' => 'top_up',
                    'value' => function($data) {
                        return abs($data['top_up']) > 0 ? Helper::getInstance()->getRupiah(abs($data['top_up'])) : abs($data['top_up']);
                    }
                ],
                [
                    'header' => 'Bonus',
                    'name' => 'bonus',
                    'value' => function($data) {
                        return $data['bonus'] > 0 ? Helper::getInstance()->getRupiah($data['bonus']) : $data['bonus'];
                    }
                ],
                [
                    'header' => 'Penjualan',
                    'name' => 'penjualan',
                    'value' => function($data) {
                        return $data['penjualan'] > 0 ? Helper::getInstance()->getRupiah($data['penjualan']) : $data['penjualan'];
                    }
                ],
                [
                    'header' => 'Komisi Penjualan',
                    'name' => 'komisi_jual',
                    'value' => function($data) {
                        return $data['komisi_jual'] > 0 ? Helper::getInstance()->getRupiah($data['komisi_jual']) : $data['komisi_jual'];
                    }
                ],
                [
                    'header' => 'Komisi Boarding',
                    'name' => 'komisi_boarding',
                    'value' => function($data) {
                        return abs($data['komisi_boarding']) > 0 ? Helper::getInstance()->getRupiah(abs($data['komisi_boarding'])) : abs($data['komisi_boarding']);
                    }
                ],
                [
                    'header' => 'Saldo Akhir',
                    'name' => 'saldo_akhir',
                    'value' => function($data) {
                        return $data['saldo_akhir'] != 0 ? Helper::getInstance()->getRupiah($data['saldo_akhir']) : $data['saldo_akhir'];
                    }
                ]
			],
			)); ?>
		</div>
	</div>

    <script>
    $('#TransactionTicketing_startdate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		header: true
	});
    $('#TransactionTicketing_enddate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		header: true
	});
    
    $('#filter').on('click', function(){
        var startdate = $('#TransactionTicketing_startdate').val();
        var enddate = $('#TransactionTicketing_enddate').val();
        var agen_id = $('#TransactionTicketing_agen_id').val();
        // var data = {startdate : startdate, enddate : enddate};
        // updateGrid(data, 'ticketing-reportPenjualan');
        location.href="<?= Constant::baseUrl() . '/' . $this->route . '?startdate=' ?>"+startdate+"&enddate="+enddate;
    });
    function exportExcel()
    {
        var startdate = $('#TransactionTicketing_startdate').val();
        var enddate = $('#TransactionTicketing_enddate').val();
        var agen_id = $('#TransactionTicketing_agen_id').val();
        window.open("<?= Constant::baseUrl() . '/' . $this->route . '/?' ?>startdate="+startdate+"&enddate="+enddate+"&excel=true");
        return false;
    }
    </script>