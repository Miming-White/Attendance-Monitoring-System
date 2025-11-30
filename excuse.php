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
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        color: white;
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
        background: url('icons/bg.jpg') no-repeat center center/cover;
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

        <h2 style="font-weight: bold;">Excuse Log</h2>

    <div class="table-container">

    <div class="mb-3 d-flex justify-content-between">
        <a href="/Attendance-Monitoring-System/index.php">
            <img src="icons/back.png" width="60" alt="Back" style="cursor: pointer;">
    </a>
        <a href="/Attendance-Monitoring-System/addexcuse.php">
            <img src="icons/add.png" width="75" alt="Add Log" style="cursor: pointer;">
    </a>
    </div>
        <br>
        <table class = "table">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Log Date/Time</th>
                <th>Delete</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
                <?php
                    include 'config.php';

                    $sql = "SELECT * FROM excuses";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['number'] . "</td>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['creation_date'] . "</td>";

                            echo "<td>

                                    <a href='/Attendance-Monitoring-System/deleteexcuse.php?number=" . $row['number'] . "' onclick=\"return confirm('Delete this record?');\">
                                    <img src='icons/delete.png' width='45' alt='Delete' style='cursor:pointer;'>
                                </a>
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