<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Lobster&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    h1 {
        font-family: 'Poppins', sans-serif;
    }

    .table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #0040ffff, #661cc8ff); /* gradient */
        color: white; /* text color */
    }

    .table th, 
    .table td {
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 12px;
        opacity: 0.9;
        text-align: center;
    }

    .table, th, td {
        font-family: 'Poppins', sans-serif;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('bg.jpg') no-repeat center center/cover;
        opacity: 0.3;
        z-index: -1;
    }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Monitoring System</title>
</head>
<body style="margin: 50px;">


    <div class="d-flex justify-content-start align-items-center mb-3">
        <a href="index.php" class="me-2">
            <img src="back.png" width="50" alt="Back" style="cursor: pointer;">
        </a>
        <h1 class="me-2" style="font-weight: bold;">Attendance Log</h1>
    </div>

    <div class="d-flex justify-content-end">
            <a href="/Attendance-Monitoring-System/create.php">
        <img src="addlog.png" width="120" alt="Add Log" style="cursor: pointer;">
    </a>
    </div>
        <br>
        <table class = "table">
        <thead>
            <tr>
                <th>Number</th>
                <th>ID</th>
                <th>Name</th>
                <th>Log Date/Time</th>
                <th>Time Out</th>
                <th>Status</th>
                <th>Edit/Delete</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
                <?php
                    include 'config.php';

                    $sql = "SELECT * FROM attendance_logs";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['number'] . "</td>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['log_datetime'] . "</td>";
                            echo "<td>" . $row['time_out'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";

                            echo "<td>
                                    <a href='/Attendance-Monitoring-System/edit.php?number=" . $row['number'] . "'>
                                    <img src='edit.png' width='40' alt='Edit' style='cursor:pointer;'>
                                </a>

                                    <a href='/Attendance-Monitoring-System/delete.php?number=" . $row['number'] . "' onclick=\"return confirm('Delete this record?');\">
                                    <img src='delete.png' width='45' alt='Delete' style='cursor:pointer;'>
                                </a>
                                </td>";

                            echo "<td>
                                    <a href='/Attendance-Monitoring-System/timeout.php?number=" . $row['number'] . "'>
                                    <img src='timeout.png' width='100' alt='Edit' style='cursor:pointer;'>
                                </td>";

                            echo "</tr>";

                        }
                    } else {
                        echo "<tr><td colspan='7'>No record found</td></tr>";
                    }

                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
</body>
</html>