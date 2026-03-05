<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Pengaduan Sarana</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.webp') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/aos.css') ?>">
    <style>
        body { margin: 0; background-color: #f8f9fa; min-height: 100vh; }
        .navbar-brand img { max-height: 40px; }
        .fab {
            position: fixed; bottom: 40px; right: 40px; width: 70px; height: 70px;
            background-color: #198754; border-radius: 50%; display: flex;
            align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: all 0.3s ease-in-out; z-index: 1000; color: #fff; text-decoration: none;
        }
        .fab:hover { background-color: #157347; transform: scale(1.05); box-shadow: 0 6px 16px rgba(0,0,0,0.3); }
        .fab i { font-size: 28px; }
        .card-aspirasi { border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-aspirasi:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08); }
        .image-container { height: 200px; display: flex; align-items: center; justify-content: center; background-color: #f3f4f6; }
        .image-container img { width: 100%; height: 100%; object-fit: cover; }
        .badge-menunggu { background-color: #f59e0b; color: white; }
        .badge-proses { background-color: #3b82f6; color: white; }
        .badge-selesai { background-color: #10b981; color: white; }
        .feedback-section { margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e5e7eb; }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/images/logo.webp') ?>" alt="Logo" class="d-inline-block align-text-top me-2">
                <span class="fw-bold">TRIADU</span>
            </a>
            <div class="ms-auto">
                <a href="<?= base_url('admin') ?>" class="btn btn-outline-success">
                    <i class="fas fa-user-lock me-2"></i>Login Admin
                </a>
            </div>
        </div>
    </nav>
</header>

<main class="py-2">
    <div class="container">
        <h2 class="text-center mb-2">Daftar Aspirasi & Pengaduan</h2>

        <?php if (!empty($aspirasi)): ?>

            <!-- Tabs Filter Status -->
            <ul class="nav nav-tabs mb-4" id="statusTabs" role="tablist" data-aos="fade-up">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="semua-tab" data-toggle="tab" data-target="#semua" type="button" role="tab">
                        Semua <span class="badge bg-primary ms-1"><?= count($aspirasi) ?></span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menunggu-tab" data-toggle="tab" data-target="#menunggu" type="button" role="tab">
                        Menunggu <span class="badge bg-warning ms-1">
                            <?= count(array_filter($aspirasi, function($a) { return $a->status == 'Menunggu'; })) ?>
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="proses-tab" data-toggle="tab" data-target="#proses" type="button" role="tab">
                        Proses <span class="badge bg-info ms-1">
                            <?= count(array_filter($aspirasi, function($a) { return $a->status == 'Proses'; })) ?>
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button" role="tab">
                        Selesai <span class="badge bg-success ms-1">
                            <?= count(array_filter($aspirasi, function($a) { return $a->status == 'Selesai'; })) ?>
                        </span>
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="statusTabsContent">
                <!-- Semua -->
                <div class="tab-pane fade show active" id="semua" role="tabpanel">
                    <div class="row">
                        <?php foreach ($aspirasi as $a): ?>
                            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= rand(100, 300) ?>">
                                <?php include('guest_aspirasi_card.php'); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Menunggu -->
                <div class="tab-pane fade" id="menunggu" role="tabpanel">
                    <div class="row">
                        <?php 
                        $menunggu = array_filter($aspirasi, function($a) { return $a->status == 'Menunggu'; }); 
                        ?>
                        <?php if (!empty($menunggu)): ?>
                            <?php foreach ($menunggu as $a): ?>
                                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= rand(100, 300) ?>">
                                    <?php include('guest_aspirasi_card.php'); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center text-muted py-5">
                                <i class="fas fa-check-circle fa-3x mb-3"></i>
                                <p>Tidak ada aspirasi yang menunggu.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Proses -->
                <div class="tab-pane fade" id="proses" role="tabpanel">
                    <div class="row">
                        <?php 
                        $proses = array_filter($aspirasi, function($a) { return $a->status == 'Proses'; }); 
                        ?>
                        <?php if (!empty($proses)): ?>
                            <?php foreach ($proses as $a): ?>
                                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= rand(100, 300) ?>">
                                    <?php include('guest_aspirasi_card.php'); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center text-muted py-5">
                                <i class="fas fa-spinner fa-3x mb-3"></i>
                                <p>Tidak ada aspirasi yang sedang diproses.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Selesai -->
                <div class="tab-pane fade" id="selesai" role="tabpanel">
                    <div class="row">
                        <?php 
                        $selesai = array_filter($aspirasi, function($a) { return $a->status == 'Selesai'; }); 
                        ?>
                        <?php if (!empty($selesai)): ?>
                            <?php foreach ($selesai as $a): ?>
                                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= rand(100, 300) ?>">
                                    <?php include('guest_aspirasi_card.php'); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center text-muted py-5">
                                <i class="fas fa-check-double fa-3x mb-3"></i>
                                <p>Tidak ada aspirasi yang telah selesai.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <div class="card text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-inbox" style="font-size: 4rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                            <h5 class="text-muted">Belum ada aspirasi</h5>
                            <p class="text-muted mb-3">Jadilah yang pertama memberikan aspirasi!</p>
                            <?php if ($this->session->userdata('siswa')): ?>
                                <a href="<?= base_url('siswa/tambah') ?>" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i> Tambah Aspirasi
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('siswa/login_page') ?>" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i> Tambah Aspirasi
                                </a>    
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>

<a href="<?= base_url('siswa/login_page') ?>" class="fab" title="Buat Aduan / Login Siswa">
    <i class="fas fa-plus"></i>
</a>

<!-- Scripts -->
<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/aos.js') ?>"></script>
<script>
    $(document).ready(function() {
        if (typeof AOS !== 'undefined') {
            AOS.init({ duration: 650, once: true });
        }

        // Tab handling (Bootstrap 4)
        $('#statusTabs .nav-link').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
</body>
</html>