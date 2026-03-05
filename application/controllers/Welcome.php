<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		// Redirect ke halaman yang sesuai
		if ($this->session->userdata('admin')) {
			redirect('admin/dashboard');
		} elseif ($this->session->userdata('siswa')) {
			redirect('siswa/my_aspirasi');
		} else {
			redirect('siswa');
		}
	}
}
