<?php include("../../connect.php"); ?>
<?php include('../inc/sesi.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="theme-color" content="#000000" />
  <title>Finapp</title>
  <meta name="description" content="Finapp HTML Mobile Template" />
  <meta name="keywords" content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" sizes="32x32" />
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/icon/192x192.png" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="manifest" href="__manifest.json" />
</head>

<body>

  <!-- loader -->
  <?php include "../inc/loader.php"; ?>
  <!-- * loader -->
  <!-- App Header -->
  <div class="appHeader">
    <div class="left">
      <a href="../" class="headerButton goBack">
        <ion-icon name="chevron-back-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">Table</div>
    <div class="right"></div>
  </div>
  <!-- * App Header -->
  <!-- App Capsule -->
  <div id="appCapsule">
    <div class="section mt-2">
      <div class="section-title">Data Siswa</div>
      <?php include '../inc/tambah.php'; ?>
      <div class="card">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <!-- <th>NIS</th> -->
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM 10_data_siswa";
              $query = mysqli_query($db, $sql);

              $nomor = 1; // Inisialisasi nomor

              while ($siswa = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $nomor . "</td>"; // Menggunakan variabel nomor
                echo "<td>" . $siswa['nama_siswa'] . "</td>";
                echo "<td>" . $siswa['kelas'] .  " " . $siswa['jurusan'] . "</td>";
                echo "<td>";
                include "../inc/edithapus.php";
                echo "</td>";

                echo "</tr>";

                $nomor++; // Inkrementasi nomor
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>



    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
      <a href="../" class="item active">
        <div class="col">
          <ion-icon name="pie-chart-outline"></ion-icon>
          <strong>Overview</strong>
        </div>
      </a>
      <a href="../pembayaran/pembayaran.php" class="item">
        <div class="col">
          <ion-icon name="search"></ion-icon>
          <strong>Search</strong>
        </div>
      </a>

      <a href="../app-settings.php" class="item">
        <div class="col">
          <ion-icon name="settings-outline"></ion-icon>
          <strong>Settings</strong>
        </div>
      </a>
    </div>
    <!-- * App Bottom Menu -->

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