<section class="section register" id="login_member">
        <div class="container">
            <div class="row">
                
                <div class="content-image">
                    <div class="wrapper" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <?php 
                    $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        // 'enableClientValidation'=>true,
                        'enableAjaxValidation' => true,
                    )); 
                    ?>

                    <div class="login-title pb-20">
                        <h1 class="title" style="text-align: center;"> Kode Verifikasi </h1>
                        <p style="margin-top: 10px;">Konfirmasi kode verifikasi dengan input kode dan klik button 'Verifikasi'</p>
                    </div>

                    <div class="<?php echo $message['status'] ?>-message <?php echo !empty($message['message']) ? '' : 'none' ?>">
                      <?= $message['message'] ?>
                    </div>

                    <div class="register-body">
                      
                      <div class="login-body">

                         <div class="row-fluid">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                              </div>
                              <?php echo $form->textField($model, 'kode_verifikasi', array('class' => 'form-control', 'placeholder' => 'Kode verifikasi', 'maxlength' => 128)); ?>
                              <?php echo $form->error($model, 'kode_verifikasi'); ?>
                          </div>
                        </div>

                      </div>
                    </div>  

                    <div class="login-body pb-15">
                      <div class="row-fluid">
                        <div class="container-button">
                          <button name="verifikasi" type="submit">
                            <span class="state">Verifikasi</span>
                          </button>
                        </div>
                      </div>    
                    </div>              

                     <?php $this->endWidget(); ?>
                    </div>
                </div>

                    <div class="background-organization"></div>
                
            </div>
        </div>
    </section>