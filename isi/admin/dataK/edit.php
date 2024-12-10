<?php

include("../../connect.php");

// cek apakah tombol simpan sudah diklik atau blum?
if (isset($_POST['simpan'])) {

    // ambil data dari formulir
    $id = $_POST['id'];
    $kelas = $_POST['kelas'];

    // buat query update
    $sql = "UPDATE 10_data_kelas SET kelas='$kelas' WHERE id=$id";
    $query = mysqli_query($db, $sql);


    if ($query) {
        header('Location:data_kelas.php');
    } else {
        die("Gagal menyimpan perubahan...");
    }
} else {
    die("Akses dilarang...");
}
