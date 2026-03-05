<div class="row justify-content-center my-4" data-aos="zoom-in-up">
    <div class="col-lg-9">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Buat Aspirasi Baru</h5>
            </div>
            <div class="card-body p-4">
                
                <form action="<?= base_url('siswa/simpan') ?>" method="POST" enctype="multipart/form-data" id="formAspirasi">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <select class="form-select form-control" id="kategori" name="kategori" required>
                                <option value="" disabled selected>Pilih kategori aspirasi...</option>
                                <?php if (!empty($kategori)): ?>
                                    <?php foreach ($kategori as $k): ?>
                                        <option value="<?= $k->id_kategori ?>"><?= htmlspecialchars($k->nama_kategori) ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>Kategori tidak tersedia</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-bold">Lokasi Spesifik</label>
                         <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Gedung A, Lantai 2, Toilet Pria" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-bold">Keterangan / Deskripsi</label>
                        <div class="input-group">
                             <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="5" placeholder="Jelaskan secara detail aspirasi atau keluhan Anda di sini..." required></textarea>
                        </div>
                        <div class="form-text mt-1">Jelaskan dengan detail agar mudah dipahami (minimal 10 karakter).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Foto / Bukti (Opsional)</label>
                        <div class="custom-file-input">
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" style="display: none;">
                            <label for="gambar" class="btn btn-outline-secondary d-block">
                                <i class="fas fa-camera me-2"></i> Pilih Gambar...
                            </label>
                        </div>
                        <div class="form-text mt-1">Lampirkan gambar jika diperlukan untuk memperjelas. Maks 5MB.</div>
                        
                        <div class="mt-3" id="imagePreview" style="display: none;">
                            <div class="preview-container position-relative d-inline-block">
                                <img id="previewImg" src="#" alt="Preview Gambar" class="img-fluid rounded shadow-sm" style="max-width: 300px; max-height: 200px; object-fit: cover;">
                                <button type="button" id="removePreview" class="btn btn-danger btn-sm position-absolute top-0 end-0">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <p id="fileName" class="mt-2 text-muted"></p>
                        </div>
                    </div>

                    <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('siswa') ?>" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Aspirasi
                    </button>
                </div>

                </form>
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
            previewImg.src = '#';
            fileNameSpan.textContent = 'Tidak ada file yang dipilih';
            imagePreview.style.display = 'none';
        }

        // Form Validation
        const form = document.getElementById('formAspirasi');
        if(form){
            form.addEventListener('submit', function(e) {
                const keterangan = document.getElementById('keterangan').value;
                if (keterangan.trim().length < 10) {
                    e.preventDefault();
                    alert('Keterangan aspirasi minimal harus 10 karakter.');
                    document.getElementById('keterangan').focus();
                    return false;
                }
            });
        }
    });
</script>