<?php
include "includes/db.php";
session_start();

if(!isset($_SESSION['student_id'])){
    header("Location: student_login.php");
    exit();
}

$result = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Available Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-modern px-4 py-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold" href="student_dashboard.php">
                <i class="bi bi-calendar-event"></i> CEMS
            </a>
            <div>
                <a href="student_dashboard.php" class="btn btn-modern btn-sm me-2">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="logout.php" class="btn btn-modern btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card card-modern p-4 fade-in">
            <h3 class="mb-4">Available Events</h3>
                <div class="table-responsive">
                    <table class="table table-modern align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = $result->fetch_assoc()){
                                $event_id = $row['event_id'];
                                $student_id = $_SESSION['student_id'];

                                $check = $conn->prepare("SELECT * FROM registrations WHERE event_id=? AND student_id=?");
                                $check->bind_param("ii",$event_id,$student_id);
                                $check->execute();

                                $res = $check->get_result();
                            ?>
                            <tr>
                                <td><strong><?php echo $row['title']; ?></strong></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['event_date']; ?></td>
                                <td><?php echo $row['venue']; ?></td>
                                <td>
                                    <?php if($res->num_rows > 0){ ?>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> Registered
                                        </span>
                                    <?php } else { ?>
                                    <button class="btn btn-modern btn-sm register-btn" data-event="<?php echo $row['event_id']; ?>">
                                        <i class="bi bi-calendar-plus"></i> Register
                                    </button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Registration Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color:#ff7a18; font-weight:600;">Event Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="modalMessage">
                </div>
            </div>
        </div>
        </div>
    <footer class="text-center mt-5 mb-3 text-muted">
        © College Event Management System
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll(".register-btn").forEach(button => {
    button.addEventListener("click", function(){
    let eventId = this.dataset.event;
    let btn = this;

    fetch("register_event.php?event_id=" + eventId)

    .then(response => response.text())

    .then(data => {

    document.getElementById("modalMessage").innerHTML = data;

    let modal = new bootstrap.Modal(document.getElementById("registerModal"));

    modal.show();

    /* Change button to Registered */

    btn.outerHTML =
    '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Registered</span>';

    });

    });

    });

</script>
</body>
</html>