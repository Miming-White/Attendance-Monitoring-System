<?php
include 'config.php';

if (isset($_GET['number'])) {

    $number = $_GET['number'];

    date_default_timezone_set('Asia/Manila');
    $time_out = date("Y-m-d H:i:s");

    $get_status = mysqli_query($conn, 
        "SELECT status, time_out FROM attendance_logs WHERE number = '$number'"
    );
    $row = mysqli_fetch_assoc($get_status);

    if (!empty($row['time_out'])) {
        echo "<script>
                alert('You have already timed out!');
                window.location.href = '/final/index.php';
              </script>";
        exit;
    }

    $current_status = $row['status'];
    if (strpos($current_status, "TIMED OUT") === false) {
        $new_status = $current_status . "; TIMED OUT";
    } else {
        $new_status = $current_status;
    }

    $sql = "UPDATE attendance_logs 
            SET time_out = '$time_out',
                status = '$new_status'
            WHERE number = '$number'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Time Out recorded successfully!');
                window.location.href = '/final/index.php';
              </script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
