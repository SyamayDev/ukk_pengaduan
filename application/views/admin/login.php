<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Pengaduan Sarana</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.webp') ?>">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/aos.css') ?>" rel="stylesheet">
    <style>
        body {
            background-image: url('<?= base_url('assets/images/bg_login.webp') ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 0;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }
        .login-card {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
        }
        .login-card h3, .login-card .form-label {
            color: #fff;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 1.5rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            background-color: rgba(255, 255, 255, 0.9);
        }
        .btn-success {
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="login-card" data-aos="fade-up" data-aos-duration="1000">
        <div class="text-center">
            <img src="<?= base_url('assets/images/logo.webp') ?>" alt="Logo" class="logo">
            <h3 class="mb-1 text-white">Login Admin</h3>
            <p class="text-white-50 mb-4">Pengaduan Sarana Sekolah</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/login') ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
            <!-- login siswa -->
            <div class="text-center mt-3">
                <a href="<?= base_url('siswa/login') ?>" class="text-white">Login sebagai Siswa</a>
            </div>
            
        </form>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/aos.js') ?>"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>