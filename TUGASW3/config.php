<?php
$host = "localhost"; // Server MySQL (default: localhost)
$user = "root";      // User MySQL (default: root)
$pass = "";          // Password MySQL (kosong di XAMPP)
$db   = "fahri";   // Nama database yang dibuat di phpMyAdmin

// Buat koneksi
$mysqli = new mysqli($host, $user, $pass, $db);

// // Cek koneksi
// if ($mysqli->connect_error) {
//     die("Koneksi gagal: " . $mysqli->connect_error);
// } else {
//     echo "Koneksi berhasil!";
// }
?>
