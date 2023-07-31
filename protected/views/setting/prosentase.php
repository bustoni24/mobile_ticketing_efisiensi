<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2><?= $title; ?></h2>
			<div class="clearfix"></div>
		</div>
		
		<div class="x_content">


			<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'setting-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
					'htmlOptions' => array('enctype' => 'multipart/form-data'),
				));
				 ?>

				<?php echo $form->errorSummary($model); ?>

				<?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
					echo '<div class="alert alert-'. $key .' alert-dismissible fade in" role="alert">'.
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. $message .'</div>';
				}
				?>

				<div class="row">
					<?php echo $form->numberField($model,'value'); ?>
					<?php echo $form->error($model,'value'); ?>
				</div>

				<div class="row buttons">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
				</div>

				<?php $this->endWidget(); ?>

			</div>

		</div>
	</div>
</div>