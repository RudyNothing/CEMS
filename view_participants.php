<?php
include "includes/db.php";
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$event_id = $_GET['event_id'];

$stmt = $conn->prepare("SELECT students.name, students.email, students.roll_number FROM registrations JOIN students on registrations.student_id = students.student_id WHERE registrations.event_id=?");

$stmt->bind_param("i", $event_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-modern px-4 py-3">
        <div class="container-fluid">
            <a href="admin_dashboard.php" class="navbar-brand fw-semibold">
                <i class="bi bi-shield-lock"></i> Admin Panel
            </a>

            <div>
                <a href="manage_events.php" class="btn btn-modern btn-sm me-2">
                    <i class="bi bi-arrow-left"></i> Back to Events
                </a>
                <a href="logout.php" class="btn btn-modern btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card card-modern p-4 fade-in">
            <h3 class="mb-4">
                <i class="bi bi-people"></i> Registered Students
            </h3>

            <div class="table-responsive">
                <table class="table table-modern align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roll Number</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td>
                                <strong><?php echo $row['name']; ?></strong>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                            <td>
                                <?php echo $row['roll_number']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5 mb-3 text-muted">
        © College Event Management System
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>