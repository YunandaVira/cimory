<?php
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    // Menampilkan halaman login
    public function index() {
        // Menampilkan pesan error jika ada
        if ($this->session->flashdata('error')) {
            $data['error'] = $this->session->flashdata('error');
        }
        $this->load->view('login', isset($data) ? $data : []);
    }

    // Menangani proses login
    public function validate_login() {
        // Atur aturan validasi form
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = trim($this->input->post('password'));

            // Ambil data user berdasarkan email
            $user = $this->User_model->get_user_by_email($email);

            if ($user) {
                // Verifikasi password
                $verify = password_verify($password, $user['password']);
                if ($verify) {
                    // Password cocok, set session
                    $this->session->set_userdata('user_id', $user['id_pengunjung']);
                    $this->session->set_userdata('username', $user['nm_pengunjung']);
                    $this->session->set_userdata('role', $user['role']);

                    // Alihkan ke halaman home setelah login berhasil
                    redirect('home');
                } else {
                    // Jika password salah
                    $this->session->set_flashdata('error', 'Password salah!');
                    redirect('login');
                }
            } else {
                // Jika email tidak ditemukan
                $this->session->set_flashdata('error', 'Email tidak ditemukan!');
                redirect('login');
            }
        }
    }

    // Fungsi logout
    public function logout() {
        $this->session->sess_destroy(); // Hapus session
        $this->session->set_flashdata('error', 'Anda telah berhasil logout!'); // Set flashdata
        redirect('login'); // Arahkan kembali ke halaman login
    }
}
