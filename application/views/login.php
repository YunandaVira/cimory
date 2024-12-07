<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cimory Dairyland</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Kontainer login */
        .login-container {
            display: flex;
            justify-content: flex-start;  /* Menempatkan form dan gambar bersebelahan */
            align-items: stretch;         /* Membuat form dan gambar memiliki tinggi yang sama */
            min-height: 100vh;            /* Pastikan kontainer memiliki tinggi penuh layar */
            height: 100vh;                /* Gambar dan form mengisi layar penuh */
            margin: 0;                    /* Menghilangkan margin */
            padding: 0;                   /* Menghilangkan padding */
            overflow: hidden;             /* Pastikan tidak ada scroll atau latar putih yang terlihat */
            position: relative;
            flex-direction: column;       /* Pastikan kontainer bisa scroll */
        }

        /* Header dengan latar belakang biru tua */
        .header {
            background-color: #003366; /* Warna biru tua */
            color: #ffffff;            /* Warna teks putih */
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            padding: 10px 0;
            margin: 0;                 /* Menghapus margin agar header menempel dengan gambar */
            width: 100%;                /* Lebar header mengikuti lebar halaman */
            z-index: 2;                 /* Memastikan header tetap di atas gambar */
        }

        /* Gambar di sebelah kiri */
        .login-image {
            flex: 1;
            background-image: url('<?= base_url("assets/images/login.jpg"); ?>');
            background-size: cover;      /* Gambar mengisi seluruh kontainer */
            background-position: top;    /* Posisi gambar lebih ke atas */
            background-repeat: no-repeat; /* Jangan mengulang gambar */
            height: calc(100vh - 80px);   /* Gambar mengisi hampir seluruh layar, kecuali header */
            width: 100%;                 /* Gambar memenuhi lebar layar */
            position: relative;
        }

        /* Form login di sebelah kanan */
       /* Form login di sebelah kanan */
.login-form-container {
    width: 400px;                 /* Lebar form login tetap, misalnya 400px */
    padding: 40px;
    background-color: rgba(255, 255, 255, 0.8); /* Membuat form login sedikit transparan */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    position: absolute;
    right: 0;                     /* Menempatkan form di sisi kanan */
    top: 50%;                      /* Menempatkan form di tengah vertikal */
    transform: translateY(-50%);   /* Menjaga form tetap berada di tengah */
    margin-right: 80px;             /* Menambahkan jarak dari sisi kiri */
}

        /* Judul login */
        .login-form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            color: #2c3e50; /* Warna lebih gelap dan elegan */
        }

        /* Form group styling */
        .form-group {
            margin-bottom: 20px;
        }

        /* Tombol login dengan gaya */
        .btn-custom {
            background-color: #007bff; /* Warna biru khas */
            color: white;
            width: 100%;
            padding: 14px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Link Daftar */
        .text-center a {
            color: #007bff;
        }

        /* Menambahkan sentuhan tipografi alami */
        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Responsif untuk ukuran layar kecil */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .login-image {
                height: 250px;            /* Menyesuaikan tinggi gambar pada layar kecil */
                width: 100%;              /* Gambar memenuhi lebar layar */
            }
            .login-form-container {
                width: 100%;              /* Form login memenuhi lebar layar */
                position: relative;
                top: 0;
                transform: none;          /* Hilangkan transformasi agar form tidak melayang */
                padding: 20px;
            }
        }

        /* Footer dengan latar belakang biru tua */
        .footer {
            background-color: #003366; /* Warna biru tua */
            color: #fff;
            text-align: center;
            padding: 20px 0;
            font-size: 14px;
            margin: 0;            /* Menghapus margin agar footer menempel dengan gambar */
        }
    </style>
</head>
<body>

    <!-- Header dengan pesan login -->
    <div class="header">
        Silakan melakukan login
    </div>

    <!-- Kontainer login -->
    <div class="login-container">
        <!-- Gambar di sebelah kiri -->
        <div class="login-image"></div>

        <!-- Form Login di sebelah kanan -->
        <div class="login-form-container">
            <h2>Login</h2>

            <!-- Menampilkan pesan error jika login gagal -->
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <!-- Form Login -->
            <form method="POST" action="<?= base_url('login/validate_login'); ?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                </div>

                <button type="submit" class="btn btn-custom">Login</button>
            </form>

            <p class="mt-3 text-center">Belum punya akun? <a href="<?= base_url('register'); ?>">Daftar di sini</a></p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2024 Cimory Dairyland | All rights reserved.
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
