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
  <link rel="manifest" href="../__manifest.json" />
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
    <div class="pageTitle">Table</div>
    <div class="right"></div>
  </div>
  <!-- * App Header -->

  <!-- App Capsule -->
  <div id="appCapsule">
    <div class="section mt-2">
      <div class="section-title">Filter Data</div>
      <div class="card">
        <form method="POST" action="">
          <div class="row">
            <div class="col">
              <label for="name">Nama</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Nama Siswa" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            <div class="col">
              <label for="class">Kelas</label>
              <select name="class" id="class" class="form-control">
                <option value="">Semua Kelas</option>
                <?php
                // Fetch classes
                $kelas_query = "SELECT * FROM 10_data_kelas";
                $kelas_result = $db->query($kelas_query);
                while ($kelas_row = $kelas_result->fetch_assoc()) {
                  echo "<option value='" . $kelas_row['kelas'] . "' " . (isset($_POST['class']) && $_POST['class'] == $kelas_row['kelas'] ? 'selected' : '') . ">" . $kelas_row['kelas'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="major">Jurusan</label>
              <select name="major" id="major" class="form-control">
                <option value="">Semua Jurusan</option>
                <?php
                // Fetch majors
                $jurusan_query = "SELECT * FROM 10_jurusan";
                $jurusan_result = $db->query($jurusan_query);
                while ($jurusan_row = $jurusan_result->fetch_assoc()) {
                  echo "<option value='" . $jurusan_row['jurusan'] . "' " . (isset($_POST['major']) && $_POST['major'] == $jurusan_row['jurusan'] ? 'selected' : '') . ">" . $jurusan_row['jurusan'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <!-- Download CSV Button -->
    <div class="section mt-2">
      <a href="download_csv.php" class="btn btn-success mt-4">Download CSV</a>
    </div>

    <div class="section mt-2">
      <div class="section-title">Data Tagihan</div>
      <div class="card">
        <div class="table-responsive">
          <table class="table">
            <?php
            // Initialize filter variables
            $selected_name = isset($_POST['name']) ? $_POST['name'] : '';
            $selected_class = isset($_POST['class']) ? $_POST['class'] : '';
            $selected_major = isset($_POST['major']) ? $_POST['major'] : '';

            // SQL query to fetch data based on filters and order by student name
            $query = "SELECT 10_tagihan.id, 10_data_siswa.nama_siswa, 10_jenis_pembayaran.nominal, 10_tagihan.sisa_bayar, 10_tagihan.bulan, 10_tagihan.keterangan 
                      FROM 10_tagihan
                      INNER JOIN 10_data_siswa ON 10_tagihan.nis = 10_data_siswa.nis
                      LEFT JOIN 10_jenis_pembayaran ON 10_data_siswa.kelas = 10_jenis_pembayaran.kelas
                      WHERE 1=1";

            if ($selected_name) {
              $query .= " AND 10_data_siswa.nama_siswa LIKE '%" . $db->real_escape_string($selected_name) . "%'";
            }
            if ($selected_class) {
              $query .= " AND 10_data_siswa.kelas = '$selected_class'";
            }
            if ($selected_major) {
              $query .= " AND 10_data_siswa.jurusan = '$selected_major'";
            }

            $query .= " ORDER BY 10_data_siswa.nama_siswa ASC";

            // Execute SQL query
            $result = $db->query($query);

            $nomor = 1;

            if ($result->num_rows > 0) {
              echo "<thead><tr><th>ID</th><th>Nama Siswa</th><th>Sisa Bayar</th><th>Bulan</th><th>Info</th></tr></thead>";
              echo "<tbody>";
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $nomor . "</td>";
                echo "<td>" . $row['nama_siswa'] . "</td>";
                echo "<td>" . $row['sisa_bayar'] . "</td>";
                echo "<td>" . $row['bulan'] . "</td>";
                echo "<td>";
                echo "<a href='#' class='item' data-bs-toggle='modal' data-bs-target='#actionSheet' data-id='" . $row['id'] . "' data-keterangan='" . $row['keterangan'] . "'>";
                echo "<div class='in'>Info</div>";
                echo "</a>";
                echo "</td>";
                echo "</tr>";
                $nomor++;
              }
              echo "</tbody>";
            } else {
              echo "<tbody><tr><td colspan='5'>Tidak ada data tagihan.</td></tr></tbody>";
            }
            ?>
          </table>

          <!-- Default Action Sheet -->
          <div class="modal fade action-sheet" id="actionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><span id="keteranganModal"></span></h5>
                </div>
                <div class="modal-body">
                  <br />
                  <ul class="action-button-list">
                    <li>
                      <a id='editButton' href='#' class='btn btn-list' data-bs-dismiss='modal'>
                        <span>Edit</span>
                      </a>
                    </li>
                    <li>
                      <a id='deleteButton' href='#' class='btn btn-list' data-bs-dismiss='modal'>
                        <span>Hapus</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="btn btn-list text-danger" data-bs-dismiss="modal">
                        <span>Cancel</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- * Default Action Sheet -->

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              var selectedId;
              var infoLinks = document.querySelectorAll('.item');
              infoLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                  selectedId = link.getAttribute('data-id');
                  var keterangan = link.getAttribute('data-keterangan');
                  document.getElementById('keteranganModal').textContent = keterangan;
                  console.log("Info diklik dengan ID: " + selectedId);
                });
              });

              var editButton = document.querySelector('#editButton');
              editButton.addEventListener('click', function() {
                console.log("Edit diklik dengan ID: " + selectedId);
                window.location.href = 'form-edit.php?id=' + selectedId;
              });

              var deleteButton = document.querySelector('#deleteButton');
              deleteButton.addEventListener('click', function() {
                console.log("Hapus diklik dengan ID: " + selectedId);
                window.location.href = 'hapus.php?id=' + selectedId;
              });
            });
          </script>

          <br />
        </div>
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

  <!-- JS Files -->
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

<?php
// Close database connection
$db->close();
?>
