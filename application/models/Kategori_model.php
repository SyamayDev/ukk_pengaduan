<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    const TABLE = 'kategori_syahrilmaimubdy';

    // Get all kategori
    public function get_all()
    {
        $this->db->select('id_kategori_syahrilmaimubdy as id_kategori, nama_kategori_syahrilmaimubdy as nama_kategori');
        return $this->db->order_by('nama_kategori_syahrilmaimubdy', 'ASC')->get(self::TABLE)->result();
    }

    // Get kategori by id
    public function get_by_id($id)
    {
        $this->db->select('id_kategori_syahrilmaimubdy as id_kategori, nama_kategori_syahrilmaimubdy as nama_kategori');
        return $this->db->get_where(self::TABLE, ['id_kategori_syahrilmaimubdy' => $id])->row();
    }

    // Insert kategori
    public function insert($data)
    {
        return $this->db->insert(self::TABLE, $data);
    }

    // Update kategori
    public function update($id, $data)
    {
        return $this->db->where('id_kategori_syahrilmaimubdy', $id)->update(self::TABLE, $data);
    }

    // Delete kategori
    public function delete($id)
    {
        return $this->db->where('id_kategori_syahrilmaimubdy', $id)->delete(self::TABLE);
    }
}
