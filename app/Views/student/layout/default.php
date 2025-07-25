<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
 
  <!-- <link rel="icon" type="image/png" href="assets/img/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg" />
  <link rel="shortcut icon" href="assets/img/favicon.ico" />-->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png" />
  <link rel="stylesheet" href="<?= base_url('assets/css/pace.css') ?>" />

  <title><?= $title ?? 'Dashboard' ?></title>

  <!-- CSS -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600" rel="stylesheet" />
  <link href="<?= base_url('assets/vendors/material-icons/material-icons.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/vendors/mono-social-icons/monosocialiconsfont.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/vendors/feather-icons/feather.css') ?>" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" />

  <!-- ✅ Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />

  <!-- Head Libs -->
  <script src="<?= base_url('assets/js/modernizr.min.js') ?>"></script>
  <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="<?= base_url('assets/js/pace.min.js') ?>"></script>

  <!-- Page-specific CSS -->
  <?= $this->renderSection('style') ?>
</head>

<body class="sidebar-horizontal">
  <div id="wrapper" class="wrapper">

    <!-- TOP NAVBAR -->
    <?= view('student/layout/navbar') ?>

    <!-- SIDEBAR -->
    <?= view('student/layout/sidebar') ?>

    <!-- MAIN CONTENT -->
    <div class="content-wrapper">
      <?= $this->renderSection('content') ?>
    </div>

    <!-- FOOTER -->
    <footer class="footer bg-primary text-inverse text-center">
      <div class="container">
        <span class="fs-13 heading-font-family">Copyright &copy;
          <?= date('Y') ?> <a class="fw-800" href="https://medhatech.in" target="_blank">Medha Tech</a>. All Rights Reserved.</span>
      </div>
    </footer>

  </div> <!-- /#wrapper -->

  <!-- SCRIPTS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.9/metisMenu.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>
<!-- Add this just before </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  

  <!-- Custom JS -->
  <script src="<?= base_url('assets/js/custom.js') ?>"></script>

  <!-- ✅ Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

  <!-- ✅ Flash Message Toasts -->
  <?php if (session()->getFlashdata('success')): ?>
    <script>
      setTimeout(() => {
        $.toast({
          heading: 'Success',
          text: '<?= session()->getFlashdata('success') ?>',
          icon: 'success',
          position: 'top-right',
          showHideTransition: 'slide'
        });
      }, 300);
    </script>
  <?php endif; ?>

  <?php if (session()->getFlashdata('error')): ?>
    <script>
      setTimeout(() => {
        $.toast({
          heading: 'Error',
          text: '<?= session()->getFlashdata('error') ?>',
          icon: 'error',
          position: 'top-right',
          showHideTransition: 'fade'
        });
      }, 300);
    </script>
  <?php endif; ?>

  <!-- Page-specific Scripts -->
  <?= $this->renderSection('scripts') ?>
</body>
</html>
