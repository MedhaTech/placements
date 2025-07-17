<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" href="assets/img/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg" />
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png" />
    <link rel="manifest" href="assets/img/site.webmanifest" />

    <!-- <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/favicon.png') ?>"> -->
    <link rel="stylesheet" href="<?= base_url('assets/css/pace.css') ?>">
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/material-icons/material-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/mono-social-icons/monosocialiconsfont.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/feather-icons/feather.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet">
    <!-- Bootstrap 4.6 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your Template Styles -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">


    <!-- Head Libs -->
    <script src="<?= base_url('assets/js/modernizr.min.js') ?>"></script>
    <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="<?= base_url('assets/js/pace.min.js') ?>"></script>
</head>

<body class="sidebar-horizontal">
    <div id="wrapper" class="wrapper">

        <!-- TOP NAVBAR -->
        <?= view('layout/navbar') ?>

        <!-- SIDEBAR -->
        < // view('layout/sidebar')?>

        <div class="content-wrapper">
