<?php
include 'config.php';

//ARCHIVE ABSENTEES
$archive_absents = "INSERT INTO archives (id, name, status)
                    SELECT id, name, status FROM absents";

$absents_ok = mysqli_query($conn, $archive_absents);

//clear absents table if archive successful
if ($absents_ok) {
    $clear_absents = mysqli_query($conn, "TRUNCATE TABLE absents");
}

//ARCHIVE ATTENDANCE LOGS
$archive_attendance = "INSERT INTO archives (id, name, log_datetime, time_out, status)
                       SELECT id, name, log_datetime, time_out, status 
                       FROM attendance_logs";

$attendance_ok = mysqli_query($conn, $archive_attendance);

//clear attendance table if archive successful
if ($attendance_ok) {
    $clear_attendance = mysqli_query($conn, "TRUNCATE TABLE attendance_logs");
}

//FINAL RESULT MESSAGE
if ($absents_ok && $attendance_ok) {
    echo "
    <script>
        alert('All attendance and absent records have been archived and cleared successfully!');
        window.location.href = '/Attendance-Monitoring-System/index.php';
    </script>";
} else {
    echo "
    <script>
        alert('Error archiving some records. Please check database tables.');
        window.location.href = '/Attendance-Monitoring-System/index.php';
    </script>";
}

mysqli_close($conn);
?>
