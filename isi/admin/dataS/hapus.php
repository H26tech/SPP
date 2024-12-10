<?php

include("../../connect.php");

if (isset($_GET['id'])) {

    // Ambil id dari query string dan sanitasi
    $id = $_GET['id'];

    // Buat query hapus menggunakan prepared statement
    $sql = "DELETE FROM 10_data_siswa WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id);

    // Apakah query hapus berhasil?
    if ($stmt->execute()) {
        $stmt->close();
        header('Location: data_siswa.php');
        exit();
    } else {
        $stmt->close();
        die("Gagal menghapus...");
    }
} else {
    die("Akses dilarang...");
}
?>
