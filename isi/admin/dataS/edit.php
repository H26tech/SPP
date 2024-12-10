<?php
include("../../connect.php");

if (isset($_POST['simpan'])) {
    // Ambil data dari formulir
    $id = $_POST['id'];
    $nis = $_POST['NIS'];
    $ns = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $pass = $_POST['password'];

    // Buat query update
    $sql = "UPDATE 10_data_siswa SET NIS='$nis', nama_siswa='$ns', kelas='$kelas', jurusan='$jurusan', password='$pass' WHERE id=$id";
    $query = mysqli_query($db, $sql);

    if ($query) {
        header('Location:data_siswa.php');
        exit(); // Keluar dari skrip setelah mengalihkan
    } else {
        die("Gagal menyimpan perubahan...");
    }
} else {
    // Tidak perlu melakukan tindakan apa pun jika tidak ada data yang dikirimkan
    header('Location:data_siswa.php');
    exit(); // Keluar dari skrip jika tidak ada data yang dikirimkan
}
