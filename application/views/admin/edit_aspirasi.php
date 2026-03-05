<div class="row">
    <!-- Aspirasi Details Column -->
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-comment-alt mr-2"></i>Detail Aspirasi</h3>
            </div>
            <div class="card-body">
                <div class="callout callout-info">
                    <h5>Info Siswa</h5>
                    <p>
                        <strong>NIS:</strong> <?= htmlspecialchars($aspirasi->nis) ?><br>
                        <strong>Kelas:</strong> <?= htmlspecialchars($aspirasi->kelas) ?><br>
                        <strong>Tanggal Lapor:</strong> <?= date('d M Y, H:i', strtotime($aspirasi->tanggal)) ?>
                    </p>
                </div>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>
                <p class="text-muted"><?= htmlspecialchars($aspirasi->lokasi) ?></p>

                <strong><i class="fas fa-tag mr-1"></i> Kategori</strong>
                <p class="text-muted"><?= htmlspecialchars($aspirasi->nama_kategori ?? 'Umum') ?></p>

                <strong><i class="fas fa-file-alt mr-1"></i> Keterangan</strong>
                <p class="text-muted"><?= nl2br(htmlspecialchars($aspirasi->keterangan)) ?></p>

                <?php if ($aspirasi->gambar): ?>
                    <hr>
                    <strong><i class="fas fa-image mr-1"></i> Gambar Lampiran</strong><br>
                    <a href="<?= base_url('uploads/aspirasi/' . htmlspecialchars($aspirasi->gambar)) ?>" target="_blank">
                        <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($aspirasi->gambar)) ?>" alt="Aspirasi" class="img-fluid rounded mt-2" style="max-height: 300px;">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Feedback Form Column -->
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Beri Feedback & Update Status</h3>
            </div>
            <!-- /.card-header -->
            <form action="<?= base_url('admin/edit_aspirasi/' . $aspirasi->id_aspirasi) ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="status">Status Aspirasi</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Menunggu" <?= ($aspirasi->status == 'Menunggu') ? 'selected' : '' ?>>Menunggu</option>
                            <option value="Proses" <?= ($aspirasi->status == 'Proses') ? 'selected' : '' ?>>Proses</option>
                            <option value="Selesai" <?= ($aspirasi->status == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="feedback">Umpan Balik / Balasan</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="5" placeholder="Berikan balasan atau umpan balik untuk siswa..."><?= htmlspecialchars($aspirasi->feedback ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="feedback_gambar">Gambar Feedback (Opsional)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="feedback_gambar" name="feedback_gambar" accept="image/*">
                                <label class="custom-file-label" for="feedback_gambar">Pilih file...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Max 5MB. Format: JPG, PNG, GIF.</small>
                    </div>

                    <!-- Image Previews -->
                    <div class="row mt-3">
                        <?php if ($aspirasi->feedback_gambar): ?>
                            <div class="col-6">
                                <small class="text-muted d-block mb-2">Gambar Feedback Saat Ini:</small>
                                <img src="<?= base_url('uploads/feedback/' . htmlspecialchars($aspirasi->feedback_gambar)) ?>" alt="Feedback" class="img-fluid rounded" style="max-height: 150px;">
                            </div>
                        <?php endif; ?>
                        <div class="col-6" id="feedbackPreview" style="display: none;">
                            <small class="text-muted d-block mb-2">Pratinjau Gambar Baru:</small>
                            <img id="previewFeedbackImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="<?= base_url('admin/aspirasi') ?>" class="btn btn-secondary"><i class="fas fa-times mr-2"></i>Batal</a>
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    // Bootstrap custom file input name update
    const fileInput = document.getElementById('feedback_gambar');
    if(fileInput) {
        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file...';
            const nextSibling = e.target.nextElementSibling;
            if(nextSibling) {
                nextSibling.innerText = fileName;
            }

            // Image Preview
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewFeedbackImg').src = event.target.result;
                    document.getElementById('feedbackPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>