<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/favicon.png') ?>">
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
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

    <!-- Head Libs -->
    <script src="<?= base_url('assets/js/modernizr.min.js') ?>"></script>
    <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="<?= base_url('assets/js/pace.min.js') ?>"></script>
</head>

<body class="sidebar-horizontal">
    <div id="wrapper" class="wrapper">

        <!-- TOP NAVBAR -->
        <?= view('admin/layout/navbar') ?>

        <!-- SIDEBAR -->
        <?= view('admin/layout/sidebar') ?>

        <!-- MAIN CONTENT -->
        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>

       

    </div> <!-- /#wrapper -->

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.9/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets/js/template.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>
<?= view('admin/layout/footer') ?>
</html>
