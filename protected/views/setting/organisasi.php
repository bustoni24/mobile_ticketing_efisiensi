<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Organisasi MNI</h2>
			<div class="clearfix"></div>
		</div>
		
		<div class="x_content">


			<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'organisasi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
					'htmlOptions' => array('enctype' => 'multipart/form-data'),
				));

				if($model['value']!=''){
					$photo = $model['value'];
					$baseUploadPath = Constant::baseUploadsPath().'/content/'.$photo;
				}else{
					$photo = 'no_image.png';
					$baseUploadPath = Constant::baseUploadsPath().'/'.$photo;
				}	

				 ?>

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
					<?php echo $form->labelEx($model,'value', array('label' => 'Struktur Organisasi')); ?>
					<?php echo $form->fileField($model,'value',array('accpet'=>'image/*')); ?>
					<?php echo $form->error($model,'value'); ?>
				</div>

				<div class="row">
					<label class="col-sm-2 control-label left">Photo</label>
					<div class="col-sm-10">
						<label style="border: 10px solid #f9e6e6; width: 30%;margin-left: 5%; padding: 5px">
							<img id="image" src="<?php echo $baseUploadPath; ?>" alt="Image" width="100%">
						</label>
					</div>
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
	document.getElementById("Setting_value").onchange = function () {
	    var reader = new FileReader();                   
	    reader.onload = function (e) {
               
	        // get loaded data and render thumbnail.
	        document.getElementById("image").src = e.target.result;
	    };
	    // read the image file as a data URL.
	    reader.readAsDataURL(this.files[0]);
	};

	var alert = $('.alert');
	if (typeof(alert) !== "undefined" && alert.length > 0){
		alert.delay("5000").hide("slow");
	}
</script>