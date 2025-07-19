<?= $this->extend('student/layout/default') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
  <h2>Upload Student Excel</h2>
  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
  <form action="<?= base_url('student/uploadExcel') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3">
      <input type="file" name="excel_file" required class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
  </form>
</div>
<?= $this->endSection() ?>
