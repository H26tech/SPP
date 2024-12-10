<?php

include("../../connect.php");

// cek apakah tombol simpan sudah diklik atau blum?
if (isset($_POST['simpan'])) {

    // ambil data dari formulir
    $id = $_POST['id'];
    $tapel = $_POST['tapel'];

    // buat query update
    $sql = "UPDATE 10_tahun_ajaran SET tapel='$tapel' WHERE id=$id";
    $query = mysqli_query($db, $sql);


    if ($query) {
        header('Location:tahun_ajaran.php');
    } else {
        die("Gagal menyimpan perubahan...");
    }
} else {
    die("Akses dilarang...");
}
