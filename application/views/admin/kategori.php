<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-2"></i>Daftar Kategori
                </h3>
                <div class="card-tools">
                    <a href="<?= base_url('admin/add_kategori') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah Kategori
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <?php if (!empty($kategori)): ?>
                    <div class="table-responsive">
                        <table id="kategoriTable" class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Nama Kategori</th>
                                    <th style="width: 20%;">Digunakan Dalam</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($kategori as $k): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?= htmlspecialchars($k->nama_kategori) ?>
                                        </td>
                                        <td>
                                            <?php
                                            // gunakan model agar nama tabel sesuai dengan schema
                                            $count = count($this->aspirasi_model->get_all(NULL, $k->id_kategori));
                                            echo '<span class="badge badge-info">' . $count . ' aspirasi</span>';
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?= base_url('admin/edit_kategori/' . $k->id_kategori) ?>"
                                                    class="btn btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/delete_kategori/' . $k->id_kategori) ?>"
                                                    class="btn btn-danger" title="Hapus"
                                                    onclick="return confirm('Yakin hapus kategori ini? Kategori yang sudah digunakan tidak dapat dihapus.')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-2x"></i>
                        <p class="mt-2">Belum ada kategori yang ditambahkan.</p>
                        <a href="<?= base_url('admin/add_kategori') ?>" class="btn btn-sm btn-primary mt-2">
                            <i class="fas fa-plus mr-1"></i> Tambah Kategori Baru
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>