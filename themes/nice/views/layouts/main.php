<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= Constant::PROJECT_NAME; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="<?= Constant::baseUrl() ?>/images/favicon.png" rel="icon"> -->
  <link href="<?= Constant::baseUrl() ?>/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <?= AppAsset::registerCss(); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo Constant::baseCssUrl(); ?>/swiper.min.css">
  <link href="<?php echo Constant::baseCssUrl(); ?>/filepond.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo Constant::baseCssUrl(); ?>/filepond-plugin-image-preview.css">
  <link rel="stylesheet" href="<?php echo Constant::baseCssUrl(); ?>/filepond-plugin-image-edit.css">
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    :root {
      --color-primary: #F58220;
      --bg-primary: #6C6D70;
    }

    #main {
        margin-top: 80px;
        padding: 20px;
        min-height: 85vh;
        background-color: #FAFAF8;
    }

    @media (min-height: 1024px){
        #main {
            min-height: 90vh;
        }
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

    body{
        font-size: 14px;
    }

    .clearfix{
      padding: 5px 0px;
        margin: 10px 0px;
    }

    .col-lg-6 {
    flex: 0 0 auto;
    width: 50%;
    }

    .color-primary{
      color: #012970;
    }

    .sub-card{
      background-color: #012970;
    color: #fff;
    padding-left: 10px;
    }

    table th{
      color: #000;
    }

    .grid-view {
    overflow-x: auto;
    }

    .text-bold{
      font-weight: 700;
    }

    .nav-pills .nav-link.active {
    background-color: #012970;
  }

  .form-check-input[type=radio] {
    cursor: pointer;
}

.isi-form .row{
  margin-bottom: 10px;
}

.pl-0{
  padding-left: 0;
}

.row-fluid{
  margin-bottom: 10px;
}

.p-v-15{
  padding:15px 0px;
}

.logo img {
    max-height: 45px;
}
.highlight-result{
  text-align: center;
    font-size: 2rem;
    font-weight: 700;
}
.none{
  display: none;
}
.pt-1r{
  padding-top: 1rem;
}
.errorMessage{
  width: 100%;
  margin-top: 0.25rem;
  font-size: .875em;
  color: #dc3545;
}
.color-primary{
      color: rgba(13, 64, 144);
    }
    .bg-primary2{
      background-color: #6C6D70;
    }
    .nav-link i{
  font-size: 1.5rem;
}
.header-nav .nav-icon {
    color: #fff;
}
.badge-custom{
    padding: 7px!important;
    background-color: #fff;
    display: block;
    border-radius: 20px;
}
.header-nav .badge-number {
    top: 8px;
    right: 12px;
    bottom: auto;
    left: auto;
}
.sidebar {
    padding: 20px 2px;
    background-color: #F2F2F2;
}
.sidebar-nav .nav-link {
  padding: 10px 15px 10px 40px;
  background: #f6f9ff54;
  color: var(--color-primary);
}
.sidebar-nav .nav-link i {
  color: var(--color-primary);
} 
.sidebar-nav .nav-link:hover {
    color: var(--color-primary);
}
.sidebar-nav .nav-link:hover i {
    color: var(--color-primary);
}
.sidebar-nav .nav-link.collapsed {
    color: var(--bg-primary);
    background: #F2F2F2;
}
.sidebar-nav .nav-link.collapsed:hover {
    color: var(--color-primary);
    background: #fff;
}
.sidebar-nav .nav-item {
    border-top: 1px solid var(--bg-primary);
    border-left: 1px solid var(--bg-primary);
    border-right: 1px solid var(--bg-primary);
    border-collapse: collapse;
    margin-bottom: 0;
}
.sidebar .last-nav{
  border-bottom: 1px solid var(--bg-primary);
}
.sidebar .dashboard{
  border:none;
}
.summary-card{
  border-bottom: 0.3rem solid #46b4e3;
}
.summary-card h6.card-title{
  color: #FA962B;
  font-size: 28px;
}
.summary-card .card-body{
  padding-top: 20px;
}
.summary-card .card-body .ps-3{
  font-size: 1.2rem;
}
.summary-card .card-body i.bi-cart{
  color: #46b4e3;
}
.summary-card .card-body i.bi-credit-card{
  color: #6DCA9A;
}
.date-dashboard{
  width: 200px;
    background: #ccc;
    padding: 4px 10px;
    margin-right: 15px;
    border-radius: 10px;
    font-weight: 700;
}
.grid-view table > thead > tr {
  background: #cccccc;
} 
.search-bar {
    min-width: 360px;
    padding-left: 5px;
    padding-right: 20px;
}
.search-bar input {
    border: 0;
    font-size: 14px;
    color: #012970;
    border: 1px solid rgba(1, 41, 112, 0.2);
    padding: 7px 38px 7px 8px;
    border-radius: 3px;
    transition: 0.3s;
    width: 100%;
}
.search-bar button {
    border: 0;
    padding: 0;
    margin-left: -30px;
    background: none;
}
.card-title {
    padding: 20px 0 15px 0;
}
.inline-block{
  display:inline-block;
}
.m-vertical-20{
margin-top: 20px;
margin-bottom: 20px;
}
.m-horizontal-20{
  margin-right: 20px;
  margin-left: 20px;
}
.btn-light {
    border-color: #cccdce;
}
.min-width-350{
  min-width: 350px;
}
.btn-light:hover {
    color: #000;
    background-color: #e6e6e6;
    border-color: #bebebe;
}
.card-body form div.row{
    margin-left: 0;
    margin-right: 0;
}
.card-body form div.row label{
  padding-left: 0;
  padding-bottom: 5px;
  font-weight: 600;
}
label {
    font-weight: 700;
    line-height: 2;
}
  </style>
  
</head>

  <body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center bg-primary2">
    <div class="d-flex align-items-center justify-content-between head-logo">
      <a href="" class="logo d-flex align-items-center">
        <!-- <img src="<?= Constant::baseUrl() ?>/images/logo.png" alt=""> -->
        <span class="d-lg-block text-white"><?= Constant::PROJECT_NAME; ?></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn text-white"></i>
    </div><!-- End Logo -->

    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> --><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <!-- <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li> --><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell"></i>
            <span class="badge badge-number badge-custom"> </span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              Tidak ada notifikasi
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li>

        <!-- <li>
            <a class="nav-link nav-icon" href="#">
                <i class="bi bi-question-circle"></i>
            </a>
        </li> -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0 text-white" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i>
             <span class="d-none d-md-block dropdown-toggle ps-2"><?= Yii::app()->user->nama; ?></span> 
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= Yii::app()->user->nama; ?></h6>
              <span><?= (in_array(Yii::app()->user->role, [1,2]) ? 'Administrator' : 'Pengguna'); ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           <!--  <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li> -->
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= CController::createUrl('site/logout'); ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul>
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->

<div class="d-flex-main">
  <div class="maxwidth-main bg-white">
  <!-- ======= Sidebar ======= -->
  <?= $this->renderPartial('/layouts/sidebar', [], true); ?>
  <!-- End Sidebar-->

    <main id="main" class="main">
    <?php
        //flashes
        foreach(Yii::app()->user->getFlashes() as $key => $message)
        echo '<div id="flashMessage" class="flash-' . $key . '">' . $message . "</div>\n";
    ?>
        <section class="section">
        <div class="col-lg-12">
            <div class="row pb-3" style="justify-content: space-between;">

              <nav style="display: inline-block;width: auto;">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= Constant::baseUrl().'/' ?>">Home</a></li>
                  <?php if (ucwords($this->Id) != "Home"): ?><li class="breadcrumb-item"><?= ucwords($this->Id) ?></li> <?php endif; ?>
                  <li class="breadcrumb-item active"><?= ucwords($this->action->Id) ?></li>
                </ol>
              </nav>

              <div style="display: flex;width: auto;align-items: baseline;text-align: center;">
                <span class="date-dashboard"><?= date('d-m-Y'); ?></span>
              </div>

            </div>
        </div>

        <div class="row">

        <?= $content; ?>

        </div>
        </section>
    </main><!-- End #main -->

<!-- ======= Footer ======= -->
    <!-- <footer id="footer" class="footer">
        <div class="copyright">
        &copy; Copyright <strong><span><?= Constant::PROJECT_NAME; ?></span></strong>. All Rights Reserved
        </div>
    </footer> --><!-- End Footer -->
  </div>
</div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?= AppAsset::registerJs(); ?>
  <script src="<?php echo Constant::baseJsUrl(); ?>/swiper.min.js"></script>
  <script src="<?php echo Constant::baseJsUrl(); ?>/filepond.js"></script>
  <script src="<?php echo Constant::baseJsUrl(); ?>/filepond-plugin-image-preview.js"></script>
  <script
    src="<?php echo Constant::baseJsUrl(); ?>/filepond-plugin-image-exif-orientation.js"></script>
  <script
    src="<?php echo Constant::baseJsUrl(); ?>/filepond-plugin-file-validate-size.js"></script>
  <script src="<?php echo Constant::baseJsUrl(); ?>/filepond-plugin-image-edit.js"></script>
  <script
    src="<?php echo Constant::baseJsUrl(); ?>/filepond-plugin-file-validate-type.js"></script>

    <script>
        window.onload = function(){
            if ($('#flashMessage') !== "undefined") {
                $('#flashMessage').delay('5000').hide('slow');
            }
        }

        var swiper = new Swiper('.swiper-container', {
          spaceBetween: 30,
          effect: 'fade',
          centeredSlides: true,
          autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
    </script>
    
</body>

</html>