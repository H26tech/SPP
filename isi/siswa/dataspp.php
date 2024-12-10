<?php include('inc/sesi.php'); ?>
<?php
if (!isset($_SESSION['NIS'])) {
    header("Location: ../../index.php");
    exit();
}

include("../connect.php");
$nis = $_SESSION['NIS'];
$search = ""; // Variabel untuk menyimpan input pencarian
$query = "SELECT YEAR(tstamp) AS tahun, bulan, keterangan, sisa_bayar FROM 10_tagihan WHERE NIS = ?";

// Fungsi untuk format Rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Cek apakah ada input pencarian
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $query .= " AND (YEAR(tstamp) LIKE ? OR bulan LIKE ?)"; // Tambahkan kondisi pencarian berdasarkan bulan atau tahun
}

$stmt = $db->prepare($query);

if (!empty($search)) {
    $search_param = "%{$search}%";
    $stmt->bind_param("sss", $nis, $search_param, $search_param); // Sesuaikan parameter query
} else {
    $stmt->bind_param("s", $nis); // Jika tidak ada pencarian, gunakan hanya NIS
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!doctype html>
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
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="manifest" href="__manifest.json">
</head>

<body>

    <!-- loader -->
    <?php include "inc/loader2.php"; ?>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            DATA SPP
        </div>
    </div>
    <!-- * App Header -->
    <div class="extraHeader">
        <form class="search-form" method="POST">
            <div class="form-group searchbox">
                <input type="text" class="form-control" placeholder="Masukkan Bulan, atau Tahun" autocomplete="off" name="search" fdprocessedid="0ffhq" value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>">
                <i class="input-icon icon ion-ios-search"></i>
            </div>
        </form>
    </div>
    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tahun</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">keterangan</th>
                        <th scope="col" class="text-end">sisa bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . htmlspecialchars($row['tahun'], ENT_QUOTES, 'UTF-8') . "</th>";
                            echo "<td>" . htmlspecialchars($row['bulan'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($row['keterangan'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td class='text-end text-primary'>" . htmlspecialchars(formatRupiah($row['sisa_bayar']), ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>Tidak ada data</td></tr>";
                    }

                    $stmt->close();
                    $db->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="index.php" class="item ">
            <div class="col">
                <ion-icon name="pie-chart-outline"></ion-icon>
                <strong>Overview</strong>
            </div>
        </a>
        <a href="dataspp.php" class="item active">
            <div class="col">
                <ion-icon name="search"></ion-icon>
                <strong>Search</strong>
            </div>
        </a>

        <a href="app-settings.php" class="item ">
            <div class="col">
                <ion-icon name="settings-outline"></ion-icon>
                <strong>Settings</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="assets/js/base.js"></script>

</body>

</html>
