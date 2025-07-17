<?= $this->extend('admin/layout/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="row mb-3">
    <div class="col-md-10 offset-md-1 d-flex justify-content-between align-items-center">
      <h6 class="mb-0" style="font-weight: 600;">Change Password</h6>
      <nav>
        <ol class="breadcrumb mb-0 bg-transparent p-0">
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success text-center">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-center align-items-center">
    <div class="container widget-holder">
        <div class="widget-bg">
            <div class="widget-body clearfix">
                <h5 class="box-title mr-b-0">Reset Password</h5>
                <p class="text-muted">A strong password helps prevent unauthorized access to your account</p>
                
                <!-- FULL WIDTH FORM START -->
                <form class="mr-t-30" method="POST" action="<?= base_url('admin/change_pwd') ?>">
                    <div class="form-group row">
                        <label class="text-sm-center col-sm-4 col-form-label">Current Password</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">lock</i></div>
                                </div>
                                <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                            </div>
                            <small class="text-danger"><?= $errors['current_password'] ?? '' ?></small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="text-sm-center col-sm-4 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">lock</i></div>
                                </div>
                                <input type="password" class="form-control" name="new_password" placeholder="New Password">
                            </div>
                            <small class="text-danger"><?= $errors['new_password'] ?? '' ?></small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="text-sm-center col-sm-4 col-form-label">Confirm New Password</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">lock</i></div>
                                </div>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                            </div>
                            <small class="text-danger"><?= $errors['confirm_password'] ?? '' ?></small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                                <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- FULL WIDTH FORM END -->

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>