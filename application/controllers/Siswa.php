<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['aspirasi_model', 'siswa_model', 'kategori_model']);
        $this->load->library('upload');
    }
    
    // PUBLIC PAGES (TANPA LOGIN)

    // Halaman utama - menampilkan semua aspirasi dengan filter pencarian
    public function index()
    {
        // Ambil data filter dari URL
        $search_id = $this->input->get('search_id', TRUE);
        $category_id = $this->input->get('category', TRUE);

        // Kirim data filter dan kategori ke view
        $data['search_id'] = $search_id;
        $data['selected_category'] = $category_id;
        $data['kategori'] = $this->kategori_model->get_all();


        // Logika untuk mendapatkan data aspirasi
        if (!empty($search_id)) {
            $result = $this->aspirasi_model->get_by_id($search_id);
            $data['aspirasi'] = $result ? [$result] : [];
        } else {
            // Filter berdasarkan kategori jika dipilih
            $data['aspirasi'] = $this->aspirasi_model->get_all(NULL, $category_id);
        }

        // Tampilkan view yang sesuai
        if ($this->session->userdata('siswa')) {
            $data['title'] = 'Semua Aspirasi';
            $this->load->view('templates/header_siswa', $data);
            $this->load->view('siswa/dashboard_aspirasi', $data);
            $this->load->view('templates/footer_siswa');
        } else {
            $this->load->view('welcome_guest', $data);
        }
    }

    // AUTHENTICATION

    // Halaman login siswa
    public function login_page()
    {
        // If already logged in, redirect to their aspirasi dashboard
        if ($this->session->userdata('siswa')) {
            redirect('siswa/my_aspirasi');
        }
        $this->load->view('auth/login_siswa');
    }

    public function login()
    {
        if ($this->input->method() !== 'post') {
            redirect('siswa/login_page');
        }

        $nis = $this->input->post('nis', TRUE);
        $kelas = $this->input->post('kelas', TRUE);

        // Validasi input
        if (empty($nis) || empty($kelas)) {
            $this->session->set_flashdata('error', 'NIS dan Kelas harus diisi!');
            redirect('siswa/login_page');
        }

        // Validasi format NIS (hanya angka)
        if (!is_numeric($nis)) {
            $this->session->set_flashdata('error', 'NIS harus berupa angka!');
            redirect('siswa/login_page');
        }

        // Validasi format Kelas (XII-RPL-1)
        if (!preg_match('/^[A-Z0-9]+-[A-Z]+-\d+$/', $kelas)) {
            $this->session->set_flashdata('error', 'Format Kelas salah! Gunakan format: XII-RPL-1');
            redirect('siswa/login_page');
        }

        $siswa = $this->siswa_model->get_by_nis_and_class($nis, $kelas);

        if ($siswa) {
            $this->session->set_userdata('siswa', $siswa);
            $this->session->set_flashdata('success', 'Login berhasil!');
            redirect('siswa/my_aspirasi');
        } else {
            $this->session->set_flashdata('error', 'NIS atau Kelas tidak ditemukan! Silakan hubungi admin.');
            redirect('siswa/login_page');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('siswa');
        $this->session->set_flashdata('success', 'Logout berhasil!');
        redirect('siswa');
    }
    
    // ASPIRASI MANAGEMENT (REQUIRE LOGIN)

    // Halaman aspirasi saya
    public function my_aspirasi()
    {
        $this->_check_login();

        $nis = $this->session->userdata('siswa')->nis;
        $data['aspirasi'] = $this->aspirasi_model->get_by_nis($nis);
        $data['title'] = 'Aspirasi Saya';

        $this->load->view('templates/header_siswa', $data);
        $this->load->view('siswa/my_aspirasi', $data);
        $this->load->view('templates/footer_siswa');
    }

    // Halaman tambah aspirasi
    public function tambah()
    {
        // Jika belum login, redirect ke halaman login
        if (!$this->session->userdata('siswa')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('siswa');
        }

        $data['kategori'] = $this->kategori_model->get_all();
        $data['title'] = 'Tambah Aspirasi';

        $this->load->view('templates/header_siswa', $data);
        $this->load->view('siswa/tambah_aspirasi', $data);
        $this->load->view('templates/footer_siswa');
    }

    // Proses simpan aspirasi
    public function simpan()
    {
        // Validasi login
        if (!$this->session->userdata('siswa')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('siswa');
        }

        if ($this->input->method() !== 'post') {
            redirect('siswa/tambah');
        }

        $nis = $this->session->userdata('siswa')->nis;

        // Validasi input
        $kategori = $this->input->post('kategori', TRUE);
        $lokasi = $this->input->post('lokasi', TRUE);
        $keterangan = $this->input->post('keterangan', TRUE);

        if (empty($kategori) || empty($lokasi) || empty($keterangan)) {
            $this->session->set_flashdata('error', 'Kategori, Lokasi, dan Keterangan harus diisi!');
            redirect('siswa/tambah');
        }

        // Validasi kategori
        $kat = $this->kategori_model->get_by_id($kategori);
        if (!$kat) {
            $this->session->set_flashdata('error', 'Kategori tidak valid!');
            redirect('siswa/tambah');
        }

        // Handle file upload (opsional)
        $gambar = '';
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path'] = './uploads/aspirasi/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['max_size'] = 5048; // 5MB
            $config['encrypt_name'] = TRUE;

            // Buat folder jika belum ada
            if (!is_dir('./uploads/aspirasi/')) {
                mkdir('./uploads/aspirasi/', 0755, TRUE);
            }

            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors());
                redirect('siswa/tambah');
            }
        }

        // Simpan aspirasi
        $data_aspirasi = [
            'nis_syahrilmaimubdy' => $nis,
            'id_kategori_syahrilmaimubdy' => $kategori,
            'lokasi_syahrilmaimubdy' => $lokasi,
            'keterangan_syahrilmaimubdy' => $keterangan,
            'gambar_syahrilmaimubdy' => $gambar,
            'status_syahrilmaimubdy' => 'Menunggu',
            'tanggal_syahrilmaimubdy' => date('Y-m-d H:i:s')
        ];

        $this->aspirasi_model->insert($data_aspirasi);
        $this->session->set_flashdata('new_aspirasi', 'true');
        $this->session->set_flashdata('success', 'Aspirasi berhasil dikirim! Terimakasih atas masukan Anda.');
        redirect('siswa/my_aspirasi');
    }

    // Halaman edit aspirasi
    public function edit_aspirasi($id)
    {
        $this->_check_login();

        $data['aspirasi'] = $this->aspirasi_model->get_by_id($id);
        $nis_session = $this->session->userdata('siswa')->nis;

        if (!$data['aspirasi'] || $data['aspirasi']->nis !== $nis_session) {
            $this->session->set_flashdata('error', 'Aspirasi tidak ditemukan atau Anda tidak memiliki hak akses.');
            redirect('siswa/my_aspirasi');
        }

        if ($data['aspirasi']->status !== 'Menunggu') {
            $this->session->set_flashdata('error', 'Aspirasi yang sudah diproses atau selesai tidak dapat diubah.');
            redirect('siswa/my_aspirasi');
        }

        $data['kategori'] = $this->kategori_model->get_all();
        $data['title'] = 'Edit Aspirasi';

        $this->load->view('templates/header_siswa', $data);
        $this->load->view('siswa/edit_aspirasi', $data);
        $this->load->view('templates/footer_siswa');
    }

    // Proses update aspirasi
    public function update_aspirasi()
    {
        $this->_check_login();

        if ($this->input->method() !== 'post') {
            redirect('siswa/my_aspirasi');
        }

        $id_aspirasi = $this->input->post('id_aspirasi');
        $aspirasi = $this->aspirasi_model->get_by_id($id_aspirasi);
        $nis_session = $this->session->userdata('siswa')->nis;

        if (!$aspirasi || $aspirasi->nis !== $nis_session) {
            $this->session->set_flashdata('error', 'Aspirasi tidak ditemukan atau Anda tidak memiliki hak akses.');
            redirect('siswa/my_aspirasi');
        }

        if ($aspirasi->status !== 'Menunggu') {
            $this->session->set_flashdata('error', 'Aspirasi yang sudah diproses atau selesai tidak dapat diubah.');
            redirect('siswa/my_aspirasi');
        }

        $kategori = $this->input->post('kategori', TRUE);
        $lokasi = $this->input->post('lokasi', TRUE);
        $keterangan = $this->input->post('keterangan', TRUE);

        if (empty($kategori) || empty($lokasi) || empty($keterangan)) {
            $this->session->set_flashdata('error', 'Kategori, Lokasi, dan Keterangan harus diisi!');
            redirect('siswa/edit_aspirasi/' . $id_aspirasi);
        }

        $kat = $this->kategori_model->get_by_id($kategori);
        if (!$kat) {
            $this->session->set_flashdata('error', 'Kategori tidak valid!');
            redirect('siswa/edit_aspirasi/' . $id_aspirasi);
        }

        $gambar = $aspirasi->gambar;
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path'] = './uploads/aspirasi/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['max_size'] = 5048; // 5MB
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {
                if ($gambar && file_exists('./uploads/aspirasi/' . $gambar)) {
                    unlink('./uploads/aspirasi/' . $gambar);
                }
                $gambar = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors());
                redirect('siswa/edit_aspirasi/' . $id_aspirasi);
            }
        }

        $data_update = [
            'id_kategori_syahrilmaimubdy' => $kategori,
            'lokasi_syahrilmaimubdy' => $lokasi,
            'keterangan_syahrilmaimubdy' => $keterangan,
            'gambar_syahrilmaimubdy' => $gambar,
        ];

        $this->aspirasi_model->update($id_aspirasi, $data_update);
        $this->session->set_flashdata('success', 'Aspirasi berhasil diperbarui.');
        redirect('siswa/my_aspirasi');
    }

    // Hapus aspirasi
    public function hapus_aspirasi($id)
    {
        $this->_check_login();

        $aspirasi = $this->aspirasi_model->get_by_id($id);
        $nis_session = $this->session->userdata('siswa')->nis;

        if (!$aspirasi || $aspirasi->nis !== $nis_session) {
            $this->session->set_flashdata('error', 'Aspirasi tidak ditemukan atau Anda tidak memiliki hak akses.');
            redirect('siswa/my_aspirasi');
        }

        if ($aspirasi->status !== 'Menunggu') {
            $this->session->set_flashdata('error', 'Aspirasi yang sudah diproses atau selesai tidak dapat dihapus.');
            redirect('siswa/my_aspirasi');
        }

        // Hapus gambar terkait jika ada
        if ($aspirasi->gambar && file_exists('./uploads/aspirasi/' . $aspirasi->gambar)) {
            unlink('./uploads/aspirasi/' . $aspirasi->gambar);
        }

        $this->aspirasi_model->delete($id);
        $this->session->set_flashdata('success', 'Aspirasi berhasil dihapus.');
        redirect('siswa/my_aspirasi');
    }

    // HELPER METHODS

    private function _check_login()
    {
        if (!$this->session->userdata('siswa')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('siswa');
        }
    }
}
