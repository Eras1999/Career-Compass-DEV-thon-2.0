<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }
        .navbar .navbar-brand img {
            height: 40px;
        }
        .navbar .nav-link {
            color: #333;
            font-weight: 500;
            font-size: 16px;
            margin-right: 20px;
        }
        .navbar .nav-link:hover {
            color: #007BFF;
        }
        .navbar .btn-login {
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 20px;
            font-weight: 500;
            margin-right: 10px;
        }
        .navbar .btn-login:hover {
            background: #0056b3;
            color: #fff;
        }
        .navbar .btn-signup {
            background: transparent;
            color: #007BFF;
            border: 1px solid #007BFF;
            border-radius: 5px;
            padding: 8px 20px;
            font-weight: 500;
        }
        .navbar .btn-signup:hover {
            background: #007BFF;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/cclogo.jpg" alt="Career Compass Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="career_path.php">Career Path</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="course.php">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_us.php">Contact</a>
                    </li>
                </ul>
                <div>
                    <a href="login.php" class="btn btn-login">Login</a>
                    <a href="register.php" class="btn btn-signup">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>