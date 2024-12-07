<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/// Model: User_model.php

class User_model extends CI_Model {

    // Fungsi untuk cek apakah email sudah terdaftar
    public function check_email_exists($email) {
        return $this->db->get_where('pengunjung', ['email' => $email])->row_array();
    }

    // Fungsi untuk menyimpan data pengguna baru
    public function insert_user($data) {
        $this->db->insert('pengunjung', $data);
        
        // Periksa apakah insert berhasil
        if ($this->db->affected_rows() > 0) {
            return true; // Data berhasil disimpan
        } else {
            return false; // Terjadi kesalahan saat menyimpan data
        }
    }
    
    
    // Fungsi untuk mendapatkan data pengguna berdasarkan email
    public function get_user_by_email($email) {
        // Hanya mengambil data dari tabel pengunjung, tanpa tabel role
        $this->db->select('pengunjung.*');  
        $this->db->from('pengunjung');
        $this->db->where('pengunjung.email', $email);
        $query = $this->db->get();
    
        // Debug: Tampilkan query SQL yang dijalankan
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
        log_message('debug', 'User found: ' . print_r($query->row_array(), TRUE));
        
        return $query->row_array();
    }
}
