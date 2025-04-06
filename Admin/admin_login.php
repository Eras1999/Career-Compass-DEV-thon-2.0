<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loginSuccess = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM Admin WHERE admin_name = ?");
    $stmt->bind_param("s", $admin_name);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if ($hashed_password && hash('sha256', $password) === $hashed_password) {
        $_SESSION['admin_logged_in'] = true;
        $loginSuccess = "success";
    } else {
        $loginSuccess = "error";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: linear-gradient(135deg, #007BFF 0%, #FFC107 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 400px;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background: white;
        }
        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
        }
        .btn-primary:hover {
            background-color: #FFC107;
            border-color: #FFC107;
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <h3 class="text-center mb-4">Admin Login</h3>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="admin_name" class="form-label">Admin Name</label>
                <input type="text" class="form-control" id="admin_name" name="admin_name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <script>
        <?php if ($loginSuccess === "success") : ?>
            Swal.fire({
                icon: 'success',
                title: 'Login Successful',
                text: 'Welcome back,',
                showConfirmButton: 'Ok',
        }).then(() => {
            window.location.href = 'index.php';
        });
        <?php elseif ($loginSuccess === "error") : ?>
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Invalid credentials!',
            confirmButtonText: 'Try Again'
        });
        <?php endif; ?>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
