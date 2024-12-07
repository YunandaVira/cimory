<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "third_party/Google/vendor/autoload.php"; // Pastikan library Google API diunduh

class GoogleLogin extends CI_Controller {
    private $client;

    public function __construct() {
        parent::__construct();
        $this->client = new Google_Client();
        $this->client->setClientId('GOOGLE_CLIENT_ID'); // Masukkan Client ID Google
        $this->client->setClientSecret('GOOGLE_CLIENT_SECRET'); // Masukkan Client Secret Google
        $this->client->setRedirectUri(base_url('googlelogin/callback'));
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function login() {
        $loginUrl = $this->client->createAuthUrl();
        redirect($loginUrl);
    }

    public function callback() {
        if ($this->input->get('code')) {
            $this->client->authenticate($this->input->get('code'));
            $token = $this->client->getAccessToken();
            $this->client->setAccessToken($token);

            $googleService = new Google_Service_Oauth2($this->client);
            $userInfo = $googleService->userinfo->get();

            // Cek apakah pengguna sudah terdaftar
            $user = $this->db->get_where('users', ['email' => $userInfo->email])->row();
            if ($user) {
                // Login berhasil
                $this->session->set_userdata('username', $user->username);
                redirect('home');
            } else {
                // Redirect ke halaman registrasi jika belum terdaftar
                redirect('register');
            }
        }
    }
}
