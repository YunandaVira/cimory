<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Pastikan fungsi cek_login() sudah didefinisikan di helper atau controller lain
        cek_login();
        $this->load->model('User_model');  // Pastikan model yang digunakan adalah User_model
    }

    public function index() {
        $data['judul'] = 'Profil Saya';
        // Ambil data pengunjung berdasarkan email yang disimpan di session
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();

        // Memuat header, sidebar, topbar dan halaman profil pengguna
        $this->load->view('templates/templates-user/header', $data);  // Header sesuai template user
        $this->load->view('templates/templates-user/sidebar', $data); // Sidebar sesuai template user
        $this->load->view('templates/templates-user/topbar', $data);  // Topbar sesuai template user
        $this->load->view('user/index', $data);  // Tampilan halaman profil pengguna
        $this->load->view('templates/templates-user/footer');  // Footer sesuai template user
    }

    public function anggota() {
        $data['judul'] = 'Data Anggota';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        // Ambil data anggota berdasarkan role_id
        $this->db->where('role_id', 1);
        $data['anggota'] = $this->db->get('pengunjung')->result_array(); // Sesuaikan tabelnya dengan pengunjung

        // Memuat header, sidebar, topbar dan halaman daftar anggota
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('templates/templates-user/sidebar', $data);
        $this->load->view('templates/templates-user/topbar', $data);
        $this->load->view('user/anggota', $data);  // Tampilan halaman anggota
        $this->load->view('templates/templates-user/footer');
    }

    public function ubahProfil() {
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak Boleh Kosong'
        ]);

        if ($this->form_validation->run() == false) {
            // Memuat tampilan jika form validasi gagal
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('templates/templates-user/sidebar', $data);
            $this->load->view('templates/templates-user/topbar', $data);
            $this->load->view('user/ubah-profile', $data);
            $this->load->view('templates/templates-user/footer');
        } else {
            // Jika form validasi berhasil, update data
            $nama = $this->input->post('nama', true);
            $email = $this->input->post('email', true);

            // Jika ada gambar yang diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3000';
                $config['max_width'] = '1024';
                $config['max_height'] = '1000';
                $config['file_name'] = 'pro' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                }
            }

            // Update nama pengguna
            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('pengunjung');  // Pastikan tabel sesuai dengan struktur yang ada

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>');
            redirect('user');
        }
    }

    public function ubahPassword() {
        $data['judul'] = 'Ubah Password';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_sekarang', 'Password Saat ini', 'required|trim', [
            'required' => 'Password saat ini harus diisi'
        ]);

        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[4]|matches[password_baru2]', [
            'required' => 'Password Baru harus diisi',
            'min_length' => 'Password tidak boleh kurang dari 4 digit',
            'matches' => 'Password Baru tidak sama dengan ulangi password'
        ]);

        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password Baru', 'required|trim|min_length[4]|matches[password_baru1]', [
            'required' => 'Ulangi Password harus diisi',
            'min_length' => 'Password tidak boleh kurang dari 4 digit',
            'matches' => 'Ulangi Password tidak sama dengan password baru'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('templates/templates-user/sidebar', $data);
            $this->load->view('templates/templates-user/topbar', $data);
            $this->load->view('user/ubah-password', $data);
            $this->load->view('templates/templates-user/footer');
        } else {
            $pwd_skrg = $this->input->post('password_sekarang', true);
            $pwd_baru = $this->input->post('password_baru1', true);
            if (!password_verify($pwd_skrg, $data['user']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password Saat ini Salah!!! </div>');
                redirect('user/ubahPassword');
            } else {
                if ($pwd_skrg == $pwd_baru) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password Baru tidak boleh sama dengan password saat ini!!! </div>');
                    redirect('user/ubahPassword');
                } else {
                    // Update password
                    $password_hash = password_hash($pwd_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('pengunjung');  // Pastikan tabel sesuai dengan struktur yang ada

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Password Berhasil diubah</div>');
                    redirect('user/ubahPassword');
                }
            }
        }
    }
}
