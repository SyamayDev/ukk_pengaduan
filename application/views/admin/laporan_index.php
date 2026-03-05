<div class="card">
    <div class="card-header">
        <h3 class="card-title">Filter Laporan Pengaduan</h3>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/laporan/generate') ?>" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="<?= isset($start_date) ? $start_date : '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_date">Tanggal Selesai</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="<?= isset($end_date) ? $end_date : '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="Menunggu" <?= (isset($selected_status) && $selected_status == 'Menunggu') ? 'selected' : '' ?>>Menunggu</option>
                            <option value="Proses" <?= (isset($selected_status) && $selected_status == 'Proses') ? 'selected' : '' ?>>Proses</option>
                            <option value="Selesai" <?= (isset($selected_status) && $selected_status == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Terapkan Filter
                    </button>
                    <a href="<?= base_url('admin/laporan') ?>" class="btn btn-secondary">
                        <i class="fas fa-sync-alt"></i> Reset Filter
                    </a>
                    <a id="cetakBtn" href="<?= base_url('admin/laporan/cetak') ?>" class="btn btn-success" target="_blank">
                        <i class="fas fa-print"></i> Cetak Laporan
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Hasil Laporan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="laporanTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($aspirasi)): ?>
                        <?php $no = 1;
                        foreach ($aspirasi as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($item->nis) ?></td>
                                <td><?= htmlspecialchars($item->nama_kategori ?? '-') ?></td>
                                <td><?= htmlspecialchars($item->lokasi) ?></td>
                                <td><?= htmlspecialchars($item->keterangan) ?></td>
                                <td><?= htmlspecialchars($item->status) ?></td>
                                <td><?= date('d M Y H:i', strtotime($item->tanggal)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>