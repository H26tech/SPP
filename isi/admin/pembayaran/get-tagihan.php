<?php
include('../../connect.php');

if (isset($_GET["nis"])) {
    $nis = $_GET["nis"];

    // Query untuk mengambil data tagihan berdasarkan NIS
    $query_tagihan = "SELECT keterangan, bulan FROM 10_tagihan WHERE nis = ?";
    $stmt_tagihan = $db->prepare($query_tagihan);
    $stmt_tagihan->bind_param("s", $nis);
    $stmt_tagihan->execute();
    $result_tagihan = $stmt_tagihan->get_result();

    if ($result_tagihan->num_rows > 0) {
        $row_tagihan = $result_tagihan->fetch_assoc();

        // Mengembalikan data tagihan dalam format JSON
        echo json_encode($row_tagihan);
    } else {
        // Jika tidak ada data tagihan yang ditemukan
        echo json_encode(array("keterangan" => "Belum Lunas", "bulan" => "-"));
    }
} else {
    // Jika parameter NIS tidak ditemukan
    echo json_encode(array("keterangan" => "Belum Lunas", "bulan" => "-"));
}

// Tutup koneksi database
$db->close();
