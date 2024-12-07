<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Area - Cimory Dairyland</title>

    <!-- Link ke Google Fonts untuk font yang lebih menarik -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* CSS untuk gambar peta dan keseluruhan halaman */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Kontainer peta */
        .map-container {
            text-align: center;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            transition: transform 0.3s ease;
        }

        .map-container:hover {
            transform: translateY(-5px); /* Efek hover pada container */
        }

        /* Gambar Peta */
        .map-image {
            width: 100%; /* Menyesuaikan lebar gambar dengan lebar layar */
            max-width: 700px; /* Membatasi lebar gambar agar tidak terlalu besar */
            height: auto; /* Menjaga rasio gambar */
            margin: 0 auto;
            display: block;
            border-radius: 15px; /* Sudut gambar lebih halus */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .map-image:hover {
            transform: scale(1.05); /* Efek zoom-in saat gambar dihover */
        }

        /* Deskripsi peta */
        .map-description {
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
            color: #555;
            margin-top: 20px;
            font-weight: 400;
            line-height: 1.5;
            text-align: justify;
            max-width: 750px;
            margin: 20px auto;
        }

        /* Judul Halaman */
        h2 {
            font-family: 'Montserrat', sans-serif;
            color: #222;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .map-container {
                padding: 15px;
            }

            .map-image {
                max-width: 100%;
            }

            h2 {
                font-size: 1.5rem;
            }

            .map-description {
                font-size: 0.9rem;
            }
        }
    </style>
    <style>
    /* Kontainer tombol */
    .map-button-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 30px;
        text-align: center;
    }

    /* Deskripsi di atas tombol */
    .map-button-description {
        font-family: 'Roboto', sans-serif;
        font-size: 1rem;
        color: #555;
        margin-bottom: 15px;
        font-weight: 400;
    }

    /* Tombol Google Map */
    .btn-google-map {
        background-color: #28a745; /* Hijau utama */
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2rem;
        font-weight: 600;
        text-transform: uppercase;
        padding: 12px 20px;
        border-radius: 30px;
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-google-map i {
        margin-right: 8px; /* Jarak ikon ke teks */
    }

     /* Efek hover: ubah menjadi biru */
     .btn-google-map:hover {
        background-color: #007bff; /* Biru */
        color: #ffffff; /* Font tetap putih */
        transform: translateY(-3px); /* Efek naik saat hover */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .btn-google-map:active {
        transform: translateY(0);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>

</head>
<body>
    <div class="container">
        <div class="map-container">
            <h2>Peta Area Cimory Dairyland</h2>
            <img src="<?= base_url('assets/images/cimory_map.jpg'); ?>" alt="Peta Cimory Dairyland" class="map-image">
            <p class="map-description">
                Berikut adalah peta area Cimory Dairyland yang menunjukkan berbagai tempat menarik yang dapat Anda kunjungi. Jelajahi area ini dan nikmati pengalaman Anda di tempat yang penuh keseruan ini! Temukan lokasi restoran, wahana, serta area wisata yang akan membuat kunjungan Anda semakin berkesan.
            </p>
        </div>
    </div>
            <!-- Link ke Google Maps -->
           <div class="map-button-container">
    <p class="map-button-description">Lihat lokasi akurat Cimory Dairyland di Google Maps.</p>
    <a href="https://maps.app.goo.gl/r9DqbhDaXBUUC6tTA" target="_blank" class="btn-google-map">
        <i class="fas fa-map-marker-alt"></i> Lihat Lokasi di Google Maps
    </a>
</div>

        <hr class="my-5">

        <!-- Tombol Kembali -->
        <div class="text-center">
            <a href="<?= base_url('home'); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
