<?php
$baseUrl = Yii::app()->assetManager->publish('./themes/gentelella');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title><?= Constant::PROJECT_NAME; ?></title>
   <!-- Bootstrap -->
   <link href="<?php echo $baseUrl; ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $baseUrl; ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $baseUrl; ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $baseUrl; ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo $baseUrl; ?>/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo $baseUrl; ?>/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <link href="<?php echo $baseUrl; ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $baseUrl; ?>/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_text.png" rel="SHORTCUT ICON" />
    <link href="<?php echo $baseUrl; ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
   
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/tinymice/tinymce.min.js"></script>
    <link href="<?= $baseUrl; ?>/css/main_custom.css" rel="stylesheet"/>
    <script src="<?php echo $baseUrl; ?>/js/jquery.js"></script>
  <script src="<?php echo $baseUrl; ?>/js/jquery.ba-bbq.js"></script>
  <link href="<?php echo $baseUrl; ?>/css/loader.css" rel="stylesheet">
  <?php
  Yii::app()->clientScript->scriptMap = array(
      'jquery.js' => false,
      'jquery.ba-bbq.js' => false
  );
  ?>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
        --bg-light-grey: #efefef;
        --color-submit: #0C9;
        }
        .container {
            max-width: 500px;
        }
        .none {
        display: none!important;
        }
        .nav-md .container.body .right_cols {
        margin-left:0;
        }
        #preloader, #loaderWaitingRoutes{
        position: fixed;
        z-index: 999;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #eeeeeef5;
        max-width: 500px;
        }
        #preloader .jumper, #loaderWaitingRoutes .jumper{
        text-align: center;
        }
        #preloader img, #loaderWaitingRoutes img {
        width: 50%;
        }
        #preloader, #loaderWaitingGeocode{
        position: fixed;
        z-index: 999;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #eeeeeef5;
        max-width: 500px;
        }
        #preloader .jumper, #loaderWaitingGeocode .jumper{
        text-align: center;
        }
        #preloader img, #loaderWaitingGeocode img {
        width: 50%;
        }
        span.required {
        color: red!important;
        }
        .main_container .top-nav{
        padding: 10px 15px;
        font-size: 18px;
        background-image: linear-gradient(to right, var(--bg-primary) , var(--border-table));
        color: #fff;
        text-align: center;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: fixed;
        width: 100%;
        max-width: 500px;
        z-index: 9;
        top: 0;
        height: 90px;
    }
    .justify-between {
        justify-content: space-between;
    }
    .nav-md .container.body .right_cols {
    margin-top: 90px;
    width:100%;
    background-color: #fff;
    }
    @media (max-width: 991px){
      .nav-md .container.body .right_cols {
        margin-top: <?= ($this->action->Id == 'homePage' ? '110px' : '140px'); ?>;
        }  
        
    }
    .btnSuccess{    
    padding: 10px 20px;
    background: #6c4292;
    border: none;
    font-size: 1.8rem;
    }
    .top-nav img{
        position: absolute;
        left: 10px;
        width: 24px;
    }
    .right_cols .x_panel{
        min-height: 87vh;
        padding-bottom: 50px;
    }
    .errorMessage{
        color: red;
    }
    .loader {
    border: 4px solid #f3f3f3;
    border-radius: 50%;
    border-top: 4px solid #3498db;
    width: 32px;
    height: 32px;
    -webkit-animation: spin 1s linear infinite; /* Safari */
    animation: spin 1s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
    .main_container .forceHomePage {
        justify-content: center;
        justify-content: center;
    background-image: none;
    background-color: #fff;
    height: 60px;
    padding: 5px;
    }
    .forceHomePage .content-text {
    margin-left: 20px;
}
    .main_container .forceHomePage img {
        width: 24px;
        position: relative;
    }
    .forceHomePage .menus{
    position: absolute;
    left: 10px;
    color: #3f428e;
}
.fixed{
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .fixed .container-fixed {
        padding: 14px 10px;
    width: 90%;
    text-align: center;
    background-color: #6C4292;
    border-radius: 10px 10px 0px 0px;
    box-shadow: #969696 2px 1px 7px 2px;
    color: #fff;
    font-size: 1.8rem;
    font-weight: 700;
    }
	.form{
		margin-bottom: 60px;
	}
    .disabledRegister {
		background-color: #b275e8!important;
	}
    .flash-error {
        padding: 10px;
        border: 1px solid red;
        color: red;
    }
    .flash-success {
        padding: 10px;
        border: 1px solid green;
        color: green;
    }
    .flash-warning {
        padding: 10px;
        border: 1px solid orange;
        color: orange;
    }
    @font-face {
    font-family: 'Copperplate';
    src: url(<?= Constant::baseUrl().'/fonts/copperplate/default.TTF'; ?>) format('truetype');
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
    .container-history {
        overflow-x: auto;
    }
    .overflowX {
        overflow-x: auto;
    }
    .successTrx{
        padding: 5px;
        border: 1px solid green;
        color: green;
        border-radius: 5px;
    }
    .failTrx{
        padding: 5px;
        border: 1px solid red;
        color: red;
        border-radius: 5px;
    }
    span.active{
	padding: 5px;
    border: 1px solid green;
    color: green;
    border-radius: 5px;
    }
    span.notactivenoborder{
	padding: 5px;
    color: red;
    }
    .menu-container{
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        z-index: 7;
    }
    .navigation .row-0{
        margin-left: 0;
        margin-right: 0;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        justify-content: center;
    }
    .navigation .coll{
        -webkit-flex-basis: 0;
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
    padding: 8px 0;
    }
    .navigation .menu-item {
        display: block;
    color: var(--bg-primary);
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
    text-align: center;
    }
    .navigation .menu-item .txt {
    display: block;
    margin-top: 5px;
    font-size: 10px !important;
    line-height: 1 !important;
    white-space: nowrap;
    }
    .navigation .menu-item .fa {
        font-size: 2rem;
    }
    .navigation .coll_aktif {
        border-top: 2px solid #fff;
        background-color: var(--color-primary);
    }
    .coll_aktif .menu-item {
        color: var(--bg-white);
    }
    .navigation .aktif {
        color: #fff;
    }
    .navigation .coll a:focus {
        color: #fff;
    }
    .navigation .d-flex {
        display: flex;
        width: 100%;
        max-width: 500px;
        background: var(--bg-secondary);
    }
    img.img-logo {
        width: 120px;
        position: initial;
    }
    .gj-datepicker-bootstrap [role=right-icon] button {
        height: 40px;
    }
    .input-group {
        display: flex;
        width: 100%;
    }
    .grey-dark {
        background-color: var(--bg-light-grey)!important;
        color: var(--black)!important;
        border-radius: 8px 8px 0px 0px;
    }
    .card-booking {
        border: 1px solid var(--bg-light-grey);
        border-radius: 8px;
        cursor: pointer;
        margin-bottom: 10px;
    }
    .card-booking .content-card {
        padding: 10px 10px;
    }
    .card-booking .border-all {
        border-radius: 8px;
    }
    .content-card span.badge-booking {
        padding: 6px 8px;
        background-color: var(--color-primary);
        color: var(--bg-white);
        font-weight: 700;
        border-radius: 8px;
    }
    .card-header {
        border: 1px solid var(--bg-light-grey);
        border-radius: 8px;
        padding: 5px 10px;
        margin-bottom: 10px;
    }
    #listViewTrip .table-bordered {
        border: none;
        display: contents;
    }
    .input-group-btn {
        width: auto;
    }
    .box-loader {
        font-size: 250%;
        color: var(--color-primary);
        }
    .mt-10 {
        margin-top: 10px!important;
    }
    .mt-20 {
        margin-top: 20px!important;
    }
    .mt-0{
        margin-top: 0px!important;
    }
    .pt-10 {
        padding-top: 10px;
    }
    .pt-20 {
        padding-top: 20px;
    }
    .table {
        padding: 10px;
    }
    .table span.empty{
        padding: 10px;
        font-size: 1.5rem;
    }

/* DECK */
    .layout-deck {
    position: relative;
}
.layout-deck .header-deck {
    padding: 10px;
    text-align: center;
    background-color: #ffdbab;
    margin-top: 30px;
}
.layout-deck .header-deck span{
    padding: 8px 20px;
    background-color: #ffdbab;
    border-radius: 42%;
    position: absolute;
    top: -5px;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: 700;
}
.img-icon{
    width: 80%;
}

    .checkbox-wrapper {
        display: inline-block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 15px;
        cursor: pointer;
    }

    .checkbox-wrapper input {
        opacity: 0;
        cursor: pointer;
    }

    .checkmark {
        z-index: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        height: 45px;
        width: 45px;
        background-image: url('<?= Constant::iconSeat() ?>');
        background-size: cover;
        transform: translate(-50%, -50%);
    }

    .checkbox-wrapper input:checked ~ .checkmark {
        z-index: 0;
        background-image: url('<?= Constant::iconSeat("selected") ?>');
        left: 70%;
    }

    .booked {
        z-index: 0;
        background-image: url('<?= Constant::iconSeat("booked") ?>');
        left: 70%;
    }

    .booked-girl {
        z-index: 0;
        background-image: url('<?= Constant::iconSeat("temporary") ?>');
    }

    .text-checkmark{
        position:absolute;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-weight: 700;
        font-size: smaller;
    }
    table.table-deck>tbody>tr>td {
        padding: 2px;
    }
    .body-deck {
        padding: 5px 20px;
    }
    .layout-form-deck{
        padding: 5px 10px;
        border: 1px solid var(--bg-light-grey);
        overflow: auto;
    }
    .img-icon {
        width: 60px;
    }
    .door {
        vertical-align: middle!important;
    text-align: center;
    background-color: antiquewhite;
    }
    table.border-none>tbody>tr>td{
        border: none!important;
    }
    .float-div {
        width: auto;
        height: 40px;
        padding: 0px;
        border-radius: 50px;
        text-align: center;
        font-size: 1.5rem;
        border: none;
    }
    .float-btn {
        width: auto;
        height: 40px;
        padding: 10px;
        color: #f5f5f5;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
        font-size: 1.5rem;
        border: none;
    }
    .btn-submit {
        background-color: var(--color-submit);
    }
    .mb-0 {
        margin-bottom: 0;
    }
    .mb-50 {
        margin-bottom: 50px;
    }
    .mb-70 {
        margin-bottom: 70px!important;
    }
    .container-button-float {
        position: fixed;
        left: 0;
        bottom: 60px;
        width: 100%;
        z-index: 7;
    }

    .container-button-float .row-0{
        margin-left: 0;
        margin-right: 0;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        justify-content: center;
    }

    .container-button-float .button-float{
        width: 100%;
        max-width: 500px;
        float: right;
        text-align: right;
    }

    .d-flex {
        display: flex;
    }
    .align-items-baseline {
        align-items: baseline;
    }
    .tagname-container span, .tagname-container a {
        font-size: 11px;
    }
    .tagname-container {
        text-align: left;
        display: flex;
        width: 70%;
        flex-wrap: wrap;
        flex-direction: column;
        margin-top: 25px;
    }
    .container-icon {
        display: flex;
        justify-content: center;
        margin-top: 25px;
    }
    .w-50 {
        width: 50%;
    }
    .w-100 {
        width: 100%;
    }
    .btn-scan-crew {
        font-size: 1.8rem;
        border-radius: 20px;
        padding: 10px 20px;
    }
    .mb-15{
        margin-bottom: 15px;
    }
    .border-none {
        border: none;
    }
    .p-0 {
        padding: 0!important;
    }
    .text-right {
        text-align: right;
    }
    .text-left {
        text-align: left;
    }
    .justify-end {
        justify-content: end;
    }
    .container-button-float .button-float-left-side {
        width: 100%;
        max-width: 500px;
        float: left;
        text-align: left;
        margin-left: 10px;
    }
    .icon-img {
        width: 70%;
    }
    .pl-5 {
        padding-left: 5px!important;
    }
    .red {
        color: red!important;
    }
    .tagname-container h5 {
        font-size: 12px;
    }
    .grid-view{
        overflow-x: auto;
    }
    </style>
</head>
  <body class="nav-md">

  <!-- popup -->
  <div class="lightbox-popup" style="display: none;">
            <div class="box">
            <div class="inner-box">
                <div class="container">
                    <div class="content-container"></div>
                    <a href="javascript:void(0);" class="closed">X</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end popup -->

    <div class="container body">
        <div class="main_container">

        <div class="top-nav <?= ($this->action->Id == 'homePage' ? 'forceHomePage' : ''); ?>">
            <?php if ($this->action->Id == 'homePage'): ?>
            <div class="menus">
                <span style="font-size:30px;font-weight:700;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>
            
            <?php else: ?>

            <?php if (isset(Yii::app()->user->id, Yii::app()->user->role) && !in_array($this->action->Id, ['profil','konfirmasiCheckpoint'])){ ?>
                
            <?php } else if ($this->action->Id == 'homePage'){} else { ?>
                <img src="<?= Constant::getImageUrl().'/back_btn.png'; ?>" id="backBtn" />
            <?php } ?>

            <?php if (in_array(Yii::app()->user->role, ['Agen','Sub Agen'])): ?>
                <div class="tagname-container mb-10">
                    <h5 class="mb-0">Nama: <?= Yii::app()->user->nama; ?></h5>
                    <div class="d-flex align-items-baseline">
                    <span>Saldo: </span>
                    </div>
                    <div class="d-flex align-items-baseline mb-15">
                        <?php
                            $saldo = 0;
                            $saldo = isset(Yii::app()->user->saldo) && !empty(Yii::app()->user->saldo) ? Yii::app()->user->saldo : 0;
                            $saldo = (int)Helper::getInstance()->getState(Constant::AGEN_SALDO);
                        ?>
                        <span>Rp </span><span id="topSaldo"> <?= ($saldo > 0 ? Helper::getInstance()->getRupiah($saldo) : '0' ); ?></span><span>,-</span> &nbsp;&nbsp;&nbsp;<a href="<?= Constant::baseUrl().'/home/topUpSaldo'; ?>" class="btn btn-success">Tambah Saldo</a>
                    </div>
                </div>

                <div class="content-text text-center container-icon w-50">
                    <img src="<?= Constant::newLogoIcon(); ?>" alt="logo" class="img-logo" style="width:30%;height:30px;"/>
                </div>

            <?php else: ?>
                <div class="content-text text-center container-icon w-100">
                    <img src="<?= Constant::newLogoIcon(); ?>" alt="logo" class="img-logo" style="width:30%;height:30px;"/>
                </div>
            <?php endif; ?>

            <?php endif; ?>
        </div>

        <!-- ***** Preloader Start  ***** -->
        <div id="preloader" class="none">
            <div class="jumper">
                <h5 id="additionalText"></h5>
                <div class="box-loader"><div class="loader-04"></div></div>
            </div>
        </div>
        <div id="loaderWaitingRoutes" class="none">
            <div class="jumper">
                <h5 id="additionalText">Kalkulasi Lokasi Rute Bus</h5>
                <div class="box-loader"><div class="loader-01"></div></div>
            </div>
        </div>
        <div id="loaderWaitingGeocode" class="none">
            <div class="jumper">
                <h5 id="additionalText">Sedang kalkulasi lokasi Anda, mohon tunggu beberapa menit...</h5>
                <div class="box-loader"><div class="loader-01"></div></div>
            </div>
        </div>
        <!-- ***** Preloader End ***** -->
            <!-- page content -->
            <div class="right_cols" role="main">
                    <div class="x_panel">
                        
                        <?php echo $content; ?>

                        <?php 
                        if (isset(Yii::app()->user->id, Yii::app()->user->role) && in_array($this->Id, ['home','booking','report'])){
                            $this->renderPartial('/layouts/fix_navbar'); 
                        }
                        ?>
                    </div>
            </div>
            <!-- /page content -->

        </div>
        </div>

    <!-- jQuery -->
    <?= AppAsset::registerJs(); ?>
    <script type="text/javascript">
        <?php if (isset(Yii::app()->user->role) && in_array(Yii::app()->user->role, ['Agen','Sub Agen'])): ?>
        function doWork() {
            getUpdateSaldo(<?= Yii::app()->user->agen_id ?>);
            repeater = setTimeout(doWork, 3000);
        }
        doWork();
    <?php endif; ?>

        $('a.closed').click(function() {
            $('.lightbox-popup').hide();
        });
        // Pasang event handler untuk 'beforeunload'
        $(window).on('beforeunload', function() {
            $('#preloader').removeClass('none');
        });
        /* $(window).bind('load', function() {
            $('#preloader').addClass('none');
        }); */
        function onQuit()
        {
            $('#preloader').addClass('none');
        }
        window.onunload = onQuit;

        $('#backBtn').on('click', function(){
            window.history.go(-1);
        });
        let actionId = "<?= $this->action->Id ?>";
        if (actionId == 'registerArmada' || actionId == 'registerCheckpoint' || actionId == 'registerTkp' || actionId == 'addJourney') {
            $(":input").on("keyup change", function(e) {
                    e.preventDefault();
                    checkEnableButton();
                });
                function checkEnableButton() {
                    var btnEnabled = true;
                    $(".form-control").each(function() { 
                        var required = $(this).prev();
                        var parent = $(this).parent();
                        
                        if (required !== "undefined" && parent !== "undefined" && !parent.hasClass('none') && required.hasClass('required')) {
                            if ($(this).val() === "" || parent.hasClass('error'))
                                btnEnabled = false;
                        }
                    });

                    if (btnEnabled === true){
                        if ($('#onRegister').children().hasClass('disabledRegister'))
                            $('#onRegister').children().removeClass('disabledRegister');
                    } else {
                        $('#onRegister').children().addClass('disabledRegister');
                    }
                }
        }

        jQuery(function($) { $.extend({
    form: function(url, data, method) {
        if (method == null) method = 'POST';
        if (data == null) data = {};

        var form = $('<form>').attr({
            method: method,
            action: url
         }).css({
            display: 'none'
         });

        var addData = function(name, data) {
            if ($.isArray(data)) {
                for (var i = 0; i <= data.length; i++) {
                    var value = data[i];
                    addData(name + '[]', value);
                }
            } else if (typeof data === 'object') {
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        addData(name + '[' + key + ']', data[key]);
                    }
                }
            } else if (data != null) {
                form.append($('<input>').attr({
                  type: 'hidden',
                  name: String(name),
                  value: String(data)
                }));
            }
        };

        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                addData(key, data[key]);
            }
        }

        return form.appendTo('body');
    }
}); });

function getUpdateSaldo(userId)
{
    $.ajax({
          url: "<?= Constant::baseUrl().'/api/getUpdateSaldo' ?>?user_id="+userId,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
            if (data.success == 1) {
                $('#topSaldo').html(accounting.formatNumber(data.saldo, 0, "."));
            } else {
                // console.log(data);
            }
          },
          error : function(xhr, response, error){
            console.log(xhr.responseText);
          }
        });
}

    <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message){
        ?>
        swal.fire('<?= $message ?>', '', '<?= $key ?>');
        <?php
    }
        ?>
</script>
</body>
</html>