<?php
include 'config.php';

if (!isset($_GET['number'])) {
    echo "<script>alert('Invalid request.'); window.location.href = '/Attendance-Monitoring-System/attendance.php';</script>";
    exit;
}

$number = intval($_GET['number']);

date_default_timezone_set('Asia/Manila');
$time_out_now = date("Y-m-d H:i:s");

$stmt = mysqli_prepare($conn, "SELECT status, time_out FROM attendance_logs WHERE number = ?");
    if (!$stmt) {
        echo "Prepare failed: " . mysqli_error($conn);
    exit;
    }
        mysqli_stmt_bind_param($stmt, "i", $number);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $current_status, $time_out_db);
        $got = mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

    if (!$got) {
        echo "<script>alert('Record not found.'); window.location.href = '/Attendance-Monitoring-System/attendance.php';</script>";
    exit;
    }

    $time_out_db = $time_out_db === null ? '' : trim((string)$time_out_db);

    if ($time_out_db !== '' && $time_out_db !== "00:00:00") {
        echo "<script>alert('You have already timed out!'); window.location.href = '/Attendance-Monitoring-System/attendance.php';</script>";
    exit;
    }

    if (is_null($current_status)) {
        $current_status = "";
    }
    if (strpos($current_status, "TIMED OUT") === false) {
        $new_status = trim($current_status) === "" ? "TIMED OUT" : $current_status . "; TIMED OUT";
    } else {
        $new_status = $current_status;
    }

$upd = mysqli_prepare($conn, "UPDATE attendance_logs SET time_out = ?, status = ? WHERE number = ?");
if (!$upd) {
    echo "Prepare failed: " . mysqli_error($conn);
    exit;
}
mysqli_stmt_bind_param($upd, "ssi", $time_out_now, $new_status, $number);
$exec = mysqli_stmt_execute($upd);
$affected = mysqli_stmt_affected_rows($upd);
mysqli_stmt_close($upd);

if ($exec && $affected >= 0) {
    echo "<script>
            alert('Time Out recorded successfully!');
            window.location.href = '/Attendance-Monitoring-System/attendance.php';
          </script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>