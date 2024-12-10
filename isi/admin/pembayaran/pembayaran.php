<?php
include('../../connect.php');

// Inisialisasi variabel pencarian
$search = "";

// Cek apakah ada input pencarian yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
}

// Ubah query SQL Anda untuk mengambil 'nominal' dari tabel 'jenis_pembayaran'
$query = "SELECT 10_data_siswa.id, 10_data_siswa.nis, 10_data_siswa.nama_siswa, 10_data_siswa.kelas, 10_data_siswa.jurusan, 10_jenis_pembayaran.nominal
FROM 10_data_siswa
LEFT JOIN 10_jenis_pembayaran ON 10_data_siswa.kelas = 10_jenis_pembayaran.kelas
WHERE (10_data_siswa.nama_siswa LIKE ? OR 10_data_siswa.kelas LIKE ? OR 10_data_siswa.jurusan LIKE ? OR 10_data_siswa.nis LIKE ?)";

// Menjalankan kueri SQL dengan parameter pencarian
$stmt = $db->prepare($query);
$searchParam = "%" . $search . "%";
$stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();

$nomor = 1; // Inisialisasi variabel nomor di luar perulangan
?>

<?php include('../inc/sesi.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Finapp</title>
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/icon/192x192.png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="manifest" href="../__manifest.json">
</head>

<body>

    <?php include "../inc/loader.php"; ?>

    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="../" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- Extra Header -->
    <div class="extraHeader">
        <form class="search-form" method="POST">
            <div class="form-group searchbox">
                <input type="text" class="form-control" placeholder="Masukkan Nama Siswa, Kelas, Jurusan, atau NIS" autocomplete="off" name="search">
                <i class="input-icon icon ion-ios-search"></i>
                <ion-icon name="search-outline"></ion-icon>
            </div>
        </form>
    </div>
    <!-- * Extra Header -->

    <!-- App Capsule -->
    <div id="appCapsule" class="extra-header-active full-height">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Sisa bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Query untuk mendapatkan keterangan dan bulan dari tabel tagihan
                                $query_tagihan = "SELECT keterangan, bulan, sisa_bayar FROM 10_tagihan WHERE nis = ? ORDER BY tstamp DESC LIMIT 1";
                                $stmt_tagihan = $db->prepare($query_tagihan);
                                $stmt_tagihan->bind_param("s", $row['nis']);
                                $stmt_tagihan->execute();
                                $result_tagihan = $stmt_tagihan->get_result();

                                // Inisialisasi variabel untuk keterangan, bulan, dan sisa_bayar
                                $keterangan = "Belum Lunas";
                                $bulan = "-";
                                $sisa_bayar = 0;

                                if ($result_tagihan->num_rows > 0) {
                                    $row_tagihan = $result_tagihan->fetch_assoc();
                                    $keterangan = $row_tagihan['keterangan'];
                                    $bulan = $row_tagihan['bulan'];
                                    $sisa_bayar = $row_tagihan['sisa_bayar'];
                                }

                                // Menghitung sisa nominal
                                $nis = $row['nis'];
                                echo "<tr>";
                                echo "<td>" . $nomor . "</td>";
                                echo "<td>" . $row['nama_siswa'] . "</td>";
                                echo "<td>" . $row['kelas'] . " " . $row['jurusan'] . "</td>";

                                if ($sisa_bayar == 0) {
                                    echo "<td> sudah lunas </td>";
                                } else {
                                    echo "<td>Rp " . number_format((float)$sisa_bayar, 0, ',', '.') . "</td>";
                                }
                                echo "<td>";
                                echo "<a href='#' class='item' data-bs-toggle='modal' data-bs-target='#actionSheetForm$nis' data-nis='" . $row['nis'] . "' data-bulan='" . $bulan . "' data-keterangan='" . $keterangan . "'>";
                                echo "<div class='in'>Bayar</div>";
                                echo "</a>";
                                echo "<a href='history-pembayaran.php?nis=" . $row['nis'] . "'>Riwayat</a>";
                                echo "</td>";
                                echo "</tr>";

                                $nomor++;
                        ?>
                                <!-- Form Action Sheet -->
                                <div class="modal fade action-sheet" id="actionSheetForm<?php echo $nis; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pembayaran</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="action-sheet-content">
                                                    <p>Sisa Bayar : <?php echo "Rp." . number_format((float)$sisa_bayar, 0, ',', '.') ?></p>
                                                    <p id="bulanModal<?php echo $nis; ?>">Bulan: <?php echo $bulan ?></p>
                                                    <p id="keteranganModal<?php echo $nis; ?>">Keterangan: <?php echo $keterangan ?> </p>
                                                    <p id="kembalian<?php echo $nis; ?>">Kembalian: Rp. 0</p> <!-- Menambahkan elemen kembalian -->
                                                    <form method="post" action="proses-pembayaran.php" onsubmit="return prepareForm(this, '<?php echo $nis; ?>');">
                                                        <input type="hidden" name="sisnom" value="<?php echo (float)$sisa_bayar; ?>">
                                                        <div class="form-group basic">
                                                            <label class="label">Masukkan nominal</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="nominal<?php echo $nis; ?>" name="nominal" required oninput="addThousandSeparator(this); calculateKembalian(this, <?php echo $sisa_bayar; ?>, '<?php echo $nis; ?>');">
                                                                <input type="hidden" name="nis" value="<?php echo $nis; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group basic">
                                                            <button type="submit" class="btn btn-primary btn-block btn-lg" data-bs-dismiss="modal">Bayar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    // Menambahkan ribuan separator pada input nominal
                                    function addThousandSeparator(input) {
                                        var value = input.value.replace(/\D/g, '');
                                        input.value = new Intl.NumberFormat('id-ID').format(value);
                                    }

                                    // Menghitung kembalian berdasarkan input nominal
                                    function calculateKembalian(input, sisaBayar, nis) {
                                        var nominal = parseInt(input.value.replace(/\D/g, '')) || 0;
                                        var kembalian = nominal - sisaBayar;
                                        if (kembalian < 0) {
                                            kembalian = 0;
                                        }
                                        document.getElementById('kembalian' + nis).textContent = 'Kembalian: Rp. ' + new Intl.NumberFormat('id-ID').format(kembalian);
                                    }

                                    // Menghapus separator ribuan sebelum pengiriman formulir
                                    function prepareForm(form, nis) {
                                        var nominalInput = document.getElementById('nominal' + nis);
                                        nominalInput.value = nominalInput.value.replace(/\D/g, ''); // Menghapus semua non-digit (separator ribuan)
                                        return true; // Lanjutkan pengiriman formulir
                                    }
                                </script>
                                <!-- * Form Action Sheet -->
                        <?php }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada hasil pencarian.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->

    <!-- App Bottom Menu -->
    <?php include "../inc/btmenu.php"; ?>
    <!-- * App Bottom Menu -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memperbarui keterangan dan bulan di modal
            function updateModalContent(nis, sisnom) {
                $.ajax({
                    type: 'GET',
                    url: 'get-tagihan.php',
                    data: {
                        nis: nis
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#keteranganModal').text('Keterangan: ' + data.keterangan);
                        $('#bulanModal').text('Bulan: ' + data.bulan);

                        // Set the hidden input values
                        $('#nominalInput').val(sisnom);
                        $('#sisnomInput').val(sisnom);
                        $('#nisInput').val(nis);
                    },
                    error: function() {
                        // Penanganan kesalahan jika terjadi
                        $('#keteranganModal').text('Keterangan: Belum Lunas');
                        $('#bulanModal').text('Bulan: -');

                        // Reset the hidden input values
                        $('#nominalInput').val('');
                        $('#sisnomInput').val('');
                        $('#nisInput').val('');
                    }
                });
            }

            // Menampilkan modal saat item diklik
            $('.item').on('click', function() {
                var nis = $(this).data('nis');
                var sisnom = $(this).data('sisnom'); // Add this line to get sisnom
                updateModalContent(nis, sisnom);
            });

            // Menampilkan modal saat modal ditampilkan
            $('#actionSheetForm').on('show.bs.modal', function(e) {
                var nis = $(e.relatedTarget).data('nis');
                var sisnom = $(e.relatedTarget).data('sisnom'); // Add this line to get sisnom
                updateModalContent(nis, sisnom);
            });
        });
    </script>

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="../assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="../assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="../assets/js/base.js"></script>
</body>

</html>