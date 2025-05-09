<?php
defined('BASEPATH') or exit('No Direct script access allowed');
class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function laporan_buku()
    {
        $data['judul'] = 'Laporan Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/laporan_buku', $data);
        $this->load->view('templates/footer');
    }
    public function cetak_laporan_buku()
    {
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

        $this->load->view('buku/laporan_print_buku', $data);
    }
    public function laporan_buku_pdf()
{
    $this->load->library('pdf'); // Muat library pdf

    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    $this->load->view('buku/laporan_pdf_buku', $data);

    $paper_size = 'A4';
    $orientation = 'landscape';
    $html = $this->output->get_output();

    // Gunakan $this->pdf, sesuai dengan penggunaan di controller Booking
    $this->pdf->set_paper($paper_size, $orientation);
    $this->pdf->load_html($html);
    $this->pdf->render();
    $this->pdf->stream("laporan_data_buku.pdf", array('attachment' => 0));
}
    public function export_excel()
    {
        $data = array('title' => 'Laporan Data Buku', 'buku' => $this->ModelBuku->getBuku()->result_array());
        $this->load->view('buku/export_excel_buku', $data);
    }
    public function laporan_pinjam()
{
    $data['judul'] = 'Laporan Data Peminjaman';
    $data['user'] = $this->ModelUser->cekData([
        'email' => $this->session->userdata('email')
    ])->row_array();

    $data['laporan'] = $this->db->query("
        SELECT * FROM pinjam p
        JOIN detail_pinjam d ON p.no_pinjam = d.no_pinjam
        JOIN buku b ON d.id_buku = b.id
        JOIN user u ON p.id_user = u.id
    ")->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('pinjam/laporan-pinjam', $data);
    $this->load->view('templates/footer');
}
    public function cetak_laporan_pinjam()
    {
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d,
        buku b,user u where d.id_buku=b.id and p.id_user=u.id
        and p.no_pinjam=d.no_pinjam")->result_array();
        $this->load->view('pinjam/laporan-print-pinjam', $data);
    }
    public function laporan_pinjam_pdf()
{
    $this->load->library('pdf');
    
    $data['laporan'] = $this->db->query("
        SELECT * FROM pinjam p
        JOIN detail_pinjam d ON p.no_pinjam = d.no_pinjam
        JOIN buku b ON d.id_buku = b.id
        JOIN user u ON p.id_user = u.id
    ")->result_array();

    $this->load->view('pinjam/laporan-pdf-pinjam', $data);

    $paper_size = 'A4'; // ukuran kertas
    $orientation = 'landscape'; // tipe format kertas portrait atau landscape
    $html = $this->output->get_output();

    $this->pdf->set_paper($paper_size, $orientation);
    // Convert to PDF
    $this->pdf->load_html($html);
    $this->pdf->render();
    $this->pdf->stream("laporan_data_peminjaman.pdf", array('Attachment' => 0)); // nama file PDF yang dihasilkan
}
    public function export_excel_pinjam()
{
    $data = array( 'title' => 'Laporan Data Peminjaman Buku', 'laporan' => $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array());
    $this->load->view('pinjam/export-excel-pinjam', $data);
}
}