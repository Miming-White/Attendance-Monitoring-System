<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM attendance_logs WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            alert('Record deleted successfully!');
            window.location.href = '/final/index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error deleting record.');
            window.location.href = '/final/index.php';
        </script>";
    }

    mysqli_close($conn);
} else {
    echo "
    <script>
        alert('No ID provided.');
        window.location.href = '/final/index.php';
    </script>";
}
?>
