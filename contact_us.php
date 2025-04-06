<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");
 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_contact'])) {
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
 
    $stmt = $conn->prepare("INSERT INTO contact (first_name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $first_name, $email, $message);
    $stmt->execute();
    $stmt->close();
 
    header("Location: contact_us.php?success=1");
    exit;
}
 
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter Tight', sans-serif;
            background: #f4f7fc;
        }
        .heading-section {
            padding: 80px 0;
            background: white;
            text-align: center;
        }
        .heading-section h1 {
            font-size: 48px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .heading-section h1 span {
            color: #007BFF;
        }
        .heading-section p {
            font-size: 16px;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.5;
        }
        .contact-form-section {
            padding: 60px 0;
            background: #f8f9fa;
        }
        .contact-form-section .illustration {
            max-width: 100%;
            height: auto;
        }
        .contact-form-section .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .contact-form-section .form-label {
            font-weight: 500;
            color: #333;
        }
        .contact-form-section .form-control {
            border-radius: 5px;
            border: 2px solid #e0e0e0;
            font-size: 14px;
        }
        .contact-form-section .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }
        .contact-form-section textarea {
            resize: vertical;
        }
        .contact-form-section .btn-submit {
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 500;
            transition: background 0.3s;
        }
        .contact-form-section .btn-submit:hover {
            background: #0056b3;
        }
        .contact-form-section .text-end {
            text-align: right;
        }
        .contact-details-section {
            padding: 60px 0;
            background: white;
        }
        .contact-details-section {
    padding: 30px 0;
    background: white;
}

.contact-info {
    text-align: right;
}

.contact-info p {
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.contact-info i {
    color: #007BFF;
    margin-right: 10px;
    font-size: 18px;
}

.social-icons {
    display: flex;
    gap: 15px;
}

.social-icons a {
    color: #007BFF;
    font-size: 24px;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #0056b3;
}

/* Newsletter Section */
.newsletter-section {
    padding: 60px 0;
    background: #FFC107;
    width: 84%;
    justify-content: center;
    align-items: center;
    margin-left: 8%;
}

.newsletter {
    text-align: center;
}

.newsletter h3 {
    font-size: 35px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.newsletter p {
    font-size: 16px;
    color: #333;
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.newsletter .input-group {
    display: flex;
    justify-content: center;
    max-width: 500px;
    margin: 0 auto;
}

.newsletter .form-control {
    background: #FFF3CD;
    border: none;
    border-radius: 50px 0 0 50px;
    padding: 12px 20px;
    font-size: 16px;
    color: #333;
    flex-grow: 1;
}

.newsletter .form-control::placeholder {
    color: #6c757d;
}

.newsletter .form-control:focus {
    box-shadow: none;
    outline: none;
}

.newsletter .btn-subscribe {
    background: white;
    color: #333;
    border: none;
    border-radius: 0 50px 50px 0;
    padding: 12px 30px;
    font-size: 16px;
    font-weight: 500;
    transition: background 0.3s, color 0.3s;
}

.newsletter .btn-subscribe:hover {
    background: #007BFF;
    color: white;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .contact-details-section {
        padding: 20px 0;
    }

    .contact-info {
        text-align: center;
        margin-bottom: 20px;
    }

    .contact-info p {
        justify-content: center;
        font-size: 14px;
    }

    .contact-info i {
        font-size: 16px;
        margin-right: 8px;
    }

    .social-icons {
        justify-content: center;
        gap: 12px;
    }

    .social-icons a {
        font-size: 20px;
    }

    .newsletter-section {
        padding: 40px 0;
    }

    .newsletter h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .newsletter p {
        font-size: 14px;
        margin-bottom: 20px;
    }

    .newsletter .input-group {
        flex-direction: column;
        max-width: 100%;
    }

    .newsletter .form-control {
        border-radius: 50px;
        margin-bottom: 10px;
        padding: 10px 15px;
        font-size: 14px;
    }

    .newsletter .btn-subscribe {
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .contact-info p {
        font-size: 12px;
    }

    .contact-info i {
        font-size: 14px;
        margin-right: 6px;
    }

    .social-icons a {
        font-size: 18px;
    }

    .newsletter h3 {
        font-size: 20px;
    }

    .newsletter p {
        font-size: 12px;
    }

    .newsletter .form-control {
        font-size: 12px;
        padding: 8px 12px;
    }

    .newsletter .btn-subscribe {
        font-size: 12px;
        padding: 8px 15px;
    }
}
    </style>
</head>
<body>
    <?php include 'includes/navigation.php'; ?>
 
    <section class="heading-section">
        <div class="container">
            <h1>Let's Get in <span>Touch!</span></h1>
            <p>Have a question or need assistance?Reach out<br> to us via email,<br>phone, or the contact form below.We're eager to<br> assist you.</p>
        </div>
    </section>
 
    <section class="contact-form-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="assets/img/contact-illustration.png" class="illustration" alt="Contact Illustration">
                </div>
                <div class="col-md-6">
                    <div class="form-container">
                        <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
                            <div class="alert alert-success" role="alert">
                                Your message has been sent successfully!
                            </div>
                        <?php } ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" name="submit_contact" class="btn btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Contact Details Section -->
<section class="contact-details-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-1">
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-telegram-plane"></i></a>
                </div>
            </div>
            <div class="col-md-6 order-md-2">
                <div class="contact-info">
                    <p><i class="fas fa-phone"></i> +94 112 123456</p>
                    <p><i class="fas fa-envelope"></i> contact@careercompass.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> No 123 Main Street, Colombo 07, Sri Lanka.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="newsletter">
                    <h3>Subscribe to our Newsletter</h3>
                    <p>Subscribe for Updates: Stay informed about the latest investor updates, financial results, and announcements by subscribing to our newsletter. </p>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="newsletter">
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                            <button type="submit" class="btn btn-subscribe">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    
</section>
 
    <?php include 'includes/footer.php'; ?>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>