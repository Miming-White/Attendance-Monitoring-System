<?php
include 'config.php';

// Define today and status
$today = date('Y-m-d');
$status = 'ABSENT';

// Handle form submission
if (isset($_POST['bulk_absent'])) {

    if (!isset($_POST['selected_ids'])) {
        echo "<script>alert('Please select at least one attendee.');</script>";
        exit();
    }

    foreach ($_POST['selected_ids'] as $attendee_id) {

        $check = mysqli_query($conn, "SELECT * FROM attendees WHERE attendee_id='$attendee_id'");
        $row = mysqli_fetch_assoc($check);

        if (!$row) continue;

        $full_name = $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'];

        $dup_check = mysqli_query($conn,
            "SELECT * FROM absents 
             WHERE id='$attendee_id' AND DATE(created_at)='$today'"
        );

        if (mysqli_num_rows($dup_check) > 0) {
            continue;
        }

        mysqli_query($conn,
            "INSERT INTO absents (id, name, status, created_at)
             VALUES ('$attendee_id', '$full_name', '$status', NOW())"
        );
    }

    echo "<script>
        alert('Selected attendees have been marked as absent!');
        window.location.href='absent.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Absentee</title>

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
    margin: 0;
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
    background-color: white;
    border-radius: 50px;
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
</style>
</head>

<body>

<div class="container">
    <div class="card shadow p-4" 
        style="border-radius: 50px; width: 60%; margin: auto;">

        <h2 style="color: black; text-align: center; margin-bottom: 20px;">
            Add Absentee
        </h2>

        <div class="d-flex flex-row justify-content-center align-items-center">
            <div style="width: 100%; display: flex; flex-direction: column;">

                <form method="POST">

                    <div class="mb-3 w-100">
                        <input type="text" 
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
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="/Attendance-Monitoring-System/index.php" class="btn btn-dark">Dashboard</a>
                        <a href="/Attendance-Monitoring-System/absent.php" class="btn btn-info">Absentees</a>
                        <button type="submit" name="bulk_absent" class="btn btn-danger">
                            Mark Selected as Absent
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

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
