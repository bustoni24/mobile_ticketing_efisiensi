<div class="container-fluid p-0">
    <div class="row mx-0">

        <div class="col col-md-12 col-lg-12 col-xl-12 p-0">
            <div class="d-flex flex-column justify-content-center bg-light p-3 p-sm-5 vh-100">
                <div class="mx-auto width-custom" style="margin-bottom: -1.75em">
                    <div class="text-center">
                        <h1 class="main-title color-primary"><?= Constant::PROJECT_NAME; ?></h1>
                    </div>

                    <div class="login-title">
                       Login ke dashboard
                    </div>

                    
                    <!-- <form class="mt-3" action="#" method="post" role="form"> -->
                    <?php
                    $form=$this->beginWidget('CActiveForm', array(
                      'id'=>'login-form',
                      'enableClientValidation'=>false,
                      'clientOptions'=>array(
                      'validateOnSubmit'=>false
                      ),
                      'htmlOptions' => ['class'=>'row g-3 needs-validation'],
                    )); 
                    ?>
                        <div class="form-group form-group-custom">
                            <input class="form-control form-control-lg" placeholder="Email" name="LoginForm[username]" type="email" autocomplete="off" required autofocus>
                            <i data-feather="user"></i>
                        </div>

                        <div class="form-group form-group-custom mb-1">
                            <input class="form-control form-control-lg" placeholder="Password" name="LoginForm[password]" type="password" autocomplete="off" required>
                            <i data-feather="lock"></i>
                            <i class="btn-toggle-password btn-toggle-password-hide d-none" data-feather="eye"></i>
                            <i class="btn-toggle-password btn-toggle-password-show d-none" data-feather="eye-off"></i>
                        </div>

                        <!-- <p class="m-0 text-right">
                            <small>
                                <a class="text-muted" href="<?= Constant::baseUrl().'/site/forgotPassword' ?>">Lupa password?</a>
                            </small>
                        </p> -->

                        <button class="btn btn-lg btn-primary btn-block btn-login mt-3 mb-4" type="submit">Login</button>
                        
                        <hr class="mt-4">

                    <span style="float:left;color: red;margin-top: 20px;text-align: center;width: 100%;">
                    <?php  echo $form->error($model,'username'); ?>
                    <?php  echo $form->error($model,'password'); ?>
                    </span>
                    <!-- </form> -->
                    <?php $this->endWidget(); ?>

                    <p class="mt-5 text-center login-title">
                        <span>Belum punya akun? <a href="<?= Constant::baseUrl().'/register' ?>">Register</a></span>
                    </p>
                </div>
              
            </div>
        </div>

    </div>
</div>