<div id="loginScreen" class="abm-login-screen">
  
  <div class="abm-agile-login-wrap">

    <div class="abm-agile-logo-wrap">
      <img class="abm-agile-logo" src="<?= Constant::newLogoIcon(); ?>" />
    </div>

    <?php
        $form=$this->beginWidget('CActiveForm', array(
          'id'=>'login-form',
          'enableClientValidation'=>false,
          'clientOptions'=>array(
          'validateOnSubmit'=>false
          ),
          'htmlOptions' => ['class'=>'abm-login-form'],
        )); 
        ?>
    
      <div class="abm-input-group">      
        <input placeholder="Username" name="LoginFormAdmin[username]" type="text" autocomplete="new-username" id="username" required>
        <span class="abm-highlight"></span>
        <span class="abm-input-bar"></span>
        <label>Username</label>
      </div>

      <div class="abm-input-group">      
        <input placeholder="Password" name="LoginFormAdmin[password]" type="password" autocomplete="new-password" id="password" required>
        <span class="abm-highlight"></span>
        <span class="abm-input-bar"></span>
        <label>Password</label>
      </div>
      
      <div class="abm-checkbox-group">
        <input class="abm-checkbox abm-checkbox--light-green" id="rememberMyLogin" type="checkbox"><label for="rememberMyLogin">Remember Me</label>
      </div>

      <span style="float:left;color: #ffc107;margin-top: 20px;text-align: center;width: 100%;">
      <?php  echo $form->error($model,'username'); ?>
      <?php  echo $form->error($model,'password'); ?>
      </span>
      
      <button class="abm-login-button" type="submit">
        Login
      </button>
      
    <?php $this->endWidget(); ?>
    
  </div>
  
</div>

<script>
  setTimeout(function() {
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
  }, 500);
</script>