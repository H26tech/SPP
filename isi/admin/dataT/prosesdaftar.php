<?php

include("../../connect.php");

if (isset($_POST['daftar'])) {


    $tapel = $_POST['tapel'];


    $sql = "INSERT into 10_tahun_ajaran (tapel) value ('$tapel')";
    $query = mysqli_query($db, $sql);



    if ($query) {

        header('Location: tahun_ajaran.php?status=sukses');
    } else {

        header('Location: tahun_ajaran.php?status=gagal');
    }
} else {
    die("Akses dilarang...");
}
