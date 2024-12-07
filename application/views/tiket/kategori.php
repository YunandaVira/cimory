<?php $this->load->view('templates/templates-user/header'); ?>

<!-- Tambahkan Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&family=Montserrat:wght@600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Roboto', sans-serif; /* Gaya font utama */
    }

    h1 {
            font-family: 'Merriweather', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 15px;
        }

    h5.card-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2rem;
        font-weight: 500;
        color: #000; /* Ubah warna ke hitam */
    }

    .btn-success {
        background-color: #28a745; /* Hijau utama */
        border: none;
        text-transform: uppercase;
        font-size: 1rem;
        font-weight: 500;
    }

    .btn-success:hover {
        background-color: #218838; /* Hijau gelap saat hover */
        color: #fff;
    }

    /* Tombol kembali ke beranda */
    .btn-primary {
        background-color: #007bff; /* Biru profesional */
        border: none;
        text-transform: uppercase;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Biru lebih gelap saat hover */
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-primary i {
        margin-right: 8px; /* Jarak ikon dengan teks */
    }
</style>

<div class="container text-center my-5">
    <h1 class="mb-4">Pilih Kategori Tiket</h1>
    <div class="row justify-content-center">
        <!-- Tiket Masuk -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <img src="<?= base_url('assets/images/kategori_tiket_masuk.jpg'); ?>" class="card-img-top" alt="Kategori Tiket Masuk" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Tiket Masuk</h5> <!-- Ubah warna ke hitam -->
                    <a href="<?= base_url('tiket/masuk'); ?>" class="btn btn-success mb-2">Lihat Tiket</a>
                </div>
            </div>
        </div>

        <!-- Tiket Makan Hewan -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <img src="<?= base_url('assets/images/kategori_tiket_makanh.jpg'); ?>" class="card-img-top" alt="Kategori Tiket Makan Hewan" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Tiket Makan Hewan</h5> <!-- Ubah warna ke hitam -->
                    <a href="<?= base_url('tiket/makanh'); ?>" class="btn btn-success mb-2">Lihat Tiket</a>
                </div>
            </div>
        </div>

        <!-- Tiket Wahana -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <img src="<?= base_url('assets/images/kategori_tiket_wahana.jpg'); ?>" class="card-img-top" alt="Kategori Tiket Wahana" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Tiket Wahana</h5> <!-- Ubah warna ke hitam -->
                    <a href="<?= base_url('tiket/wahana'); ?>" class="btn btn-success mb-2">Lihat Tiket</a>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="<?= base_url('home'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<?php $this->load->view('templates/templates-user/footer'); ?>
