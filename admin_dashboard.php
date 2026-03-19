<?php
include "includes/db.php";
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
/* TOTAL EVENTS */
$events = $conn->query("SELECT COUNT(*) as total FROM events");
$total_events = $events->fetch_assoc()['total'];

/* TOTAL STUDENTS */
$students = $conn->query("SELECT COUNT(*) as total FROM students");
$total_students = $students->fetch_assoc()['total'];

/* TOTAL REGISTRATIONS */
$registrations = $conn->query("SELECT COUNT(*) as total FROM registrations");
$total_registrations = $registrations->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-modern px-4 py-3">
        <div class="container-fluid">
            <a href="logout.php" class="btn btn-modern btn-sm">
                <i class="bi bi-box-arrow-right"></i>Logout
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="mb-4">
            Admin Dashboard
        </h3>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-modern p-4 text-center fade-in">
                    <div class="mb-3">
                        <i class="bi bi-calendar-plus" style="font-size:40px;color:#ff7a18;"></i>
                    </div>

                    <h5 class="mb-3">
                        Create Event
                    </h5>

                    <p class="text-muted">Add new college events for students.</p>
                    <a href="create_event.php" class="btn btn-modern">
                        Create Event
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-modern p-4 text-center fade-in">
                    <div class="mb-3">
                        <i class="bi bi-gear" style="font-size:40px;color:#ff7a18;"></i>
                    </div>

                    <h5 class="mb-3">
                        Manage Events
                    </h5>
                    <p class="text-muted">View Events and See Registered Participants.</p>
                    <a href="manage_events.php" class="btn btn-modern">
                        Manage Events
                    </a>
                </div>
            </div>
            <div class="row g-4 mb-4">
                <!-- TOTAL EVENTS -->
                <div class="col-md-4">
                    <div class="card card-modern p-4 text-center">
                        <i class="bi bi-calendar-event" style="font-size:32px;color:#ff7a18;"></i>
                        <h4 class="mt-2"><?php echo $total_events; ?></h4>
                        <p class="text-muted"> Total Events</p>
                    </div>
                </div>
                <!-- TOTAL STUDENTS -->
                <div class="col-md-4">
                    <div class="card card-modern p-4 text-center">
                        <i class="bi bi-people" style="font-size:32px;color:#ff7a18;"></i>
                        <h4 class="mt-2"><?php echo $total_students; ?></h4>
                        <p class="text-muted">Registered Students</p>
                    </div>
                </div>
                <!-- TOTAL REGISTRATIONS -->
                <div class="col-md-4">
                    <div class="card card-modern p-4 text-center">
                        <i class="bi bi-check2-circle" style="font-size:32px;color:#ff7a18;"></i>
                        <h4 class="mt-2"> <?php echo $total_registrations; ?></h4>
                        <p class="text-muted">Total Registrations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5 mb-3 text-muted">
        © College Event Management System
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
