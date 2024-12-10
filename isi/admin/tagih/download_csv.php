<?php
include("../../connect.php");
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data_tagihan.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Initialize filter variables
$selected_name = isset($_POST['name']) ? $_POST['name'] : '';
$selected_class = isset($_POST['class']) ? $_POST['class'] : '';
$selected_major = isset($_POST['major']) ? $_POST['major'] : '';

// SQL query to fetch data based on filters
$query = "SELECT 10_data_siswa.nis, 10_data_siswa.nama_siswa, 10_data_siswa.kelas, 10_data_siswa.jurusan, 10_tagihan.sisa_bayar, 10_tagihan.bulan 
          FROM 10_tagihan
          INNER JOIN 10_data_siswa ON 10_tagihan.nis = 10_data_siswa.nis
          WHERE 1=1";
if ($selected_name) {
    $query .= " AND 10_data_siswa.nama_siswa LIKE '%" . $db->real_escape_string($selected_name) . "%'";
}
if ($selected_class) {
    $query .= " AND 10_data_siswa.kelas = '$selected_class'";
}
if ($selected_major) {
    $query .= " AND 10_data_siswa.jurusan = '$selected_major'";
}
$query .= " ORDER BY 10_data_siswa.nama_siswa ASC";

// Execute SQL query
$result = $db->query($query);

// Output CSV headers
$output = fopen('php://output', 'w');
fputcsv($output, ['NIS', 'Nama Siswa', 'Kelas', 'Jurusan', 'Sisa Bayar', 'Bulan']);

// Output CSV rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['nis'], $row['nama_siswa'], $row['kelas'], $row['jurusan'], $row['sisa_bayar'], $row['bulan']]);
    }
} else {
    fputcsv($output, ['Tidak ada data.']);
}

fclose($output);
$db->close();
exit();
?>
