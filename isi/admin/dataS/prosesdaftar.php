<?php
include("../../connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nis = $_POST['NIS'];
    $nama = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $password = $_POST['password'];

    // Periksa apakah NIS sudah terdaftar
    $sql_check_nis = "SELECT id FROM 10_data_siswa WHERE NIS = '$nis'";
    $result_check_nis = mysqli_query($db, $sql_check_nis);

    if (mysqli_num_rows($result_check_nis) > 0) {
        // NIS sudah terdaftar, berikan pesan kesalahan
        header('Location: daftar.php?status=gagal');
        exit();
    } else {
        // NIS belum terdaftar, lakukan pendaftaran
        $sql_insert = "INSERT INTO 10_data_siswa (NIS, nama_siswa, kelas, jurusan, password ) VALUES ('$nis', '$nama', '$kelas', '$jurusan', '$password')";
        $result_insert = mysqli_query($db, $sql_insert);

        if ($result_insert) {
            // Pendaftaran sukses
            header('Location: data_siswa.php?status=sukses');
            exit();
        } else {
            // Pendaftaran gagal
            header('Location: data_siswa.php?status=gagal');
            exit();
        }
    }
} else {
    // Akses dilarang jika bukan metode POST
    die("Akses dilarang...");
}
