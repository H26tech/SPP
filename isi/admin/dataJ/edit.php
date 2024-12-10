<?php

include("../../connect.php");

// cek apakah tombol simpan sudah diklik atau tidak
if (isset($_POST['simpan'])) {

    // ambil data dari formulir
    $id = $_POST['id'];
    $jurusan = $_POST['jurusan'];

    // buat query update
    $sql = "UPDATE 10_jurusan SET jurusan='$jurusan' WHERE id=$id";
    $query = mysqli_query($db, $sql);

    if ($query) {
        header('Location:jurusan.php');
    } else {
        die("Gagal menyimpan perubahan...");
    }
} else {
    die("Akses dilarang...");
}
