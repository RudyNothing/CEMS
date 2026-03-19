<?php
include "includes/db.php";
session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT admin_id, password_hash FROM admins where username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        if(password_verify($password,$row['password_hash'])){
            $_SESSION['admin_id'] = $row['admin_id'];
    
            header("Location:admin_dashboard.php");
            exit();
        }
        else{
            $error = "Incorrect Password";
        }
    }
    else{
        $error = "Admin not Found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
        <div class="card card-modern p-5 fade-in text-center" style="max-width:420px;width:100%;">
            <div class="mb-3">
                <i class="bi bi-shield-lock" style="font-size:40px;color:#ff7a18;"></i>
            </div>

            <h3 class="mb-4">Admin Login</h3>

            <?php if(isset($error)){ ?>

            <div class="alert alert-danger">
                <?php echo $error;?>
            </div>
            <?php } ?>

            <form method="POST">
                
                <div class="mb-3 text-start">
                    <label class="form-label">
                        Username
                    </label>
                    <input type="text" class="form-control" name="username" required>
                </div>

                <div class="mb-4 text-start">
                    <label class="form-label">
                        Password
                    </label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-modern">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Admin Login
                    </button>
                </div>
            </form>
        </div>        
    </div>
    <footer class="text-center mt-5 mb-3 text-muted">
        © College Event Management System
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>