<?php

include("../../connect.php");

if (isset($_POST['daftar'])) {


    $kelas = $_POST['kelas'];


    $sql = "INSERT into 10_data_kelas (kelas) value ('$kelas')";
    $query = mysqli_query($db, $sql);



    if ($query) {

        header('Location: data_kelas.php?status=sukses');
    } else {

        header('Location: data_kelas.php?status=gagal');
    }
} else {
    die("Akses dilarang...");
}
