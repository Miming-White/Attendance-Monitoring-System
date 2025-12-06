<?php
include 'config.php';

// Define today and status
$today = date('Y-m-d');
$status = 'Absent';

// Handle form submission
if (isset($_POST['bulk_absent'])) {

    if (!isset($_POST['selected_ids'])) {
        echo "<script>alert('Please select at least one attendee.');</script>";
        exit();
    }

    foreach ($_POST['selected_ids'] as $attendee_id) {

        // Get attendee info
        $check = mysqli_query($conn, "SELECT * FROM attendees WHERE attendee_id='$attendee_id'");
        $row = mysqli_fetch_assoc($check);

        if (!$row) continue;

        $full_name = $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'];

        // Check for duplicate absents today
        $dup_check = mysqli_query($conn,
            "SELECT * FROM absents 
             WHERE id='$attendee_id' AND DATE(created_at)='$today'"
        );

        if (mysqli_num_rows($dup_check) > 0) {
            continue; // skip duplicates
        }

        // Insert into absents
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
<title>Add Absents</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: url('icons/bg.jpg') no-repeat center center/cover;
    background-size: cover;
    color: white;
    padding: 20px;
}
.card {
    background-color: white;
    border-radius: 20px;
    padding: 20px;
    color: black;
}
.form-control {
    border-radius: 50px;
}
</style>
</head>
<body>
<div class="container">
    <div class="card mx-auto" style="max-width: 800px;">
        <h2 class="text-center mb-4">Add Absentees</h2>

        <form method="POST">
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by ID or Name...">
            </div>

            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-hover">
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
                <a href="index.php" class="btn btn-primary">Dashboard</a>
                <a href="absent.php" class="btn btn-secondary">Absentees</a>
                <button type="submit" name="bulk_absent" class="btn btn-danger">Mark Selected as Absent</button>
            </div>
        </form>
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
