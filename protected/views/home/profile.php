<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Profil Saya</h2>
			<div class="clearfix"></div>
		</div>
		
		<div class="x_content">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'profile-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.,
            'enableAjaxValidation'=>false,
            'htmlOptions' => ['onsubmit'=>'return onSubmitForm(event)']
        )); 
        ?>
        
        <table class="table">
            <tr>
                <th width="30%">Nama</th>
                <td style="width: 10px;">:</td>
                <td><?= $nama; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td style="width: 10px;">:</td>
                <td><?= $email; ?></td>
            </tr>
            <tr>
                <th>No Hp</th>
                <td style="width: 10px;">:</td>
                <td><?= $no_hp; ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td style="width: 10px;">:</td>
                <td><?= $alamat; ?></td>
            </tr>
            <tr>
                <th colspan="3"><span class="red">Isi password jika ingin mengubah</span></th>
            </tr>
            <tr>
                <th>Password</th>
                <td style="width: 10px;">:</td>
                <td><?= CHtml::passwordField("User[old_passwprd]", "", ['class' => 'form-control', 'placeholder' => 'ketik password lama']); ?></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
                <td><?= CHtml::passwordField("User[new_passwprd]", "", ['class' => 'form-control', 'placeholder' => 'ketik password baru']); ?></td>
            </tr>
        </table>

        <div class="row buttons pull-right">
            <button class="btn btn-warning">Simpan</button>
            <button type="button" onclick="history.back();" class="btn btn-outline-warning resetBtn"><i class="fa fa-reply"></i> Kembali</button>
        </div>
        <?php $this->endWidget(); ?>

        </div>
    </div>
</div>
