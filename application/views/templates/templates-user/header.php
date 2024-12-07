<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tiket</title>
    <!-- Sertakan Bootstrap untuk tata letak -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Sertakan FontAwesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Navbar dengan latar belakang biru tua dan teks putih */
        nav {
            background-color: #003366;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Tampilan untuk navigasi dan ikon */
        .nav-link {
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            padding: 10px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            margin-right: 8px;
        }

        .nav-link:hover {
            transform: translateY(-4px);
            color: #f0f0f0;
        }

        /* Navbar brand */
        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 20px;
            display: flex;
            align-items: center;
        }

        /* Pesan selamat datang */
        .welcome-message {
            color: white;
            font-size: 18px;
            font-weight: 500;
            text-align: right;
            margin-right: 30px;
            flex-grow: 1;
        }

        /* Mobile view navbar adjustment */
        @media (max-width: 768px) {
            .navbar-nav {
                margin-top: 10px;
            }
            .navbar-brand {
                display: block;
                text-align: center;
                margin: 0 auto;
            }
            .welcome-message {
                text-align: center;
                margin-right: 0;
            }
            .navbar-collapse {
                justify-content: flex-start;
                width: 100%;
            }
            .nav-item {
                display: block;
                width: 100%;
            }
        }

        /* CSS untuk Logo Keranjang Mengambang */
        .floating-cart-logo {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            background-color: #28a745;
            padding: 12px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
            animation: bounce 1s infinite; /* Menambahkan animasi bounce pada logo keranjang */
        }

        .cart-icon {
            color: white;
            font-size: 30px;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            z-index: 10;
        }

        .floating-cart-logo:hover {
            background-color: #218838;
            cursor: pointer;
            transform: scale(1.1);
            transition: transform 0.2s ease-in-out;
        }

        /* Animasi bounce untuk logo keranjang */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Animasi gerakan untuk badge */
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(5px); }
            50% { transform: translateX(0); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }

        .shake {
            animation: shake 0.5s ease;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="<?= base_url('home'); ?>">
            <i class="fas fa-home"></i>
            <span>Cimory Dairyland</span>
        </a>

        <!-- Pesan Selamat Datang dengan nama pengguna yang login -->
        <div class="welcome-message">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Selamat datang, <?= htmlspecialchars($_SESSION['username']); ?>!</span>
            <?php else: ?>
                <span>Selamat datang, Pengunjung!</span>
            <?php endif; ?>
        </div>

        <!-- Tombol navigasi untuk menu dropdown dan login -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bars"></i> Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url('tiket'); ?>">Beli Tiket</a>
                        <a class="dropdown-item" href="<?= base_url('tentang'); ?>">Tentang Kami</a>
                        <a class="dropdown-item" href="<?= base_url('map_area'); ?>">Map Area</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('login'); ?>"><i class="fas fa-user"></i> Log-In</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Logo Keranjang Mengambang -->
    <div id="floating-cart-logo" class="floating-cart-logo">
        <a href="<?= base_url('tiket/keranjang'); ?>">
            <i class="fas fa-shopping-cart cart-icon"></i>
            <span class="cart-badge" id="cart-badge">
    <?php
        // Ambil jumlah tiket dari session keranjang
        $keranjang = $this->session->userdata('keranjang') ?? [];
        $cart_items = 0;
        foreach ($keranjang as $item) {
            $cart_items += $item['jumlah']; // Menjumlahkan total tiket
        }
        echo $cart_items;
    ?>
</span>

        </a>
    </div>

    <!-- Sertakan JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> <!-- Popper.js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->

    <!-- JavaScript untuk Animasi dan Keranjang -->
    <script>
        // Efek animasi logo keranjang saat diklik
        document.getElementById('floating-cart-logo').addEventListener('click', function() {
            this.style.animation = 'none'; // Menghapus animasi saat diklik
            setTimeout(() => {
                this.style.animation = 'bounce 1s infinite'; // Menambahkan kembali animasi setelah 1 detik
            }, 1000);
        });

        // Efek bergerak naik turun secara terus menerus
        function animateCartLogo() {
            const logo = document.getElementById('floating-cart-logo');
            let position = 20;
            let direction = 1;

            setInterval(function() {
                if (position <= 10 || position >= 30) {
                    direction *= -1; // Membalik arah
                }
                position += direction;
                logo.style.bottom = position + 'px'; // Menggerakkan logo
            }, 30);
        }

        animateCartLogo(); // Memulai animasi
    </script>

</body>
</html>
