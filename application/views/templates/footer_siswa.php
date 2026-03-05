<!-- Content ends here -->
        </div>
    </main>

    <!-- Mobile Navigation -->
    <nav class="navbar-mobile">
        <a href="<?= base_url('siswa') ?>" class="nav-link <?= ($this->uri->segment(1) == 'siswa' && empty($this->uri->segment(2))) ? 'active' : '' ?>">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>
        <a href="<?= base_url('siswa/tambah') ?>" class="nav-link <?= ($this->uri->segment(2) == 'tambah') ? 'active' : '' ?>">
            <i class="fas fa-plus-circle"></i>
            <span>Tambah</span>
        </a>
        <a href="<?= base_url('siswa/my_aspirasi') ?>" class="nav-link <?= ($this->uri->segment(2) == 'my_aspirasi') ? 'active' : '' ?>">
            <i class="fas fa-file-alt"></i>
            <span>Aspirasiku</span>
        </a>
        <a href="<?= base_url('siswa/logout') ?>" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </nav>
    
    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Aos -->
    <script src="<?= base_url('assets/js/aos.js') ?>"></script>
    <script>
            $(document).ready(function() {
        console.log("jQuery is working");
        console.log("AOS is available:", typeof AOS !== 'undefined');
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 650,
                once: true
            });
        }
    });
    </script>
    
</body>
</html>