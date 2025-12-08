<?php
include 'config.php';

//copy all records to the history table
$archive_sql = "INSERT INTO archives (id, name, log_datetime, time_out, status)
                SELECT id, name, log_datetime, time_out, status
                FROM attendance_logs";

if (mysqli_query($conn, $archive_sql)) {
    //clear the attendance_logs table
    $truncate_sql = "TRUNCATE TABLE attendance_logs";

    if (mysqli_query($conn, $truncate_sql)) {
        echo "
        <script>
            alert('Attendance records have been archived and cleared successfully!');
            window.location.href = '/Attendance-Monitoring-System/index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error clearing attendance logs after archiving.');
            window.location.href = '/Attendance-Monitoring-System/index.php';
        </script>";
    }
} else {
    echo "
    <script>
        alert('Error archiving attendance records.');
        window.location.href = '/Attendance-Monitoring-System/index.php';
    </script>";
}

mysqli_close($conn);
?>
