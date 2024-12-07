<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    // Konstruktor untuk memuat model dan helper
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');  // Memuat model User_model
        $this->load->helper('url');        // Memuat helper URL untuk redirect
        $this->load->library('form_validation');  // Memuat library form_validation
    }

    // Menampilkan form pendaftaran
    public function index() {
        $this->load->view('register'); // Memuat view register
    }

    // Menangani proses pendaftaran
    public function register_user() {
        // Atur validasi form
        $this->form_validation->set_rules('nm_pengunjung', 'Nama Pengunjung', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    
        // Jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            // Menyimpan error dalam flashdata dan redirect kembali ke halaman register
            $this->session->set_flashdata('error', validation_errors());
            redirect('register');
        } else {
            // Ambil data dari form
            $nm_pengunjung = $this->input->post('nm_pengunjung');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Menggunakan PASSWORD_DEFAULT
        
            // Cek apakah email sudah terdaftar
            if ($this->User_model->check_email_exists($email)) {
                $this->session->set_flashdata('error', 'Email sudah terdaftar!');
                redirect('register');
            } else {
                // Menyiapkan data untuk disimpan di database
                // Tentukan role, misalnya default 'member'
                $role = 'member';  // Ganti sesuai logika role yang diinginkan (misalnya bisa 'admin' jika diperlukan)
                
                $data = [
                    'nm_pengunjung' => $nm_pengunjung,
                    'email' => $email,
                    'password' => $hashed_password,  // Menyimpan password yang sudah di-hash
                    'role' => $role,  // Menggunakan 'admin' atau 'member'
                    'created_at' => date('Y-m-d H:i:s') // Waktu pembuatan akun
                ];
        
                // Menyimpan data pengguna baru
                if ($this->User_model->insert_user($data)) {
                    $this->session->set_flashdata('success', 'Akun berhasil dibuat! Silakan login.');
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat pendaftaran.');
                    redirect('register');
                }            
            }
        }
    }
}
