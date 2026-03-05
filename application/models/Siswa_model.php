<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{

    const TABLE = 'siswa_syahrilmaimubdy';

    // Get all siswa
    public function get_all()
    {
        $this->db->select('nis_syahrilmaimubdy as nis, kelas_syahrilmaimubdy as kelas');
        return $this->db->get(self::TABLE)->result();
    }

    // Get siswa by nis
    public function get_by_nis($nis)
    {
        $this->db->select('nis_syahrilmaimubdy as nis, kelas_syahrilmaimubdy as kelas');
        return $this->db->get_where(self::TABLE, ['nis_syahrilmaimubdy' => $nis])->row();
    }

    // Get siswa by nis and class
    public function get_by_nis_and_class($nis, $kelas)
    {
        $this->db->select('nis_syahrilmaimubdy as nis, kelas_syahrilmaimubdy as kelas');
        return $this->db->get_where(self::TABLE, ['nis_syahrilmaimubdy' => $nis, 'kelas_syahrilmaimubdy' => $kelas])->row();
    }

    // Insert siswa
    public function insert($data)
    {
        return $this->db->insert(self::TABLE, $data);
    }

    // Update siswa
    public function update($nis, $data)
    {
        return $this->db->where('nis_syahrilmaimubdy', $nis)->update(self::TABLE, $data);
    }

    // Delete siswa
    public function delete($nis)
    {
        return $this->db->where('nis_syahrilmaimubdy', $nis)->delete(self::TABLE);
    }
}
