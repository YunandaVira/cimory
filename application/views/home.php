<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu - Cimory Dairyland</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- CSS untuk background dan menu -->
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .background {
            background-image: url('assets/images/background.jpg'); /* Pastikan path benar */
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .menu-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px; /* Jarak antar menu */
            text-align: center;
            flex-wrap: wrap; /* Agar menu bisa berbaris ke bawah pada layar kecil */
        }

        .menu-container .card {
            background: rgba(0, 0, 0, 0.7); /* Transparansi latar menu */
            color: white;
            width: 200px; /* Lebar kartu diperkecil */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px; /* Jarak bawah antar menu */
        }

        .menu-container .card:hover {
            transform: translateY(-5px); /* Efek melayang */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .menu-container .card-body {
            padding: 15px;
        }

        .menu-container .card-title {
            font-size: 1rem; /* Ukuran teks lebih kecil */
            margin-bottom: 10px;
            font-weight: bold;
        }

        .menu-container .card-text {
            font-size: 0.8rem; /* Ukuran deskripsi lebih kecil */
            opacity: 0.9;
        }

        .menu-container .btn-primary {
            font-size: 0.8rem; /* Ukuran tombol lebih kecil */
            padding: 5px 10px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .menu-container .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #003d80);
            transform: scale(1.05); /* Efek memperbesar */
        }

        .menu-container .card-title i {
            font-size: 1.3rem; /* Ukuran ikon lebih kecil */
            margin-bottom: 5px;
            display: block;
        }

        /* Media Queries untuk tampilan mobile */
        @media (max-width: 768px) {
            .menu-container .card {
                width: 90%; /* Memperlebar kartu pada layar kecil */
                margin-bottom: 10px;
            }

            .menu-container {
                flex-direction: column; /* Menampilkan menu berbaris ke bawah pada mobile */
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Menampilkan pesan login sukses jika ada -->
    <?php if ($this->session->flashdata('login_success')): ?>
        <div class="alert alert-success text-center">
            <?php echo $this->session->flashdata('login_success'); ?>
        </div>
    <?php endif; ?>
    <!-- Background dan Menu -->
    <div class="background">
        <div class="menu-container">
            <!-- Menu Beli Tiket -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-ticket-alt"></i> Beli Tiket
                    </h5>
                    <p class="card-text">Pesan tiket untuk pengalaman seru di Cimory Dairyland.</p>
                    <a href="<?= base_url('tiket'); ?>" class="btn btn-primary">Lihat Tiket</a>
                </div>
            </div>

            <!-- Menu Tentang Kami -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-info-circle"></i> Tentang Kami
                    </h5>
                    <p class="card-text">Ketahui lebih banyak tentang Cimory Dairyland.</p>
                    <a href="<?= base_url('tentang'); ?>" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>

            <!-- Menu Map Area (Kontak Kami diubah menjadi Map Area) -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-map-marked-alt"></i> Map Area
                    </h5>
                    <p class="card-text">Lihat area lokasi pada peta Cimory Dairyland.</p>
                    <a href="<?= base_url('home/map_area'); ?>" class="btn btn-primary">Lihat Peta</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
