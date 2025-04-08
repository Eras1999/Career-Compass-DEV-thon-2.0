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
$stmt = $conn->prepare("DELETE FROM Blog WHERE blog_id = ?");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$stmt->close();

header("Location: blog_details.php");
$conn->close();
?>