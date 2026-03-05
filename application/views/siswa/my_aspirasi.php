<!-- Halaman Aspirasi Saya (Siswa) -->
<div class="row">
    <div class="col-12" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0">
                <i class="fas fa-file-alt me-2"></i> Aspirasi Saya
            </h2>
            <div>
                <span class="badge bg-light text-dark me-2">
                    <i class="fas fa-user me-1"></i> <?= htmlspecialchars($this->session->userdata('siswa')->nis) ?>
                </span>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($aspirasi)): ?>
    <!-- Tabs untuk Filter Status -->
    <ul class="nav nav-tabs mb-4" id="statusTabs" role="tablist" data-aos="fade-up">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="semua-tab" data-toggle="tab" data-target="#semua" type="button" role="tab">
                Semua <span class="badge bg-primary ms-1"><?= count($aspirasi) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="menunggu-tab" data-toggle="tab" data-target="#menunggu" type="button" role="tab">
                Menunggu <span class="badge bg-warning ms-1"><?= count(array_filter($aspirasi, function($a) { return $a->status == 'Menunggu'; })) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="proses-tab" data-toggle="tab" data-target="#proses" type="button" role="tab">
                Proses <span class="badge bg-info ms-1"><?= count(array_filter($aspirasi, function($a) { return $a->status == 'Proses'; })) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button" role="tab">
                Selesai <span class="badge bg-success ms-1"><?= count(array_filter($aspirasi, function($a) { return $a->status == 'Selesai'; })) ?></span>
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="statusTabsContent">
        <!-- Semua -->
        <div class="tab-pane fade show active" id="semua" role="tabpanel">
            <div class="row">
                <?php foreach ($aspirasi as $a): ?>
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="card card-aspirasi h-100 status-<?= strtolower($a->status) ?>">
                            <!-- Header Card -->
                            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8fafc;">
                                <div>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar me-1"></i>
                                        <?= date('d M Y H:i', strtotime($a->tanggal)) ?>
                                    </small>
                                </div>
                                <span class="badge badge-<?= strtolower($a->status) ?>">
                                    <?= $a->status ?>
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <!-- Location -->
                                <h5 class="card-title mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <?= htmlspecialchars($a->lokasi) ?>
                                </h5>

                                <!-- Category & Kelas -->
                                <div class="mb-3">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="fas fa-tag me-1"></i> <?= htmlspecialchars($a->nama_kategori ?? 'Umum') ?>
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-book me-1"></i> <?= htmlspecialchars($a->kelas) ?>
                                    </span>
                                </div>

                                <!-- Description -->
                                <p class="card-text text-muted" style="font-size: 0.95rem;">
                                    <?= nl2br(htmlspecialchars($a->keterangan)) ?>
                                </p>

                                <!-- Image -->
                                <?php if ($a->gambar): ?>
                                    <div class="mb-3">
                                        <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($a->gambar)) ?>"
                                            alt="Bukti"
                                            class="img-fluid rounded"
                                            style="max-height: 250px; width: 100%; object-fit: cover;"
                                            loading="lazy">
                                    </div>
                                <?php endif; ?>

                                <!-- Progress & Feedback -->
                                <?php if ($a->status == 'Proses' || $a->status == 'Selesai'): ?>
                                    <div class="alert alert-info py-2 px-3" role="alert">
                                        <small>
                                            <i class="fas fa-info-circle me-1"></i>
                                            <strong>Status Progres:</strong>
                                            <?php
                                            if ($a->status == 'Proses') {
                                                echo 'Aspirasi Anda sedang diproses oleh admin';
                                            } else {
                                                echo 'Aspirasi Anda telah selesai diproses';
                                            }
                                            ?>
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <!-- Feedback Section -->
                                <?php if ($a->feedback): ?>
                                    <div class="feedback-section">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <strong class="text-success">
                                                <i class="fas fa-reply me-1"></i> Umpan Balik Admin
                                            </strong>
                                            <span class="badge bg-success">Balasan</span>
                                        </div>

                                        <p class="mb-2" style="font-size: 0.95rem;">
                                            <?= nl2br(htmlspecialchars($a->feedback)) ?>
                                        </p>

                                        <?php if ($a->feedback_gambar): ?>
                                            <img src="<?= base_url('uploads/feedback/' . htmlspecialchars($a->feedback_gambar)) ?>"
                                                alt="Feedback"
                                                class="img-fluid rounded"
                                                style="max-height: 300px; width: 100%; object-fit: cover;"
                                                loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning py-2 px-3" role="alert">
                                        <small>
                                            <i class="fas fa-hourglass-half me-1"></i>
                                            Menunggu feedback dari admin...
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <!-- Tombol Edit dan Hapus -->
                                <?php if ($a->status == 'Menunggu'): ?>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <a href="<?= base_url('siswa/edit_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <a href="<?= base_url('siswa/hapus_aspirasi/' . $a->id_aspirasi) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Menunggu -->
        <div class="tab-pane fade" id="menunggu" role="tabpanel">
            <div class="row">
                <?php $menunggu = array_filter($aspirasi, function($a) { return $a->status == 'Menunggu'; });
                if (!empty($menunggu)): ?>
                    <?php foreach ($menunggu as $a): ?>
                        <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="card card-aspirasi h-100 status-<?= strtolower($a->status) ?>">
                            <!-- Header Card -->
                            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8fafc;">
                                <div>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar me-1"></i>
                                        <?= date('d M Y H:i', strtotime($a->tanggal)) ?>
                                    </small>
                                </div>
                                <span class="badge badge-<?= strtolower($a->status) ?>">
                                    <?= $a->status ?>
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <!-- Location -->
                                <h5 class="card-title mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <?= htmlspecialchars($a->lokasi) ?>
                                </h5>

                                <!-- Category & Kelas -->
                                <div class="mb-3">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="fas fa-tag me-1"></i> <?= htmlspecialchars($a->nama_kategori ?? 'Umum') ?>
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-book me-1"></i> <?= htmlspecialchars($a->kelas) ?>
                                    </span>
                                </div>

                                <!-- Description -->
                                <p class="card-text text-muted" style="font-size: 0.95rem;">
                                    <?= nl2br(htmlspecialchars($a->keterangan)) ?>
                                </p>

                                <!-- Image -->
                                <?php if ($a->gambar): ?>
                                    <div class="mb-3">
                                        <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($a->gambar)) ?>"
                                            alt="Bukti"
                                            class="img-fluid rounded"
                                            style="max-height: 250px; width: 100%; object-fit: cover;"
                                            loading="lazy">
                                    </div>
                                <?php endif; ?>

                                <!-- Progress & Feedback -->
                                <?php if ($a->status == 'Proses' || $a->status == 'Selesai'): ?>
                                    <div class="alert alert-info py-2 px-3" role="alert">
                                        <small>
                                            <i class="fas fa-info-circle me-1"></i>
                                            <strong>Status Progres:</strong>
                                            <?php
                                            if ($a->status == 'Proses') {
                                                echo 'Aspirasi Anda sedang diproses oleh admin';
                                            } else {
                                                echo 'Aspirasi Anda telah selesai diproses';
                                            }
                                            ?>
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <!-- Feedback Section -->
                                <?php if ($a->feedback): ?>
                                    <div class="feedback-section">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <strong class="text-success">
                                                <i class="fas fa-reply me-1"></i> Umpan Balik Admin
                                            </strong>
                                            <span class="badge bg-success">Balasan</span>
                                        </div>

                                        <p class="mb-2" style="font-size: 0.95rem;">
                                            <?= nl2br(htmlspecialchars($a->feedback)) ?>
                                        </p>

                                        <?php if ($a->feedback_gambar): ?>
                                            <img src="<?= base_url('uploads/feedback/' . htmlspecialchars($a->feedback_gambar)) ?>"
                                                alt="Feedback"
                                                class="img-fluid rounded"
                                                style="max-height: 300px; width: 100%; object-fit: cover;"
                                                loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning py-2 px-3" role="alert">
                                        <small>
                                            <i class="fas fa-hourglass-half me-1"></i>
                                            Menunggu feedback dari admin...
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <!-- Tombol Edit dan Hapus -->
                                <?php if ($a->status == 'Menunggu'): ?>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <a href="<?= base_url('siswa/edit_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <a href="<?= base_url('siswa/hapus_aspirasi/' . $a->id_aspirasi) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-check-circle" style="font-size: 2rem; opacity: 0.3;"></i>
                            <p class="mt-2">Tidak ada aspirasi menunggu</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Proses -->
        <div class="tab-pane fade" id="proses" role="tabpanel">
            <div class="row">
                <?php $proses = array_filter($aspirasi, function($a) { return $a->status == 'Proses'; });
                if (!empty($proses)): ?>
                    <?php foreach ($proses as $a): ?>
                        <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="card card-aspirasi h-100 status-<?= strtolower($a->status) ?>">
                            <!-- Header Card -->
                            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8fafc;">
                                <div>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar me-1"></i>
                                        <?= date('d M Y H:i', strtotime($a->tanggal)) ?>
                                    </small>
                                </div>
                                <span class="badge badge-<?= strtolower($a->status) ?>">
                                    <?= $a->status ?>
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <!-- Location -->
                                <h5 class="card-title mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <?= htmlspecialchars($a->lokasi) ?>
                                </h5>

                                <!-- Category & Kelas -->
                                <div class="mb-3">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="fas fa-tag me-1"></i> <?= htmlspecialchars($a->nama_kategori ?? 'Umum') ?>
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-book me-1"></i> <?= htmlspecialchars($a->kelas) ?>
                                    </span>
                                </div>

                                <!-- Description -->
                                <p class="card-text text-muted" style="font-size: 0.95rem;">
                                    <?= nl2br(htmlspecialchars($a->keterangan)) ?>
                                </p>

                                <!-- Image -->
                                <?php if ($a->gambar): ?>
                                    <div class="mb-3">
                                        <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($a->gambar)) ?>"
                                            alt="Bukti"
                                            class="img-fluid rounded"
                                            style="max-height: 250px; width: 100%; object-fit: cover;"
                                            loading="lazy">
                                    </div>
                                <?php endif; ?>

                                <!-- Progress & Feedback -->
                                <?php if ($a->status == 'Proses' || $a->status == 'Selesai'): ?>
                                    <div class="alert alert-info py-2 px-3" role="alert">
                                        <small>
                                            <i class="fas fa-info-circle me-1"></i>
                                            <strong>Status Progres:</strong>
                                            <?php
                                            if ($a->status == 'Proses') {
                                                echo 'Aspirasi Anda sedang diproses oleh admin';
                                            } else {
                                                echo 'Aspirasi Anda telah selesai diproses';
                                            }
                                            ?>
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <!-- Feedback Section -->
                                <?php if ($a->feedback): ?>
                                    <div class="feedback-section">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <strong class="text-success">
                                                <i class="fas fa-reply me-1"></i> Umpan Balik Admin
                                            </strong>
                                            <span class="badge bg-success">Balasan</span>
                                        </div>

                                        <p class="mb-2" style="font-size: 0.95rem;">
                                            <?= nl2br(htmlspecialchars($a->feedback)) ?>
                                        </p>

                                        <?php if ($a->feedback_gambar): ?>
                                            <img src="<?= base_url('uploads/feedback/' . htmlspecialchars($a->feedback_gambar)) ?>"
                                                alt="Feedback"
                                                class="img-fluid rounded"
                                                style="max-height: 300px; width: 100%; object-fit: cover;"
                                                loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning py-2 px-3" role="alert">
                                        <small>
                                            <i class="fas fa-hourglass-half me-1"></i>
                                            Menunggu feedback dari admin...
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <!-- Tombol Edit dan Hapus -->
                                <?php if ($a->status == 'Menunggu'): ?>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <a href="<?= base_url('siswa/edit_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <a href="<?= base_url('siswa/hapus_aspirasi/' . $a->id_aspirasi) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-spinner" style="font-size: 2rem; opacity: 0.3;"></i>
                            <p class="mt-2">Tidak ada aspirasi dalam proses</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Selesai -->
        <div class="tab-pane fade" id="selesai" role="tabpanel">
            <div class="row">
                <?php $selesai = array_filter($aspirasi, function($a) { return $a->status == 'Selesai'; });
                if (!empty($selesai)): ?>
                    <?php foreach ($selesai as $a): ?>
                        <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="card card-aspirasi h-100 status-<?= strtolower($a->status) ?>">
                            <!-- Header Card -->
                            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8fafc;">
                                <div>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar me-1"></i>
                                        <?= date('d M Y H:i', strtotime($a->tanggal)) ?>
                                    </small>
                                </div>
                                <span class="badge badge-<?= strtolower($a->status) ?>">
                                    <?= $a->status ?>
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <!-- Location -->
                                <h5 class="card-title mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <?= htmlspecialchars($a->lokasi) ?>
                                </h5>

                                <!-- Category & Kelas -->
                                <div class="mb-3">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="fas fa-tag me-1"></i> <?= htmlspecialchars($a->nama_kategori ?? 'Umum') ?>
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-book me-1"></i> <?= htmlspecialchars($a->kelas) ?>
                                    </span>
                                </div>

                                <!-- Description -->
                                <p class="card-text text-muted" style="font-size: 0.95rem;">
                                    <?= nl2br(htmlspecialchars($a->keterangan)) ?>
                                </p>

                                <!-- Image -->
                                <?php if ($a->gambar): ?>
                                    <div class="mb-3">
                                        <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($a->gambar)) ?>"
                                            alt="Bukti"
                                            class="img-fluid rounded"
                                            style="max-height: 250px; width: 100%; object-fit: cover;"
                                            loading="lazy">
                                    </div>
                                <?php endif; ?>

                                <!-- Progress & Feedback -->
                                <?php if ($a->status == 'Proses' || $a->status == 'Selesai'): ?>
                                    <div class="alert alert-info py-2 px-3" role="alert">
                                        <small>
                                            <i class="fas fa-info-circle me-1"></i>
                                            <strong>Status Progres:</strong>
                                            <?php
                                            if ($a->status == 'Proses') {
                                                echo 'Aspirasi Anda sedang diproses oleh admin';
                                            } else {
                                                echo 'Aspirasi Anda telah selesai diproses';
                                            }
                                            ?>
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <!-- Feedback Section -->
                                <?php if ($a->feedback): ?>
                                    <div class="feedback-section">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <strong class="text-success">
                                                <i class="fas fa-reply me-1"></i> Umpan Balik Admin
                                            </strong>
                                            <span class="badge bg-success">Balasan</span>
                                        </div>

                                        <p class="mb-2" style="font-size: 0.95rem;">
                                            <?= nl2br(htmlspecialchars($a->feedback)) ?>
                                        </p>

                                        <?php if ($a->feedback_gambar): ?>
                                            <img src="<?= base_url('uploads/feedback/' . htmlspecialchars($a->feedback_gambar)) ?>"
                                                alt="Feedback"
                                                class="img-fluid rounded"
                                                style="max-height: 300px; width: 100%; object-fit: cover;"
                                                loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning py-2 px-3" role="alert">
                                        <small>
                                            <i class="fas fa-hourglass-half me-1"></i>
                                            Menunggu feedback dari admin...
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <!-- Tombol Edit dan Hapus -->
                                <?php if ($a->status == 'Menunggu'): ?>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <a href="<?= base_url('siswa/edit_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <a href="<?= base_url('siswa/hapus_aspirasi/' . $a->id_aspirasi) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-check-double" style="font-size: 2rem; opacity: 0.3;"></i>
                            <p class="mt-2">Tidak ada aspirasi selesai</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <!-- Empty State -->
    <div class="row">
        <div class="col-12">
            <div class="card text-center py-5">
                <div class="card-body">
                    <i class="fas fa-inbox" style="font-size: 4rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                    <h5 class="text-muted">Belum ada aspirasi</h5>
                    <p class="text-muted mb-3">Mulai dengan menambahkan aspirasi Anda</p>
                    <a href="<?= base_url('siswa/tambah') ?>" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i> Tambah Aspirasi
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
    .badge-menunggu {
        background-color: #F59E0B !important;
        color: white !important;
    }

    .badge-proses {
        background-color: #0EA5E9 !important;
        color: white !important;
    }

    .badge-selesai {
        background-color: #10B981 !important;
        color: white !important;
    }

    .card-aspirasi.status-menunggu {
        border-left: 4px solid #F59E0B;
    }

    .card-aspirasi.status-proses {
        border-left: 4px solid #0EA5E9;
    }

    .card-aspirasi.status-selesai {
        border-left: 4px solid #10B981;
    }
</style>