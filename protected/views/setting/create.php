<?php
/* @var $this SettingController */
/* @var $model Setting */

$this->breadcrumbs=array(
	'Settings'=>array('index'),
	'Create',
);
?>

<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Create Setting</h2>
			<div class="clearfix"></div>
		</div>
		
		<div class="x_content">

			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</div>