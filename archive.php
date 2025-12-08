<?php
include 'config.php'; // Your database connection

// Fetch all archived records
$sql = "SELECT * FROM archives ORDER BY archived_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Attendance History</h2>
            <div class="mb-3">
        <a href="index.php" class="btn btn-dark">Back to Dashboard</a>
        <a href="deleteallarchive.php" class="btn btn-danger">Clear Archive</a>
    </div>        
    <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>History ID</th>
                    <th>Original ID</th>
                    <th>Name</th>
                    <th>Log In</th>
                    <th>Time Out</th>
                    <th>Status</th>
                    <th>Archived At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row['history_id'] . "</td>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['log_datetime'] . "</td>";
                        echo "<td>" . ($row['time_out'] ?? '-') . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['archived_at'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No archived records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
