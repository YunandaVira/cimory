<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Contoh fungsi untuk mengambil data tiket masuk
    public function get_tiket_masuk()
    {
        return $this->db->get('tiket_masuk')->result();
    }

   // Fungsi untuk mengambil tiket berdasarkan hari dan jenis tiket
public function get_tiket_masuk_by_hari_jenis($hari = '', $jenis_tiket = '')
{
    $this->db->select('*');
    $this->db->from('tiket_masuk');

    // Filter berdasarkan hari
    if ($hari && in_array($hari, ['weekday', 'weekend'])) {
        $this->db->where('pilih_hari', $hari);
    }

    // Filter berdasarkan jenis tiket (anak/dewasa)
    if ($jenis_tiket && in_array($jenis_tiket, ['anak', 'dewasa'])) {
        $this->db->where('jenis_tiket', $jenis_tiket);
    }

    // Menampilkan hasil query
    return $this->db->get()->result();
}

// Fungsi untuk mengambil tiket berdasarkan hari (tanpa jenis tiket)
public function get_tiket_masuk_by_hari($hari = '')
{
    if ($hari == 'weekday' || $hari == 'weekend') {
        return $this->db->get_where('tiket_masuk', ['pilih_hari' => $hari])->result();
    } elseif ($hari == 'semua') {
        return $this->db->get('tiket_masuk')->result(); // Menampilkan semua tiket jika "semua" dipilih
    }
    return $this->db->get('tiket_masuk')->result(); // Default: menampilkan semua tiket
}


    // Fungsi lainnya jika perlu
    public function get_tiket_makanh() {
        $query = $this->db->get('tiket_makanh');
        return $query->result();
    }

    public function get_tiket_wahana()
    {
        return $this->db->get('tiket_wahana')->result(); // Ambil semua tiket wahana dari tabel
    }

    // Mengambil tiket wahana berdasarkan id_tiketwahana
    public function get_tiket_wahana_by_id($id_tiketwahana)
    {
        return $this->db->get_where('tiket_wahana', ['id_tiketwahana' => $id_tiketwahana])->row(); // Ambil tiket berdasarkan ID
    }
    
}
