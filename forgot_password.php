<?php
$conn = new mysqli("localhost", "root", "", "career_compass");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE Users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password, $email);
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $success = "Password updated successfully! Please login with your new password.";
    } else {
        $error = "Email not found.";
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
    <title>Forgot Password - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Work Sans', sans-serif;
            background: #f4f7fc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            align-items: center;
            max-width: 900px;
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
            padding: 10px; /* Simplified padding since there's no eye icon */
            height: 50px; /* Match the height from the screenshot */
            background: transparent; /* Ensure the background is transparent */
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
        .form-section .link {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            display: block;
            text-align: left;
            margin-top: 15px;
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
        }
        .logo {
            position: relative; 
            bottom: 25px;
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
    <a href="login.php" class="link">< Back to login</a> <br>
            <h2>Forgot your password?</h2>
            <p>Don’t worry, happens to all of us. Enter your email below to recover your password</p>
            <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
            <?php if (isset($success)) { echo "<p class='text-success'>$success</p>"; } ?>
            <br>
            <form method="POST">
            <div class="mb-3 position-relative">
                <div class="input-wrapper">
                    <input type="email" class="form-control" id="email" name="email" required>
                    <label for="email" class="form-label">Email</label>
                </div>
            </div>
                
                <button type="submit" class="btn btn-submit">Submit</button>
                
            </form>
        </div>
        <div class="image-section">
            <img src="assets/img/forgot img.jpg" alt="Forgot Password Image">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    </script>
</body>
</html>