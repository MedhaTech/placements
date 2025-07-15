<?php include(APPPATH . 'Views/layout/header.php'); ?>
<?php include(APPPATH . 'Views/layout/main.php'); ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Profile Card -->
        <div class="col-md-3 mb-4">
            <div class="card text-center p-4">
                <img src="<?= base_url('assets/demo/users/user1.jpg') ?>" class="rounded-circle mx-auto mb-3" width="100" alt="User">
                <h5 class="mb-1">John Doe</h5>
                <p class="text-muted mb-3">john@example.com</p>
                <a href="#" class="btn btn-outline-primary btn-sm">Edit Profile</a>
            </div>
        </div>

        <!-- Account Info -->
        <div class="col-md-5 mb-4">
            <div class="card p-4">
                <h6 class="text-muted mb-3">Account Information</h6>
                <p><strong>Full Name:</strong> John Doe</p>
                <p><strong>Email:</strong> john@example.com</p>
                <p><strong>Phone:</strong> +91 9876543210</p>
                <p><strong>Role:</strong> Admin</p>
            </div>
        </div>
    </div>
</div>

<?php include(APPPATH . 'Views/layout/footer.php'); ?>
