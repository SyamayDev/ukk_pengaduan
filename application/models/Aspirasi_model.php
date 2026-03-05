<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aspirasi_model extends CI_Model
{

    const TABLE = 'aspirasi_syahrilmaimubdy';

    private function _set_select_join()
    {
        $this->db->select('a.id_aspirasi_syahrilmaimubdy as id_aspirasi, a.nis_syahrilmaimubdy as nis, a.id_kategori_syahrilmaimubdy as id_kategori, a.lokasi_syahrilmaimubdy as lokasi, a.keterangan_syahrilmaimubdy as keterangan, a.gambar_syahrilmaimubdy as gambar, a.tanggal_syahrilmaimubdy as tanggal, a.status_syahrilmaimubdy as status, a.feedback_syahrilmaimubdy as feedback, a.feedback_gambar_syahrilmaimubdy as feedback_gambar, s.kelas_syahrilmaimubdy as kelas, k.nama_kategori_syahrilmaimubdy as nama_kategori');
        $this->db->from(self::TABLE . ' a');
        $this->db->join('siswa_syahrilmaimubdy s', 'a.nis_syahrilmaimubdy = s.nis_syahrilmaimubdy', 'left');
        $this->db->join('kategori_syahrilmaimubdy k', 'a.id_kategori_syahrilmaimubdy = k.id_kategori_syahrilmaimubdy', 'left');
    }

    // Get all aspirasi with join
    public function get_all($limit = NULL, $category_id = NULL)
    {
        $this->_set_select_join();

        // Filter by category if provided
        if (!empty($category_id)) {
            $this->db->where('a.id_kategori_syahrilmaimubdy', $category_id);
        }

        $this->db->order_by('a.tanggal_syahrilmaimubdy', 'DESC');

        if ($limit) {
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }

    // Get aspirasi by nis
    public function get_by_nis($nis)
    {
        $this->_set_select_join();
        $this->db->where('a.nis_syahrilmaimubdy', $nis);
        $this->db->order_by('a.tanggal_syahrilmaimubdy', 'DESC');

        return $this->db->get()->result();
    }

    // Get aspirasi by id
    public function get_by_id($id)
    {
        $this->_set_select_join();
        $this->db->where('a.id_aspirasi_syahrilmaimubdy', $id);

        return $this->db->get()->row();
    }

    // Get Aspirasi by status
    public function get_by_status($status)
    {
        $this->_set_select_join();
        $this->db->where('a.status_syahrilmaimubdy', $status);
        $this->db->order_by('a.tanggal_syahrilmaimubdy', 'DESC');

        return $this->db->get()->result();
    }

    // Count total aspirasi
    public function count_all()
    {
        return $this->db->count_all(self::TABLE);
    }

    // Count aspirasi by status
    public function count_by_status($status)
    {
        return $this->db->where('status_syahrilmaimubdy', $status)->count_all_results(self::TABLE);
    }

    // Insert aspirasi
    public function insert($data)
    {
        return $this->db->insert(self::TABLE, $data);
    }

    // Update aspirasi
    public function update($id, $data)
    {
        return $this->db->where('id_aspirasi_syahrilmaimubdy', $id)->update(self::TABLE, $data);
    }

    // Delete aspirasi
    public function delete($id)
    {
        return $this->db->where('id_aspirasi_syahrilmaimubdy', $id)->delete(self::TABLE);
    }

    // Get aspirasi by date range and status
    public function get_by_date_and_status($start_date = '', $end_date = '', $status = '')
    {
        $this->_set_select_join();

        // Filter by date range (optional)
        if (!empty($start_date)) {
            $this->db->where('a.tanggal_syahrilmaimubdy >=', $start_date);
        }

        if (!empty($end_date)) {
            $this->db->where('a.tanggal_syahrilmaimubdy <=', $end_date . ' 23:59:59');
        }

        // Filter by status (optional)
        if (!empty($status)) {
            $this->db->where('a.status_syahrilmaimubdy', $status);
        }

        $this->db->order_by('a.tanggal_syahrilmaimubdy', 'DESC');

        return $this->db->get()->result();
    }
}
