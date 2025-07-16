<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'My App' ?></title>

    <!-- Add CSS from your template -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- Add more CSS as needed -->
</head>
<body>
    <!-- HEADER -->
    <?= $this->include('student/layout/header') ?>

    <!-- SIDEBAR -->
    <?= $this->include('student/layout/sidebar') ?>

    <!-- MAIN CONTENT -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- FOOTER -->
    <?= $this->include('student/layout/footer') ?>

    <!-- JS -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <!-- Add more JS as needed -->
</body>
</html>
