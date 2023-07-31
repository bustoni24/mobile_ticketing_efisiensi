<?php
$baseUrl = Yii::app()->assetManager->publish('./themes/gentelella');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title><?= Constant::PROJECT_NAME; ?> | Admin</title>
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
    <link href="<?php echo $baseUrl; ?>/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/css/select2.min.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/images/icon.png" rel="SHORTCUT ICON" />
  <script src="<?php echo $baseUrl; ?>/js/jquery.js"></script>
  <script src="<?php echo $baseUrl; ?>/js/jquery.ba-bbq.js"></script>
  <?php
  Yii::app()->clientScript->scriptMap = array(
      'jquery.js' => false,
      'jquery.ba-bbq.js' => false
  );
  ?>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/tinymice/tinymce.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
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
    .pt-0{
      padding-top: 0;
    }
    .pl-0{
      padding-left: 0;
    }
    .pr-0{
      padding-right: 0;
    }
    .p-0{
        padding: 0!important;
    }
    .mb-0{
      margin-bottom: 0;
    }
    .x_title h2 {
        height: 20px;
    }
    .row {
        margin: 0px!important;
    }
    .row label {
        margin-top: 10px;
    }
    .row .buttons {
        margin-top: 15px;
        padding: 10px;
    }
    
    input[type="submit"]{
        padding: 8px 15px;
        border: 1px solid var(--color-primary);
        border-radius: 8px;
        box-shadow: 1px 1px 2px 0 #827b7b;
        background-color: var(--color-primary);
        color: #fff;
    }
    input[type=file] {
        width: 100%;
    }
    input.btn-success{
        border: 1px solid var(--color-success);
        background-color: var(--color-success);
    }
    input[type="password"], input[type="number"], input[type="text"], textarea, select{
        width: 100%!important;
        display: inline-block;
        height: 40px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
    input[readonly="readonly"] {
        background-color:#eee;
    }
    textarea{
        height: 84px!important;
    }
    .breadcrumbs {
        padding-left: 15px;
    }

    ul.yiiPager a:link, ul.yiiPager a:visited {
        padding: 3px 6px;
    }
    .pager li>a, .pager li>span {
        border-radius: 0px;
    }
    ul.yiiPager {
        font-size: 12px;
        display: inline-flex;
    }
    .full {
        margin-left: 0px!important;
    }
    body {
        background: #e2e2e2;
    }
    .nav_menu {
        background-color: var(--bg-primary);
    }
    .toggle a i {
        color: var(--bg-white);
    }
    .tile-stats .count, .tile-stats h3, .tile-stats p {
        z-index: 0;
    }
    .tile-stats {
        margin: 0px;
    }
    .x_panel {
        padding: 0px;
    }

.loader1 {
   display:inline-block;
   font-size:0px;
   padding:0px;
}
.loader1 span {
   vertical-align:middle;
   border-radius:100%;

   display:inline-block;
   width:10px;
   height:10px;
   margin:3px 2px;
   -webkit-animation:loader1 0.8s linear infinite alternate;
   animation:loader1 0.8s linear infinite alternate;
}
.loader1 span:nth-child(1) {
   -webkit-animation-delay:-1s;
   animation-delay:-1s;
   background:rgb(103 114 245 / 40%);
}
.loader1 span:nth-child(2) {
   -webkit-animation-delay:-0.8s;
   animation-delay:-0.8s;
   background:rgb(103 121 245 / 80%);
}
.loader1 span:nth-child(3) {
   -webkit-animation-delay:-0.26666s;
   animation-delay:-0.26666s;
   background:rgb(103 107 245);
}
.loader1 span:nth-child(4) {
   -webkit-animation-delay:-0.8s;
   animation-delay:-0.8s;
   background:rgb(103 121 245 / 80%);

}
.loader1 span:nth-child(5) {
   -webkit-animation-delay:-1s;
   animation-delay:-1s;
   background:rgb(103 114 245 / 40%);
}

@keyframes loader1 {
   from {transform: scale(0, 0);}
   to {transform: scale(1, 1);}
}
@-webkit-keyframes loader1 {
   from {-webkit-transform: scale(0, 0);}
   to {-webkit-transform: scale(1, 1);}
}
.contain-loader{
    padding: 20px 0px;
}
.text-center{
    text-align: center;
}
.x_panel{
    padding: 10px 5px;
}
.divider-top{
    margin-top: 10px;
    border-bottom: 1px solid #ddd;
}
.grid-view {
    overflow: auto;
}
.grid-view .view img{
    display: inline-block;
    cursor: pointer;
}
.grid-view .button-column a{
    cursor: pointer;
    margin-bottom: 2px;
}
.grid-view .view{
    /* display: block;
    border: 1px solid #4063cb;
    border-radius: 5px; */
    text-align: left;
    /* padding: 5px; */
    line-height: 1;
}
/* .grid-view .view:hover{
    background: #4063cb;
    color: #fff;
} */
/* .grid-view .view:after{
    content: "Lihat";
    vertical-align: middle;
    margin-left: 5px;
} */
.grid-view .update{
    /* display: block;
    border: 1px solid #26b99a;
    border-radius: 5px; */
    text-align: left;
    /* padding: 5px; */
    line-height: 1;
}
/* .grid-view .update:hover{
    background: #26b99a;
    color: #fff;
} */
/* .grid-view .update:after{
    content: "Ubah";
    vertical-align: middle;
    margin-left: 5px;
} */
.grid-view .delete{
    /* display: block;
    border: 1px solid #d9534f;
    border-radius: 5px; */
    text-align: left;
    /* padding: 5px; */
    line-height: 1;
}
/* .grid-view .delete:hover{
    background: #d9534f;
    color: #fff;
} */
/* .grid-view .delete:after{
    content: "Hapus";
    vertical-align: middle;
    margin-left: 5px;
} */
.grid-view .button-column {
    text-align: center;
    min-width: 90px;
    width: 90px;
}
.grid-view table.items {
    background: white;
    border-collapse: initial;
    width: 100%;
    border: 1px #eee solid;
}
.grid-view table.items td {
    font-size: 0.9em;
    border: 1px white solid;
    padding: 0.7em 0.2em;
    line-height: 2.5em;
}
table.table > thead > tr > th {
  background-color: var(--bg-header-table);
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid var(--border-table);
}
.table-bordered {
    border: 1px solid var(--border-table);
}
.lightbox-popup {
    display: none;
    position: fixed;
    z-index: 9999;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
}
.lightbox-popup .box {
    margin: 0px;
    border: 0;
    position: absolute;
    padding: 0 !important;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    width: 100vw;
}
.lightbox-popup .container {
    background-color: #fff;
    color: #000;
    max-width: 80%;
    padding: 50px 15px 0px 15px;
    border-radius: 8px;
    position: relative;
}
.lightbox-popup .container p {
    margin: 0;
}
.lightbox-popup .box .container a{
    padding: 15px 5px;
    float: right;
    margin-right: 10px;
    text-decoration: none;
    color: #000;
}
.lightbox-popup .box .container a:hover{
    text-decoration: none;
}
.lightbox-popup .box .container a[class*="choice-"]{
    display: inline-flex;
}
.lightbox-popup .box .container .closed {
    position: absolute;
    top: 15px;
    right: 5px;
    border: 1px solid;
    margin: -10px 0 0 -10px;
    width: 20px;
    height: 20px;
    color: #ff0707;
    font-size: 13px;
    font-weight: 700;
    text-align: center;
    border-radius: 50%;
    background-color: #fff;
    cursor: pointer;
    text-decoration: none;
    padding: 0px;
}
h2 small{
    font-size: 80%;
}
.lightbox-popup .box .container a[name="submit"]{
    padding: 8px 15px;
    border: 1px solid #bfb6b6;
    border-radius: 8px;
    box-shadow: 1px 1px 2px 0 #827b7b;
    background: #00d410;
    color: #fff;
    float: left;
}
.lightbox-popup .detail-view, .detail-view{
    width: 96%;
    margin: 20px 15px;
    line-height: 2;
}
.lightbox-popup .content-container{
    padding: 0px 20px 20px 20px;
}
.lightbox-popup .content-container h1{
    font-weight: bold;
    margin-left: 15px;
        font-size: 2.5rem;
    color: #0C496C;
}
.lightbox-popup .box .inner-box{
    overflow-y: scroll;
    max-height: 90vh;
}
.detail-view .odd{
   background-color: #f3f3f3!important;
}

.detail-view td, .detail-view th {
    padding: 1rem;
    text-align: left!important;
}
div[class="error"]{
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #ff0707;
    color: red;
    display: none;
}
.none{
    display: none!important;
}
.border-required{
    border: 1px solid red!important;
}
.nav.side-menu>li.active, .nav.side-menu>li.current-page, .nav-sm .nav.side-menu li.active-sm, .nav-sm .nav.child_menu li.active {
    border-right: 5px solid var(--color-primary);
}

.left_col{
      background: var(--bg-secondary);
}
.nav.side-menu>li>a:hover {
    color: var(--color-primary)!important;
}
.main_menu span.fa {
    color: var(--bg-primary);
}
.nav.side-menu>li.active>a {
    text-shadow: rgb(0 0 0 / 25%) 0 -1px 0;
    background: linear-gradient(var(--bg-secondary),var(--bg-secondary)),var(--bg-secondary);
    box-shadow: rgb(0 0 0 / 25%) 0 1px 0, inset rgb(255 255 255 / 16%) 0 1px 0;
    color: var(--color-primary);
}
.nav-md ul.nav.child_menu li:before {
    background: var(--bg-primary);
  }
  .nav-md ul.nav.child_menu li:after {
    border-left: 1px solid var(--bg-primary);
  }
  .nav.child_menu>li>a:hover{
    color: var(--color-primary);
  }
  .nav li.current-page {
    background: rgb(68 50 0 / 5%);
}

.nav-sm ul.nav.child_menu {
    background: var(--bg-secondary);
}
.site_title {
    font-weight: 400;
    font-size: 22px;
    width: 100%;
    line-height: 59px;
    display: flex;
    height: 100%;
    margin: 0;
    align-items: center;
    justify-content: center;
}
footer {
    background: #f7f7f7;
    }

    .grid-view table.items th {
      padding: 15px 0px;
    background: #0c496c;
    }
  .grid-view table.items tr.odd {
    background: #fff;
}
.mt-0{
    margin-top: 0!important;
}
.mt-50{
    margin-top: 50px;
}
.mt-10{
    margin-top: 10px;
}
.mt-15{
    margin-top: 15px;
}
.nav_title {
    background-color: var(--bg-primary);
}
/* @media (max-width: 991px) {
    body.nav-md{
        margin-top: -59px;
    }
} */
@media (min-width: 2400px){
    body{
       font-size: 200%;
    }
    .nav-md .container.body .col-md-3.left_col {
        width: 280px;
    }
    .main_container .top_nav {
        margin-left: 280px;
    }
    .dropdown-menu {
        font-size: 90%;
    }
    .grid-view .button-column {
        width: 120px;
    }
    .nav.child_menu>li>a {
        font-size: 90%;
    }
    footer {
        margin-left: 280px;
    }
    .btn {
        font-size: 100%;
    }
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

span.active{
	padding: 5px;
    border: 1px solid green;
    color: green;
    border-radius: 5px;
}	
span.notactive{
	padding: 5px;
    border: 1px solid red;
    color: red;
    border-radius: 5px;
}	
.nav.child_menu>li>a, .nav.side-menu>li>a {
    color: var(--bg-primary);
    font-weight: 600;
}
.nav.child_menu>li.active>a, .nav.side-menu>li.active>a {
    color: var(--color-primary);
}
.nav li li.current-page a,.nav.child_menu li li a.active, .nav.child_menu li li a:hover {
    color: var(--color-primary);
}
/* .nav li li.current-page a.active{
    color: var(--color-primary);
}
.nav li li.current-page a{
    color: var(--bg-primary);
} */
.nav.navbar-nav>li>a{
    color: var(--bg-white)!important;
}
#content .x_title {
    padding: 5px 10px;
    background-color: var(--color-primary);
    color: var(--bg-white);
}
.btn-outline-warning{
    border: 1px solid var(--color-primary);
    color: var(--color-primary);
    background-color: var(--bg-white);
}
.btn-outline-warning:hover{
    border: 1px solid var(--color-primary);
    color: var(--bg-white);
    background-color: var(--color-primary);
}
.btn-warning {
  border: 1px solid var(--color-primary);
  background-color: var(--color-primary);
}
.btn-warning:hover {
  border: 1px solid var(--color-primary);
  color: var(--color-primary);
  background-color: var(--bg-white);
}
.btn-danger.active.focus, .btn-danger.active:focus, .btn-danger.active:hover, .btn-danger:active.focus, .btn-danger:active:focus, .btn-danger:active:hover, .open>.dropdown-toggle.btn-danger.focus, .open>.dropdown-toggle.btn-danger:focus, .open>.dropdown-toggle.btn-danger:hover, .btn-danger:active, .btn-danger:focus, button.btn-danger {
    border: 1px solid var(--bg-danger);
    background-color: var(--bg-danger);
    color: red;
}
button.btn-danger:hover {
    border: 1px solid var(--bg-red);
    background-color: var(--bg-white);
    color: var(--bg-red);
}
div.dataTables_length select {
    width: 75px!important;
    display: inline-block;
}
div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: auto!important;
}
.custom-file-input2::-webkit-file-upload-button {
          visibility: hidden!important;
      }
      .custom-file-input2::before {
          content: '';
          display: inline-block;
          outline: none;
          white-space: nowrap;
          -webkit-user-select: none;
          cursor: pointer;
          height: 40px;
          padding: 10px;
          color: #585555!important;
          background: #eee;
          box-shadow: 1px 3px 5px #eee;
          width: 100%;
          text-decoration: underline;
      }
      .sertifikat_kompetensi::before{
        content: 'Lampirkan Sertifikat Kompetensi';
      }
      .lampiran_sim::before{
        content: 'Lampirkan SIM';
      }
      .lampiran_stnk::before{
        content: 'Lampirkan STNK';
      }
      .lampiran_kir::before{
        content: 'Lampirkan KIR';
      }
      .lampiran_kps::before{
        content: 'Lampirkan KPS';
      }
      .nota_bbm::before{
        content: 'Lampirkan Nota';
      }
      .dokumen_kontrak::before{
        content: 'Lampirkan Dokumen Kontrak';
      }
      .lampiran_sim::before
      .custom-file-input2:hover::before {
          border-color: black;
      }
      .custom-file-input2:active::before {
          background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
      }
      .input-group {
		display:block;
	}
	.input-group .form-control {
		z-index: 0;
	}
	.gj-datepicker [role=right-icon] {
		position: absolute;
    right: 0;
	}
	.gj-datepicker-bootstrap [role=right-icon] button {
    	height: 34px;
	}
  .errorSummary, .errorMessage{
    color:red;
  }
  .successChoose {
    width: 96%;
    height: 40px;
    position: absolute;
    z-index: 99;
    border: 1px solid var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    background: var(--color-primary);
    color: #fff;
    border-radius: 5px;
    top: 0;
}
  .none{
    display: none;
  }
  a.lightbox img {
height: 150px;
border: 3px solid white;
box-shadow: 0px 0px 8px rgba(0,0,0,.3);
margin: 94px 20px 20px 20px;
}

/* Styles the lightbox, removes it from sight and adds the fade-in transition */

.lightbox-target {
position: fixed;
top: -100%;
width: 100%;
background: rgba(0,0,0,.7);
width: 100%;
opacity: 0;
-webkit-transition: opacity .5s ease-in-out;
-moz-transition: opacity .5s ease-in-out;
-o-transition: opacity .5s ease-in-out;
transition: opacity .5s ease-in-out;
overflow: hidden;
 
}
/* Styles the lightbox image, centers it vertically and horizontally, adds the zoom-in transition and makes it responsive using a combination of margin and absolute positioning */
.lightbox-target img {
margin: auto;
position: absolute;
top: 0;
left:0;
right:0;
bottom: 0;
max-height: 0%;
max-width: 0%;
border: 3px solid white;
box-shadow: 0px 0px 8px rgba(0,0,0,.3);
box-sizing: border-box;
-webkit-transition: .5s ease-in-out;
-moz-transition: .5s ease-in-out;
-o-transition: .5s ease-in-out;
transition: .5s ease-in-out;
}

/* Styles the close link, adds the slide down transition */
a.lightbox {
  color: var(--color-link);
}
a.lightbox-close {
display: block;
width:50px;
height:50px;
box-sizing: border-box;
background: white;
color: black;
text-decoration: none;
position: absolute;
top: -80px;
right: 0;
-webkit-transition: .5s ease-in-out;
-moz-transition: .5s ease-in-out;
-o-transition: .5s ease-in-out;
transition: .5s ease-in-out;
}
/* Provides part of the "X" to eliminate an image from the close link */
a.lightbox-close:before {
content: "";
display: block;
height: 30px;
width: 1px;
background: black;
position: absolute;
left: 26px;
top:10px;
-webkit-transform:rotate(45deg);
-moz-transform:rotate(45deg);
-o-transform:rotate(45deg);
transform:rotate(45deg);
}
/* Provides part of the "X" to eliminate an image from the close link */
a.lightbox-close:after {
content: "";
display: block;
height: 30px;
width: 1px;
background: black;
position: absolute;
left: 26px;
top:10px;
-webkit-transform:rotate(-45deg);
-moz-transform:rotate(-45deg);
-o-transform:rotate(-45deg);
transform:rotate(-45deg);
}
/* Uses the :target pseudo-class to perform the animations upon clicking the .lightbox-target anchor */
.lightbox-target:target {
  opacity: 1;
    top: 0;
    bottom: 0;
    overflow: scroll;
    right: 0;
    z-index: 9;
}
.lightbox-target:target img {
max-height: 100%;
max-width: 100%;
}
.lightbox-target:target a.lightbox-close {
top: 0;
}
.top_nav li a i.fa-user {
    border: 1px solid #EAEAEA;
    padding: 5px 6px;
    border-radius: 50%;
}
.info-number .badge {
    padding: 5px 6px;
    right: -10px;
}
@media (min-width: 480px){
.top_nav .navbar-right li {
    margin-right: 5px;
}
}
.bg-primary{
  background: var(--color-primary)!important;
    border: 1px solid var(--color-primary)!important;
}
a.site_title img{
    width: 170px;
}
.nav-md .container.body .right_col {
    min-height: 94vh!important;
}
.nav-md .container.body .col-md-3.left_col {
    width: 260px;
}
.nav-md .nav_title {
    width: 260px;
}
.main_container .nav-md .top_nav {
    margin-left: 260px;
}
.nav-md .container.body .right_col {
    margin-left: 260px;
}
@media (max-width: 991px){
.nav-md .container.body .right_col, .nav-md .container.body .top_nav {
    width: 100%;
    margin: 0;
}
}
.sub_title h4, .sub_title h5{
    margin: 0;
    padding: 10px;
    background-color: var(--bg-header-table);
    font-weight: 600;
}
.icheckbox_flat-green, .iradio_flat-green {
    background: url(<?= Constant::baseUrl().'/themes/gentelella/vendors/iCheck/skins/flat/orange.png' ?>) no-repeat;
}
.primary-underline{
    color: var(--color-primary);
    text-decoration: underline;
}
.main_container .top_nav {
    margin-left: 250px;
}
#content{
    overflow-x: auto;
}
.green{
    color: green;
}
.red{
    color: red!important;
}
.orange{
    color: orange;
}
.bgRed{
    background-color: #f55656!important;
    color: var(--bg-white);
}
.bgOrange{
    background-color: var(--color-primary)!important;
    color: var(--bg-white);
}
.info {
    color: var(--color-link);
}
.text-bold{
    font-weight: 700;
}
.fa-print{
        font-size: 3.5rem;
    }
.alert {
    margin-bottom: 10px;
    font-size: 1.6rem;
}
span.link{
    color: #00beff;
    text-decoration: underline;
    cursor: pointer;
}
.swal2-styled.swal2-confirm, .swal2-styled.swal2-deny {
        font-size: 1.4rem!important;
    }
.link-inactive{
    color: var(--bg-primary);text-decoration: underline;
}
.link-active{
    color: var(--color-link);text-decoration: underline;
    cursor: pointer;
}
html input.likeText[disabled] {
    cursor: default;
    border: none;
    padding: 0;
    box-shadow: none;
}
.mr-0 {
    margin-right: 0;
}
.mr-10{
    margin-right: 10px;
}
#flashMessage{
    margin-bottom: 1rem;
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
.btnSwitch{
    cursor: pointer;
}
.item-ui{
		background-color:#eee;
		padding: 5px 10px;
		height:40px;
		list-style:none;
		margin-left:-40px;
		width: 200px;
	}
	.item-ui a {
		color: var(--color-primary);
		height: 35px;
        width: 180px;
        display: block;
	}
	.item-ui:hover,.item-ui:focus,.item-ui:target,.item-ui:visited,.item-ui:active{background:var(--color-primary);cursor: pointer;}
	.item-ui:hover a{
		color:#fff;
	}
	.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus {
    cursor: pointer;
    background:var(--color-primary);
	padding: 5px 10px;
	height:40px;
	width: 200px;
	color:#fff;
	display: block;
	position: relative;
	margin-left: -10px;
	margin-top: -5px;
	border: 1px solid #eee;
}
.gj-timepicker-md [role=right-icon] {
    top: 8px;
    width: 100%;
    text-align: right;
}
.w-100{
    width: 100%;
}
input[type="submit"].btn-danger {
    border: 1px solid var(--btn-danger-border);
    background-color: var(--btn-danger);
}
<?php if ($this->id == 'dailyCheck'): ?>
input.input_bbm, input.input_radio{
    opacity: 0;
}
span#FormSesudahMengemudi_pengisian_bahan_bakar, .form-group span{
    display: flex;
    margin-left: -13px;
}
#viewKonfirmasiSebelum .form-group span{
    margin-left: 0;
}
.label_bbm, .label_radio_custom{
    display: inline-flex;
    margin: 0;
}
.label_bbm:before, .label_radio_custom:before {
    background: url(<?= Constant::baseUrl().'/themes/gentelella/vendors/iCheck/skins/flat/orange.png' ?>) no-repeat;
    content: '';
    z-index: 9;
    width: 20px;
    height: 40px;
    cursor: pointer;
    display: inline-block;
    margin-right: 10px;
}
.label_bbm.changed:before, .label_radio_custom.changed:before{
    background-position: -110px 0px;
}
input[type=radio] {
    height: 18px;
    width: 18px;
    cursor: pointer;
}
<?php endif; ?>
.fa-file-excel-o, .fa-file-pdf-o {
    font-size: 3.5rem;
}
.swal2-html-container {
    font-size: 1.5rem!important;
}
.va-bottom{
    vertical-align: bottom;
}
.pb-10{
    padding-bottom: 10px;
}
.ln_solid {
    border-top: 1px solid #f58222;
    color: #fff;
    background-color: #fff;
    height: 1px;
    margin: 0px 0 20px 0;
}
.bordered{
    border: 1px solid #000;
}
input[type="radio"]{
        cursor: pointer;
    }
    .navbar-nav .open .dropdown-menu.msg_list {
    width: 370px;
}
table.border-none>tbody>tr>td{
    border: none!important;
}
.switchery-default{
    box-shadow: rgb(245 130 32) 0px 0px 0px 10.5px inset;
    border-color: rgb(245 130 32);
    border-color: rgb(245 130 32);
    background-color: rgb(38, 185, 154);
    transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;
}
input[type="checkbox"].toggle-custom {
  opacity: 0;
  position: absolute;
  left: -99999px;
}
input[type="checkbox"].toggle-custom + label {
	height: 28px;
    line-height: 10px;
  background-color: #ccc;
  padding: 0px 8px;
  border-radius: 16px;
  display: inline-block;
  position: relative;
  cursor: pointer;
  -moz-transition: all 0.25s ease-in;
  -o-transition: all 0.25s ease-in;
  -webkit-transition: all 0.25s ease-in;
  transition: all 0.25s ease-in;
  -moz-box-shadow: inset 0px 0px 2px rgba(0, 0, 0, 0.5);
  -webkit-box-shadow: inset 0px 0px 2px rgba(0, 0, 0, 0.5);
  box-shadow: inset 0px 0px 2px rgba(0, 0, 0, 0.5);
}
input[type="checkbox"].toggle-custom + label.active{
	background-color: #d9534f;
}
input[type="checkbox"].toggle-custom + label:before, input[type="checkbox"].toggle-custom + label:hover:before {
  content: " ";
  position: absolute;
  top: 2px;
  left: 2px;
  width: 15px;
	height: 24px;
  background: #fff;
  z-index: 2;
  -moz-transition: all 0.25s ease-in;
  -o-transition: all 0.25s ease-in;
  -webkit-transition: all 0.25s ease-in;
  transition: all 0.25s ease-in;
  -moz-border-radius: 14px;
  -webkit-border-radius: 14px;
  border-radius: 14px;
}
input[type="checkbox"].toggle-custom + label .off,
input[type="checkbox"].toggle-custom + label .on {
  color: #fff;
}
input[type="checkbox"].toggle-custom + label .off {
  margin-left: 15px;
  display: inline-block;
}
input[type="checkbox"].toggle-custom + label .on {
  display: none;
}
input[type="checkbox"].toggle-custom:checked + label .off {
  display: none;
}
input[type="checkbox"].toggle-custom:checked + label .on {
  margin-right: 40px;
  display: inline-block;
  padding-left: 7px;
}
input[type="checkbox"].toggle-custom:checked + label, input[type="checkbox"].toggle-custom:focus:checked + label {
  background-color: #67a5ec;
}
input[type="checkbox"].toggle-custom:checked + label.active, input[type="checkbox"].toggle-custom:focus:checked + label.active {
  background-color: #40c893;
}
input[type="checkbox"].toggle-custom:checked + label:before, input[type="checkbox"].toggle-custom:checked + label:hover:before, input[type="checkbox"].toggle-custom:focus:checked + label:before, input[type="checkbox"].toggle-custom:focus:checked + label:hover:before {
  background-position: 0 0;
  top: 2px;
  left: 100%;
  margin-left: -22px;
}
</style>
</head>
  <body class="nav-md">
  <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo Constant::baseAdminUrl(); ?>" class="site_title">
              <img src="<?= Constant::getImageUrl() . '/logo_text.png'; ?>" />
            </a>
            </div>
            <div class="clearfix"></div>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <?php
                  $this->sideNav(Yii::app()->user->role);
                  ?>                  
                </ul>
            </div>
        </div>

    </div>
</div>
   
   <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="<?php echo Constant::getImageUrl().'/avatar.png' ?>" alt=""> -->
                    <i class="fa fa-user"></i>
                    <?php echo Yii::app()->user->nama; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <?php if (isset(Yii::app()->user->role) && Yii::app()->user->role != '4'): 
                        if (isset(Yii::app()->user->id_user)) {
                            ?>
                            <li><a href="<?php echo Constant::baseUrl() . '/ticketing/user/profile/' . Yii::app()->user->id_user; ?>"> Profile</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="<?php echo CController::createUrl('user/profile', array('id' => Yii::app()->user->id)); ?>"> Profile</a></li>
                            <?php
                        }
                    ?>
                    <?php endif; ?>
                    <li><a href="<?php echo CController::createUrl('site/logoutAdmin'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-file-text-o"></i>
                    <span class="badge bg-primary"><?php if (false) echo '18'; ?></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="message">
                          Belum ada notifikasi
                        </span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-red" id="spanBell"></span>
                  </a>
                  <ul id="menu2" class="dropdown-menu list-unstyled msg_list" role="menu">
                    
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="col-md-12 col-sm-12 col-xs-12">
             <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'htmlOptions'=>array('class'=>'breadcrumb card', 'style'=>'padding: 7px 10px; margin :0 -10px;'),
                    'separator'=>'&nbsp;/&nbsp;'
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>
          </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <?php
                    //flashes
                    foreach(Yii::app()->user->getFlashes() as $key => $message)
                    echo '<div id="flashMessage" class="flash-' . $key . '">' . $message . "</div>\n";
                    ?>

                    <?php echo $content; ?>

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
                </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        
        <!-- footer content -->
        <footer>
          <div class="clearfix"></div>
          &copy; <?= date('Y'); ?> - <?= Constant::PROJECT_NAME; ?>
        </footer>
        <!-- /footer content -->

      </div>
    </div>

<!-- jQuery -->
<?= AppAsset::registerJs(); ?>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script type="text/javascript">
    $('a.closed').click(function() {
        $('.lightbox-popup').hide();
    });
</script>
<?php
    $auth = GroupAuth::model()->findByAttributes(['className' => $this->Id, 'group_id' => Yii::app()->user->role]);
    $isMemberView = false;
    if (isset($auth->action)){
        if(preg_match('/(view)/', $auth->action))
            $isMemberView = true;
    }
?>
<script type="text/javascript">
    <?php 
        $className = $this->Id;
        if ($className == 'dailyCheck') {
            $className = $this->action->id;
        }
    ?>

    var $className = "<?php echo $className; ?>";
    $('#btn-refresh').on('click', function(){
        $("#"+$className+"-grid").yiiGridView("update", {});
    });

    function viewForm($url, $action)
    {
        if (typeof($url) !== "undefined"){
            $.ajax({
                type : "GET",
                url : $url,
                dataType : "Html",
                success : function(data) {
                    $('.lightbox-popup .box .container .content-container').attr('id', $className);
                    $('.lightbox-popup .box .container .content-container').html(data);
                    $('.lightbox-popup').fadeIn();

                    if (typeof($action) !== "undefined" && ($action == "create" || $action == "update")){
                        actionForm($url);
                    }
                },
                error : function(data){
                    if (typeof(data.responseText) !== "undefined")
                        console.log(data.responseText);
                }
            });
        }
    }
    $('#menu_toggle').on('click', function(){
        
        if ($('body').hasClass('nav-sm')) {
            $('a.site_title').html('<img src="<?= Constant::getImageUrl() . '/logo_text.png'; ?>"/>');
        } else {
            $('a.site_title').html('E');
        }
    })
</script>
<script>
  $(".table-responsive select:not(.for-filter)").on("change", function(e) {
		var data = {};
		data['display'] = $(this).val();
		updateGrid(data);
	});
	$(".table-responsive :input.input-sm").on("keyup", function(e) {
		var data = {};
		data['filter'] = $(this).val();
		updateGrid(data);
	});
    $(".table-responsive :input.date").on("change", function(e) {
		var data = {};
		data['date_filter'] = $(this).val();
		updateGrid(data);
	});

	function updateGrid(data, classNamed){
		if (typeof(data) === "undefined" || data === null)
			return false;

        if (typeof(classNamed) !== "undefined" && classNamed !== null) {
            $className = classNamed;
        }
        $className = $className.replace("/", "-");
        console.log(data);
        console.log($className);
		$("#"+$className+"-grid").yiiGridView("update", {
			data: data,
			complete: function(){
			
			},
            error : function(data){
                if (typeof(data.responseText) !== "undefined")
                    console.log(data.responseText);
            }
		});
	}
	// var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    function successAttach(el, file){
      if (typeof(el) === 'undefined' || el === null)
        return false;

      if (file !== null){
        el.nextElementSibling.classList.remove('none');
      } else {
        el.nextElementSibling.classList.add('none');
      }
    }

    $('.resetBtn').on('click', function(){
      $('.successChoose').addClass('none');
    });
    $('a').on('click', function(){
        var link = $(this).attr('href');
        if (typeof(link) !== 'undefined' && link === 'javascript:void(0);') {
            alert('Coming Soon');
        }
    });
    window.onload = function(){
        if ($('#flashMessage') !== "undefined") {
            $('#flashMessage').delay('7000').hide('slow');
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
                for (var i = 0; i < data.length; i++) {
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

var repeater;
$(document).on('ready', function(){
    $('.form-group').find('.input_radio').each(function(){
        if ($(this).is(':checked')){
            var valueRadio = $(this).val();
            toggleRadioChecked(valueRadio, $(this));
        }
    });

    <?php if (isset(Yii::app()->user->jabatan) && in_array(Yii::app()->user->jabatan, ['Manager HRD','Staff HRD','Superadmin'])): ?>
        function doWork() {
            getNotification("'EMPLOYE_EXPIRED'");
            repeater = setTimeout(doWork, 1000);
        }
        doWork();
    <?php endif; ?>
    <?php if (isset(Yii::app()->user->jabatan) && in_array(Yii::app()->user->jabatan, ['Supplier'])): ?>
        // setInterval(getNotification("'ORDER_GOODS'"), 1000);
        function doWork() {
            getNotification("'ORDER_GOODS','<?= Constant::MESSAGE_TYPE_SUPPLIER ?>'");
            repeater = setTimeout(doWork, 1000);
        }
        doWork();
    <?php endif; ?>
    <?php if (isset(Yii::app()->user->jabatan) && in_array(Yii::app()->user->jabatan, ['Manager Jalur','Pengemudi'])): ?>
        function doWork() {
            getNotification("'NOTIFY_DAILYCHECK'");
            repeater = setTimeout(doWork, 1000);
        }
        doWork();
    <?php endif; ?>
    <?php if (isset(Yii::app()->user->jabatan) && in_array(Yii::app()->user->jabatan, explode(',', Constant::AUTH_MEKANIK))): ?>
        function doWork() {
            getNotification("'<?= Constant::MESSAGE_TYPE_SERVICE ?>'");
            repeater = setTimeout(doWork, 1000);
        }
        doWork();
    <?php endif; ?>
    <?php if (isset(Yii::app()->user->jabatan) && in_array(Yii::app()->user->jabatan, explode(',', Constant::AUTH_PEMBELIAN))): ?>
        function doWork() {
            getNotification("'SUPPLIER_PRICE_QUOTATION','<?= Constant::MESSAGE_TYPE_PEMBELIAN ?>'");
            repeater = setTimeout(doWork, 1000);
        }
        doWork();
    <?php endif; ?>
    <?php if (isset(Yii::app()->user->jabatan) && in_array(Yii::app()->user->jabatan, explode(',', Constant::AUTH_WAREHOUSE))): ?>
        function doWork() {
            getNotification("'<?= Constant::MESSAGE_TYPE_WAREHOUSE ?>','<?= Constant::MESSAGE_TYPE_WAREHOUSE_CONFIRM ?>'");
            repeater = setTimeout(doWork, 1000);
        }
        doWork();
    <?php endif; ?>
});

function toggleRadioChecked(valueRadio, element) {
    if (typeof(valueRadio) === 'undefined' || typeof(element) === 'undefined'){
        return false;
    }
    if (valueRadio == '1') {
        element.next('.label_radio_custom').addClass('changed');
        element.prev().prev('.label_radio_custom').removeClass('changed');
    }
    else if (valueRadio == '0') {
        element.next('.label_radio_custom').addClass('changed');
        element.next().next().next().next('.label_radio_custom').removeClass('changed');
    }
}

$('.form-group').find('.input_radio').each(function(){
    $(this).change(function(){
        if ($(this).is(':checked')){
            var valueRadio = $(this).val();
            toggleRadioChecked(valueRadio, $(this));
        }
    });
});

function getNotification(type = ""){
    $.ajax({
          url: "<?= Constant::baseUrl().'/cron/getNotification' ?>?type="+type,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
            if (data.success == 1) {
              $('#menu2').html(data.html);
              $('#spanBell').html(data.count);
            } else {
                $('#menu2').html('<li><a><span class="message">Belum ada notifikasi</span></a></li>');
            }
          },
          error : function(xhr, response, error){
            console.log(xhr.responseText);
          }
        });
}

function showNotification(id)
    {
        if (typeof(id) === 'undefined') {
            alert('Undefined ID');
            return false;
        }
      $.ajax({
        url: "<?= Constant::baseUrl().'/cron/readNotif' ?>",
        type: 'post',
        data: {id:id},
        dataType: 'JSON',
        success: function(data) {
          if (data.success === 1) {
                Swal.fire({
                    html: "<h3>"+data.header+"</h3>"+"<p style='font-size:1.5rem;line-height:20px;'>"+data.message+"</p>",  
                    confirmButtonText: "OK", 
                    confirmButtonColor: '#F58220',
                    customClass: 'swal-wide',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        if (data.header === 'PENAWARAN HARGA') {
                            location.href = "<?= Constant::baseUrl() . '/pembelian/perbandinganHarga' ?>";
                        } else {
                            if (typeof data.url_redirect !== 'undefined') {
                                location.href = data.url_redirect;

                                return false;
                            }
                            location.reload();
                        }
                    }
                });
            }
        },
        error : function(xhr, response, error){
          console.log(xhr.responseText);
        }
      });
    }
</script>
</body>
</html>