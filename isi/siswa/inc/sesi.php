<?php
// Mulai session
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["NIS"])) {
    // Jika tidak, redirect ke halaman login
    header("Location: ../../../index.php");
    exit();
}

// Sisanya dari halaman...
