<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat model dan library yang diperlukan
        $this->load->model('Tiket_model');
        $this->load->library('session');
    }

    // Fungsi untuk menampilkan daftar tiket
    public function index()
    {
        // Mendapatkan data tiket dari model
        $data['tiket_masuk'] = $this->Tiket_model->get_tiket_masuk();
        $data['tiket_makanh'] = $this->Tiket_model->get_tiket_makanh();
        $data['tiket_wahana'] = $this->Tiket_model->get_tiket_wahana();
        
        // Menambahkan gambar untuk setiap tiket
        foreach ($data['tiket_masuk'] as &$tiket) {
            $tiket->image = 'assets/images/tiket_masuk.jpg'; // Ganti sesuai file gambar
        }

        foreach ($data['tiket_makanh'] as &$tiket) {
            $tiket->image = 'assets/images/tiket_makanh.jpg'; // Ganti sesuai file gambar
        }

        foreach ($data['tiket_wahana'] as &$tiket) {
            $tiket->image = 'assets/images/tiket_wahana.jpg'; // Ganti sesuai file gambar
        }

        // Menampilkan view dengan data tiket
        $this->load->view('tiket/index', $data);
    }

    // Fungsi untuk membeli tiket
    public function beli($id_tiket)
    {
        // Cek tipe tiket (masuk, makan hewan, wahana)
        if ($this->db->get_where('tiket_masuk', ['id_tiketmasuk' => $id_tiket])->row_array()) {
            $tabel = 'tiket_masuk';
            $kolom = 'id_tiketmasuk';
        } elseif ($this->db->get_where('tiket_makanh', ['id_tiketmakanh' => $id_tiket])->row_array()) {
            $tabel = 'tiket_makanh';
            $kolom = 'id_tiketmakanh';
        } elseif ($this->db->get_where('tiket_wahana', ['id_tiketwahana' => $id_tiket])->row_array()) {
            $tabel = 'tiket_wahana';
            $kolom = 'id_tiketwahana';
        } else {
            show_404(); // Tampilkan halaman error jika ID tiket tidak valid
        }

        // Ambil data tiket
        $tiket = $this->db->get_where($tabel, [$kolom => $id_tiket])->row_array();

        // Kirim data tiket ke view
        $data['tiket'] = $tiket;
        $data['tabel'] = $tabel;
        $data['kolom'] = $kolom; // Menambahkan kolom untuk referensi
        $this->load->view('tiket/beli', $data);
    }

    // Fungsi untuk memproses pembelian tiket
    public function proses_beli()
    {
        $id_tiket = $this->input->post('id_tiket');
        $tabel = $this->input->post('tabel');
        $kolom = $this->input->post('kolom'); // Menambahkan kolom untuk referensi
        $jumlah = $this->input->post('jumlah');

        // Ambil data tiket
        $tiket = $this->db->get_where($tabel, [$kolom => $id_tiket])->row_array();

        // Validasi stok
        if ($jumlah > $tiket['stok']) {
            show_error('Stok tidak mencukupi!', 400, 'Kesalahan');
        }

        // Kurangi stok tiket
        $this->db->set('stok', 'stok - ' . $jumlah, FALSE)
                 ->where($kolom, $id_tiket)
                 ->update($tabel);

        // Simpan pembelian transaksi
        $data = [
            'id_tiket' => $id_tiket,
            'jumlah' => $jumlah,
            'total_harga' => $jumlah * $tiket['harga'],
            'tanggal_transaksi' => date('Y-m-d H:i:s') // Menyimpan tanggal transaksi
        ];
        $this->db->insert('transaksi', $data);

        // Mengarahkan pengguna ke halaman tiket setelah pembelian sukses
        $this->session->set_flashdata('success', 'Tiket berhasil dipesan!');
        redirect('tiket');
    }

    public function kategori()
    {
        $this->load->view('tiket/kategori'); // Menampilkan halaman kategori
    }

    public function masuk()
    {
        // Ambil parameter hari dan jenis_tiket dari URL
        $hari = $this->input->get('hari');
        $jenis_tiket = $this->input->get('jenis_tiket');
        
        // Filter tiket berdasarkan hari dan jenis tiket
        if ($hari || $jenis_tiket) {
            // Jika ada filter hari atau jenis tiket, ambil data tiket dengan filter
            $data['tiket_masuk'] = $this->Tiket_model->get_tiket_masuk_by_hari_jenis($hari, $jenis_tiket);
        } else {
            // Tampilkan semua tiket jika tidak ada filter
            $data['tiket_masuk'] = $this->Tiket_model->get_tiket_masuk();
        }

        $this->load->view('tiket/masuk', $data);
    }

    public function makanh()
    {
        $data['tiket_makanh'] = $this->Tiket_model->get_tiket_makanh();
        $this->load->view('tiket/makanh', $data);
    }

    public function wahana()
    {
        $data['tiket_wahana'] = $this->Tiket_model->get_tiket_wahana();
        $this->load->view('tiket/wahana', $data);
    }

    public function tambah_ke_keranjang()
{
    $id_tiket = $this->input->post('id_tiket');
    $nama_tiket = $this->input->post('nama_tiket');
    $harga = $this->input->post('harga');
    $jenis = $this->input->post('jenis');
    $jumlah = $this->input->post('jumlah');
    $pilih_hari = $this->input->post('pilih_hari'); // Ambil nilai pilih_hari

    // Ambil data tiket berdasarkan jenis
    $tabel = ($jenis === 'masuk') ? 'tiket_masuk' : (($jenis === 'makanh') ? 'tiket_makanh' : 'tiket_wahana');
    $kolom = ($jenis === 'masuk') ? 'id_tiketmasuk' : (($jenis === 'makanh') ? 'id_tiketmakanh' : 'id_tiketwahana');
    $tiket = $this->db->get_where($tabel, [$kolom => $id_tiket])->row_array();

    // Ambil data keranjang dari session
    $keranjang = $this->session->userdata('keranjang') ?? [];

    // Periksa apakah tiket ini sudah ada di keranjang
    $key = "{$jenis}_{$id_tiket}";
    if (isset($keranjang[$key])) {
        // Jika sudah ada, tambahkan jumlah
        $keranjang[$key]['jumlah'] += $jumlah;
    } else {
        // Jika belum ada, tambahkan ke keranjang
        $keranjang[$key] = [
            'id_tiket' => $id_tiket,
            'nama_tiket' => $nama_tiket,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'jenis' => $jenis,
            'foto' => $tiket['foto'] ?? 'default.jpg', // Ambil foto atau gunakan default
            'pilih_hari' => $pilih_hari, // Menyimpan pilihan hari
        ];
    }

    // Simpan kembali ke session
    $this->session->set_userdata('keranjang', $keranjang);

    $this->session->set_flashdata('success', 'Tiket berhasil ditambahkan ke keranjang!');
    redirect('tiket/keranjang');
}
    public function keranjang()
    {
        $data['keranjang'] = $this->session->userdata('keranjang') ?? [];
        $this->load->view('tiket/keranjang', $data);
    }

    public function hapus_dari_keranjang($key)
    {
        $keranjang = $this->session->userdata('keranjang') ?? [];
        if (isset($keranjang[$key])) {
            unset($keranjang[$key]);
            $this->session->set_userdata('keranjang', $keranjang);
            $this->session->set_flashdata('success', 'Tiket berhasil dihapus dari keranjang!');
        }
        redirect('tiket/keranjang');
    }


    public function checkout()
{
    // Ambil id_pengunjung dari sesi
    $id_pengunjung = $this->session->userdata('id_pengunjung');

    if (!$id_pengunjung) {
        // Jika id_pengunjung tidak ada, arahkan ke halaman login
        $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
        redirect('login');
    }

    $keranjang = $this->session->userdata('keranjang') ?? [];

    if (empty($keranjang)) {
        $this->session->set_flashdata('error', 'Keranjang kosong!');
        redirect('tiket/keranjang');
    }

    foreach ($keranjang as $item) {
        // Tentukan kolom yang digunakan untuk ID tiket
        $id_tiket_col = '';
        if ($item['jenis'] === 'masuk') {
            $id_tiket_col = 'id_tiketmasuk';
        } elseif ($item['jenis'] === 'makanh') {
            $id_tiket_col = 'id_tiketmakanh';
        } elseif ($item['jenis'] === 'wahana') {
            $id_tiket_col = 'id_tiketwahana';
        }

        // Simpan transaksi ke database
        $data_transaksi = [
            'id_pengunjung' => $id_pengunjung,  // Pastikan id_pengunjung ada
            $id_tiket_col => $item['id_tiket'],
            'tgl_datang' => $item['pilih_hari'] ?? NULL,
            'tgl_pesan' => date('Y-m-d H:i:s'),
            'qty' => $item['jumlah'],
            'harga' => $item['harga'],
            'total_bayar' => $item['jumlah'] * $item['harga'] // Hitung total bayar
        ];
        $this->db->insert('transaksi', $data_transaksi);

        // Kurangi stok tiket setelah checkout
        $this->db->set('stok', 'stok - ' . $item['jumlah'], FALSE)
                 ->where($id_tiket_col, $item['id_tiket'])
                 ->update($item['jenis']);
    }

    // Kosongkan keranjang setelah checkout
    $this->session->unset_userdata('keranjang');
    $this->session->set_flashdata('success', 'Pembelian berhasil!');

    redirect('tiket');
}
    public function tambah_jumlah_keranjang($id) {
        // Ambil data tiket dari keranjang
        $keranjang = $this->session->userdata('keranjang');
        
        if (isset($keranjang[$id])) {
            // Tambah jumlah tiket
            $keranjang[$id]['jumlah']++;
            
            // Simpan kembali ke session
            $this->session->set_userdata('keranjang', $keranjang);
            
            // Mengembalikan response JSON
            echo json_encode(['success' => true, 'harga' => $keranjang[$id]['harga']]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    // Fungsi untuk mengurangi jumlah tiket
    public function kurang_jumlah_keranjang($id) {
        // Ambil data tiket dari keranjang
        $keranjang = $this->session->userdata('keranjang');
        
        if (isset($keranjang[$id]) && $keranjang[$id]['jumlah'] > 1) {
            // Kurangi jumlah tiket
            $keranjang[$id]['jumlah']--;
            
            // Simpan kembali ke session
            $this->session->set_userdata('keranjang', $keranjang);
            
            // Mengembalikan response JSON
            echo json_encode(['success' => true, 'harga' => $keranjang[$id]['harga']]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    public function getTiketById($id) {
        $this->db->select('id, nama_tiket, harga, jenis_tiket, pilih_hari');
        $this->db->from('tiket_masuk'); // Sesuaikan dengan tabel yang relevan
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }
    

}
