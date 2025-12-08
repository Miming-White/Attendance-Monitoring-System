<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Attendees</title>
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

    <h2>Registered Attendees</h2>

    <div class="table-container">

        <div class="mb-3 d-flex justify-content-between">
        <a href="index.php" class="btn btn-dark">< Dashboard</a>

        <a href="index.php" class="btn btn-success">+ ADD NEW ATTENDEE</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Attendee ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Sex</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>

<tbody>
<?php
    include 'config.php';

    $sql = "SELECT * FROM attendees ORDER BY attendee_id ASC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id    = htmlspecialchars($row['attendee_id']);
            $ln    = htmlspecialchars($row['last_name']);
            $fn    = htmlspecialchars($row['first_name']);
            $mn    = htmlspecialchars($row['middle_name']);
            $sex   = htmlspecialchars($row['sex']);
            $phone = htmlspecialchars($row['phone_number']);
            $email = htmlspecialchars($row['email_address']);

            echo '<tr>
                    <td>' . $id . '</td>
                    <td>' . $ln . '</td>
                    <td>' . $fn . '</td>
                    <td>' . $mn . '</td>
                    <td>' . $sex . '</td>
                    <td>' . $phone . '</td>
                    <td>' . $email . '</td>
                    <td class="text-center">
                        <a href="/Attendance-Monitoring-System/editattendee.php?attendee_id=' . $id . '"
                            class="btn btn-dark btn-sm">
                                Edit
                        </a>

                        <a href="/Attendance-Monitoring-System/deleteattendee.php?attendee_id=' . $id . '"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm(\'Delete this record?\');">
                                Delete
                        </a>
                    </td>
                  </tr>';
        }
    } else {
        echo '<tr>
                <td colspan="8" class="text-center">No attendees registered yet.</td>
              </tr>';
    }
?>
</tbody>

        </table>
    </div>

</body>
</html>
