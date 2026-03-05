<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title . ' - Triadu Admin' : 'Triadu Admin' ?></title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.webp') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons (OFFLINE) -->
  <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">

  <!-- AdminLTE Theme style (OFFLINE) -->
  <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/buttons.bootstrap4.min.css') ?>">


  <style>
/* ===== DataTables Styling ===== */
.dataTables_wrapper .dataTables_length label,
.dataTables_wrapper .dataTables_filter label {
    font-weight: 600;
    color: #495057;
}

.dataTables_wrapper .dataTables_filter input {
    border-radius: 20px;
    padding: 4px 12px;
    border: 1px solid #ced4da;
    outline: none;
}

.dataTables_wrapper .dataTables_length select {
    border-radius: 8px;
    padding: 4px 8px;
}

table.dataTable {
    border-collapse: separate !important;
    border-spacing: 0 6px;
}

table.dataTable thead th {
    background: #f4f6f9;
    border-bottom: none !important;
    font-weight: 700;
    color: #343a40;
}

table.dataTable tbody tr {
    background: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,.05);
    transition: all .2s ease;
}

table.dataTable tbody tr:hover {
    transform: scale(1.005);
    box-shadow: 0 6px 14px rgba(0,0,0,.08);
}

table.dataTable td {
    vertical-align: middle;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    border-radius: 50% !important;
    margin: 0 3px;
    border: none !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #007bff !important;
    color: #fff !important;
}

.dataTables_wrapper .dt-buttons .btn {
    border-radius: 8px;
    font-size: 13px;
    padding: 5px 10px;
}

/* Jarak kanan-kiri Search box */
.dataTables_wrapper .dataTables_filter {
    margin-right: 10px;
}

/* Jarak dalam input search */
.dataTables_wrapper .dataTables_filter input {
    margin-left: 6px;
}

/* Biar di mobile nggak nempel */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_filter {
        text-align: left !important;
        margin-top: 10px;
    }
}
/* ===== PERBAIKAN TAMPILAN DATATABLES ===== */

/* 1. Mengatur jarak (padding) container kontrol agar tidak nabrak pinggir */
/* Ini akan memberi jarak pada baris Search/Length (atas) dan Pagination/Info (bawah) */
.dataTables_wrapper > .row:first-child, 
.dataTables_wrapper > .row:last-child {
    padding: 15px 20px; /* Atas-Bawah 15px, Kiri-Kanan 20px */
    margin: 0; /* Reset margin bawaan row bootstrap agar tidak melebar keluar */
}

/* 2. Memberi garis pembatas (divider) di bawah area search agar lebih rapi */
.dataTables_wrapper > .row:first-child {
    border-bottom: 1px solid #ebebeb; /* Garis halus */
    margin-bottom: 10px; /* Jarak antara search dengan tabel */
}

/* 3. Memperbaiki lebar input "Tampilkan [10] data" yang kekecilan */
.dataTables_wrapper .dataTables_length select {
    min-width: 70px; /* Lebar minimum agar angka tidak terpotong */
    padding: 4px 8px;
    margin: 0 5px; /* Jarak antara teks dan kotak input */
    display: inline-block;
}

/* 4. Memastikan input Search tidak terlalu nempel kanan (opsional, sudah tercover padding di poin 1) */
.dataTables_wrapper .dataTables_filter {
    padding-right: 0;
}

/* 5. Styling tambahan agar tabel terlihat menyatu dengan card */
table.dataTable {
    margin-top: 0 !important;
    border-top: none;
}

/* Memberi jarak antar tombol di DataTables */
.dt-buttons .btn {
    margin-right: 5px; /* Jarak kanan antar tombol */
    border-radius: 4px !important; /* Membuat sudut tombol sedikit melengkung */
    margin-bottom: 5px;
}

/* Perbaikan Margin Kontrol DataTables */
.dataTables_wrapper .row:first-child, 
.dataTables_wrapper .row:last-child {
    margin: 0 !important;
    padding: 10px 15px; /* Memberikan jarak agar tidak nempel ke pinggir card */
}

/* Memperbaiki dropdown Tampilkan Data yang kekecilan */
.dataTables_wrapper .dataTables_length select {
    min-width: 60px;
    margin: 0 5px;
    display: inline-block !important;
}

/* Jarak antar tombol ekspor */
.dt-buttons .btn {
    margin-right: 5px;
    border-radius: 4px !important;
}

/* Divider halus di bawah header kontrol */
.dataTables_wrapper .row:first-child {
    border-bottom: 1px solid #f4f4f4;
    padding-bottom: 15px;
}
</style>

  <!-- Notification System -->
  <script src="<?= base_url('assets/js/notification-system.js') ?>"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">TRIADU Admin</span>
            <div class="dropdown-divider"></div>

            <!-- Time & Date -->
            <div class="dropdown-item text-center">
              <i class="far fa-clock mr-1"></i>
              <strong id="admin-jam">00:00:00</strong><br>
              <small id="admin-tanggal">-- -- ----</small>
            </div>

            <div class="dropdown-divider"></div>

            <div class="text-center">
              <a href="<?= base_url('admin/logout') ?>" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </a>
            </div>
          </div>

        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
        <img src="<?= base_url('assets/images/logo.webp') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TRIADU Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/aspirasi') ?>" class="nav-link <?= ($this->uri->segment(2) == 'aspirasi') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-comments"></i>
                <p>Kelola Aspirasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/kategori') ?>" class="nav-link <?= ($this->uri->segment(2) == 'kategori') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-list"></i>
                <p>Kelola Kategori</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/siswa') ?>" class="nav-link <?= ($this->uri->segment(2) == 'siswa') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Kelola Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/laporan') ?>" class="nav-link <?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-print"></i>
                <p>Laporan Pengaduan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= isset($title) ? $title : 'Dashboard' ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                <li class="breadcrumb-item active"><?= isset($title) ? $title : 'Dashboard' ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle mr-2"></i>
              <?= $this->session->flashdata('success') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle mr-2"></i>
              <?= $this->session->flashdata('error') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          <?php endif; ?>

          <!-- Page content starts here -->