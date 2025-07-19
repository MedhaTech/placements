<?= $this->extend('student/layout/default') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success text-center">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<main class="main-wrapper clearfix">
    <!-- Page Title Area -->
    <div class="container-fluid">
        <div class="row page-title clearfix">
            <div class="page-title-left">
                <h6 class="page-title-heading mr-0 mr-r-5">Change Password</h6>
                <p class="page-title-description mr-0 d-none d-md-inline-block">A strong password helps prevent unauthorized access to your account</p>
            </div>
            <!-- /.page-title-left -->
        </div>
        <!-- /.page-title -->
    </div>
    <!-- /.container-fluid -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="container">
        <div class="widget-list">
            <div class="row">
                <div class="widget-holder col-md-12">
                    <div class="widget-bg">
                        <!-- <div class="widget-heading widget-heading-border">
                            <h5 class="widget-title">Blank Starter Page</h5>
                        </div> -->
                        <!-- /.widget-heading -->
                        <div class="widget-body">
                            <!-- FULL WIDTH FORM START -->
                            <form class="mr-t-30" method="POST" action="<?= base_url('student/student_pwd') ?>">
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
                                            <a href="<?= base_url('student/dashboard') ?>" class="btn btn-default">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- FULL WIDTH FORM END -->
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.widget-list -->
    </div>
    <!-- /.container-fluid -->
</main>
 
 

<?= $this->endSection() ?>