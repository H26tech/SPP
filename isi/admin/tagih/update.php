<?php
include('../../connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $bulan = $_POST['bulan'];
    $keterangan = $_POST['keterangan'];
    $nominal = $_POST['nominal'];
    $sisa_bayar = $_POST['sisa_bayar']; // Ambil nilai yang dipilih dari dropdown

    $query = "UPDATE 10_tagihan SET bulan = '$bulan', keterangan = '$keterangan', nominal = '$nominal', sisa_bayar = '$sisa_bayar' WHERE id = $id";

    if ($db->query($query) === TRUE) {
        header("Location: tagihan.php");
        exit();
    } else {
        echo "Error: " . $db->error;
    }

    $db->close();
} else {
    echo "Permintaan tidak valid.";
}
