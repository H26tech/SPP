<?php
include('../../connect.php');

// Periksa apakah parameter nis telah disediakan
if (isset($_GET['nis'])) {
  $nis = $_GET['nis'];

  // Query untuk mengambil riwayat pembayaran berdasarkan nis
  $query = "SELECT * FROM 10_tagihan WHERE nis = ?";
  $stmt = $db->prepare($query);

  if ($stmt) {
    $stmt->bind_param("s", $nis);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cari nama siswa dari tabel 10_data_siswa
    $query_nama_siswa = "SELECT nama_siswa FROM 10_data_siswa WHERE nis = ?";
    $stmt_nama_siswa = $db->prepare($query_nama_siswa);

    if ($stmt_nama_siswa) {
      $stmt_nama_siswa->bind_param("s", $nis);
      $stmt_nama_siswa->execute();
      $result_nama_siswa = $stmt_nama_siswa->get_result();

      if ($result_nama_siswa->num_rows > 0) {
        $row_nama_siswa = $result_nama_siswa->fetch_assoc();
        $nama_siswa = $row_nama_siswa['nama_siswa'];
      } else {
        $nama_siswa = "Nama Siswa Tidak Ditemukan"; // Atur pesan default jika NIS tidak ada di tabel 10_data_siswa
      }
    } else {
      $nama_siswa = "Nama Siswa Tidak Ditemukan"; // Atur pesan default jika terjadi kesalahan dalam kueri
    }

    // Output riwayat pembayaran
    if ($result->num_rows > 0) {
?>
<?php include('inc/sesi.php'); ?>
      <!DOCTYPE html>
      <html lang='en'>

      <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover' />
        <meta name='apple-mobile-web-app-capable' content='yes' />
        <meta name='apple-mobile-web-app-status-bar-style' content='black-translucent' />
        <meta name='theme-color' content='#000000' />
        <title>Riwayat Pembayaran</title>
        <meta name='description' content='Riwayat Pembayaran Siswa' />
        <meta name='keywords' content='riwayat, pembayaran, siswa, nis' />
        <link rel='icon' type='image/png' href='../assets/img/favicon.png' sizes='32x32' />
        <link rel='apple-touch-icon' sizes='180x180' href='../assets/img/icon/192x192.png' />
        <link rel='stylesheet' href='../assets/css/style.css' />
        <link rel='manifest' href='../__manifest.json' />
      </head>

      <body>

        <div class='appHeader'>
          <div class='left'>
            <a href='pembayaran.php' class='headerButton goBack'>
              <ion-icon name='chevron-back-outline'></ion-icon>
            </a>
          </div>
          <div class='pageTitle'>Riwayat Pembayaran</div>
          <div class='right'></div>
        </div>

        <div id='appCapsule'>
          <div class='section mt-2'>
            <div class='section-title'>
              <h1>Riwayat Pembayaran untuk nama: <?php echo $nama_siswa;
                                                  echo "($nis)"; ?></h1>
            </div>
            <div class='card'>
              <div class='table-responsive'>
                <table class='table'>
                  <tr>
                    <th>Bulan</th>
                    <th>Keterangan</th>
                    <th>Sisa Bayar</th>
                    <th>tanggal Pembayaran</th>
                  </tr>

                  <?php
                  while ($row = $result->fetch_assoc()) {
                    $sisa_bayar = floatval($row['sisa_bayar']);
                  ?>

                    <tr>
                      <td><?php echo $row['bulan']; ?></td>
                      <td><?php echo $row['keterangan']; ?></td>
                      <td>Rp <?php echo number_format($sisa_bayar, 0, ',', '.'); ?></td>
                      <td><?php echo $row['tstamp']; ?></td>
                    </tr>
                  <?php } ?>

                </table>
              </div>
            </div>
          </div>
        </div>

        <div class='appBottomMenu'>
          <a href='../' class='item active'>
            <div class='col'>
              <ion-icon name='pie-chart-outline'></ion-icon>
              <strong>Overview</strong>
            </div>
          </a>
          <a href='../pembayaran/pembayaran.php' class='item'>
            <div class='col'>
              <ion-icon name='apps-outline'></ion-icon>
              <strong>Search</strong>
            </div>
          </a>
          <a href='app-settings.html' class='item'>
            <div class='col'>
              <ion-icon name='settings-outline'></ion-icon>
              <strong>Settings</strong>
            </div>
          </a>
        </div>

        <script src='assets/js/lib/bootstrap.bundle.min.js'></script>
        <script type='module' src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
        <script src='assets/js/plugins/splide/splide.min.js'></script>
        <script src='assets/js/base.js'></script>
      </body>

      </html>
<?php
    } else {
      echo "Tidak ada data pembayaran ditemukan untuk NIS: $nis";
    }

    // Bebaskan hasil kueri dan tutup pernyataan
    $stmt->close();
  } else {
    echo "Gagal mempersiapkan pernyataan kueri: " . $db->error;
  }
} else {
  echo "NIS tidak ditemukan dalam parameter.";
}

$db->close();
?>