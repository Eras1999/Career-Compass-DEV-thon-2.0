<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "career_compass");
$admin_name = "ssadmin";
$result = $conn->query("SELECT * FROM Contact");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
        }
        /* Header */
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

        /* Sidebar */
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

        /* Content */
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

        /* Table */
        .table {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .table thead {
            background: #007BFF;
            color: white;
        }
        .table thead th {
            font-weight: 500;
            padding: 15px;
        }
        .table tbody tr {
            transition: background 0.3s;
        }
        .table tbody tr:hover {
            background: #f8f9fa;
        }
        .table tbody td {
            padding: 15px;
            color: #333;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="../images/cclogo.jpg" alt="Career Compass Logo">
        <div class="admin-info">
            <span><?php echo $admin_name; ?></span>
            <a href="logout.php" class="btn btn-sm">Logout</a>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="users_details.php"><i class="fas fa-users"></i> Users Details</a>
        <a href="course_details.php"><i class="fas fa-book"></i> Course Details</a>
        <a href="contact_details.php" class="active"><i class="fas fa-envelope"></i> Contact Details</a>
        <a href="blog_details.php"><i class="fas fa-blog"></i> Blog Details</a>
        <a href="feedback_details.php"><i class="fas fa-comment"></i> Feedback Details</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Contact Details</h2>
        <p>View all contact messages here.</p>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['contact_id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php } $conn->close(); ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>