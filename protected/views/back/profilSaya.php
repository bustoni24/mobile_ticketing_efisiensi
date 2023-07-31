<div class="profil">
    <hr/>
    <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username', ['label' => 'Email / Username']); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128,'readonly'=>true)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alamat'); ?>
		<?php echo $form->textField($model,'alamat',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'alamat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_hp'); ?>
		<?php echo $form->textField($model,'no_hp',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'no_hp'); ?>
	</div>

	<div class="row">
      <?php echo $form->labelEx($model,'password', array('label' => 'Password Lama (diisi jika ingin ubah password)')); ?>
      <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>256, 'value' => '' )); ?>
      <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row">
      <label class="required">Password Baru (diisi jika ingin ubah password)<span class="required"> *</span></label>
      <?php echo Chtml::passwordField('password', ''); ?>
    </div>

    <div class="row">
      <label class="required">Ulangi Password Baru<span class="required"> *</span></label>
      <?php echo Chtml::passwordField('confirm_password', ''); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Perbarui Data'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>

<script>
  var password = document.getElementById("password"), 
  confirm_password = document.getElementById("confirm_password");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
</script>