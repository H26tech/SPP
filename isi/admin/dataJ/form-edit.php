<?php
include("../../connect.php");

// Kalau tidak ada id di query string
if (!isset($_GET['id'])) {
    header('Location: jurusan.php');
    exit();
}

// Ambil id dari query string
$id = $_GET['id'];

// Buat query untuk ambil data dari database
$sql = "SELECT * FROM 10_jurusan WHERE id=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

// Jika data yang di-edit tidak ditemukan
if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}
?>
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
            <a href="jurusan.php" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Edit</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div class="section mt-2 mb-2">
        <div class="section-title">Edit</div>
        <div class="card">
            <div class="card-body">
                <form action="edit.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>" />

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="jurusan">jurusan:</label>
                            <input type="text" class="form-control" name="jurusan" placeholder="edit Jurusan" value="<?php echo $siswa['jurusan']; ?>" />
                        </div>
                    </div>

                    <button type="submit" value="Simpan" name="simpan" class="btn btn-primary btn-block">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->

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