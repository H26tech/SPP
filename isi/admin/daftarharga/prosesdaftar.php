<?php

include("../../connect.php");

if(isset($_POST['daftar'])){

    
    $tapel = $_POST['tapel'];
    $kelas = $_POST['kelas'];
    $nominal = $_POST['nominal'];

    $sql ="INSERT into 10_jenis_pembayaran (tapel,kelas,nominal) value ('$tapel','$kelas','$nominal')";
    $query= mysqli_query($db,$sql);
    

    
    if( $query ) {
        
        header('Location: dh.php?status=sukses');
    } else {
        
        header('Location: dh.php?status=gagal');
    }


} else {
    die("Akses dilarang...");
}

?>