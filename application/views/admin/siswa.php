<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>Daftar Siswa
                </h3>
                <div class="card-tools">
                    <a href="<?= base_url('admin/add_siswa') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah Siswa
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <?php if (!empty($siswa)): ?>
                    <div class="table-responsive">
                        <table id="siswaTable" class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 25%;">NIS</th>
                                    <th style="width: 25%;">Kelas</th>
                                    <th style="width: 20%;">Total Aspirasi</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($siswa as $s): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= htmlspecialchars($s->nis) ?></strong></td>
                                        <td><?= htmlspecialchars($s->kelas) ?></td>
                                        <td>
                                            <?php
                                            // hitung aspirasi menggunakan model sehingga nama tabel sesuai schema terbaru
                                            $count = count($this->aspirasi_model->get_by_nis($s->nis));
                                            echo '<span class="badge badge-success">' . $count . ' aspirasi</span>';
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?= base_url('admin/edit_siswa/' . $s->nis) ?>" class="btn btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/delete_siswa/' . $s->nis) ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Yakin hapus siswa ini? Siswa yang memiliki aspirasi tidak dapat dihapus.')">
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
                        <i class="fas fa-users-slash fa-2x"></i>
                        <p class="mt-2">Belum ada data siswa.</p>
                        <a href="<?= base_url('admin/add_siswa') ?>" class="btn btn-sm btn-primary mt-2">
                            <i class="fas fa-plus mr-1"></i> Tambah Siswa Baru
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>