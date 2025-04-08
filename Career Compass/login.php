<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['first_name'];
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Good job!",
                    text: "Login successful!",
                    icon: "success"
                }).then(function() {
                    window.location.href = "index.php";
                });
            });
        </script>';
        
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Invalid email or password!"
                    });
                });
              </script>';
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
    <title>Login - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Work Sans', sans-serif;
            background: #f4f7fc;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
        }
        .form-section {
            padding: 40px;
            flex: 1;
            min-width: 300px;
        }
        .form-section h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        .form-section p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .form-section .form-check-label {
            font-size: 14px;
            color: #6c757d;
        }
        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .form-section .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            font-size: 14px;
            padding: 10px 40px 10px 10px;
            height: 50px; 
            background: transparent; 
        }

        .form-section .form-label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 14px;
            color: #6c757d;
            background: white;
            padding: 0 5px;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .form-section .form-control:focus + .form-label,
        .form-section .form-control:not(:placeholder-shown) + .form-label {
            top: 0;
            font-size: 12px;
            color:rgb(0, 0, 0);
        }
        .form-section .position-absolute {
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .form-section .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }
        .form-section .btn-submit {
            background: #FFC107;
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-weight: bold;
            width: 100%;
            transition: background 0.3s;
        }
        .form-section .btn-submit:hover {
            background: #007BFF;
            color: white;
        }
        .form-section .social-buttons {
            margin-top: 20px;
        }
        .form-section .social-buttons .btn {
            flex: 1;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
        }
        .form-section .social-buttons .btn-facebook {
            background: #3b5998;
            color: white;
            width: 100%;
        }
        .form-section .social-buttons .btn-google {
            background: #db4437;
            color: white;
            width: 100%;
            margin-top: 10px;
        }
        .form-section .social-buttons .btn-apple {
            background: #000;
            color: white;
            width: 100%;
            margin-top: 10px;
        }
        .form-section .link {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            margin-top: 0;
        }
        .form-section .link1 {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            display: block;
            text-align: center;
            margin-top: 15px;
            font-weight: 500;
        }
        .form-section .link1 span{
            color: #000;
        }
        
        .image-section {
            flex: 1;
        
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 300px;
        }
        .image-section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .logo {
            position: relative;
            margin-bottom: 25px;
        }
        .logo img {
            height: 50px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="form-section">
        <div class="logo">
        <img src="images/cclogo.jpg" alt="Career Compass Logo">
        </div>
            <h1>Login</h1>
            <p>Login to access your Career Compaas account</p>
            <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
            <?php if (isset($_GET['success'])) { echo "<p class='text-success'>{$_GET['success']}</p>"; } ?>
            <br>
            <form method="POST">
                <div class="mb-3 position-relative">
            <div class="input-wrapper">
                <input type="email" class="form-control" id="email" name="email" required>
                <label for="email" class="form-label">Email</label>
            </div>
        </div>
        <div class="mb-3 position-relative">
            <div class="input-wrapper">
                <input type="password" class="form-control" id="password" name="password" required>
                <label for="password" class="form-label">Password</label>
                <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePassword()">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                </span>
            </div>
        </div>

            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="forgot_password.php" class="link">Forgot Password</a>
            </div>
                
                <button type="submit" class="btn btn-submit">Login</button>
                <a href="register.php" class="link1"><span>Don’t have an account?</span> Sign up</a>
                <br>
                <p class="text-center mt-3 mb-3" style="color: #6c757d; font-size: 14px;">Or login with</p>
                <div class="social-buttons">
                    <button type="button" class="btn btn-facebook"><i class="fab fa-facebook-f"></i></button>
                    <button type="button" class="btn btn-google"><i class="fab fa-google"></i></button>
                    <button type="button" class="btn btn-apple"><i class="fab fa-apple"></i></button>
                </div>
                
            </form>
        </div>
        <div class="image-section">
            <img src="assets/img/login img.jpg" alt="Login Image">
        </div>
    </div>

    <!-- Add this JavaScript before the closing </body> tag -->
<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const toggleIcon = document.getElementById("togglePasswordIcon");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>