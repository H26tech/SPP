<?php



$server = "localhost";

$user = "u993542331_adxuser";

$pass = "BMXRider123";

$database = "u993542331_digital";



$db = mysqli_connect($server, $user, $pass, $database);



if (!$db) {

    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
