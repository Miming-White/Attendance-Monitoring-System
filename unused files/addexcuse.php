<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<style>
    body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
    font-family: 'Poppins', sans-serif;
    color: white;
    }

    h1 {
        font-family: 'Poppins', sans-serif;
    }

    .card {
        background-color: white;
        border-radius: 50px;
    }

    h1, label {
        color: white;
    }

    .form-control {
        background-color: #f1f1f1;
        color: black;
        border: 1px solid #ccc;
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
                style="border-radius: 50px; 
                        width: 60%; 
                        margin: auto;">
                        

                <h2 style="color: black; text-align: center; margin-bottom: 20px;">
                    Add New Excuse
                </h2>

    <div class="d-flex flex-row justify-content-center align-items-center">

            <div style="width: 100%; display: flex; flex-direction: column;">
<form method="POST">

<div class="mb-3 w-100">
    <input 
        type="text" 
        id="searchInput" 
        class="form-control" 
        placeholder="Search by ID or Name...">
</div>

<div style="max-height: 400px; overflow-y: auto;">
<table class="table table-bordered table-hover bg-white text-dark">


    <thead class="table-dark text-center">
        <tr>
            <th>Select</th>
            <th>ID</th>
            <th>Full Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $attendees = mysqli_query($conn, "SELECT * FROM attendees ORDER BY last_name ASC");
        while ($row = mysqli_fetch_assoc($attendees)) {
            $fullName = $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'];
                        ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="selected_ids[]" value="<?= $row['attendee_id'] ?>">
                            </td>
                            <td><?= $row['attendee_id'] ?></td>
                            <td><?= $fullName ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <a href="/Attendance-Monitoring-System/index.php" class="btn btn-primary">Dashboard</a>
                    <a href="/Attendance-Monitoring-System/excuse.php" class="btn btn-secondary">Excuses</a>
                    <button type="submit" name="bulk_timein" class="btn btn-success">Excuse Selected</button>
                </div>
    </table>
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

    $sql = "INSERT INTO excuses (id, name, creation_date)
            VALUES ('$attendee_id', '$full_name', '$log_datetime')";

    if (mysqli_query($conn, $sql)) { 
        echo "<script>
        alert('An excuse is added successfully!');
        window.location.href = '/Attendance-Monitoring-System/excuse.php';
        </script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
    }

}

    ?>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(function (row) {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>

</body>
</html>