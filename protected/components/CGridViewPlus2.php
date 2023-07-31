<?php
 
Yii::import('zii.widgets.grid.CGridView');
 
class CGridViewPlus2 extends CGridView {
 
    public $addingHeaders = array();
 
    public function renderTableHeader() {
        //if (!empty($this->addingHeaders))
            $this->multiRowHeader();
 
        //parent::renderTableHeader();
    }
 
    protected function multiRowHeader() {
        echo CHtml::openTag('thead') . "\n";
       // foreach ($this->addingHeaders as $row) {
            $this->addHeaderRow(); //$row
        //}
        echo CHtml::closeTag('thead') . "\n";
    }
 
 	// each cell value expects array(array($text,$colspan,$options), array(...))
    protected function addHeaderRow($row = "") {
        // add a single header row
        echo '<tr style="background-color: #49afcd;color: #fff;" role="row">
<th rowspan="2" style="text-align: center; vertical-align: middle; width: 92px;" class="sorting_disabled" colspan="1">Nama Barang</th>   

<th colspan="5" style="text-align: center;vertical-align: middle;" rowspan="1">Pembelian</th>
            <th colspan="5" style="text-align: center;vertical-align: middle;" rowspan="1">Pengeluaran</th>
            <th colspan="4" style="text-align: center;vertical-align: middle;" rowspan="1">Saldo</th></tr>
                <tr style="background-color: #49afcd;color: #fff;" role="row">
                <th style="text-align: center; vertical-align: middle; width: 24px;" class="sorting_disabled" rowspan="1" colspan="1">Tgl.</th>
                <th style="text-align: center; vertical-align: middle; width: 44px;" class="sorting_disabled" rowspan="1" colspan="1">No. SOP</th>
                <th style="text-align: center; vertical-align: middle; width: 61px;" class="sorting_disabled" rowspan="1" colspan="1">Kuantitas</th>
                <th style="text-align: center; vertical-align: middle; width: 74px;" class="sorting_disabled" rowspan="1" colspan="1">Harga Satuan</th>
                <th style="text-align: center; vertical-align: middle; width: 62px;" class="sorting_disabled" rowspan="1" colspan="1">Harga Total</th>
                <th style="text-align: center; vertical-align: middle; width: 24px;" class="sorting_disabled" rowspan="1" colspan="1">Tgl.</th>
                <th style="text-align: center; vertical-align: middle; width: 58px;" class="sorting_disabled" rowspan="1" colspan="1">No. BPPBG</th><th style="text-align: center; vertical-align: middle; width: 61px;" class="sorting_disabled" rowspan="1" colspan="1">Kuantitas</th><th style="text-align: center; vertical-align: middle; width: 72px;" class="sorting_disabled" rowspan="1" colspan="1">Harga Satuan</th><th style="text-align: center; vertical-align: middle; width: 60px;" class="sorting_disabled" rowspan="1" colspan="1">Harga Total</th><th style="text-align: center; vertical-align: middle; width: 24px;" class="sorting_disabled" rowspan="1" colspan="1">Tgl.</th><th style="text-align: center; vertical-align: middle; width: 61px;" class="sorting_disabled" rowspan="1" colspan="1">Kuantitas</th><th style="text-align: center; vertical-align: middle; width: 64px;" class="sorting_disabled" rowspan="1" colspan="1">Harga Satuan</th><th style="text-align: center; vertical-align: middle; width: 54px;" class="sorting_disabled" rowspan="1" colspan="1">Harga Total</th></tr>
                ';
    }
 
}
?> 

