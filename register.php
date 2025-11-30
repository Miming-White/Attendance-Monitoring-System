<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Attendee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: 'Poppins', sans-serif;
        position: relative;
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

    .card {
        background-color: rgba(255,255,255,0.9);
        padding: 25px;
        border-radius: 50px;
        width: 50%;
    }

    .form-control {
        background-color: #f1f1f1;
        color: black;
        border: 1px solid #ccc;
        border-radius: 50px;
    }
</style>
</head>

<body>
<div class="card shadow">
    <h2 class="text-center text-dark mb-4">Register Attendee</h2>

    <form method="POST">

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label text-dark">Last Name</label>
                <input type="text" class="form-control" name="last_name" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label text-dark">First Name</label>
                <input type="text" class="form-control" name="first_name" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label text-dark">Middle Name</label>
                <input type="text" class="form-control" name="middle_name">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Phone Number</label>
            <input type="text" class="form-control" name="phone_number">
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Email Address</label>
            <input type="email" class="form-control" name="email_address">
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Sex</label>
            <select class="form-control" name="sex" required>
                <option value="" disabled selected>Select Sex</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="/Attendance-Monitoring-System/index.php" class="btn btn-primary">Dashboard</a>
            <a href="/Attendance-Monitoring-System/attendees.php" class="btn btn-secondary">Attendees</a>
            <button type="submit" class="btn btn-success">Register</button>
        </div>

    </form>

    <?php
        include 'config.php';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $ln = $_POST['last_name'];
            $fn = $_POST['first_name'];
            $mn = $_POST['middle_name'];
            $phone = $_POST['phone_number'];
            $email = $_POST['email_address'];
            $sex = $_POST['sex'];

            $sql = "INSERT INTO attendees (last_name, first_name, middle_name, phone_number, email_address, sex)
                    VALUES ('$ln', '$fn', '$mn', '$phone', '$email', '$sex')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Attendee registered successfully!');</script>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
    ?>
</div>

</body>
</html>
