<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Tentang MNI</h2>
			<div class="clearfix"></div>
		</div>
		
		<div class="x_content">


			<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'about-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)); ?>

				<?php echo $form->errorSummary($model); ?>

				<?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
					echo '<div class="alert alert-'. $key .' alert-dismissible fade in" role="alert">'.
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. $message .'</div>';
				}
				?>

				<div class="row">
					<?php echo $form->labelEx($model,'name', array('label' => 'Title')); ?>
					<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($model,'name'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'value', array('label' => 'Description')); ?>
					<?php echo $form->textArea($model,'value',array('rows'=>60,'cols'=>2)); ?>
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

<script type="text/javascript">
	tinymce.init({ 

		selector: "textarea",
		theme: "modern",
		plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor colorpicker textpattern imagetools",
		"autoresize autosave codesample example example_dependency",
		"importcss layer legacyoutput noneditable spellchecker tabfocus jbimages"
		],
		toolbar1: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
		image_advtab: true

	});

	var alert = $('.alert');
	if (typeof(alert) !== "undefined" && alert.length > 0){
		alert.delay("5000").hide("slow");
	}
</script>