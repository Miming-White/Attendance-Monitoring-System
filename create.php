<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<style>
    body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }
    h1 {
        font-family: 'Poppins', sans-serif;
    }
    body {
        color: white;
    }

    .card {
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 50px;
    }

    h1, label {
        color: white;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.2);
        color: black;
        border: 1px solid rgba(0, 0, 0, 0.5);
        border-radius: 50px;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.3);
        border-color: black;
        box-shadow: none;
        color: black;
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

</head>
<body>

    <div class="container">
            <div class="card shadow p-4" 
                style="background-color: rgba(255,255,255,0.9); 
                        border-radius: 20px; 
                        width: 60%; 
                        margin: auto;">

                <h1 style="color: black; text-align: center; margin-bottom: 20px; font-weight: bold;">
                    Add New Log
                </h1>

    <div class="d-flex flex-row justify-content-center align-items-center">

            <div style="width: 50%; display: flex; justify-content: center; align-items: center;">
                <img src="icons/logo.png" alt="Illustration"
                    style="width: 90%; border-radius: 10px;">
            </div>

                <div style="width: 40%; padding-left: 20px; display: flex; flex-direction: column; align-items: center;">
                <form method="POST">

                    <div class="mb-3">
                        <label for="attendee_id" class="form-label" style="color: black;">Attendee ID</label>
                        <input type="text" class="form-control" id="attendee_id" name="attendee_id" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/Attendance-Monitoring-System/index.php" class="btn btn-primary">Dashboard</a>
                        <a href="/Attendance-Monitoring-System/attendance.php" class="btn btn-secondary">Records</a>
                        <button type="submit" name="submit" class="btn btn-success">Time In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
include 'config.php';

if (isset($_POST['submit'])) {
    $attendee_id = $_POST['attendee_id'];

    $check = mysqli_query($conn, "SELECT * FROM attendees WHERE attendee_id='$attendee_id'");

    if (mysqli_num_rows($check) == 0) {
        echo "<script>alert('This attendee is NOT registered! Register first.');</script>";
        exit();
    }

    $row = mysqli_fetch_assoc($check);
    $full_name = $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'];

    date_default_timezone_set('Asia/Manila');
    $log_datetime = date("Y-m-d H:i:s");

    $cutoff = strtotime("08:00:00");
    $now = strtotime(date("H:i:s"));

    $status = ($now <= $cutoff) ? "PRESENT" : "LATE";
    $time_out = "-";

    $sql = "INSERT INTO attendance_logs (id, name, log_datetime, time_out, status)
            VALUES ('$attendee_id', '$full_name', '$log_datetime', '$time_out', '$status')";

    if (mysqli_query($conn, $sql)) { 
        echo "<script>
        alert('Record added successfully!');
        window.location.href = '/Attendance-Monitoring-System/attendance.php';
        </script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
    }

}

    ?>
</body>
</html>