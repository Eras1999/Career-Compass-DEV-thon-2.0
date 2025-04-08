<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "career_compass");
$admin_name = "ssadmin"; // Replace with dynamic admin name if needed
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Career Compass</title>
    <link href="assets/img/logo.png" rel="icon">
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

        .sidebar a:hover,
        .sidebar a.active {
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

        /* Cards */
        .dashboard-cards .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            background: white;
            transition: transform 0.3s;
        }

        .dashboard-cards .card:hover {
            transform: translateY(-5px);
        }

        .dashboard-cards .card h5 {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .dashboard-cards .card h3 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .dashboard-cards .card p {
            font-size: 12px;
            color: #28a745;
            margin: 0;
        }

        .dashboard-cards .card i {
            font-size: 24px;
            color: #007BFF;
        }

        /* Placeholder Sections */
        .placeholder-section {
            margin-top: 30px;
        }

        .placeholder-section h4 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .placeholder-section .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            height: 200px;
        }

        .calendar .card {
            height: auto;
            padding: 20px;
        }

        .calendar table {
            width: 100%;
            text-align: center;
        }

        .calendar th,
        .calendar td {
            padding: 10px;
            font-size: 14px;
        }

        .calendar th {
            color: #6c757d;
        }

        .calendar td {
            color: #333;
        }

        .calendar td.today {
            background: #007BFF;
            color: white;
            border-radius: 50%;
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
        <a href="admin_dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="users_details.php"><i class="fas fa-users"></i> Users Details</a>
        <a href="course_details.php"><i class="fas fa-book"></i> Course Details</a>
        <a href="contact_details.php"><i class="fas fa-envelope"></i> Contact Details</a>
        <a href="blog_details.php"><i class="fas fa-blog"></i> Blog Details</a>
        <a href="feedback_details.php"><i class="fas fa-comment"></i> Feedback Details</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Welcome back, <?php echo $admin_name; ?>!</h2>
        <p>Here's what's happening with your platform today.</p>

        <!-- Dashboard Cards -->
        <div class="row dashboard-cards mt-4">
            <?php
            $counts = [
                ["title" => "Total Users", "count" => $conn->query("SELECT COUNT(*) FROM Users")->fetch_row()[0], "icon" => "fas fa-users", "change" => "+12.3%"],
                ["title" => "Total Courses", "count" => $conn->query("SELECT COUNT(*) FROM Course_Details")->fetch_row()[0], "icon" => "fas fa-book", "change" => "+8.7%"],
                ["title" => "Total Contacts", "count" => $conn->query("SELECT COUNT(*) FROM Contact")->fetch_row()[0], "icon" => "fas fa-envelope", "change" => "+5.2%"],
                ["title" => "Total Blogs", "count" => $conn->query("SELECT COUNT(*) FROM Blog")->fetch_row()[0], "icon" => "fas fa-blog", "change" => "+3.6%"],
                ["title" => "Total Feedbacks", "count" => $conn->query("SELECT COUNT(*) FROM Feedback")->fetch_row()[0], "icon" => "fas fa-comment", "change" => "+1.8%"]
            ];
            foreach ($counts as $item) {
                echo "
                <div class='col-md-3 mb-4'>
                    <div class='card'>
                        <div class='d-flex justify-content-between align-items-center'>
                            <div>
                                <h5>{$item['title']}</h5>
                                <h3>{$item['count']}</h3>
                                <p><i class='fas fa-arrow-up me-1'></i> {$item['change']} from last month</p>
                            </div>
                            <i class='{$item['icon']}'></i>
                        </div>
                    </div>
                </div>";
            }
            $conn->close();
            ?>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>