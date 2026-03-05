<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Aspirasi Siswa' ?> - Pengaduan Sarana</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.webp') ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!-- Font Awesome Icons (OFFLINE) -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <!-- Aos -->
    <link rel="stylesheet" href="<?= base_url('assets/css/aos.css') ?>">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
            padding-bottom: 80px; /* Space for bottom navbar */
        }
        .navbar-brand img {
            max-height: 40px;
        }

        /* Desktop Navigation (Top) */
        .navbar-desktop {
            display: none; /* Hidden on mobile */
        }

        /* Mobile Navigation (Bottom) */
        .navbar-mobile {
            display: flex; /* Shown on mobile */
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e5e7eb;
            z-index: 1000;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.08);
            padding: 0.5rem 0;
            justify-content: space-around;
        }
        .navbar-mobile .nav-item {
            flex: 1;
            text-align: center;
        }
        .navbar-mobile .nav-link {
            color: #6b7280;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            padding: 0.5rem 0;
            font-size: 0.75rem;
            text-decoration: none;
        }
        .navbar-mobile .nav-link i {
            font-size: 1.2rem;
        }
        .navbar-mobile .nav-link.active {
            color: #198754; /* Green to match theme */
            font-weight: 600;
        }

        /* Responsive Breakpoint */
        @media (min-width: 768px) {
            .navbar-desktop {
                display: flex; /* Show on desktop */
            }
            .navbar-mobile {
                display: none; /* Hide on desktop */
            }
             body, html {
                padding-bottom: 0; /* No bottom padding on desktop */
            }
        }
        
        /* Form & Card Styling to match welcome_guest */
        .card {
            border: none;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }
        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }
        .btn-success:hover {
            background-color: #157347;
            border-color: #157347;
        }

        .preview-img {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .preview-img:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
        }


    </style>
</head>
<body>

    <header>
        <!-- Desktop Navigation -->
        <nav class="navbar navbar-expand-md navbar-light bg-gradient shadow-sm navbar-desktop">
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= ($this->uri->segment(1) == 'siswa' && empty($this->uri->segment(2))) ? 'active' : '' ?>" href="<?= base_url('siswa') ?>"><i class="fas fa-home"></i> Semua Aspirasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($this->uri->segment(2) == 'my_aspirasi') ? 'active' : '' ?>" href="<?= base_url('siswa/my_aspirasi') ?>"><i class="fas fa-file-alt"></i> Aspirasiku</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link <?= ($this->uri->segment(2) == 'tambah') ? 'active' : '' ?>" href="<?= base_url('siswa/tambah') ?>"><i class="fas fa-plus-circle"></i> Buat Aspirasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('siswa/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-content py-2">
        <div class="container">
<?php if ($this->session->flashdata('success')): ?>
    <div 
        class="alert alert-success alert-dismissible fade show" 
        role="alert"
        style="
            border-radius: 14px;
            padding: 14px 48px 14px 16px;
            box-shadow: 0 6px 14px rgba(0, 128, 0, 0.15);
            position: relative;
            font-size: 14px;
        "
    >
        <?= $this->session->flashdata('success') ?>

        <button 
            type="button" 
            class="close" 
            data-dismiss="alert" 
            aria-label="Close"
            style="
                position: absolute;
                top: 50%;
                right: 12px;
                transform: translateY(-50%);
                width: 28px;
                height: 28px;
                border-radius: 50%;
                border: none;
                background: rgba(0,0,0,0.08);
                font-size: 18px;
                line-height: 1;
                opacity: 0.7;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s ease;
            "
            onmouseover="this.style.background='rgba(0,0,0,0.15)';this.style.opacity='1'"
            onmouseout="this.style.background='rgba(0,0,0,0.08)';this.style.opacity='0.7'"
        >
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

    <!-- Content starts here -->