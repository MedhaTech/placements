<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Placements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('<?= base_url('assets/img/site-bg.jpg') ?>');
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        .login-box {
            max-width: 400px;
            margin: 6% auto;
            background: rgba(255, 255, 255, 0.96);
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .login-box img {
            display: block;
            margin: 0 auto 10px;
            max-height: 80px;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-control {
            width: 100%;
            padding: 10px 40px 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 15px;
        }
        #togglePassword {
            position: absolute;
            top: 69%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 1.1em;
            cursor: pointer;
            color: #666;
            z-index: 1;
        }
        .btn {
            font-weight: 500;
            padding: 10px 0;
        }
        .alert {
            font-size: 14px;
            padding: 8px 12px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <form method="POST" action="<?= base_url('login-user') ?>">
        <img src="<?= base_url('assets/img/mycare.png') ?>" alt="Logo" class="img-fluid">
        <h4 class="text-center mb-4">Sign in to dashboard</h4> 

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="name@admin.com" class="form-control" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter your password" class="form-control" id="password" required>
            <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>

<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
        const isHidden = password.type === 'password';
        password.type = isHidden ? 'text' : 'password';
        toggle.classList.toggle('fa-eye');
        toggle.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
