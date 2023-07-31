<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from app.ngorder.id/login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Mar 2022 09:55:09 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $this->pageTitle; ?></title>

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

	<link rel="stylesheet" href="<?= Constant::frontAsset() . '/app/assets/dist/vendor-user-d2d3a37e8f.css' ?>">
	<link rel="stylesheet" href="<?= Constant::frontAsset() . '/app/assets/dist/style-user-1579a36acb.css' ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700&display=swap" rel="stylesheet">

	<script src="<?= Constant::frontAsset() . '/app/assets/dist/vendor-user-0afa29bf19.js' ?>"></script>
<style>
    :root {
        --color-primary: #F58220;
        --color-primary-dark: #fa7808;
        --color-primary-darker: #d4670a;
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
        }
    html, body, .font-body {
    font-family: 'Poppins', sans-serif!important;
    }
    .main-title{
      font-size: 1.8rem;font-weight: 700;
    }
    .color-primary{
      color: var(--color-primary);
    }
    .secondary-color{
        color: var(--color-secondary);
    }
    .pt-2r{
        padding-top: 2.5rem;
    }
    .form-group-custom {
        width: 100%;
    }
    .usernameText{
        font-size: 0.9rem;
        font-style: italic;
    }
    #userUsername{
        font-weight: 700;
    }
    .logomark{
      /* Auto layout */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 0px;
      gap: 10px;
      isolation: isolate;
      width: 100px;
      height: 100px;
      position: relative;
      /* Primary/Main */
      background: #2563EB;
      border-radius: 99px;
      /* Inside auto layout */
      flex: none;
      order: 0;
      flex-grow: 0;
      margin-right: 7px;
    }
    .logomark p{
        font-family: "Poppins", sans-serif;
        font-style: normal;
        font-weight: 900;
        color: #FFFFFF;
        order: 0;
        z-index: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }
    .container-fluid {
        max-width: 500px;
    }
    .btn-login{
        background-color: var(--color-primary-dark);
    }
    .btn-login:hover {
        background-color: var(--color-primary-darker);
    }
    .bg-primary {
        background-color: var(--color-primary)!important;
    }
    a.bg-primary:focus, a.bg-primary:hover, button.bg-primary:focus, button.bg-primary:hover {
    background-color: var(--color-primary-dark)!important;
}
</style>
<body>
    <?= $content; ?>

    <script src="<?= Constant::frontAsset() . '/app/assets/dist/login-7152a68561.js' ?>"></script>
    <script src="<?= Constant::assetsUrl() . '/js/sweetalert2.min.js' ?>"></script>
    <script>
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