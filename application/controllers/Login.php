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
    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->ModelUser->cekData(['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'id_pengunjung' => $user['id'],
                    'nama' => $user['nama']
                ];
                $this->session->set_userdata($data);

                // Tambahkan pesan flash untuk login berhasil
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Anda berhasil login!!</div>');

                redirect('home'); // Redirect ke halaman yang diinginkan
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>'
                );
                redirect('home'); // jika login gagal, kembali ke home
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>'
            );
            redirect('home');
        }
    }
  // Fungsi logout
    public function logout() {
        $this->session->sess_destroy(); // Hapus session
        $this->session->set_flashdata('error', 'Anda telah berhasil logout!'); // Set flashdata
        redirect('login'); // Arahkan kembali ke halaman login
    }
}
