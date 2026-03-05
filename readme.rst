📌 Sistem Informasi Pengaduan Sarana & Prasarana Sekolah



[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-DD4814?style=for-the-badge&logo=codeigniter&logoColor=white)](#)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](#)
[![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](#)




Sistem Informasi Pengaduan Sarana & Prasarana Sekolah adalah aplikasi berbasis web yang dibangun menggunakan Framework CodeIgniter.

Aplikasi ini bertujuan untuk mempermudah siswa dalam menyampaikan laporan terkait kerusakan atau permasalahan fasilitas sekolah, serta membantu admin dalam mengelola dan menindaklanjuti laporan tersebut secara sistematis dan terdokumentasi.

🎯 Tujuan Aplikasi

Mempermudah proses pengaduan fasilitas sekolah

Meningkatkan transparansi laporan

Mempermudah monitoring status pengaduan

Mengelola data laporan secara terstruktur

Menyediakan fitur export laporan (PDF / Excel)

👥 Role / Hak Akses Pengguna

Aplikasi ini memiliki 3 peran utama, yaitu:

1️⃣ Tamu (Guest)

Pengguna umum yang belum login.

Hak Akses:

Melihat daftar pengaduan yang sudah diproses / dipublikasikan

Melihat detail pengaduan

Tidak bisa membuat laporan

Tersedia tombol login

📷 Screenshot Halaman Guest

https://ibb.co.com/tpN3NzRj

2️⃣ Siswa

Pengguna terdaftar yang dapat login dan membuat laporan.

Hak Akses:

Login ke sistem

Membuat pengaduan baru

Upload foto bukti

Melihat riwayat pengaduan

Melihat status laporan:

Menunggu

Diproses

Selesai

📷 Screenshot Dashboard Siswa

https://ibb.co.com/JW7nh6LH

3️⃣ Admin

Pengelola sistem yang memiliki kontrol penuh terhadap data pengaduan.

Hak Akses:

Login sebagai admin

Melihat semua pengaduan dari seluruh siswa

Mengubah status pengaduan

Memberi tanggapan

Mengelola kategori

Generate laporan PDF

Export laporan Excel

📷 Screenshot Dashboard Admin

https://ibb.co.com/Jj2q96z2

🔐 Informasi Login Default
Username Admin : admin
Password Admin : admin123

⚠️ Disarankan untuk mengganti password setelah deploy.

⚙️ Cara Kerja Aplikasi (Alur Sistem)

Berikut adalah alur sistem dari awal hingga laporan selesai:

1️⃣ Halaman Awal (Guest View)

Saat pertama kali membuka aplikasi, pengguna akan diarahkan ke halaman:

application/views/welcome_guest.php

Sistem menampilkan daftar pengaduan yang sudah diproses.

Pengguna dapat melihat detail laporan.

Tersedia tombol login untuk siswa/admin.

2️⃣ Proses Login (Autentikasi)

File terkait:

application/models/M_login.php
application/views/auth/
Alur:

User memasukkan username & password

Sistem memverifikasi ke database

Jika berhasil:

Siswa → diarahkan ke dashboard siswa

Admin → diarahkan ke dashboard admin

Jika gagal → tampil pesan error

3️⃣ Proses Siswa Membuat Pengaduan

Controller:

application/controllers/Siswa.php

Model:

application/models/Siswa_model.php
application/models/Aspirasi_model.php
Langkah:

Siswa mengisi:

Judul

Isi laporan

Kategori

Upload foto bukti

Data dikirim ke controller

Sistem menyimpan data ke database

Foto disimpan di:

uploads/aspirasi/

Status awal otomatis: Menunggu

4️⃣ Proses Admin Menindaklanjuti

Controller:

application/controllers/Admin.php
Admin dapat:

Melihat semua laporan

Membuka detail laporan

Mengubah status menjadi:

Diproses

Selesai

Memberikan tanggapan

Menghapus laporan jika diperlukan

5️⃣ Generate Laporan

Controller:

application/controllers/Laporan.php

Fitur:

Export ke PDF

Export ke Excel

Cetak laporan

🗂️ Struktur Folder Penting
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
🛠️ Teknologi yang Digunakan

PHP

CodeIgniter 3

MySQL

Bootstrap

HTML5 & CSS3

JavaScript

Library PDF & Excel Export

🧩 Struktur Database (Gambaran Umum)

Tabel utama yang digunakan:

users

aspirasi

kategori

tanggapan

Relasi:

1 user (siswa) dapat memiliki banyak aspirasi

1 aspirasi memiliki 1 kategori

1 aspirasi dapat memiliki 1 tanggapan dari admin

📷 Tambahkan ERD di sini

![ERD](assets/images/erd.png)
🚀 Cara Instalasi
1️⃣ Clone Repository
git clone https://github.com/SyamayDev/ukk_pengaduan.git
2️⃣ Pindahkan ke Folder Server

Jika menggunakan:

XAMPP → htdocs

Laragon → www

3️⃣ Import Database

Buka phpMyAdmin

Import file .sql

4️⃣ Atur Konfigurasi Database

File:

application/config/database.php

Sesuaikan:

'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'nama_database',
5️⃣ Jalankan di Browser
http://localhost/ukk_pengaduan

📊 ERD Sistem

https://ibb.co.com/gMQ340rN

🔒 Keamanan

Session login

Role-based access control

Validasi form

Upload file restriction

Redirect jika belum login

📌 Pengembangan Selanjutnya

Notifikasi email

Dashboard grafik statistik

Sistem rating kepuasan

Upload multiple images

REST API version

📄 Lisensi

Project ini dibuat untuk kebutuhan UKK dan pembelajaran.
Bebas digunakan dan dikembangkan kembali.
