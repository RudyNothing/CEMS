<?php include "includes/db.php";  

if (isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $roll = $_POST['roll_number'];
    $password = $_POST['password'];

    // Hash password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Statement
    $stmt = $conn->prepare("INSERT into students (name, email, roll_number, password_hash) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $roll, $hashed_password);

    if($stmt->execute()){
        $success = "Registration Successful! You can now login.";
    } else{
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
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
        <div class="card card-modern p-5 fade-in" style="max-width:450px; width:100%">
            <h3 class="text-center mb-4">
                Student Registration
            </h3>

            <?php if(isset($success)){?>
            <div class="alert alert-success">
                <?php echo $success;?>
            </div>
            <?php } ?>

            <?php if(isset($error)){ ?>
            <div class="alert alert-danger">
                <?php echo $error;?>
            </div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">
                        Full Name
                    </label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Email Address
                    </label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Roll Number
                    </label>
                    <input type="text" class="form-control" name="roll_number" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Password
                    </label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" name="register" class="btn btn-modern">
                        <i class="bi bi-person-plus"></i>Register
                    </button>
                </div>
            </form>
            <div class="text-center mt-3">
                Already have an account?
                <a href="student_login.php" style="color:#ff7a18; text-decoration:none;">
                    Login
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