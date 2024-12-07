<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model yang dibutuhkan
        $this->load->model(['Tiket_model', 'User_model', 'Transaksi_model']);
        // Tambahkan helper untuk cek login
        cek_login(); 
    }

    public function index() {
        // Data untuk halaman admin dashboard
        $data['judul'] = 'Dashboard Admin';
        $data['pengunjung'] = $this->Pengunjung_model->getPengunjungLimit(); // Menampilkan pengunjung terbaru
        $data['tiket_masuk'] = $this->Tiket_model->getTiketMasuk();
        $data['tiket_makanh'] = $this->Tiket_model->getTiketMakanHewan();
        $data['tiket_wahana'] = $this->Tiket_model->getTiketWahana();

        // Periksa transaksi yang sudah kadaluarsa (misalnya lebih dari 2 hari)
        $transaksi = $this->Transaksi_model->getAllTransaksi();
        if (!empty($transaksi)) {
            foreach ($transaksi as $trx) {
                $tgl_pesan = date_create($trx['tgl_pesan']);
                $tgl_sekarang = date_create();
                $beda = date_diff($tgl_pesan, $tgl_sekarang);

                if ($beda->days > 2) {
                    // Jika transaksi kadaluarsa, hapus dari database
                    $this->Transaksi_model->hapusTransaksiKadaluarsa($trx['id_transaksi']);
                }
            }
        }

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}
