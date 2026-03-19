<?php
include "includes/db.php";
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$result = $conn->query("SELECT * from events");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-modern px-4 py-3">
        <div class="container-fluid">
            <a href="admin_dashboard.php" class="navbar-brand fw-semibold">
                <i class="bi bi-shield-lock"></i>Admin Panel
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
        <div class="card card-modern p-4 fade-in">
            <h3 class="mb-4">
                <i class="bi bi-gear"></i> Manage Events
            </h3>

            <div class="table-responsive">
                <table class="table table-modern align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Participants</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            while($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td>
                                <strong><?php echo $row['title'];?></strong>
                            </td>
                            <td>
                                <?php echo $row['description']; ?>
                            </td>
                            <td>
                                <?php echo $row['event_date'];?>
                            </td>
                            <td>
                                <?php echo $row['venue'];?>
                            </td>
                            <td>
                                <a href="view_participants.php?event_id=<?php echo $row['event_id'];?>" class="btn btn-modern btn-sm">
                                    <i class="bi bi-people"></i>Participants
                                </a>
                            </td>

                            <td>
                                <a href="delete_event.php?event_id=<?php echo $row['event_id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
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