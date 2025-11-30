<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attendee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <style>
     body {
        font-family: 'Poppins', sans-serif;
        color: black;
        padding-top: 40px;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('icons/bg.jpg') no-repeat center center/cover;
        opacity: 0.2;
        z-index: -1;
    }

    .edit-container {
        width: 600px;
        margin: auto;
        background: white;
        border-radius: 15px;
        padding: 30px 40px;
        box-shadow: 0px 5px 20px rgba(0,0,0,0.2);
    }

    h2 {
        text-align: center;
        font-weight: 400;
        color: black;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 500;
        color: black;
    }

    .form-control {
        background-color: #f1f1f1;
        color: black;
        border: 1px solid #ccc;
        border-radius: 50px;
    }

    .form-control:focus {
        background-color: white;
        border-color: black;
        box-shadow: none;
        color: black;
    }

    .card {
        background-color: rgba(255,255,255,0.9);
        padding: 25px;
        border-radius: 50px;
        width: 50%;
    }
    </style>
    </head>
<body>
            <?php
                include 'config.php';

                if (isset($_GET['attendee_id'])) {
                    $id = $_GET['attendee_id'];
                    $sql = "SELECT * FROM attendees WHERE attendee_id = '$id'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    } else {
                        echo "<div class='alert alert-danger'>Attendee not found.</div>";
                        exit;
                    }
                }

                if (isset($_POST['update'])) {

                    $id = $_POST['attendee_id'];
                    $last_name = $_POST['last_name'];
                    $first_name = $_POST['first_name'];
                    $middle_name = $_POST['middle_name'];
                    $phone_number = $_POST['phone_number'];
                    $email_address = $_POST['email_address'];
                    $sex = $_POST['sex'];

                $sql_update = "UPDATE attendees
                    SET last_name = '$last_name',
                    first_name = '$first_name',
                    middle_name = '$middle_name',
                    phone_number = '$phone_number',
                    email_address = '$email_address',
                    sex = '$sex'
                WHERE attendee_id = '$id'";



                    if (mysqli_query($conn, $sql_update)) {
                        echo "<script>
                                alert('Attendee updated successfully!');
                                window.location.href = '/Attendance-Monitoring-System/attendees.php';
                              </script>";
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
                    }
                }

                mysqli_close($conn);
            ?>

            <div class="edit-container">

                <h2>Edit Attendee</h2>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Attendee ID (fixed)</label>
                    <input type="text" class="form-control" name="attendee_id" value="<?php echo $row['attendee_id']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control" name="middle_name" value="<?php echo $row['middle_name']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" value="<?php echo $row['phone_number']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email_address" value="<?php echo $row['email_address']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sex</label>
                    <select class="form-control" name="sex" required>
                        <option value="Male" <?php echo ($row['sex'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($row['sex'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($row['sex'] === 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>


                <div class="d-flex justify-content-between">
                    <a href="/Attendance-Monitoring-System/attendees.php" class="btn btn-primary">Back</a>
                    <button type="submit" name="update" class="btn btn-success">Update Log</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>