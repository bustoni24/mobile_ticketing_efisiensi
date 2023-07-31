
<?php 
$baseUrl = Yii::app()->assetManager->publish('./themes/gentelella');
?>
<!DOCTYPE html>
<html >
<head>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title>Login Form</title>
  
  <link rel="icon" type="image/png" href="<?php echo Constant::getImageUrl() . '/icon.png'; ?>"/>
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  
  <!-- Bootstrap -->
  <link href="<?php echo $baseUrl; ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo $baseUrl; ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo $baseUrl; ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="<?php echo $baseUrl; ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?php echo $baseUrl; ?>/build/css/custom.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="<?php echo $baseUrl; ?>/css/loader.css" rel="stylesheet">
  <style>
    :root {
      --color-primary: #F58220;
      --bg-primary: #6C6D70;
      --bg-white: #fff;
      --bg-secondary: #F2F2F2;
      --bg-header-table: #FDD9B7;
      --color-secondary: #FEF0E2;
      --border-table: #848484;
      --color-link: #007bff;
      --black: #000;
      --bg-danger: #FECA0A;
      --bg-red: #d9534f;
      --btn-danger: #c9302c;
      --btn-danger-border: #ac2925;
      --color-success: #07c16c;
    }
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      body {
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  background-color: #00283A 50% fixed;
  background-size: cover;
}

@keyframes spinner {
  0% {
    transform: rotateZ(0deg);
  }
  100% {
    transform: rotateZ(359deg);
  }
}
* {
  box-sizing: border-box;
}

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
  background: #ffffff;
}

.login {
  margin-top: 90px;
  border-radius: 8px;
  padding: 10px 20px 20px 20px;
  width: 98%;
  max-width: 768px;
  background: #ffffff;
  position: relative;
  padding-bottom: 50px;
  box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
}
.login.loading button {
  max-height: 100%;
  padding-top: 50px;
}
.login.loading button .spinner {
  opacity: 1;
  top: 40%;
}
.login.ok button {
  background-color: #8bc34a;
}
.login.ok button .spinner {
  border-radius: 0;
  border-top-color: transparent;
  border-right-color: transparent;
  height: 20px;
  animation: none;
  transform: rotateZ(-45deg);
}
.login input {
  display: block;
  padding: 15px 10px;
  margin-bottom: 10px;
  width: 100%;
  border: 1px solid #ddd;
  transition: border-width 0.2s ease;
  border-radius: 30px;
  outline: none;
  border-color: var(--color-primary);
  border-left-width: 45px;
}
.login input + i.fa {
  color: #fff;
  font-size: 1em;
  position: absolute;
  margin-top: -47px;
  opacity: 1;
  left: 37px;
  transition: all 0.25s ease-out;
}
.login a {
  font-size: 0.8em;
  color: #2196F3;
  text-decoration: none;
}
.login .title {
  color: #444;
  font-size: 1.2em;
  font-weight: bold;
  margin: 10px 0 20px 0;
  border-bottom: 1px solid #eee;
  padding-bottom: 20px;
}
.login button {
  width: 90%;
  height: 100%;
  padding: 10px 10px;
  background: var(--color-primary);
  color: #fff;
  position: relative;
  border: none;
  margin-top: 20px;
  position: absolute;
  max-height: 60px;
  border: 0px solid rgba(0, 0, 0, 0.1);
  border-radius: 30px;
  transform: rotateZ(0deg);
  transition: all 0.1s ease-out;
  border-bottom-width: 7px;
}
.login button .spinner {
  display: block;
  width: 40px;
  height: 40px;
  position: absolute;
  border: 4px solid #ffffff;
  border-top-color: rgba(255, 255, 255, 0.3);
  border-radius: 100%;
  left: 50%;
  top: 0;
  opacity: 0;
  margin-left: -20px;
  margin-top: -20px;
  animation: spinner 0.6s infinite linear;
  transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
  box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
}
.login:not(.loading) button:hover {
  box-shadow: 0px 1px 3px #2196F3;
}
.login:not(.loading) button:focus {
  border-bottom-width: 4px;
}

footer {
  display: block;
  padding-top: 50px;
  text-align: center;
  color: #ddd;
  font-weight: normal;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.2);
  font-size: 0.8em;
}
footer a, footer a:link {
  color: #fff;
  text-decoration: none;
}

.judul{
  text-transform: uppercase;
  font-size: 24px;
  font-weight: 700;
  color: #000;
  margin-bottom: 30px;
}
.container-button{
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  padding: 20px;
  flex-wrap: wrap;
}
.divider{
  display: block;
    margin: 40px 0px 30px 0px;
    text-align: center;
}
.container-button button[name="register"] {
  background-color : var(--color-success);
}
.none {
  display: none!important;
}
#preloader{
  position: fixed;
  z-index: 999;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #eeeeeef5;
}
#preloader .jumper{
  text-align: center;
}
#preloader img {
  width: 50%;
}
.top-nav{
    padding: 15px;
    font-size: 18px;
    background-color: var(--bg-primary);
    color: #fff;
    text-align: center;
    font-weight: 700;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    position: fixed;
    width: 100%;
    z-index: 9;
    top: 0;
    height: 80px;
}
.top-nav img{
  width: 150px;
  margin-right: 15px;
}
.top-nav .menus{
  position: absolute;
    left: 10px;
}
@font-face {
    font-family: 'Copperplate';
    src: url(<?= Constant::baseUrl().'/fonts/copperplate/COPRGTB.TTF'; ?>) format('truetype');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'Copperplate regular';
    src: url(<?= Constant::baseUrl().'/fonts/copperplate/regular.ttf'; ?>) format('truetype');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'Copperplate bold';
    src: url(<?= Constant::baseUrl().'/fonts/copperplate/bold.ttf'; ?>) format('truetype');
    font-weight: 700;
    font-style: normal;
}
.box-loader {
  font-size: 250%;
  color: var(--color-primary);
}
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader" class="none">
        <div class="jumper">
          <div class="box-loader"><div class="loader-04"></div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <?php echo $content ?>
  
    <script>
    $('#register').on('click', function(){
        window.location.href = "<?= Constant::baseUrl().'/front/chooseRegister' ?>";
    });
    $('.top-nav').on('click', function(){
            window.location.href="<?= Constant::baseUrl().'/'; ?>";
        });
    $(window).bind('load', function() {
            $('#preloader').removeClass('none');
            setTimeout(function() {
                $('#preloader').css({'display':'none'});
            }, 500)
        });
    </script>
  </body>
  </html>