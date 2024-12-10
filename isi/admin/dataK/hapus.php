<?php

include("../../connect.php");

if (isset($_GET['id'])) {

    // ambil id dari query string
    $id = $_GET['id'];

    // buat query hapus
    $sql = "DELETE FROM 10_data_kelas WHERE id=$id";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if ($query) {
        header('Location: data_kelas.php');
    } else {
        die("gagal menghapus...");
    }
} else {
    die("akses dilarang...");
}
