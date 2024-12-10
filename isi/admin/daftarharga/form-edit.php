<?php



include("../../connect.php");



// kalau tidak ada id di query string

if (!isset($_GET['id'])) {

    header('Location: dh.php');

}



//ambil id dari query string

$id = $_GET['id'];



// buat query untuk ambil data dari database

$sql = "SELECT * FROM 10_jenis_pembayaran WHERE id=$id";

$query = mysqli_query($db, $sql);

$siswa = mysqli_fetch_assoc($query);



// jika data yang di-edit tidak ditemukan

if (mysqli_num_rows($query) < 1) {

    die("data tidak ditemukan...");

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

            <a href="dh.php" class="headerButton goBack">

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

                            <label class="label" for="tapel">Tahun Pelajaran:</label>

                            <select class="form-control custom-select" name="tapel" required>

                                <?php

                                $sql_tapel = "SELECT * FROM 10_tahun_ajaran";

                                $query_tapel = mysqli_query($db, $sql_tapel);



                                while ($tp = mysqli_fetch_assoc($query_tapel)) {

                                    $selected = ($tp['tapel'] == $siswa['tapel']) ? 'selected' : '';

                                    echo "<option value='{$tp['tapel']}' $selected>{$tp['tapel']}</option>";

                                }

                                ?>

                            </select>

                        </div>

                    </div>



                    <div class="form-group boxed">

                        <div class="input-wrapper">

                            <label class="label" for="kelas">Kelas:</label>

                            <select class="form-control custom-select" name="kelas" required>

                                <?php

                                $sql_kelas = "SELECT * FROM 10_data_kelas";

                                $query_kelas = mysqli_query($db, $sql_kelas);



                                while ($kel = mysqli_fetch_assoc($query_kelas)) {

                                    $selected = ($kel['kelas'] == $siswa['kelas']) ? 'selected' : '';

                                    echo "<option value='{$kel['kelas']}' $selected>{$kel['kelas']}</option>";

                                }

                                ?>

                            </select>

                        </div>

                    </div>



                    <div class="form-group boxed">

                        <div class="input-wrapper">

                            <label class="label" for="nominal">Nominal:</label>

                            <input type="number" class="form-control" name="nominal" placeholder="Nominal" value="<?php echo $siswa['nominal'] ?>" />

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