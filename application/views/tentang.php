<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Cimory Dairyland</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1.display-4 {
            font-family: 'Merriweather', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 15px;
        }

        p.lead {
            font-size: 1.1rem;
            font-weight: 500;
            color: #6c757d;
        }

        h3 {
            font-family: 'Poppins', sans-serif;
            color: #003366;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1.4rem;
        }

        p, li {
            font-size: 1rem;
            line-height: 1.8;
        }

        .list-group-item a {
            color: #003366;
            text-decoration: none;
        }

        .list-group-item a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            background: linear-gradient(135deg, #003366, #0056b3);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #003d80);
        }

        .map-container {
            margin-top: 20px;
            height: 300px;
            border: 2px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .location-container h3 {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .text-center {
            margin-top: 5px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Judul Halaman -->
        <div class="text-center">
            <h1 class="display-4">Tentang Cimory Dairyland</h1>
            <p class="lead text-muted">
                Destinasi wisata keluarga yang menggabungkan edukasi, petualangan, dan pengalaman kuliner.
            </p>
        </div>

        <!-- Konten Utama -->
        <div class="row mt-5">
            <!-- Deskripsi -->
            <div class="col-lg-8">
                <h3>Kenapa Memilih Cimory Dairyland?</h3>
                <p>
                    Cimory Dairyland adalah tujuan wisata yang dirancang untuk memberikan pengalaman unik kepada pengunjung dari segala usia. 
                    Anda dapat menikmati berbagai wahana seru, belajar tentang peternakan modern, serta mencicipi produk susu segar 
                    yang diproduksi langsung di tempat. Tempat ini juga menjadi lokasi sempurna untuk liburan keluarga yang penuh 
                    dengan kenangan indah.
                </p>
                <ul class="list-group mt-3">
                    <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Wahana edukasi dan petualangan</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Produk susu segar, yogurt, dan bolu</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Lingkungan yang aman dan ramah keluarga</li>
                </ul>
                <div class="mt-4">
            <p><strong>Catatan:</strong> Semua data, informasi, dan gambar yang digunakan dalam proyek ini berasal dari sumber yang dapat diakses publik, termasuk Google dan beberapa sumber lain yang relevan dengan Cimory Dairyland. Kami sangat menghargai hak cipta dan mendorong untuk selalu memverifikasi keaslian dan asal-usul setiap materi yang digunakan, guna memastikan penggunaan yang sesuai dengan ketentuan yang berlaku. Proyek ini bertujuan untuk memenuhi tugas UAS semester 4 dan menghargai setiap kontribusi sumber informasi yang digunakan.</p>
        </div>
            </div>

            

            <!-- Kontak Admin -->
            <div class="col-lg-4">
                <h3>Kontak Admin</h3>
                <p class="text-muted">Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi:</p>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Yunanda Vira Gayatri:</strong>
                        <a href="mailto:yunadvrg@gmail.com">yunadvrg@gmail.com</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Delta Tian Marchiska:</strong>
                        <a href="mailto:deltatianm@gmail.com">deltatianm@gmail.com</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Fitriana Novianti:</strong>
                        <a href="mailto:fitriana1120@gmail.com">fitriana1120@gmail.com</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Steven Jordan:</strong>
                        <a href="mailto:stevenjordan@gmail.com">stevenjordan@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-5">

        <!-- Lokasi - Peta Mini -->
        <div class="location-container">
            <h3>Lokasi Cimory Dairyland</h3>
            <p class="text-muted">Lihat lokasi kami di peta di bawah ini, atau klik tombol untuk menuju Google Maps:</p>

            <!-- Embed Peta Google dengan koordinat yang sesuai -->
            <a href="https://maps.app.goo.gl/r9DqbhDaXBUUC6tTA" target="_blank">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.735066774133!2d106.90263707017127!3d-6.649988840263855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4d0be70b4bb%3A0x7ab42d19a6de8881!2sCimory%20Dairyland!5e0!3m2!1sen!2sid!4v1668757400214!5m2!1sen!2sid" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </a>

            <!-- Link ke Google Maps -->
            <a href="https://maps.app.goo.gl/r9DqbhDaXBUUC6tTA" target="_blank" class="btn btn-primary btn-block mt-3">
                Lihat Lokasi di Google Maps
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

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
