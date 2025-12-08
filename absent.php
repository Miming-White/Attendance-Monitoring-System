<?php
include 'config.php';

// Fetch all archived records
$sql = "SELECT * FROM absents ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absentees Log</title>

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

    <h2>Absentees Log</h2>

    <div class="table-container">

        <div class="mb-3 d-flex justify-content-between">
            <a href="index.php" class="btn btn-dark">< Dashboard</a>

            <a href="archiveabsent.php"
                class="btn btn-danger"
                onclick="return confirm('Are you sure you want to archive ALL absentees? This action cannot be undone.');">
                ↓ Archive All Absentees
            </a>
        </div>

        <div class="mb-3 d-flex justify-content-between">
            <a href="createabsent.php" class="btn btn-success">+ MARK ABSENTEE</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Absent ID</th>
                    <th>Attendee ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $aid = htmlspecialchars($row['absent_id']);
                        $id  = htmlspecialchars($row['id']);
                        $name = htmlspecialchars($row['name']);
                        $stat = htmlspecialchars($row['status']);
                        $date = htmlspecialchars($row['created_at']);

                        echo "
                        <tr>
                            <td>$aid</td>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$stat</td>
                            <td>$date</td>
                            <td>
                                <a href='deleteabsent.php?absent_id=$aid'
                                    class='btn btn-danger btn-sm'
                                    onclick=\"return confirm('Delete this absent record?');\">
                                    Delete
                                </a>
                            </td>
                        </tr>";
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

<?php mysqli_close($conn); ?>
