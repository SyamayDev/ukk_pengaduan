<div class="container my-5" data-aos="zoom-in-up">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Aspirasi</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('siswa/update_aspirasi') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_aspirasi" value="<?= htmlspecialchars($aspirasi->id_aspirasi) ?>">

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori...</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= htmlspecialchars($k->id_kategori) ?>" <?= ($k->id_kategori == $aspirasi->id_kategori) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($k->nama_kategori) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= htmlspecialchars($aspirasi->lokasi) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required><?= htmlspecialchars($aspirasi->keterangan) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto / Bukti (Opsional)</label>
                            <div class="custom-file-input">
                                <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*" style="display: none;">
                                <label for="gambar" class="btn btn-outline-secondary d-block">
                                    <i class="fas fa-camera me-2"></i> Pilih Gambar...
                                </label>
                            </div>
                            <div class="form-text mt-1">Lampirkan gambar jika diperlukan untuk memperjelas. Maks 5MB.</div>
                            
                            <div class="mt-3" id="imagePreview" style="display: <?= $aspirasi->gambar ? 'block' : 'none' ?>;">
                                <div class="preview-container position-relative d-inline-block">
                                    <img id="previewImg" 
                                         src="<?= $aspirasi->gambar ? base_url('uploads/aspirasi/' . htmlspecialchars($aspirasi->gambar)) : '#' ?>" 
                                         alt="Preview Gambar" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-width: 300px; max-height: 200px; object-fit: cover;">
                                    <button type="button" id="removePreview" class="btn btn-danger btn-sm position-absolute top-0 end-0" style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <p id="fileName" class="mt-2 text-muted"></p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('siswa/my_aspirasi') ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .preview-container {
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 8px;
    }
    .preview-container img {
        transition: transform 0.3s ease;
    }
    .preview-container:hover img {
        transform: scale(1.05);
    }
    #removePreview {
        z-index: 10;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gambarInput = document.getElementById('gambar');
        const previewImg = document.getElementById('previewImg');
        const fileNameSpan = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreview');
        const removePreview = document.getElementById('removePreview');

        if (gambarInput) {
            gambarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Update file name display
                    fileNameSpan.textContent = file.name;
                    
                    // Show image preview
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImg.src = event.target.result;
                        imagePreview.style.display = 'block';
                        removePreview.style.display = 'block'; // Show remove button for new upload
                    };
                    reader.readAsDataURL(file);
                } else {
                    resetPreview();
                }
            });
        }

        if (removePreview) {
            removePreview.addEventListener('click', function() {
                gambarInput.value = ''; // Clear file input
                resetPreview();
            });
        }

        function resetPreview() {
            <?php if ($aspirasi->gambar): ?>
                previewImg.src = '<?= base_url('uploads/aspirasi/' . htmlspecialchars($aspirasi->gambar)) ?>';
                fileNameSpan.textContent = 'Gambar existing: <?= htmlspecialchars($aspirasi->gambar) ?>';
                removePreview.style.display = 'none'; // Hide remove for existing
            <?php else: ?>
                previewImg.src = '#';
                fileNameSpan.textContent = 'Tidak ada file yang dipilih';
                imagePreview.style.display = 'none';
            <?php endif; ?>
        }
    });
</script>