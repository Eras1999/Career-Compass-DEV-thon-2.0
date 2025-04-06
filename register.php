<?php
$conn = new mysqli("localhost", "root", "", "career_compass");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO Users (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $password);
    if ($stmt->execute()) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Good job!",
                    text: "Register successful!",
                    icon: "success"
                }).then(function() {
                    window.location.href = "login.php";
                });
            });
        </script>';
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Registration failed. Email might already be in use."
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
    <title>Register - Career Compass</title>
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
            overflow: auto;
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
      
        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            font-size: 14px;
            padding: 10px 40px 10px 10px; 
            height: 50px; 
            background: transparent; 
        }

        .form-label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 14px;
            color: #6c757d;
            background: white; /* Background to cover the border */
            padding: 0 5px;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        /* When the input is focused or has a value, move the label to the border */
        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: 0;
            font-size: 12px;
            color:rgb(0, 0, 0); /* Match the focus color */
        }

        /* Ensure the eye icon stays in place */
        .position-absolute {
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Remove padding-right for non-password fields */
        .input-wrapper input[type="text"],
        .input-wrapper input[type="email"] {
            padding-right: 10px; /* No eye icon, so less padding */
        }
        .form-section .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }
        .form-section .input-group {
            position: relative;
        }
        .form-section .input-group .form-control {
            padding-right: 40px;
        }
        .form-section .input-group .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        .form-section .form-check {
            margin-top: 10px;
        }
        .form-section .form-check-label {
            font-size: 14px;
            color: #333;FF8682
        }
        .form-section .form-check-label span{
            color: #FF8682
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
            width: 100%;
            margin-top: 20px;
            justify-content: space-between;
        }
        .form-section .social-buttons .btn {
            flex: 1;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }
        .form-section .social-buttons .btn-facebook {
            background: #3b5998;
            color: white;
            width: 100%;
        }
        .form-section .social-buttons .btn-facebook:hover {
            background: #2d4373;
        }
        .form-section .social-buttons .btn-google {
            background: #db4437;
            color: white;
            width: 100%;
            margin-top: 10px;
        }
        .form-section .social-buttons .btn-google:hover {
            background: #c1352b;
        }
        .form-section .social-buttons .btn-apple {
            background: #000;
            color: white;
            width: 100%;
            margin-top: 10px;
        }
        .form-section .social-buttons .btn-apple:hover {
            background: #333;
        }
        .form-section .social-buttons .btn i {
            font-size: 20px;
        }
        .form-section .link {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            display: block;
            text-align: center;
            margin-top: 15px;
        }
        .form-section .link span{
            color:rgb(0, 0, 0);
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
            height: 80%;
            border-radius: 10px;
        }
        .logo {
            position: relative;
            margin-bottom: 30px;
            text-align: right; /* Align the logo to the right */
        }
        .logo img {
            height: 50px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="image-section">
            <img src="assets/img/register img.jpg" alt="Register Image">
        </div>
        <div class="form-section">
        <div class="logo">
        <img src="images/cclogo.jpg" alt="Career Compass Logo">
        </div>
            <h1>Register</h1>
            <p>Let’s get you all st up so you can access your Career Compaas account.</p>
            <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
            <br>
            <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3 position-relative">
                    <div class="input-wrapper">
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                        <label for="first_name" class="form-label">First Name</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3 position-relative">
                    <div class="input-wrapper">
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                        <label for="last_name" class="form-label">Last Name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3 position-relative">
                    <div class="input-wrapper">
                        <input type="email" class="form-control" id="email" name="email" required>
                        <label for="email" class="form-label">Email</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3 position-relative">
                    <div class="input-wrapper">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        <label for="phone_number" class="form-label">Phone Number</label>
                    </div>
                </div>
            </div>
            <div class="mb-3 position-relative">
                <div class="input-wrapper">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <label for="password" class="form-label">Password</label>
                    <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePassword()">
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3 position-relative">
                <div class="input-wrapper">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="toggleConfirmPassword()">
                        <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                    </span>
                </div>
            </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">I agree to all the <span>Terms</span> and <span>Privacy Policies</span></a></label>
                </div>
                <br>
                <button type="submit" class="btn btn-submit">Create account</button>
                <a href="login.php" class="link"><span>Already have an account?</span> Login</a>
                <br>
                <p class="text-center mt-3 mb-3" style="color: #6c757d; font-size: 14px;">Or Sign up with</p>
                <div class="social-buttons">
                    <button type="button" class="btn btn-facebook"><i class="fab fa-facebook-f"></i></button>
                    <button type="button" class="btn btn-google"><i class="fab fa-google"></i></button>
                    <button type="button" class="btn btn-apple"><i class="fab fa-apple"></i></button>
                </div>
                
            </form>
        </div>
    </div>

    <script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const toggleIcon = document.getElementById("togglePassword");
        
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

    function toggleConfirmPassword() {
        const confirmPasswordField = document.getElementById("confirm_password");
        const toggleIcon = document.getElementById("toggleConfirmPassword");
        
        if (confirmPasswordField.type === "password") {
            confirmPasswordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            confirmPasswordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>