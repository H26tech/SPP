<?php include('inc/sesi.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title><?php include     "inc/title.php"; ?></title>
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
                        <a href="dataS/data_siswa.php">
                            <div class="icon-wrapper bg-info">
                                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                            </div>
                            <strong>Data Siswa</strong>
                        </a>
                    </div>

                    <div class="item">
                        <a href="dataK/data_kelas.php">
                            <div class="icon-wrapper bg-info">
                                <ion-icon name="school" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                            </div>
                            <strong>Data Kelas</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="dataJ/jurusan.php">
                            <div class="icon-wrapper bg-wrapper">
                                <ion-icon name="book-outline" role="img" class="md hydrated" aria-label="card outline"></ion-icon>
                            </div>
                            <strong>Jurusan</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="pembayaran/pembayaran.php">
                            <div class="icon-wrapper bg-warning">
                                <ion-icon name="wallet" role="img" class="md hydrated" aria-label="swap vertical"></ion-icon>
                            </div>
                            <strong>Pembayaran</strong>
                        </a>
                    </div>

                </div>
                <!-- * Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="dataT/tahun_ajaran.php">
                            <div class="icon-wrapper bg-wrapper">
                                <ion-icon name="calendar" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                            </div>
                            <strong>Tahun Ajaran</strong>
                            </=>
                    </div>
                    <div class="item">
                        <a href="daftarharga/dh.php">
                            <div class="icon-wrapper bg-success">
                                <ion-icon name="calculator" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                            </div>
                            <strong>Daftar Harga</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="tagih/tagihan.php">
                            <div class="icon-wrapper bg-danger">
                                <ion-icon name="book-outline" role="img" class="md hydrated" aria-label="card outline"></ion-icon>
                            </div>
                            <strong>Tagihan</strong>
                        </a>
                    </div>
                    <?php include "inc/logout.php"; ?>



                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->

        <!-- * Transactions -->
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
                                <div class="title"> Siswa</div>
                                <div class="value text-black">
                                    <?php
                                    include("../../connect.php");

                                    $query = "SELECT COUNT(nama_siswa) AS total_siswa FROM 10_data_siswa";
                                    $result = $db->query($query);

                                    if ($result->num_rows > 0) {

                                        $row = $result->fetch_assoc();
                                        $ts = $row["total_siswa"];


                                        echo   $ts;
                                    } else {
                                        echo "Tidak ada data siswa.";
                                    }
                                    $db->close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-box">
                                <div class="title"> Kelas</div>
                                <div class="value text-black">
                                    <?php
                                    include("../../connect.php");

                                    $query = "SELECT COUNT(kelas) AS total_kelas FROM 10_data_kelas";
                                    $result = $db->query($query);

                                    if ($result->num_rows > 0) {

                                        $row = $result->fetch_assoc();
                                        $tk = $row["total_kelas"];


                                        echo   $tk;
                                    } else {
                                        echo "Tidak ada data kelas.";
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
                                <div class="title"> Jurusan</div>
                                <div class="value text-black">
                                    <?php
                                    include("../../connect.php");

                                    $query = "SELECT COUNT(Jurusan) AS total_jur FROM 10_jurusan";
                                    $result = $db->query($query);

                                    if ($result->num_rows > 0) {

                                        $row = $result->fetch_assoc();
                                        $tj = $row["total_jur"];


                                        echo   $tj;
                                    } else {
                                        echo "Tidak ada data Jurusan.";
                                    }
                                    $db->close();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-box">
                                <div class="title"> Tahun ajaran</div>
                                <div class="value text-black">
                                    <?php
                                    include("../../connect.php");

                                    // Query SQL untuk menghitung jumlah baris di mana keterangan = 'belum lunas'
                                    $query = "SELECT COUNT(tapel) AS tpj FROM 10_tahun_ajaran";
                                    $result = $db->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $tpj = $row["tpj"];
                                        echo $tpj;
                                    } else {
                                        echo "Tidak ada data Tahun.";
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
                <a href="hijau.php" class="stat-box-link">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="title">Lunas</div>
                            <div class="value text-success">
                                <?php
                                include("../../connect.php");

                                $query = "SELECT COUNT(*) AS tl FROM 10_tagihan where keterangan = 'Lunas'";
                                $result = $db->query($query);

                                if ($result->num_rows > 0) {

                                    $row = $result->fetch_assoc();
                                    $tl = $row["tl"];


                                    echo   $tl;
                                } else {
                                    echo 0;
                                }
                                $db->close();
                                ?>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-6 ">
                        <a href="merah.php" class="stat-box-link">
                            <div class="stat-box">
                                <div class="title">Belum Lunas</div>
                                <div class="value text-danger">
                                    <?php
                                    include("../../connect.php");

                                    $query = "SELECT COUNT(*) AS tbl FROM 10_tagihan WHERE keterangan = 'belum lunas'";
                                    $result = $db->query($query);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $tbl = $row["tbl"];
                                        echo $tbl;
                                    } else {
                                        echo "Tidak ada data belum lunas.";
                                    }

                                    $db->close();
                                    ?>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
            </div>
        </div>
        <!-- * App Capsule -->


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

            <a href="pembayaran/pembayaran.php" class="item">
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
                                <a href="dataS/data_siswa.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Data Siswa

                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="dataK/data_kelas.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Data Kelas
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="dataJ/jurusan.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Jurusan
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="dataT/tahun_ajaran.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Tahun ajaran
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="daftarharga/dh.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Daftar harga
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="pembayaran/pembayaran.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="card-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Pembayaran
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="tagih/tagihan.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Tagihan
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
                            <!-- <li>
                            <a href="component-messages.html" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Support
                                </div>
                            </a>
                        </li> -->
                            <li>
                                <a href="logout.php" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="log-out-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Log out
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