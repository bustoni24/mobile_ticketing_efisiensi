<!DOCTYPE html>
<html>
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

    <style>
        @media print{
                @page {size: 80mm 80mm;margin: 0;}
                body { margin: 0; }
            }

        @media print {
          html, body {
          width: 80mm;
          height: 60mm;
        }

        /* ... the rest of the rules ... */
        } 
        .table {
              width: 100%;
              max-width: 100%;
              margin-bottom: 20px;
          }
          table.table > thead > tr > th {
          background-color: var(--bg-header-table);
        }
        .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 1px solid var(--border-table);
        }
        .d-flex {
            display: flex;
        }
        .justify-content-center{
            justify-content: center;
        }
        .table-bordered {
            border: 1px solid var(--border-table);
        }
        table.border-none>tbody>tr>td{
            border: none!important;
        }
        .ln_black{
            border: 1.5px solid;
        }
        table.head-print > tbody > tr > td {
          padding: 2px;
        }
        .table-bordered>tbody>tr>td.no-border, .table>tbody>tr>td.no-border, .table>tbody>tr>th.no-border{
          border-top: none;
          border-bottom: none;
        }
        p {
          margin: 0;
      }
      td span {
          line-height: 1.42857143!important;
        }
        .table>tbody>tr>td {
        padding: 4px;
        }
        table.head-print > tbody > tr > td {
        font-size: 70%;
        }
        table.table-content > thead > tr > td h3{
        font-size: 140%;
        }
        table.table-content > thead > tr > td h5{
        font-size: 100%;
        }
        table.table-content > tbody > tr > td, table.table-content > tbody > tr > td p{
        font-size: 90%;
        }
        .ln_solid {
            border-top: 1px solid #000;
            color: #fff;
            background-color: #fff;
            height: 1px;
            margin: 0px 0 20px 0;
        }
        .page-break {
            page-break-after: always; /* Memaksa pemisahan halaman setelah elemen ini */
        }
    </style>
</head>
<body onLoad="javascript:window.print();">
    <?= $content ?>
</body>
</html>
