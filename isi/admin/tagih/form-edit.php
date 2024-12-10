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
    <link rel="manifest" href="../__manifest.json" />
</head>
<body>
    <!-- loader -->
    <?php include "../inc/loader.php"; ?>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="tagihan.php" class="headerButton goBack">
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
                <form action="update.php" method="POST">
                    <?php
                    include('../../connect.php');

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $query = "SELECT 10_tagihan.id, 10_data_siswa.nis, 10_data_siswa.nama_siswa, 10_data_siswa.kelas, 10_data_siswa.jurusan, 10_tagihan.bulan, 10_tagihan.keterangan 
                                  FROM 10_tagihan
                                  INNER JOIN 10_data_siswa ON 10_tagihan.nis = 10_data_siswa.nis
                                  WHERE 10_tagihan.id = $id";
                        $result = $db->query($query);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                    ?>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <p>NIS: <?php echo $row['nis']; ?></p>
                            <p>Nama Siswa: <?php echo $row['nama_siswa']; ?></p>
                            <p>Kelas: <?php echo $row['kelas']; ?></p>
                            <p>Jurusan: <?php echo $row['jurusan']; ?></p>
                            
                            <div class="form-group boxed">
                                <label class="label" for="bulan">Bulan:</label>
                                <select class="form-control custom-select" name="bulan">
                                    <option value="Januari" <?php if ($row['bulan'] == 'Januari') echo 'selected'; ?>>Januari</option>
                                    <option value="Februari" <?php if ($row['bulan'] == 'Februari') echo 'selected'; ?>>Februari</option>
                                    <option value="Maret" <?php if ($row['bulan'] == 'Maret') echo 'selected'; ?>>Maret</option>
                                    <option value="April" <?php if ($row['bulan'] == 'April') echo 'selected'; ?>>April</option>
                                    <option value="Mei" <?php if ($row['bulan'] == 'Mei') echo 'selected'; ?>>Mei</option>
                                    <option value="Juni" <?php if ($row['bulan'] == 'Juni') echo 'selected'; ?>>Juni</option>
                                    <option value="Juli" <?php if ($row['bulan'] == 'Juli') echo 'selected'; ?>>Juli</option>
                                    <option value="Agustus" <?php if ($row['bulan'] == 'Agustus') echo 'selected'; ?>>Agustus</option>
                                    <option value="September" <?php if ($row['bulan'] == 'September') echo 'selected'; ?>>September</option>
                                    <option value="Oktober" <?php if ($row['bulan'] == 'Oktober') echo 'selected'; ?>>Oktober</option>
                                    <option value="November" <?php if ($row['bulan'] == 'November') echo 'selected'; ?>>November</option>
                                    <option value="Desember" <?php if ($row['bulan'] == 'Desember') echo 'selected'; ?>>Desember</option>
                                </select>
                            </div>

                            <div class="form-group boxed">
                                <label class="label" for="keterangan">Keterangan:</label>
                                <select class="form-control custom-select" name="keterangan">
                                    <option value="Lunas" <?php if ($row['keterangan'] == 'Lunas') echo 'selected'; ?>>Lunas</option>
                                    <option value="Belum Lunas" <?php if ($row['keterangan'] == 'Belum Lunas') echo 'selected'; ?>>Belum Lunas</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sisa_bayar">Sisa Bayar:</label>
                                <select name="sisa_bayar" class="form-control">
                                    <?php
                                    $kelas = $row['kelas'];
                                    $query = "SELECT nominal FROM 10_jenis_pembayaran WHERE kelas = '$kelas'";
                                    $result = $db->query($query);

                                    while ($row_nominal = $result->fetch_assoc()) {
                                        echo '<option value="' . $row_nominal['nominal'] . '">' . $row_nominal['nominal'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>

                    <?php
                        } else {
                            echo "Data tagihan tidak ditemukan.";
                        }
                    } else {
                        echo "ID tidak valid.";
                    }

                    // Menutup koneksi database
                    $db->close();
                    ?>
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
                <ion-icon name="apps-outline"></ion-icon>
                <strong>Search</strong>
            </div>
        </a>
        <a href="app-settings.html" class="item">
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
