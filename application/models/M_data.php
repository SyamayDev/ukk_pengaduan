<?php
class M_data extends CI_Model{

    // FUNGSI CRUD

    // fungsi untuk mengambil data dari database
    public function get_data($table){
        return $this->db->get($table);
    }

    // fungsi untuk menginput data ke database
    public function insert_data($data,$table){
        $this->db->insert($table,$data);
    }

    // fungsi untuk mengedit data
    public function edit_data($where,$table){
        return $this->db->get_where($table,$where);
    }

    // fungsi untuk mengupdate atau mengubah data di database
    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    // fungsi untuk menghapus data dari database
    public function delete_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    // AKHIR FUNGSI CRUD

    function cek_login($table,$where){
        return $this->db->get_where($table,$where);
    }
}
