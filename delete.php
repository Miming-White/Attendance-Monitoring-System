<?php
include 'config.php';

if (isset($_GET['number'])) {
    $number = $_GET['number'];

    $sql = "DELETE FROM attendance_logs WHERE number = '$number'";

    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            alert('Record deleted successfully!');
            window.location.href = '/Attendance-Monitoring-System/attendance.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error deleting record.');
            window.location.href = '/Attendance-Monitoring-System/attendance.php';
        </script>";
    }

    mysqli_close($conn);
} else {
    echo "
    <script>
        alert('No ID provided.');
        window.location.href = '/Attendance-Monitoring-System/attendance.php';
    </script>";
}
?>
