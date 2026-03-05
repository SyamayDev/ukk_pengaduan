<div class="card card-aspirasi h-100">
    <!-- Image Section -->
    <?php if ($a->gambar): ?>
        <div class="image-container">
            <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($a->gambar)) ?>"
                alt="<?= htmlspecialchars($a->lokasi) ?>"
                loading="lazy">
        </div>
    <?php else: ?>
        <div class="image-container" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <i class="fas fa-image" style="font-size: 3rem; color: rgba(255,255,255,0.3);"></i>
        </div>
    <?php endif; ?>

    <!-- Card Body -->
    <div class="card-body">
        <!-- Location & Category -->
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0" style="max-width: 70%;">
                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                <?= htmlspecialchars($a->lokasi) ?>
            </h5>
            <span class="badge badge-<?=
                                        ($a->status == 'Selesai' ? 'selesai' : ($a->status == 'Proses' ? 'proses' : 'menunggu'))
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
        <p class="card-text text-muted" style="font-size: 0.9rem; min-height: 10px;">
            <?= substr(htmlspecialchars($a->keterangan), 0, 100) ?>
            <?php if (strlen($a->keterangan) > 100): ?>...<?php endif; ?>
        </p>

        <!-- Meta Info -->
        <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
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
            <div class="feedback-section">
                <strong class="d-block mb-2">
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
    </div>
</div>
