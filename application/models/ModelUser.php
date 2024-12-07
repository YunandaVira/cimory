<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    public function simpanData($data = null)
    {
        $this->db->insert('pengunjung', $data);
    }

    public function cekData($where = null)
    {
        return $this->db->get_where('pengunjung', $where);
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('pengunjung', $where);
    }

    public function cekUserAccess($where = null)
    {
        $this->db->select('*');
        $this->db->from('access_menu');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getUserLimit()
    {
        $this->db->select('*');
        $this->db->from('pengunjung');
        $this->db->limit(10, 0);
        return $this->db->get();
    }
    // Fungsi untuk cek apakah email sudah terdaftar
    public function check_email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('pengunjung'); // Nama tabel Anda
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Mengembalikan data user sebagai array
        }
        return false; // Email tidak ditemukan
    }    

    // Fungsi untuk menyimpan data pengguna baru
    public function insert_user($data) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT); // Meng-hash password
        $data['password'] = $password; // Menyimpan password yang sudah di-hash
        return $this->db->insert('pengunjung', $data);
    }
    
    // Fungsi untuk mendapatkan data pengguna berdasarkan email
    public function get_user_by_email($email) {
        return $this->db->get_where('pengunjung', ['email' => $email])->row_array();
    }

}
