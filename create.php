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
        background: url('bg.jpg') no-repeat center center/cover;
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

                <h1 style="color: black; text-align: center; margin-bottom: 20px;">
                    ADD NEW LOG
                </h1>

    <div class="d-flex flex-row justify-content-center align-items-center">

            <div style="width: 50%; display: flex; justify-content: center; align-items: center;">
                <img src="logo.png" alt="Illustration"
                    style="width: 90%; border-radius: 10px;">
            </div>

                <div style="width: 40%; padding-left: 20px; display: flex; flex-direction: column; align-items: center;">
                <form method="POST" action="create.php">

                    <div class="mb-3">
                        <label for="id" class="form-label" style="color: black;">ID</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label" style="color: black;">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>



                    <div class="d-flex justify-content-between">
                        <a href="/final/index.php" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submit" class="btn btn-success">Time In</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php
        include 'config.php';

        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];

            date_default_timezone_set('Asia/Manila');
            $log_datetime = date("Y-m-d H:i:s");

            $cutoff = strtotime("08:00:00");
            $time_in_now = strtotime(date("H:i:s"));

            $status = ($time_in_now <= $cutoff) ? "PRESENT" : "LATE";

            $time_out = "-";

            $sql = "INSERT INTO attendance_logs (id, name, log_datetime, time_out, status)
                    VALUES ('$id', '$name', '$log_datetime', '$time_out', '$status')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>
                        alert('Record added successfully!');
                        window.location.href = '/final/index.php';
                      </script>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
            }

            mysqli_close($conn);
        }
    ?>
</body>
</html>