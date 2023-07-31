<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= Constant::PROJECT_NAME; ?></title>

    <!-- Bootstrap -->
    <link href="<?= Constant::assetsUrl() ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= Constant::assetsUrl() ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= Constant::assetsUrl() ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= Constant::assetsUrl() ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= Constant::assetsUrl() ?>/build/css/custom.min.css" rel="stylesheet">
    <style>
        @media print{
                @page {size: letter portrait;margin: 2rem;}
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
table.border-none>tbody>tr>td{
    border: none!important;
}
.p-0{
        padding: 0!important;
    }
    </style>
  </head>

  <body class="login" onLoad="javascript:window.print();">
    <div>
        <?= $content; ?>
    </div>
  </body>
</html>