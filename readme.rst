<h1 align="center">📌 Sistem Informasi Pengaduan Sarana & Prasarana Sekolah</h1>

<p align="center">
  <img src="https://img.shields.io/badge/CodeIgniter-DD4814?style=for-the-badge&logo=codeigniter&logoColor=white"/>
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white"/>
</p>

<hr>

<h2>📖 Deskripsi Proyek</h2>

<p>
Sistem Informasi Pengaduan Sarana & Prasarana Sekolah adalah aplikasi berbasis web 
yang dibangun menggunakan <b>Framework CodeIgniter 3</b> dengan arsitektur 
<b>MVC (Model-View-Controller)</b>.
</p>

<p>
Aplikasi ini dirancang untuk mempermudah siswa dalam menyampaikan laporan 
terkait kerusakan atau permasalahan fasilitas sekolah, serta membantu admin 
dalam mengelola dan menindaklanjuti laporan secara sistematis, transparan, 
dan terdokumentasi dengan baik.
</p>

<hr>

<h2>🎯 Tujuan Aplikasi</h2>

<ul>
  <li>Mempermudah proses pengaduan fasilitas sekolah</li>
  <li>Meningkatkan transparansi laporan</li>
  <li>Mempermudah monitoring status pengaduan</li>
  <li>Mengelola data laporan secara terstruktur</li>
  <li>Menyediakan fitur export laporan (PDF & Excel)</li>
</ul>

<hr>

<h2>👥 Role / Hak Akses Pengguna</h2>

<h3>1️⃣ Tamu (Guest)</h3>
<ul>
  <li>Melihat daftar pengaduan yang sudah diproses</li>
  <li>Melihat detail pengaduan</li>
  <li>Tidak dapat membuat laporan</li>
  <li>Tersedia tombol login</li>
</ul>

<p><b>Screenshot Halaman Guest:</b></p>
<img src="https://ibb.co.com/tpN3NzRj" width="800"/>

<hr>

<h3>2️⃣ Siswa</h3>
<ul>
  <li>Login ke sistem</li>
  <li>Membuat pengaduan baru</li>
  <li>Upload foto bukti</li>
  <li>Melihat riwayat pengaduan</li>
  <li>Status laporan: Menunggu, Diproses, Selesai</li>
</ul>

<p><b>Screenshot Dashboard Siswa:</b></p>
<img src="https://ibb.co.com/JW7nh6LH" width="800"/>

<hr>

<h3>3️⃣ Admin</h3>
<ul>
  <li>Login sebagai admin</li>
  <li>Melihat seluruh pengaduan</li>
  <li>Mengubah status laporan</li>
  <li>Memberikan tanggapan</li>
  <li>Mengelola kategori</li>
  <li>Generate laporan PDF</li>
  <li>Export laporan Excel</li>
</ul>

<p><b>Screenshot Dashboard Admin:</b></p>
<img src="https://ibb.co.com/Jj2q96z2" width="800"/>

<hr>

<h2>🔐 Informasi Login Default</h2>

<pre>
Username : admin
Password : admin123
</pre>

<p><i>Disarankan untuk mengganti password setelah deploy.</i></p>

<hr>

<h2>⚙️ Cara Kerja Sistem</h2>

<h3>1️⃣ Halaman Awal (Guest View)</h3>
<ul>
  <li>File: <code>application/views/welcome_guest.php</code></li>
  <li>Menampilkan daftar pengaduan yang sudah diproses</li>
  <li>Pengguna dapat melihat detail laporan</li>
</ul>

<h3>2️⃣ Proses Login (Autentikasi)</h3>
<ul>
  <li>Model: <code>application/models/M_login.php</code></li>
  <li>View: <code>application/views/auth/</code></li>
  <li>Sistem memverifikasi username dan password ke database</li>
  <li>Redirect berdasarkan role (Siswa / Admin)</li>
</ul>

<h3>3️⃣ Proses Siswa Membuat Pengaduan</h3>
<ul>
  <li>Controller: <code>application/controllers/Siswa.php</code></li>
  <li>Model: <code>Siswa_model.php</code> & <code>Aspirasi_model.php</code></li>
  <li>Upload gambar disimpan di: <code>uploads/aspirasi/</code></li>
  <li>Status awal otomatis: <b>Menunggu</b></li>
</ul>

<h3>4️⃣ Proses Admin Menindaklanjuti</h3>
<ul>
  <li>Controller: <code>application/controllers/Admin.php</code></li>
  <li>Mengubah status menjadi Diproses / Selesai</li>
  <li>Memberikan tanggapan</li>
</ul>

<h3>5️⃣ Generate Laporan</h3>
<ul>
  <li>Controller: <code>application/controllers/Laporan.php</code></li>
  <li>Export ke PDF</li>
  <li>Export ke Excel</li>
</ul>

<hr>

<h2>🗂️ Struktur Folder Penting</h2>

<pre>
application/
│
├── controllers/
│   ├── Welcome.php
│   ├── Siswa.php
│   ├── Admin.php
│   └── Laporan.php
│
├── models/
│   ├── M_login.php
│   ├── Siswa_model.php
│   ├── Admin_model.php
│   └── Aspirasi_model.php
│
├── views/
│   ├── welcome_guest.php
│   ├── auth/
│   ├── siswa/
│   └── admin/
│
uploads/
└── aspirasi/
</pre>

<hr>

<h2>🛠️ Teknologi yang Digunakan</h2>

<ul>
  <li>PHP</li>
  <li>CodeIgniter 3</li>
  <li>MySQL</li>
  <li>Bootstrap</li>
  <li>HTML5 & CSS3</li>
  <li>JavaScript</li>
</ul>

<hr>

<h2>🚀 Cara Instalasi</h2>

<ol>
  <li>Clone repository:
    <pre>git clone https://github.com/SyamayDev/ukk_pengaduan.git</pre>
  </li>
  <li>Pindahkan ke folder server (htdocs / www)</li>
  <li>Import database melalui phpMyAdmin</li>
  <li>Konfigurasi file:
    <code>application/config/database.php</code>
  </li>
  <li>Jalankan di browser:
    <pre>http://localhost/ukk_pengaduan</pre>
  </li>
</ol>

<hr>

<h2>🔒 Keamanan</h2>

<ul>
  <li>Session-based login</li>
  <li>Role-based access control</li>
  <li>Validasi input form</li>
  <li>Pembatasan upload file</li>
</ul>

<hr>

<h2>📌 Pengembangan Selanjutnya</h2>

<ul>
  <li>Notifikasi Email</li>
  <li>Dashboard Grafik Statistik</li>
  <li>Sistem Rating Kepuasan</li>
  <li>Upload Multiple Images</li>
  <li>REST API Version</li>
</ul>

<hr>

<h2>📄 Lisensi</h2>

<p>
Project ini dibuat untuk kebutuhan UKK dan pembelajaran. 
Bebas digunakan dan dikembangkan kembali untuk tujuan edukasi.
</p>

<hr>

<p align="center">
⭐ Jika project ini membantu, jangan lupa beri star di repository ⭐
</p>