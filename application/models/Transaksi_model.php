<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    // Fungsi untuk mengambil data transaksi
    public function get_all_transaksi() {
        return $this->db->get('transaksi')->result_array();
    }

    // Fungsi untuk mengambil data transaksi berdasarkan ID
    public function get_transaksi_by_id($id) {
        return $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
    }

    // Fungsi untuk menyimpan transaksi baru
    public function save_transaksi($data) {
        return $this->db->insert('transaksi', $data);
    }

    // Fungsi untuk memperbarui transaksi
    public function update_transaksi($id, $data) {
        return $this->db->update('transaksi', $data, ['id_transaksi' => $id]);
    }

    // Fungsi untuk menghapus transaksi
    public function delete_transaksi($id) {
        return $this->db->delete('transaksi', ['id_transaksi' => $id]);
    }
}
