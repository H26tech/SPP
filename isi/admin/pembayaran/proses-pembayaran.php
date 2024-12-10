<?php
include('../../connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nominal = parseNumericValue($_POST['nominal']);
    $nis = $_POST['nis'];
    $tstamp = date('Y-m-d H:i:s'); // Mengambil timestamp saat ini

    // Validate the input values
    if (!is_numeric($nominal) || empty($nis)) {
        echo "Invalid input data.";
        exit;
    }

    // Begin transaction
    $db->begin_transaction();

    try {
        // Update the sisa bayar in the 10_tagihan table
        $query_update_sisa = "UPDATE 10_tagihan 
                              SET sisa_bayar = CASE 
                                  WHEN (sisa_bayar - ?) < 0 THEN 0
                                  ELSE (sisa_bayar - ?)
                                  END,
                                  tstamp = ?
                              WHERE nis = ? AND keterangan = 'Belum Lunas'";

        $stmt_update_sisa = $db->prepare($query_update_sisa);
        if (!$stmt_update_sisa) {
            throw new Exception("Failed to prepare update statement.");
        }
        $stmt_update_sisa->bind_param("ssss", $nominal, $nominal, $tstamp, $nis);
        if (!$stmt_update_sisa->execute()) {
            throw new Exception("Failed to execute update statement.");
        }

        // Check if sisa_bayar is zero and update keterangan and add new month if needed
        $query_check_sisa = "SELECT bulan, sisa_bayar FROM 10_tagihan WHERE nis = ? ORDER BY tstamp ASC";
        $stmt_check_sisa = $db->prepare($query_check_sisa);
        if (!$stmt_check_sisa) {
            throw new Exception("Failed to prepare check statement.");
        }
        $stmt_check_sisa->bind_param("s", $nis);
        $stmt_check_sisa->execute();
        $stmt_check_sisa->store_result();

        if ($stmt_check_sisa->num_rows > 0) {
            $stmt_check_sisa->bind_result($bulan, $sisa_bayar);
            $all_paid = true; // Assume all are paid initially

            while ($stmt_check_sisa->fetch()) {
                if ($sisa_bayar > 0) {
                    $all_paid = false;
                    // Set keterangan to 'Belum Lunas'
                    $query_update_keterangan = "UPDATE 10_tagihan SET keterangan = 'Belum Lunas' WHERE nis = ? AND bulan = ?";
                    $stmt_update_keterangan = $db->prepare($query_update_keterangan);
                    if (!$stmt_update_keterangan) {
                        throw new Exception("Failed to prepare update statement.");
                    }
                    $stmt_update_keterangan->bind_param("ss", $nis, $bulan);
                    if (!$stmt_update_keterangan->execute()) {
                        throw new Exception("Failed to execute update statement.");
                    }
                } else {
                    // If sisa_bayar is zero, update keterangan to 'Lunas'
                    $query_update_keterangan = "UPDATE 10_tagihan SET keterangan = 'Lunas' WHERE nis = ? AND bulan = ?";
                    $stmt_update_keterangan = $db->prepare($query_update_keterangan);
                    if (!$stmt_update_keterangan) {
                        throw new Exception("Failed to prepare update statement.");
                    }
                    $stmt_update_keterangan->bind_param("ss", $nis, $bulan);
                    if (!$stmt_update_keterangan->execute()) {
                        throw new Exception("Failed to execute update statement.");
                    }
                }
            }

            if ($all_paid) {
                // Check if there is a record for the next month
                $next_month = date('F Y', strtotime("+1 month"));

                $query_check_next_month = "SELECT COUNT(*) FROM 10_tagihan WHERE nis = ? AND bulan = ?";
                $stmt_check_next_month = $db->prepare($query_check_next_month);
                if (!$stmt_check_next_month) {
                    throw new Exception("Failed to prepare check statement.");
                }
                $stmt_check_next_month->bind_param("ss", $nis, $next_month);
                $stmt_check_next_month->execute();
                $stmt_check_next_month->store_result();

                $count = 0;
                $stmt_check_next_month->bind_result($count);
                $stmt_check_next_month->fetch();

                if ($count == 0) {
                    // Insert new month record if not exists
                    $new_nominal = 0; // Set your desired new nominal here
                    $query_insert_next_month = "INSERT INTO 10_tagihan (nis, bulan, nominal, sisa_bayar, keterangan, tstamp) VALUES (?, ?, ?, ?, 'Belum Lunas', ?)";
                    $stmt_insert_next_month = $db->prepare($query_insert_next_month);
                    if (!$stmt_insert_next_month) {
                        throw new Exception("Failed to prepare insert statement.");
                    }
                    $stmt_insert_next_month->bind_param("sssss", $nis, $next_month, $new_nominal, $new_nominal, $tstamp);
                    if (!$stmt_insert_next_month->execute()) {
                        throw new Exception("Failed to execute insert statement.");
                    }
                }
            }
        }

        // Commit transaction
        $db->commit();
        echo "Pembayaran berhasil.";
    } catch (Exception $e) {
        // Rollback transaction on error
        $db->rollback();
        echo "Pembayaran gagal: " . $e->getMessage();
    }

    // Redirect to pembayaran.php
    header("Location: pembayaran.php");
    exit;
} else {
    echo "Invalid request.";
}
$db->close();

// Function to parse text input into a numeric value
function parseNumericValue($input)
{
    // Remove all non-numeric characters except the decimal point
    $numericValue = floatval(preg_replace('/[^\d.]/', '', $input));
    if (is_nan($numericValue)) {
        $numericValue = 0; // Handle invalid values
    }
    return $numericValue;
}
