<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

// Get the blog ID from the URL
$blog_id = isset($_GET['blog_id']) ? intval($_GET['blog_id']) : 0;

// Fetch the blog post
$blog = null;
if ($blog_id > 0) {
    // Increment the views count
    $conn->query("UPDATE blog SET views = views + 1 WHERE id = $blog_id");

    // Fetch the blog post details
    $query = "SELECT * FROM blog WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Details - Career Compass</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
        }

        /* Blog Details Section */
        .blog-details-section {
            padding: 80px 0;
            background: white;
        }

        .blog-details-section .container {
            max-width: 800px;
        }

        .blog-details-section .blog-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .blog-details-section .blog-meta {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .blog-details-section .blog-title {
            font-size: 36px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .blog-details-section .blog-content {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .blog-details-section .back-btn {
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .blog-details-section .back-btn:hover {
            background: #0056b3;
            color: #fff;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .blog-details-section .blog-image {
                height: 250px;
            }

            .blog-details-section .blog-title {
                font-size: 28px;
            }

            .blog-details-section .blog-content {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Blog Details Section -->
    <section class="blog-details-section">
        <div class="container">
            <?php if ($blog) { ?>
                <img src="images/<?php echo htmlspecialchars($blog['image']); ?>" class="blog-image"
                    alt="<?php echo htmlspecialchars($blog['title']); ?>">
                <div class="blog-meta">
                    <span><?php echo date('d-May-Y', strtotime($blog['created_at'])); ?></span> |
                    <span>Views: <?php echo htmlspecialchars($blog['views']); ?></span>
                </div>
                <h1 class="blog-title"><?php echo htmlspecialchars($blog['title']); ?></h1>
                <div class="blog-content">
                    <?php echo nl2br(htmlspecialchars($blog['content'])); ?>
                </div>
                <a href="blog.php" class="back-btn">Back to Blog</a>
            <?php } else { ?>
                <p>Blog post not found. <a href="blog.php">Go back to Blog</a></p>
            <?php } ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>