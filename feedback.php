<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $position = $_POST['position'];
    $message = $_POST['message'];
    $image_path = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $max_size) {
            $upload_dir = 'images/';

            // Create images directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $image_name = uniqid() . '_' . $_FILES['image']['name'];
            $image_path = $upload_dir . $image_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                try {
                    $sql = "INSERT INTO feedback (full_name, position, image, message, created_at, approved) 
                            VALUES (?, ?, ?, ?, NOW(), 0)";
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $full_name, $position, $image_path, $message);
                    $stmt->execute();
                    $stmt->close();
                    
                    $success = "Feedback submitted successfully!";
                } catch (mysqli_sql_exception $e) {
                    $error = "Database error: " . $e->getMessage();
                    // Remove uploaded file if database insertion fails
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }
            } else {
                $error = "Failed to upload image";
            }
        } else {
            $error = "Invalid image file. Allowed types: JPG, PNG, GIF. Max size: 5MB";
        }
    } else {
        // Handle case with no image
        try {
            $sql = "INSERT INTO feedback (full_name, position, image, message, created_at, approved) 
                    VALUES (?, ?, ?, ?, NOW(), 0)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $full_name, $position, $image_path, $message);
            $stmt->execute();
            $stmt->close();
            
            $success = "Feedback submitted successfully!";
        } catch (mysqli_sql_exception $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
        }
        /* Feedback Form Section */
        .feedback-section {
            padding: 80px 0;
            background: white;
        }
        .feedback-section .container {
            max-width: 800px;
        }
        .feedback-section h1 {
            font-size: 36px;
            font-weight: 700;
            color: #007BFF;
            text-align: center;
            margin-bottom: 20px;
        }
        .feedback-section p {
            font-size: 16px;
            color: #6c757d;
            text-align: center;
            margin-bottom: 40px;
        }
        .feedback-section .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .feedback-section .form-label {
            font-weight: 500;
            color: #333;
        }
        .feedback-section .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            font-size: 14px;
        }
        .feedback-section .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }
        .feedback-section textarea {
            resize: vertical;
        }
        .feedback-section .btn-submit {
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 500;
            transition: background 0.3s;
            display: block;
            margin: 0 auto;
        }
        .feedback-section .btn-submit:hover {
            background: #0056b3;
        }
        .feedback-section .success {
            color: #28a745;
            text-align: center;
            margin-bottom: 20px;
        }
        .feedback-section .error {
            color: #dc3545;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .feedback-section h1 {
                font-size: 28px;
            }
            .feedback-section p {
                font-size: 14px;
            }
            .feedback-section .form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Feedback Form Section -->
    <section class="feedback-section">
        <div class="container">
            <h1>Submit Feedback</h1>
            <p>We value your feedback! Share your thoughts with us to help improve our services.</p>
            <div class="form-container">
                <?php if ($success) { ?>
                    <div class="success"><?php echo htmlspecialchars($success); ?></div>
                <?php } ?>
                <?php if ($error) { ?>
                    <div class="error"><?php echo htmlspecialchars($error); ?></div>
                <?php } ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image (optional)</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/png,image/gif">
                        <small class="form-text text-muted">Allowed types: JPG, PNG, GIF. Max size: 5MB</small>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit">Submit Feedback</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>