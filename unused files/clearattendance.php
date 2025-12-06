<?php
include 'config.php';

$sql = "TRUNCATE TABLE attendance_logs";

if (mysqli_query($conn, $sql)) {
    echo "
    <script>
        alert('All attendance records have been cleared successfully!');
        window.location.href = '/Attendance-Monitoring-System/attendance.php';
    </script>";
} else {
    echo "
    <script>
        alert('Error clearing attendance records.');
        window.location.href = '/Attendance-Monitoring-System/attendance.php';
    </script>";
}

mysqli_close($conn);
?>