<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<style>
    body {
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
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 10px;
    }

    h1, label {
        color: white;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.3);
        border-color: white;
        box-shadow: none;
        color: white;
    }
</style>
</head>

<body>

    <h1 class="text-center mb-4" style="color: black; font-weight: bold;">Edit Record</h1>

    <div class="container">
        <div class="card shadow p-4">
            <?php
                include 'config.php';

                if (isset($_GET['number'])) {
                    $number = $_GET['number'];
                    $sql = "SELECT * FROM attendance_logs WHERE number = '$number'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    } else {
                        echo "<div class='alert alert-danger'>Record not found.</div>";
                        exit;
                    }
                }

                if (isset($_POST['update'])) {

                    $number = $_POST['number'];
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $status = $_POST['status'];

                    $sql_update = "UPDATE attendance_logs 
                                SET id = '$id',
                                name = '$name',
                                status = '$status'
                                WHERE number = '$number'";


                    if (mysqli_query($conn, $sql_update)) {
                        echo "<script>
                                alert('Record updated successfully!');
                                window.location.href = '/Attendance-Monitoring-System/attendance.php';
                              </script>";
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
                    }
                }

                mysqli_close($conn);
            ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Log Number (fixed)</label>
                    <input type="text" class="form-control" name="number" value="<?php echo $row['number']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="text" class="form-control" name="id" value="<?php echo $row['id']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" name="status" value="<?php echo $row['status']; ?>">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/Attendance-Monitoring-System/index.php" class="btn btn-secondary">Back</a>
                    <button type="submit" name="update" class="btn btn-warning">Update Log</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>