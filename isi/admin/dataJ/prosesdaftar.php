<?php

include("../../connect.php");

if (isset($_POST['daftar'])) {


    $jurusan = $_POST['jurusan'];


    $sql = "INSERT into 10_jurusan (jurusan) value ('$jurusan')";
    $query = mysqli_query($db, $sql);



    if ($query) {

        header('Location: jurusan.php?status=sukses');
    } else {

        header('Location: jurusan.php?status=gagal');
    }
} else {
    die("Akses dilarang...");
}
