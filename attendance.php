<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Log</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <style>
        h2 {
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            position: relative;
            padding-top: 40px;
            color: white;
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

        .table-container {
            background: rgba(255, 255, 255, 0.95);
            color: black;
            border-radius: 50px;
            padding: 30px;
            width: 90%;
            margin: auto;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.4);
        }

        th {
            background-color: #007bff;
            color: white;
        }

        h2 {
            color: black;
            font-weight: bold;
            text-align: center;
            margin-bottom: 25px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <h2>Attendance Log</h2>

    <div class="table-container">

        <div class="mb-3 d-flex justify-content-between">
            <a href="index.php" class="btn btn-dark">< Dashboard</a>

            <a href="archiveattendance.php"
                class="btn btn-danger"
                onclick="return confirm('Are you sure you want to archive ALL attendance? This action cannot be undone.');">
                ↓ Archive All Attendance
            </a>
        </div>

        <div class="mb-3 d-flex justify-content-between">
            <a href="create.php" class="btn btn-success">+ TIME IN</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Log Date/Time</th>
                    <th>Time Out</th>
                    <th>Status</th>
                    <th>Delete</th>
                    <th>Time Out Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include 'config.php';

                $sql = "SELECT * FROM attendance_logs ORDER BY number ASC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $num  = htmlspecialchars($row['number']);
                        $id   = htmlspecialchars($row['id']);
                        $name = htmlspecialchars($row['name']);
                        $log  = htmlspecialchars($row['log_datetime']);
                        $out  = htmlspecialchars($row['time_out']);
                        $stat = htmlspecialchars($row['status']);

                        echo '<tr>
                                <td>' . $num . '</td>
                                <td>' . $id . '</td>
                                <td>' . $name . '</td>
                                <td>' . $log . '</td>
                                <td>' . $out . '</td>
                                <td>' . $stat . '</td>
                                <td>
                                    <a href="/Attendance-Monitoring-System/delete.php?number=' . $num . '"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Delete this record?\');">
                                        Delete
                                    </a>
                                </td>
                                <td>
                                    <a href="/Attendance-Monitoring-System/timeout.php?number=' . $num . '"
                                        class="btn btn-dark btn-sm">
                                            Time Out
                                    </a>
                                </td>
                              </tr>';
                    }
                } else {
                    echo '<tr>
                            <td colspan="8" class="text-center">No record found</td>
                          </tr>';
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>

    </div>

</body>
</html>