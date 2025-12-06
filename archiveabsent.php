<?php
include 'config.php';

// Step 1: Copy all records to the history table
$archive_sql = "INSERT INTO archives (id, name, status)
                SELECT id, name, status
                FROM attendance_logs";

if (mysqli_query($conn, $archive_sql)) {
    // Step 2: Clear the attendance_logs table
    $truncate_sql = "TRUNCATE TABLE absents";

    if (mysqli_query($conn, $truncate_sql)) {
        echo "
        <script>
            alert('Absent records have been archived and cleared successfully!');
            window.location.href = '/Attendance-Monitoring-System/absent.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error clearing absent logs after archiving.');
            window.location.href = '/Attendance-Monitoring-System/absent.php';
        </script>";
    }
} else {
    echo "
    <script>
        alert('Error archiving absent records.');
        window.location.href = '/Attendance-Monitoring-System/absent.php';
    </script>";
}

mysqli_close($conn);
?>
