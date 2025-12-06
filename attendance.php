<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Lobster&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    h2 {
        font-family: 'Poppins', sans-serif;
        color: black;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    .table-container {
        background: rgba(255, 255, 255, 0.95);
        color: black;
        border-radius: 50px;
        padding: 30px;
        width: 90%;
        margin: auto;
        box-shadow: 0px 0px 20px rgba(0,0,0,0.4);
    }

    .table {
    background-color: rgba(255, 255, 255, 0.9);
    color: black;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
    }

    .table th, 
    .table td {
        border: 1px solid rgba(255, 255, 255, 1.0);
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
        background: url('icons/bg.jpg') no-repeat center center/cover;
        opacity: 0.3;
        z-index: -1;
    }

    thead {
    position: sticky;
    top: 0;
    z-index: 2;
    }

    .table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.05);
    }

    thead tr {
    background-color: #212529;
    color: white;
}
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Monitoring System</title>
</head>
<body style="margin: 50px;">

        <h2 style="font-weight: bold;">Attendance Log</h2>

    <div class="table-container">

    <div class="mb-3 d-flex justify-content-between">
        <a href="/Attendance-Monitoring-System/index.php">
            <img src="icons/back.png" width="60" alt="Back" style="cursor: pointer;">
    </a>
        <a href="/Attendance-Monitoring-System/create.php">
            <img src="icons/add.png" width="75" alt="Add Log" style="cursor: pointer;">
    </a>
    </div>
        <br>
        <table class = "table table-bordered table-hover bg-white text-dark">
        <thead class= "table-dark text-center">
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Log Date/Time</th>
                <th>Time Out</th>
                <th>Status</th>
                <th>Delete</th>
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

                                    <a href='/Attendance-Monitoring-System/delete.php?number=" . $row['number'] . "' onclick=\"return confirm('Delete this record?');\">
                                    <img src='icons/delete.png' width='45' alt='Delete' style='cursor:pointer;'>
                                </a>
                                </td>";

                            echo "<td>
                                    <a href='/Attendance-Monitoring-System/timeout.php?number=" . $row['number'] . "'>
                                    <img src='icons/timeout.png' width='100' alt='Edit' style='cursor:pointer;'>
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