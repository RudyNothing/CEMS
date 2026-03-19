<?php
session_start();

if(!isset($_SESSION['student_id'])){
    header("Location: student_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-modern px-4 py-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold" href="index.php">
                <i class="bi bi-calendar-event"></i>CEMS
            </a>

            <div class="d-flex align-items-center">
                <span class="me-3">
                    <i class="bi bi-person-circle"></i>
                    <?php echo $_SESSION['student_name'];?>
                </span>

                <a href="logout.php" class="btn btn-modern btn-sm">
                    <i class="bi bi-box-arrow-right"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-modern p-5 text-center fade-in">
                    <h3 class="mb-3">
                        Welcome <?php echo $_SESSION['student_name'];?>
                    </h3>
                    <p class="text-muted mb-4">
                        You can browse and register for college events.
                    </p>

                    <div class="d-grid gap-3">
                        <a href="view_events.php" class="btn btn-modern">
                            <i class="bi bi-calendar2-event"></i>View Available Events
                        </a>
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