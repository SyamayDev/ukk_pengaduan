<!-- Admin Dashboard -->
<div class="row" data-aos="fade-up">
    <!-- Stats Cards -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-primary border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Total Aspirasi</p>
                        <h3 class="mb-0"><?= $total_aspirasi ?></h3>
                    </div>
                    <div style="font-size: 2.5rem; color: #3B82F6; opacity: 0.2;">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Menunggu</p>
                        <h3 class="mb-0" style="color: #F59E0B;"><?= $aspirasi_menunggu ?></h3>
                    </div>
                    <div style="font-size: 2.5rem; color: #F59E0B; opacity: 0.2;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-info border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Proses</p>
                        <h3 class="mb-0" style="color: #0EA5E9;"><?= $aspirasi_proses ?></h3>
                    </div>
                    <div style="font-size: 2.5rem; color: #0EA5E9; opacity: 0.2;">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-success border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Selesai</p>
                        <h3 class="mb-0" style="color: #10B981;"><?= $aspirasi_selesai ?></h3>
                    </div>
                    <div style="font-size: 2.5rem; color: #10B981; opacity: 0.2;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Aspirations -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card" data-aos="fade-up" data-aos-delay="100">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i> Aspirasi Terbaru
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="recentAspirasiTable" class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th>NIS</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th style="width: 20%;">Keterangan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($aspirasi)): ?>
                                <?php $no = 1;
                                foreach ($aspirasi as $a): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark"><?= htmlspecialchars($a->nis) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($a->lokasi) ?></td>
                                        <td><?= htmlspecialchars($a->nama_kategori ?? '-') ?></td>
                                        <td>
                                            <small><?= substr(htmlspecialchars($a->keterangan), 0, 30) ?>...</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-<?=
                                                                        ($a->status == 'Selesai' ? 'success' : ($a->status == 'Proses' ? 'info' : 'warning'))
                                                                        ?>">
                                                <?= $a->status ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small><?= date('d/m/Y H:i', strtotime($a->tanggal)) ?></small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?= base_url('admin/edit_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-warning" title="Proses & Feedback">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/delete_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Yakin hapus aspirasi ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- DataTables will display a default "No data available" message when
                                     the table body is empty, so we don't need a custom colspan row. -->
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('admin/aspirasi') ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-right me-2"></i> Lihat Semua
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Notification Container -->
<div id="notificationContainer"></div>


<style>
    .badge-success {
        background-color: #10B981 !important;
    }

    .badge-info {
        background-color: #0EA5E9 !important;
    }

    .badge-warning {
        background-color: #F59E0B !important;
    }

    .border-primary {
        border-color: #3B82F6 !important;
    }

    .border-warning {
        border-color: #F59E0B !important;
    }

    .border-info {
        border-color: #0EA5E9 !important;
    }

    .border-success {
        border-color: #10B981 !important;
    }

    /* ===== NOTIFICATION STYLES ===== */
    #notificationContainer {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 350px;
    }

    .notification {
        background: white;
        border-left: 4px solid #3B82F6;
        padding: 16px;
        margin-bottom: 12px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        animation: slideIn 0.4s ease-out;
        cursor: pointer;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .notification:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        transform: translateX(-5px);
    }

    .notification.info {
        border-left-color: #3B82F6;
    }

    .notification.success {
        border-left-color: #10B981;
    }

    .notification.warning {
        border-left-color: #F59E0B;
    }

    .notification.danger {
        border-left-color: #EF4444;
    }

    .notification-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 12px;
        font-size: 20px;
        float: left;
        flex-shrink: 0;
    }

    .notification.info .notification-icon {
        background-color: #DDE9F9;
        color: #3B82F6;
    }

    .notification.success .notification-icon {
        background-color: #D2F5E9;
        color: #10B981;
    }

    .notification.warning .notification-icon {
        background-color: #FEF3C7;
        color: #F59E0B;
    }

    .notification.danger .notification-icon {
        background-color: #FEE2E2;
        color: #EF4444;
    }

    .notification-content {
        overflow: hidden;
    }

    .notification-title {
        font-weight: bold;
        color: #1F2937;
        margin-bottom: 4px;
        font-size: 14px;
    }

    .notification-message {
        color: #6B7280;
        font-size: 13px;
        line-height: 1.4;
    }

    .notification-close {
        float: right;
        cursor: pointer;
        color: #9CA3AF;
        font-size: 20px;
        line-height: 1;
        transition: color 0.2s ease;
        margin-left: 10px;
    }

    .notification-close:hover {
        color: #374151;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(400px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(400px);
        }
    }
</style>

<!-- Dashboard Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('notificationContainer');

        // Main function to show notifications
        function showNotification(title, message, type = 'info', duration = 5000, onClick = null) {
            const icons = {
                info: 'fas fa-info-circle',
                success: 'fas fa-check-circle',
                warning: 'fas fa-exclamation-triangle',
                danger: 'fas fa-times-circle'
            };

            const notif = document.createElement('div');
            notif.className = `notification ${type}`;
            notif.innerHTML = `
                <div class="notification-icon">
                    <i class="${icons[type]}"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">${title}</div>
                    <p class="notification-message">${message}</p>
                </div>
                <span class="notification-close">&times;</span>
            `;

            container.appendChild(notif);

            // Click to execute action or close
            notif.addEventListener('click', (e) => {
                if (e.target.className === 'notification-close') {
                    closeNotification(notif);
                    return;
                }
                if (onClick) {
                    onClick();
                } else {
                    closeNotification(notif);
                }
            });

            // Auto-dismiss
            if (duration) {
                setTimeout(() => closeNotification(notif), duration);
            }
        }

        function closeNotification(notif) {
            if (!notif) return;
            notif.style.animation = 'slideOut 0.4s ease-out forwards';
            setTimeout(() => {
                if (notif.parentNode === container) {
                    container.removeChild(notif);
                }
            }, 400);
        }

        // --- Trigger Notifications ---

        // 1. Welcome Notification
        const hour = new Date().getHours();
        let greeting = 'Selamat Pagi';
        if (hour >= 12 && hour < 17) greeting = 'Selamat Siang';
        else if (hour >= 17) greeting = 'Selamat Malam';

        showNotification(
            `${greeting}, Admin!`,
            'Dashboard siap digunakan. Mari kelola aspirasi siswa.',
            'info',
            5000
        );

        // 2. New Aspiration Notification (from flash data)
        <?php if ($this->session->flashdata('new_aspirasi')): ?>
            setTimeout(() => {
                showNotification(
                    '🚀 1 Pesan Baru',
                    'Aspirasi baru telah diterima dan menunggu untuk diproses.',
                    'success',
                    7000,
                    () => {
                        window.location.href = '<?= base_url('admin/aspirasi') ?>';
                    }
                );
            }, 1000); // Delay to not overlap with welcome
        <?php endif; ?>

        // 3. Pending Aspirations Summary
        <?php if ($aspirasi_menunggu > 0): ?>
            setTimeout(() => {
                showNotification(
                    '🔔 Ada Aspirasi Menunggu',
                    'Terdapat <?= $aspirasi_menunggu ?> aspirasi yang perlu diproses.',
                    'warning',
                    8000,
                    () => {
                        window.location.href = '<?= base_url('admin/aspirasi?status=Menunggu') ?>';
                    }
                );
            }, 2000); // Delay further
        <?php endif; ?>
    });
</script>