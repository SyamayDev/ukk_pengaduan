<!-- Page content ends here -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Pengaduan Sarana
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; <?= date('Y') ?> <a href="#">TRIADU</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js') ?>"></script>

<!-- DataTables Buttons -->
<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.bootstrap4.min.js') ?>"></script>

<!-- Export Dependencies -->
<script src="<?= base_url('assets/js/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/js/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/js/vfs_fonts.js') ?>"></script>

<!-- Buttons -->
<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/js/buttons.colVis.min.js') ?>"></script>

<!-- AdminLTE -->
<script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>


<?php if (isset($pending_aspirasi_count) && $pending_aspirasi_count > 0): ?>
  <script>
    $(document).ready(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Notifikasi Aspirasi',
        subtitle: 'Baru',
        body: 'Ada <strong><?= $pending_aspirasi_count ?></strong> aspirasi baru yang menunggu untuk diproses. <br/><a href="<?= base_url('admin/aspirasi') ?>" class="text-white"><u>Klik untuk melihat.</u></a>',
        position: 'bottomRight',
        autohide: true,
        delay: 7000, // 7 seconds
        icon: 'fas fa-envelope fa-lg',
      });
    });
  </script>
<?php endif; ?>

<script>
  function updateAdminTime() {
    const now = new Date();

    const jam = now.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit'
    });

    const tanggal = now.toLocaleDateString('id-ID', {
      weekday: 'long',
      day: 'numeric',
      month: 'long',
      year: 'numeric'
    });

    document.getElementById('admin-jam').innerText = jam;
    document.getElementById('admin-tanggal').innerText = tanggal;
  }

  setInterval(updateAdminTime, 1000);
  updateAdminTime();
</script>

<?php
if (isset($page_script)) {
  $this->load->view($page_script);
}
?>


</body>

</html>