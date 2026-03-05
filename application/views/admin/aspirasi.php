<div class="row">
    <div class="col-12">
        <!-- Filter Tabs -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-filter me-2"></i>Filter Aspirasi Berdasarkan Status</h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?= empty($this->input->get('status')) ? 'active' : '' ?>" href="<?= base_url('admin/aspirasi') ?>" role="tab">
                            <i class="fas fa-list me-1"></i>
                            Semua Aspirasi
                            <span class="badge bg-secondary ms-2"><?= count($aspirasi) ?></span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?= ($this->input->get('status') == 'Menunggu') ? 'active' : '' ?>" href="<?= base_url('admin/aspirasi?status=Menunggu') ?>" role="tab">
                            <i class="fas fa-clock me-1"></i>
                            Menunggu
                            <span class="badge bg-info ms-2"><?= $this->aspirasi_model->count_by_status('Menunggu') ?></span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?= ($this->input->get('status') == 'Proses') ? 'active' : '' ?>" href="<?= base_url('admin/aspirasi?status=Proses') ?>" role="tab">
                            <i class="fas fa-spinner me-1"></i>
                            Proses
                            <span class="badge bg-warning ms-2"><?= $this->aspirasi_model->count_by_status('Proses') ?></span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?= ($this->input->get('status') == 'Selesai') ? 'active' : '' ?>" href="<?= base_url('admin/aspirasi?status=Selesai') ?>" role="tab">
                            <i class="fas fa-check-circle me-1"></i>
                            Selesai
                            <span class="badge bg-success ms-2"><?= $this->aspirasi_model->count_by_status('Selesai') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Aspirasi Cards -->
        <div class="row">
            <?php if (!empty($aspirasi)): ?>
                <?php foreach ($aspirasi as $a): ?>
                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up">
                        <div class="card card-aspirasi h-100 border-left border-<?=
                                                                                ($a->status == 'Selesai' ? 'success' : ($a->status == 'Proses' ? 'warning' : 'info'))
                                                                                ?> border-3">
                            <!-- Image Section -->
                            <?php if ($a->gambar): ?>
                                <div class="image-container" style="height: 200px; overflow: hidden; background-color: #f8f9fa;">
                                    <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($a->gambar)) ?>"
                                        alt="<?= htmlspecialchars($a->lokasi) ?>"
                                        style="width: 100%; height: 100%; object-fit: cover;"
                                        loading="lazy">
                                </div>
                            <?php else: ?>
                                <div class="image-container" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 3rem; color: rgba(255,255,255,0.3);"></i>
                                </div>
                            <?php endif; ?>

                            <!-- Card Body -->
                            <div class="card-body">
                                <!-- Location & Status -->
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0" style="max-width: 70%;">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                        <?= htmlspecialchars($a->lokasi) ?>
                                    </h5>
                                    <span class="badge badge-<?=
                                                                ($a->status == 'Selesai' ? 'success' : ($a->status == 'Proses' ? 'warning' : 'info'))
                                                                ?>">
                                        <?= $a->status ?>
                                    </span>
                                </div>

                                <!-- Category Badge -->
                                <p class="mb-2">
                                    <small class="badge bg-light text-dark">
                                        <i class="fas fa-tag me-1"></i> <?= htmlspecialchars($a->nama_kategori ?? 'Umum') ?>
                                    </small>
                                </p>

                                <!-- Description -->
                                <p class="card-text text-muted" style="font-size: 0.9rem; min-height: 60px;">
                                    <?= substr(htmlspecialchars($a->keterangan), 0, 100) ?>
                                    <?php if (strlen($a->keterangan) > 100): ?>...<?php endif; ?>
                                </p>

                                <!-- Meta Info -->
                                <div class="mb-3 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-user me-1"></i>
                                        <strong><?= htmlspecialchars($a->nis) ?></strong>
                                        (<?= htmlspecialchars($a->kelas) ?>)
                                    </small>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar me-1"></i>
                                        <?= date('d M Y H:i', strtotime($a->tanggal)) ?>
                                    </small>
                                </div>

                                <!-- Feedback Section -->
                                <?php if ($a->feedback): ?>
                                    <div class="feedback-section mb-3 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                                        <strong class="d-block mb-2" style="font-size: 0.9rem;">
                                            <i class="fas fa-reply text-success me-1"></i> Umpan Balik
                                        </strong>
                                        <p class="mb-2" style="font-size: 0.85rem;">
                                            <?= nl2br(htmlspecialchars(substr($a->feedback, 0, 150))) ?>
                                            <?php if (strlen($a->feedback) > 150): ?><br><small class="text-primary">...selengkapnya</small><?php endif; ?>
                                        </p>
                                        <?php if ($a->feedback_gambar): ?>
                                            <img src="<?= base_url('uploads/feedback/' . htmlspecialchars($a->feedback_gambar)) ?>"
                                                alt="Feedback"
                                                class="img-fluid rounded mt-2"
                                                style="max-height: 200px; width: 100%; object-fit: cover;"
                                                loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Action Buttons -->
                                <div class="btn-group w-100" role="group">
                                    <a href="<?= base_url('admin/edit_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-sm btn-info flex-fill" title="Proses & Feedback">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/delete_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-sm btn-danger flex-fill" title="Hapus" onclick="return confirm('Yakin hapus aspirasi ini?')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="card text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-inbox fa-4x text-muted mb-3" style="opacity: 0.3;"></i>
                            <h5 class="text-muted">Tidak ada aspirasi</h5>
                            <p class="text-muted mb-3">Belum ada aspirasi untuk status ini</p>
                            <a href="<?= base_url('admin/aspirasi') ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-list me-1"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .badge-success {
        background-color: #10B981 !important;
        color: white !important;
    }

    .badge-info {
        background-color: #0EA5E9 !important;
        color: white !important;
    }

    .badge-warning {
        background-color: #F59E0B !important;
        color: white !important;
    }

    .card-aspirasi {
        transition: all 0.3s ease;
        border-top: none !important;
        border-right: none !important;
        border-bottom: none !important;
    }

    .card-aspirasi:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
    }

    .image-container {
        position: relative;
        overflow: hidden;
        background-color: #f0f0f0;
    }

    .image-container img {
        transition: transform 0.3s ease;
    }

    .card-aspirasi:hover .image-container img {
        transform: scale(1.05);
    }

    .border-success {
        border-left-color: #10B981 !important;
    }

    .border-warning {
        border-left-color: #F59E0B !important;
    }

    .border-info {
        border-left-color: #0EA5E9 !important;
    }

    .nav-tabs .nav-link {
        color: #6B7280;
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        color: #374151;
        border-bottom-color: #D1D5DB;
    }

    .nav-tabs .nav-link.active {
        color: #1F2937;
        border-bottom-color: #3B82F6;
        background: transparent;
    }

    .feedback-section {
        background-color: #F3F4F6;
        padding: 12px;
        border-radius: 6px;
    }
</style>