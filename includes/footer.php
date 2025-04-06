<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .footer {
            background: #f8f9fa;
            padding: 40px 0;
            border-top: 1px solid #e0e0e0;
        }
        .footer .logo img {
            height: 40px;
            margin-bottom: 10px;
        }
        .footer p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 0;
        }
        .footer h5 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }
        .footer ul {
            list-style: none;
            padding: 0;
        }
        .footer ul li {
            margin-bottom: 10px;
        }
        .footer ul li a {
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }
        .footer ul li a:hover {
            color: #007BFF;
        }
        .footer .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }
        .footer .social-icons a {
            color: #6c757d;
            font-size: 20px;
        }
        .footer .social-icons a:hover {
            color: #007BFF;
        }
        .footer .bottom-text {
            text-align: center;
            color: #6c757d;
            font-size: 12px;
            margin-top: 20px;
        }
        .footer .bottom-text a {
            color: #007BFF;
            text-decoration: none;
        }
        .footer .bottom-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="logo">
                        <img src="images/cclogo.jpg" alt="Career Compass Logo">
                    </div>
                    <p>Career Compass is a user-friendly, tailored system that helps students discover personalized career paths based on their qualifications and interests.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="career_path.php">Career Path</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="contact.php">Help & Support</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>About</h5>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="terms.php">Terms of Service</a></li>
                        <li><a href="privacy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Main Street, Colombo 07, Sri Lanka</p>
                    <p><i class="fas fa-phone"></i> +94 112 345 678</p>
                    <p><i class="fas fa-envelope"></i> info@careercompass.lk</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="bottom-text">
                <p>&copy; 2025 Career Compass. All Rights Reserved. Website by <a href="#">Syntax Studio</a></p>
                <p><a href="terms.php">Terms of Service</a> | <a href="privacy.php">Privacy Policy</a></p>
            </div>
        </div>
    </footer>
</body>
</html>