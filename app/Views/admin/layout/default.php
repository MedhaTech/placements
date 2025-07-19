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
    <link rel="stylesheet" href="<?= base_url('assets/css/pace.css') ?>">
    <title><?= $title; ?></title>

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

    <!-- ✅ Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />

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

    <!-- ✅ Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <!-- ✅ Toastr Flash Message Script -->
    <?php if (session()->getFlashdata('success')): ?>
        <script>
            setTimeout(function () {
                $.toast({
                    heading: 'Success',
                    text: '<?= session()->getFlashdata('success') ?>',
                    icon: 'success',
                    showHideTransition: 'slide',
                    position: 'top-right'
                });
            }, 300);
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <script>
            setTimeout(function () {
                $.toast({
                    heading: 'Error',
                    text: '<?= session()->getFlashdata('error') ?>',
                    icon: 'error',
                    showHideTransition: 'fade',
                    position: 'top-right'
                });
            }, 300);
        </script>
    <?php endif; ?>

</body>

<?= view('admin/layout/footer') ?>
</html>
