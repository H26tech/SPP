<?php
session_start();

if (!isset($_SESSION['NIS'])) {
    header("Location: ../../index.php");
    exit();
}

include("../connect.php");
$nis = $_SESSION['NIS'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>siswa</title>
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
    <div class="appHeader bg-primary text-light">
        <h1 style="color:white;">APLIKASI SPP</h1>
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <!-- * Balance -->
                </div>
                <div class="wallet-footer">
                    <div class="item">
                        <a href="dataspp.php">
                            <div class="icon-wrapper bg-info">
                                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                            </div>
                            <strong>Data SPP</strong>
                        </a>
                    </div>

                    <div class="item">
                        <a href="history.php">
                            <div class="icon-wrapper bg-info">
                                <ion-icon name="school" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                            </div>
                            <strong>Riwayat pembayaran</strong>
                        </a>
                    </div>
                    <?php include "inc/logout.php"; ?>

                </div>

            </div>
        </div>
        <!-- Wallet Card -->

        <!-- * App Capsule -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tahun</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" class="text-end">Sisa Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("../../connect.php");
                    $query = "SELECT YEAR(tstamp) AS tahun, bulan, keterangan, sisa_bayar FROM 10_tagihan WHERE NIS = ? ORDER BY tstamp DESC LIMIT 4";
                    $stmt = $db->prepare($query);
                    $stmt->bind_param("s", $nis);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row['tahun'] . "</th>";
                            echo "<td>" . $row['bulan'] . "</td>";
                            echo "<td>" . $row['keterangan'] . "</td>";
                            echo "<td class='text-end text-primary'>Rp " . number_format($row['sisa_bayar'], 0, ',', '.') . "</td>";
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

        <br />
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">INFORMASI</h2>
            </div>
            <div class="transactions">
                <!-- Jumlah -->
                <div class="section">
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="title">Nama</div>
                                <div class="value text-black">
                                    <?php
                                    include("../connect.php");

                                    // Check if the session contains the NIS
                                    if (isset($_SESSION['NIS'])) {
                                        $NIS = $_SESSION['NIS'];

                                        // Prepare and execute the query to fetch the student's name
                                        $query = "SELECT nama_siswa FROM 10_data_siswa WHERE NIS = ?";
                                        $stmt = $db->prepare($query);
                                        $stmt->bind_param("s", $NIS);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo $row['nama_siswa'];
                                        } else {
                                            echo "Nama tidak ditemukan.";
                                        }

                                        $stmt->close();
                                    } else {
                                        echo "NIS tidak ditemukan dalam sesi.";
                                    }

                                    $db->close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-box">
                                <div class="title">Kelas</div>
                                <div class="value text-black">
                                    <?php
                                    include("../connect.php");

                                    // Check if the session contains the NIS
                                    if (isset($_SESSION['NIS'])) {
                                        $NIS = $_SESSION['NIS'];

                                        // Prepare and execute the query to fetch the student's class
                                        $query = "SELECT kelas FROM 10_data_siswa WHERE NIS = ?";
                                        $stmt = $db->prepare($query);
                                        $stmt->bind_param("s", $NIS);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo $row['kelas'];
                                        } else {
                                            echo "Kelas tidak ditemukan.";
                                        }

                                        $stmt->close();
                                    } else {
                                        echo "Kelas tidak ditemukan dalam sesi.";
                                    }

                                    $db->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--* Jumlah -->
                    <!-- Jumlah -->
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="title">Jurusan</div>
                                <div class="value text-black">
                                    <?php
                                    include("../connect.php");

                                    // Check if the session contains the NIS
                                    if (isset($_SESSION['NIS'])) {
                                        $NIS = $_SESSION['NIS'];

                                        // Prepare and execute the query to fetch the student's major
                                        $query = "SELECT jurusan FROM 10_data_siswa WHERE NIS = ?";
                                        $stmt = $db->prepare($query);
                                        $stmt->bind_param("s", $NIS);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo $row['jurusan'];
                                        } else {
                                            echo "Jurusan tidak ditemukan.";
                                        }

                                        $stmt->close();
                                    } else {
                                        echo "Jurusan tidak ditemukan dalam sesi.";
                                    }

                                    $db->close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-box">
                                <div class="title">NIS</div>
                                <div class="value text-black">
                                    <?php
                                    include("../connect.php");

                                    // Check if the session contains the NIS
                                    if (isset($_SESSION['NIS'])) {
                                        $NIS = $_SESSION['NIS'];

                                        // Prepare and execute the query to fetch the student's NIS
                                        $query = "SELECT NIS FROM 10_data_siswa WHERE NIS = ?";
                                        $stmt = $db->prepare($query);
                                        $stmt->bind_param("s", $NIS);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo $row['NIS'];
                                        } else {
                                            echo "NIS tidak ditemukan.";
                                        }

                                        $stmt->close();
                                    } else {
                                        echo "NIS tidak ditemukan dalam sesi.";
                                    }

                                    $db->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!--* Jumlah -->

                    </div>
                </div>

            </div>
            <div class="section">
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="title">Lunas</div>
                            <div class="value text-success">
                                <?php
                                include("../../connect.php");
                                $nis = $_SESSION['NIS'];
                                $query = "SELECT COUNT(*) AS tl FROM 10_tagihan WHERE keterangan = 'Lunas' AND NIS = ?";
                                $stmt = $db->prepare($query);
                                $stmt->bind_param("s", $nis);
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($tl);
                                $stmt->fetch();
                                echo $tl;
                                $stmt->close();
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="stat-box">
                            <div class="title">Belum Lunas</div>
                            <div class="value text-danger">
                                <?php
                                include("../../connect.php");
                                $query = "SELECT COUNT(*) AS tl FROM 10_tagihan WHERE keterangan = 'Belum Lunas' AND NIS = ?";
                                $stmt = $db->prepare($query);
                                $stmt->bind_param("s", $nis);
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($tl);
                                $stmt->fetch();
                                echo $tl;
                                $stmt->close();
                                $db->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- App Bottom Menu -->
        <div class="appBottomMenu">
            <a href="index.php" class="item active">
                <div class="col">
                    <ion-icon name="pie-chart-outline"></ion-icon>
                    <strong>Overview</strong>
                </div>
            </a>
            <div class="icon-inner">
            </div>

            <a href="dataspp.php" class="item">
                <div class="col">
                    <ion-icon name="search"></ion-icon>
                    <strong>Search</strong>
                </div>
            </a>

            <a href="app-settings.php" class="item">
                <div class="col">
                    <ion-icon name="settings-outline"></ion-icon>
                    <strong>Settings</strong>
                </div>
            </a>
        </div>
        <!-- * App Bottom Menu -->
        <!-- App Sidebar -->
        <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <!-- menu -->
                        <div class="listview-title mt-1">Menu</div>
                        <ul class="listview flush transparent no-line image-listview">
                            <li>
                                <a href="dataspp.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Data SPP
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="history.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Riwayat Pembayaran
                                    </div>
                                </a>
                            </li>

                        </ul>
                        <!-- * menu -->
                        <!-- others -->
                        <div class="listview-title mt-1">Others</div>
                        <ul class="listview flush transparent no-line image-listview">
                            <li>
                                <a href="app-settings.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="settings-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Settings
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- * others -->

                    </div>
                </div>
            </div>
        </div>
        <!-- * App Sidebar -->

        <!-- iOS Add to Home Action Sheet -->
        <div class="modal inset fade action-sheet ios-add-to-home" id="ios-add-to-home-screen" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add to Home Screen</h5>
                        <a href="#" class="close-button" data-bs-dismiss="modal">
                            <ion-icon name="close"></ion-icon>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content text-center">
                            <div class="mb-1"><img src="assets/img/icon/192x192.png" alt="image" class="imaged w64 mb-2">
                            </div>
                            <div>
                                Install <strong>Finapp</strong> on your iPhone's home screen.
                            </div>
                            <div>
                                Tap <ion-icon name="share-outline"></ion-icon> and Add to homescreen.
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * iOS Add to Home Action Sheet -->

        <!-- Android Add to Home Action Sheet -->
        <div class="modal inset fade action-sheet android-add-to-home" id="android-add-to-home-screen" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add to Home Screen</h5>
                        <a href="#" class="close-button" data-bs-dismiss="modal">
                            <ion-icon name="close"></ion-icon>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content text-center">
                            <div class="mb-1">
                                <img src="assets/img/icon/192x192.png" alt="image" class="imaged w64 mb-2">
                            </div>
                            <div>
                                Install <strong>Finapp</strong> on your Android's home screen.
                            </div>
                            <div>
                                Tap <ion-icon name="ellipsis-vertical"></ion-icon> and Add to homescreen.
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Android Add to Home Action Sheet -->
        <!-- ========= JS Files =========  -->
        <!-- Bootstrap -->
        <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
        <!-- Ionicons -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <!-- Splide -->
        <script src="assets/js/plugins/splide/splide.min.js"></script>
        <!-- Base Js File -->
        <script src="assets/js/base.js"></script>

        <script>
            // Add to Home with 2 seconds delay.
            AddtoHome("2000", "once");
        </script>

</body>

</html>