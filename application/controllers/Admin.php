<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['aspirasi_model', 'admin_model', 'kategori_model', 'siswa_model']);
        $this->load->library(['upload', 'form_validation']);
    }

    // AUTHENTICATION 

    public function index()
    {
        if ($this->session->userdata('admin')) {
            redirect('admin/dashboard');
        }
        $this->load->view('admin/login');
    }

    public function login()
    {
        if ($this->input->method() !== 'post') {
            redirect('admin');
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');

        // Validasi input
        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan password harus diisi!');
            redirect('admin');
        }

        $admin = $this->admin_model->login($username);

        if ($admin && md5($password) == $admin->password) {
            $this->session->set_userdata('admin', $admin);
            $this->session->set_flashdata('success', 'Login berhasil!');
            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('admin');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('admin');
        $this->session->set_flashdata('success', 'Logout berhasil!');
        redirect('admin');
    }

    // DASHBOARD

    public function dashboard()
    {
        $this->_check_login();

        $data['total_aspirasi'] = $this->aspirasi_model->count_all();
        $data['aspirasi_menunggu'] = $this->aspirasi_model->count_by_status('Menunggu');
        $data['aspirasi_proses'] = $this->aspirasi_model->count_by_status('Proses');
        $data['aspirasi_selesai'] = $this->aspirasi_model->count_by_status('Selesai');
        $data['aspirasi'] = $this->aspirasi_model->get_all(100);
        $data['title'] = 'Dashboard';
        $data['page_script'] = 'admin/dashboard_script';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer_admin');
    }

    // ASPIRASI MANAGEMENT

    public function aspirasi()
    {
        $this->_check_login();

        $filter_status = $this->input->get('status');

        if ($filter_status) {
            $data['aspirasi'] = $this->aspirasi_model->get_by_status($filter_status);
        } else {
            $data['aspirasi'] = $this->aspirasi_model->get_all();
        }

        $data['title'] = 'Kelola Aspirasi';
        $data['filter_status'] = $filter_status;

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/aspirasi', $data);
        $this->load->view('templates/footer_admin');
    }

    public function edit_aspirasi($id)
    {
        $this->_check_login();

        $aspirasi = $this->aspirasi_model->get_by_id($id);
        if (!$aspirasi) {
            $this->session->set_flashdata('error', 'Aspirasi tidak ditemukan!');
            redirect('admin/aspirasi');
        }

        if ($this->input->method() === 'post') {
            $feedback_gambar = $aspirasi->feedback_gambar;

            // Handle file upload
            if (!empty($_FILES['feedback_gambar']['name'])) {
                $config['upload_path'] = './uploads/feedback/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                $config['max_size'] = 5048;
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('feedback_gambar')) {
                    if ($feedback_gambar && file_exists('./uploads/feedback/' . $feedback_gambar)) {
                        unlink('./uploads/feedback/' . $feedback_gambar);
                    }
                    $feedback_gambar = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors());
                    redirect('admin/edit_aspirasi/' . $id);
                }
            }

            $update = [
                'status_syahrilmaimubdy' => $this->input->post('status', TRUE),
                'feedback_syahrilmaimubdy' => $this->input->post('feedback', TRUE),
                'feedback_gambar_syahrilmaimubdy' => $feedback_gambar
            ];

            $this->aspirasi_model->update($id, $update);
            $this->session->set_flashdata('success', 'Aspirasi berhasil diperbarui!');
            redirect('admin/aspirasi');
        }

        $data['aspirasi'] = $aspirasi;
        $data['title'] = 'Edit Aspirasi';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/edit_aspirasi', $data);
        $this->load->view('templates/footer_admin');
    }

    public function delete_aspirasi($id)
    {
        $this->_check_login();

        $aspirasi = $this->aspirasi_model->get_by_id($id);
        if (!$aspirasi) {
            $this->session->set_flashdata('error', 'Aspirasi tidak ditemukan!');
            redirect('admin/aspirasi');
        }

        // Hapus file gambar
        if ($aspirasi->gambar && file_exists('./uploads/aspirasi/' . $aspirasi->gambar)) {
            unlink('./uploads/aspirasi/' . $aspirasi->gambar);
        }
        if ($aspirasi->feedback_gambar && file_exists('./uploads/feedback/' . $aspirasi->feedback_gambar)) {
            unlink('./uploads/feedback/' . $aspirasi->feedback_gambar);
        }

        $this->aspirasi_model->delete($id);
        $this->session->set_flashdata('success', 'Aspirasi berhasil dihapus!');
        redirect('admin/aspirasi');
    }

    // KATEGORI MANAGEMENT

    public function kategori()
    {
        $this->_check_login();

        $data['kategori'] = $this->kategori_model->get_all();
        $data['title'] = 'Kelola Kategori';
        $data['page_script'] = 'admin/kategori_script';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/kategori', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_kategori()
    {
        $this->_check_login();

        if ($this->input->method() === 'post') {
            $nama = $this->input->post('nama_kategori', TRUE);

            if (empty($nama)) {
                $this->session->set_flashdata('error', 'Nama kategori tidak boleh kosong!');
                redirect('admin/kategori');
            }

            $this->kategori_model->insert(['nama_kategori_syahrilmaimubdy' => $nama]);
            $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
            redirect('admin/kategori');
        }

        $data['title'] = 'Tambah Kategori';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/add_kategori', $data);
        $this->load->view('templates/footer_admin');
    }

    public function edit_kategori($id)
    {
        $this->_check_login();

        $kategori = $this->kategori_model->get_by_id($id);
        if (!$kategori) {
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan!');
            redirect('admin/kategori');
        }

        if ($this->input->method() === 'post') {
            $nama = $this->input->post('nama_kategori', TRUE);

            if (empty($nama)) {
                $this->session->set_flashdata('error', 'Nama kategori tidak boleh kosong!');
                redirect('admin/edit_kategori/' . $id);
            }

            $this->kategori_model->update($id, ['nama_kategori_syahrilmaimubdy' => $nama]);
            $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
            redirect('admin/kategori');
        }

        $data['kategori'] = $kategori;
        $data['title'] = 'Edit Kategori';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/edit_kategori', $data);
        $this->load->view('templates/footer_admin');
    }

    public function delete_kategori($id)
    {
        $this->_check_login();

        // Check if kategori is in use
        $count = $this->db->where('id_kategori_syahrilmaimubdy', $id)->count_all_results('aspirasi_syahrilmaimubdy');

        if ($count > 0) {
            $this->session->set_flashdata('error', 'Kategori tidak dapat dihapus karena masih digunakan!');
        } else {
            $this->kategori_model->delete($id);
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        }

        redirect('admin/kategori');
    }

    // SISWA MANAGEMENT

    public function siswa()
    {
        $this->_check_login();

        $data['siswa'] = $this->siswa_model->get_all();
        $data['title'] = 'Kelola Siswa';
        $data['page_script'] = 'admin/siswa_script';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/siswa', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_siswa()
    {
        $this->_check_login();

        if ($this->input->method() === 'post') {
            $nis = $this->input->post('nis', TRUE);
            $kelas = $this->input->post('kelas', TRUE);

            if (empty($nis) || empty($kelas)) {
                $this->session->set_flashdata('error', 'NIS dan Kelas harus diisi!');
                redirect('admin/add_siswa');
            }

            // Check if NIS already exists
            $existing = $this->siswa_model->get_by_nis($nis);
            if ($existing) {
                $this->session->set_flashdata('error', 'NIS sudah terdaftar!');
                redirect('admin/add_siswa');
            }

            $this->siswa_model->insert(['nis_syahrilmaimubdy' => $nis, 'kelas_syahrilmaimubdy' => $kelas]);
            $this->session->set_flashdata('success', 'Siswa berhasil ditambahkan!');
            redirect('admin/siswa');
        }

        $data['title'] = 'Tambah Siswa';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/add_siswa', $data);
        $this->load->view('templates/footer_admin');
    }

    public function edit_siswa($nis)
    {
        $this->_check_login();

        $siswa = $this->siswa_model->get_by_nis($nis);
        if (!$siswa) {
            $this->session->set_flashdata('error', 'Siswa tidak ditemukan!');
            redirect('admin/siswa');
        }

        if ($this->input->method() === 'post') {
            $kelas = $this->input->post('kelas', TRUE);

            if (empty($kelas)) {
                $this->session->set_flashdata('error', 'Kelas harus diisi!');
                redirect('admin/edit_siswa/' . $nis);
            }

            $this->siswa_model->update($nis, ['kelas_syahrilmaimubdy' => $kelas]);
            $this->session->set_flashdata('success', 'Siswa berhasil diperbarui!');
            redirect('admin/siswa');
        }

        $data['siswa'] = $siswa;
        $data['title'] = 'Edit Siswa';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/edit_siswa', $data);
        $this->load->view('templates/footer_admin');
    }

    public function delete_siswa($nis)
    {
        $this->_check_login();

        // Check if siswa has aspirasi
        $count = $this->db->where('nis_syahrilmaimubdy', $nis)->count_all_results('aspirasi_syahrilmaimubdy');

        if ($count > 0) {
            $this->session->set_flashdata('error', 'Siswa tidak dapat dihapus karena memiliki aspirasi!');
        } else {
            $this->siswa_model->delete($nis);
            $this->session->set_flashdata('success', 'Siswa berhasil dihapus!');
        }

        redirect('admin/siswa');
    }

    // HELPER METHODS

    private function _check_login()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin');
        }
    }
}
