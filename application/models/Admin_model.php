<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    const TABLE = 'admin_syahrilmaimubdy';

    // Get admin by username
    public function login($username)
    {
        $this->db->select('id_admin_syahrilmaimubdy as id_admin, username_syahrilmaimubdy as username, password_syahrilmaimubdy as password');
        return $this->db->get_where(self::TABLE, ['username_syahrilmaimubdy' => $username])->row();
    }

    // Get by id
    public function get_by_id($id)
    {
        $this->db->select('id_admin_syahrilmaimubdy as id_admin, username_syahrilmaimubdy as username, password_syahrilmaimubdy as password');
        return $this->db->get_where(self::TABLE, ['id_admin_syahrilmaimubdy' => $id])->row();
    }
}
