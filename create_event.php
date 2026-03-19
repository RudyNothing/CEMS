<?php
include "includes/db.php";
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

if(isset($_POST['create'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $venue = $_POST['venue'];

    $stmt = $conn->prepare("INSERT into events (title, description, event_date, venue) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $title, $description, $date, $venue);

    if($stmt->execute()){
        $success =  "Event created successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-modern pc-4 py-3">
        <div class="container-fluid">
            <a href="admin_dashboard.php" class="navbar-brand fw-semibold">
                <i class="bi bi-shield-lock"></i> Admin Panel
            </a>
            <div>
                <a href="admin_dashboard.php" class="btn btn-modern btn-sm me-2">
                    <i class="bi bi-speedometer2"></i>Dashboard
                </a>

                <a href="logout.php" class="btn btn-modern btn-sm">
                    <i class="bi bi-box-arrow-right"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-modern p-5 fade-in">
                    <h3 class="mb-4 text-center">
                        <i class="bi bi-calendar-plus"></i>Create New Event
                    </h3>

                    <?php if(isset($success)){ ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="create" class="btn btn-modern">
                                <i class="bi bi-plus-circle"></i>Create Event
                            </button>
                        </div>
                    </form>
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