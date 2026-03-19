<?php
include "includes/db.php";
session_start();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT student_id, name, password_hash FROM students WHERE email=?");

    if(!$stmt){
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s",$email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){

    $row = $result->fetch_assoc();

        if(password_verify($password,$row['password_hash'])){
            $_SESSION['student_id'] = $row['student_id'];
            $_SESSION['student_name'] = $row['name'];

            header("Location: student_dashboard.php");
            exit();

        }
        else{
            echo "Incorrect Password";
        }
    }
    else{
        echo "Email not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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
        </div>
    </nav>
    <div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
        <div class="card card-modern p-5 fade-in" style="max-width:420px; width:100%">
            <h3 class="text-center mb-4">
                Student Login
            </h3>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">
                        Email
                    </label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Password
                    </label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-modern">
                        <i class="bi bi-box-arrow-in-right"></i>Login
                    </button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="student_register.php" class="text-decoration-none" style="color:#ff7a18">
                    Create an account
                </a>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5 mb-3 text-muted">
        © College Event Management System
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>