<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "career_compass");

if (!isset($_GET['id'])) {
    header("Location: blog_details.php");
    exit;
}

$blog_id = $_GET['id'];
$result = $conn->query("SELECT * FROM blog WHERE id = $blog_id");
$blog = $result->fetch_assoc();

if (!$blog) {
    header("Location: blog_details.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $is_popular = isset($_POST['is_popular']) ? 1 : 0;

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $blog['image'];
    }

    $stmt = $conn->prepare("UPDATE blog SET title = ?, content = ?, image = ?, is_popular = ? WHERE id = ?");
    $stmt->bind_param("sssii", $title, $content, $image, $is_popular, $blog_id);
    $stmt->execute();
    $stmt->close();
    header("Location: blog_details.php");
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog - Career Compass</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
        }
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .header img {
            height: 40px;
        }
        .header .admin-info {
            display: flex;
            align-items: center;
        }
        .header .admin-info span {
            margin-right: 15px;
            font-weight: 500;
            color: #333;
        }
        .header .admin-info .btn {
            background: #007BFF;
            color: white;
            border: none;
        }
        .header .admin-info .btn:hover {
            background: #FFC107;
        }
        .sidebar {
            width: 220px;
            background: white;
            height: 100vh;
            position: fixed;
            top: 60px;
            left: 0;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }
        .sidebar a {
            color: #6c757d;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
        }
        .sidebar a i {
            margin-right: 10px;
            color: #007BFF;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #e9ecef;
            color: #007BFF;
        }
        .content {
            margin-left: 220px;
            margin-top: 60px;
            padding: 30px;
        }
        .content h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }
        .content p {
            color: #6c757d;
            font-size: 14px;
        }
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            max-width: 800px;
        }
        .form-container .form-label {
            font-weight: 500;
            color: #333;
        }
        .form-container .form-control, .form-container .form-control-file {
            border-radius: 5px;
            border: 1px solid #ced4da;
            font-size: 14px;
        }
        .form-container .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }
        .form-container textarea {
            resize: vertical;
        }
        .form-container .btn-submit {
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background 0.3s;
        }
        .form-container .btn-submit:hover {
            background: #FFC107;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="../images/cclogo.jpg" alt="Career Compass Logo">
        <div class="admin-info">
            <span>ssadmin</span>
            <a href="logout.php" class="btn btn-sm">Logout</a>
        </div>
    </div>

    <div class="sidebar">
        <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="users_details.php"><i class="fas fa-users"></i> Users Details</a>
        <a href="course_details.php"><i class="fas fa-book"></i> Course Details</a>
        <a href="contact_details.php"><i class="fas fa-envelope"></i> Contact Details</a>
        <a href="blog_details.php" class="active"><i class="fas fa-blog"></i> Blog Details</a>
        <a href="feedback_details.php"><i class="fas fa-comment"></i> Feedback Details</a>
    </div>

    <div class="content">
        <h2>Edit Blog</h2>
        <p>Update the blog post here.</p>
        <div class="form-container">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image (Leave blank to keep current)</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <small>Current image: <?php echo htmlspecialchars($blog['image']); ?></small>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_popular" name="is_popular" <?php echo $blog['is_popular'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="is_popular">Mark as Popular</label>
                </div>
                <button type="submit" class="btn btn-submit">Update Blog</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>