<?php
// Password yang dimasukkan oleh user
// Hash password yang diketahui
$test_password = '123'; // Password yang ingin Anda tes
$test_hash = password_hash($test_password, PASSWORD_DEFAULT); // Hash password

// Outputkan hash untuk memverifikasi
echo "Hash yang dihasilkan: " . $test_hash;

// Verifikasi hash dengan password yang benar
if (password_verify($test_password, $test_hash)) {
    echo "Password cocok!";
} else {
    echo "Password tidak cocok!";
}
