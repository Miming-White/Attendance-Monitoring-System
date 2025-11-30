<?php
include 'config.php';

if (isset($_GET['attendee_id'])) {
    $id = $_GET['attendee_id'];

    $sql = "DELETE FROM attendees WHERE attendee_id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            alert('Attendee deleted successfully!');
            window.location.href = '/Attendance-Monitoring-System/attendees.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error deleting attendee.');
            window.location.href = '/Attendance-Monitoring-System/attendees.php';
        </script>";
    }

    mysqli_close($conn);
} else {
    echo "
    <script>
        alert('No ID provided.');
        window.location.href = '/Attendance-Monitoring-System/attendees.php';
    </script>";
}
?>
