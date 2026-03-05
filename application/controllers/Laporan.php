<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('aspirasi_model');
        $this->_check_login();
    }

    // Menampilkan halaman laporan
    public function index()
    {
        $data['title'] = 'Laporan Pengaduan';
        $data['aspirasi'] = $this->aspirasi_model->get_all();
        $data['is_generated'] = true;
        $data['start_date'] = '';
        $data['end_date'] = '';
        $data['selected_status'] = '';
        $data['page_script'] = 'admin/laporan_script';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/laporan_index', $data);
        $this->load->view('templates/footer_admin');
    }

    // Menampilkan halaman laporan yang sudah difilter
    public function generate()
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/laporan');
        }

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $status = $this->input->post('status');

        $data['aspirasi'] = $this->aspirasi_model->get_by_date_and_status($start_date, $end_date, $status);
        $data['title'] = 'Laporan Pengaduan';
        $data['is_generated'] = true;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['selected_status'] = $status;
        $data['page_script'] = 'admin/laporan_script';

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/laporan_index', $data);
        $this->load->view('templates/footer_admin');
    }

    // Menampilkan halaman cetak laporan
    public function cetak()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $status = $this->input->get('status');

        $data['aspirasi'] = $this->aspirasi_model->get_by_date_and_status($start_date, $end_date, $status);
        $data['title'] = 'Cetak Laporan Pengaduan';
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['selected_status'] = $status;

        $this->load->view('admin/laporan_cetak', $data);
    }

    private function _check_login()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin');
        }
    }
}
