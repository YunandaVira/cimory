<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['ModelUser', 'ModelBooking']);
    }

    public function index()
    {
        $this->_login();
    }

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

    //==================================================================================================//

    public function daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama Belum diisi!!'
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required', [
            'required' => 'Alamat Belum diisi!!'
        ]);

        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[pengunjung.email]', [
            'valid_email' => 'Email Tidak Benar!!',
            'required' => 'Email Belum diisi!!',
            'is_unique' => 'Email Sudah Terdaftar!'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Tidak Sama!!',
            'min_length' => 'Password Terlalu Pendek'
        ]);

        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

        $email = $this->input->post('email', true);
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'alamat' => $this->input->post('alamat', true),
            'email' => htmlspecialchars($email),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role' => 2, // role member
            'is_active' => 1,
            'tanggal_input' => time()
        ];

        $this->ModelUser->simpanData($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun anggota anda sudah dibuat.</div>');
        redirect(base_url());
    }

    //======================================================================================================================//

    public function myProfil()
    {
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'image' => $user['image'],
            'user' => $user['nama'],
            'email' => $user['email'],
            'tanggal_input' => $user['tanggal_input'],
        ];

        $data['judul'] = 'Profil Saya';
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('member/index', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer', $data);
    }

    //==========================================================================================//

    public function ubahProfil()
    {
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        // Cek jika user tidak ditemukan
        if (!$user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User tidak ditemukan!</div>');
            redirect('home');
            return; // Jangan lanjutkan jika user tidak ditemukan
        }

        $data = [
            'image' => $user['image'],
            'user' => $user['nama'],
            'email' => $user['email'],
            'tanggal_input' => $user['tanggal_input'],
        ];

        $data['judul'] = 'Profil Saya';
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak Boleh Kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('member/ubah-anggota', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        } else {
            $nama = $this->input->post('nama', true);
            $email = $this->input->post('email', true);

            // jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3000';
                $config['max_width'] = '1024';
                $config['max_height'] = '1000';
                $config['file_name'] = 'pro_' . time(); // Penamaan gambar yang unik

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['image']; // Menggunakan $data['image'] yang benar
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    // Tampilkan pesan kesalahan jika upload gagal
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('member/ubahprofil'); // Redirect ke halaman ubah profil
                }
            }

            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('pengunjung');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah</div>');
            redirect('member/myprofil');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Anda telah logout!!</div>');
        redirect('home');
    }
}
