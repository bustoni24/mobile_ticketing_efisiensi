<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<style>
	.col-middle{
		margin-top: 10%;
	}
</style>
<div class="col-md-12" style="width:100%;">
	<div class="col-middle">
		<div class="text-center">
			<h1 class="error-number"><?php echo $code == "404"?"":"Error ".$code; ?></h1>

			<p><?php echo CHtml::encode($message); ?></p>
			<div class="mid_center">
				<h3>Go Back</h3>
				<a href="javascript:window.history.back()" class="btn btn-primary"> Back</a>
			</div>
		</div>
	</div>
</div>