<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memuat model Tiket_model secara global untuk digunakan di semua method
        $this->load->model('Tiket_model');
    }

    public function index() {
        // Menampilkan halaman Home
        $this->load->view('templates/templates-user/header');  // Memuat header
        $this->load->view('home');  // Memuat tampilan home
        $this->load->view('templates/templates-user/footer');  // Memuat footer
    }

    // Menampilkan daftar tiket
    public function daftar_tiket() {
        // Mengambil data tiket untuk berbagai kategori
        $data['tiket_masuk'] = $this->Tiket_model->getTiketMasuk();
        $data['tiket_makanh'] = $this->Tiket_model->getTiketMakanHewan();
        $data['tiket_wahana'] = $this->Tiket_model->getTiketWahana();
        
        // Menampilkan halaman daftar tiket
        $this->load->view('templates/templates-user/header');
        $this->load->view('tiket/index', $data);  // Menampilkan daftar tiket
        $this->load->view('templates/templates-user/footer');
    }

    public function tentang() {
        // Load header, view tentang, dan footer
        $this->load->view('templates/templates-user/header');
        $this->load->view('tentang'); // File view tentang
        $this->load->view('templates/templates-user/footer');
    }

    public function map_area() {
        // Menampilkan halaman Map Area
        $this->load->view('templates/templates-user/header');  // Memuat header
        $this->load->view('map_area');  // Memuat tampilan map.php
        $this->load->view('templates/templates-user/footer');  // Memuat footer
    }
}
