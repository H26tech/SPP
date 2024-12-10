<?php

include("../../connect.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan'])){

    // ambil data dari formulir
    $id = $_POST['id'];
    $tapel = $_POST['tapel'];
    $kelas = $_POST['kelas'];
    $nominal = $_POST['nominal'];

    // buat query update
    $sql = "UPDATE 10_jenis_pembayaran SET tapel='$tapel', kelas='$kelas', nominal='$nominal' WHERE id=$id";
    $query = mysqli_query($db, $sql);


    if( $query ) {
        header('Location:dh.php');
    } else {
        die("Gagal menyimpan perubahan...");
    }


} else {
    die("Akses dilarang...");
}

?>