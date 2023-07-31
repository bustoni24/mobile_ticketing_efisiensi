<?php
/* @var $this SettingController */
/* @var $model Setting */

$this->breadcrumbs=array(
'Settings'=>array('index'),
'Manage',
);

?>

<div class="pull-right text-right">   
	<?php
	$this->subMenu(array(
	array('label'=>'Refresh', 'url'=>'', 'icon'=>'fa-refresh', array('class' => 'btn btn-success', 'id'=>'btn-refresh')),
	array('label'=>'Tambah', 'url'=>'setting/create', 'icon'=>'fa-plus-circle', array('class' => 'btn btn-info')),
	));
	?>  
</div>
<div class="x_title">
	<h2>Data Setting</h2>
	<div class="clearfix"></div>
</div>


<div class="col-sm-12">
	<div class="card-box table-responsive">

		<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'setting-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			array(
				'header' => '<font color="white">No.</font>',
				'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
				'htmlOptions' => array('style'=>'text-align: center; width:40px;'),
			),
		'name',
		array(
			'header' => 'Value',
			'name' => 'value',
		),
			array(
			'class'=>'CButtonColumn',
			),
			),
			)); ?>

		</div>
	</div>
