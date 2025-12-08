<?php
include 'config.php';

if (isset($_GET['absent_id'])) {
    $aid = $_GET['absent_id'];

    $sql = "DELETE FROM absents WHERE absent_id = '$aid'";

    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            alert('Record deleted successfully!');
            window.location.href = '/Attendance-Monitoring-System/absent.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error deleting record.');
            window.location.href = '/Attendance-Monitoring-System/absent.php';
        </script>";
    }

    mysqli_close($conn);
} else {
    echo "
    <script>
        alert('No ID provided.');
        window.location.href = '/Attendance-Monitoring-System/absent.php';
    </script>";
}
?>
