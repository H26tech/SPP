<?php
include('connect.php');

// Mulai session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Periksa tabel users untuk login admin
    $stmt = $db->prepare("SELECT id FROM 10_users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $_SESSION["username"] = $username;
        $_SESSION["role"] = 'admin';
        header("Location: isi/admin/index.php");
        exit();
    } else {
        // Jika tidak ditemukan di tabel users, periksa tabel 10_data_siswa untuk login siswa
        $stmt->close();
        $stmt = $db->prepare("SELECT NIS FROM 10_data_siswa WHERE NIS = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["NIS"] = $username; // Menyimpan NIS dalam sesi
            $_SESSION["role"] = 'siswa';
            // Buat cookie unik untuk setiap sesi siswa
            setcookie("user_session", session_id(), time() + (86400 * 30), "/"); // 86400 = 1 hari
            header("Location: isi/siswa/index.php");
            exit();
        } else {
            $loginError = "Username atau password tidak valid";
        }
    }

    $stmt->close();
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Login</title>
    <link rel="stylesheet" href="isi/assets/css/style.css">
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="isi/admin/assets/img/loading.png" alt="icon" class="loading-icon" />
    </div>
    <!-- * loader -->

    <!-- App Header -->

    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>APP SPP</h1>
            <h4>Isi Username dan Password untuk login</h4>
        </div>
        <div class="section mb-5 p-2">
            <?php if (isset($loginError)) {
                echo "<p>$loginError</p>";
            } ?>
            <form action="" method="post">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="username">Username (NIS)</label>
                                <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="NIS">
                                <i class="clear-input">
                                    <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Kata sandi">
                                <i class="clear-input">
                                    <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-button-group transparent">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                </div>

            </form>
        </div>

    </div>
    <!-- * App Capsule -->

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="isi/assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="isi/assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="isi/assets/js/base.js"></script>

</body>

</html>