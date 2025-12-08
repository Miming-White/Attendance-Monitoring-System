<?php
include 'config.php';

$sql = "TRUNCATE TABLE archives";

if (mysqli_query($conn, $sql)) {
    echo "
    <script>
        alert('All archived attendance records have been cleared successfully!');
        window.location.href = 'archive.php';
    </script>";
} else {
    echo "
    <script>
        alert('Error clearing archived attendance records.');
        window.location.href = 'archive.php';
    </script>";
}

mysqli_close($conn);
?>
