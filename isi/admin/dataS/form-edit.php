<?php
include("../../connect.php");

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Query untuk mendapatkan data siswa berdasarkan id
    $sql_get_siswa = "SELECT * FROM 10_data_siswa WHERE id = '$id'";
    $result_get_siswa = mysqli_query($db, $sql_get_siswa);

    if (mysqli_num_rows($result_get_siswa) == 1) {
        $siswa = mysqli_fetch_assoc($result_get_siswa);
    } else {
        // Data siswa tidak ditemukan
        header("Location: data_siswa.php");
        exit();
    }
} else {
    // ID tidak diberikan, kembali ke halaman data siswa
    header("Location: data_siswa.php");
    exit();
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int)$_POST['id'];
    $nis = (int)$_POST['NIS'];
    $sql_check_nis = "SELECT id FROM 10_data_siswa WHERE NIS = '$nis' AND id != '$id'";
    $result_check_nis = mysqli_query($db, $sql_check_nis);

    if (mysqli_num_rows($result_check_nis) > 0) {
        $error_message = "NIS sudah terdaftar.";
    } else {
        header("Location: data_siswa.php");
        exit();
    }
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
            <a href="data_siswa.php" class="headerButton goBack">
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
                    <?php if ($error_message) : ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>" />


                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="NIS">NIS:</label>
                            <input type="number" class="form-control" name="NIS" placeholder="NIS" value="<?php echo $siswa['NIS'] ?>" required />
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="nama_siswa">Nama:</label>
                            <input type="text" class="form-control" name="nama_siswa" placeholder="nama siswa" value="<?php echo $siswa['nama_siswa'] ?>" required>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="jurusan">Jurusan:</label>
                            <select class="form-control custom-select" name="jurusan" required>
                                <?php
                                include '../../connect.php';
                                $sql_jurusan = "SELECT * FROM 10_jurusan";
                                $query_jurusan = mysqli_query($db, $sql_jurusan);

                                while ($jur = mysqli_fetch_assoc($query_jurusan)) {
                                    $selected = ($jur['jurusan'] == $siswa['jurusan']) ? 'selected' : ''; // Ini akan memeriksa apakah jurusan saat ini adalah jurusan siswa yang sedang diedit
                                    echo "<option value='{$jur['jurusan']}' $selected>{$jur['jurusan']}</option>";
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
                            <label class="label" for="password">Password:</label>
                            <input type="text" class="form-control" name="password" placeholder="Password" value="<?php echo $siswa['password'] ?>" required />
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