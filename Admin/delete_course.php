<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "career_compass");

if (!isset($_GET['id'])) {
    header("Location: course_details.php");
    exit;
}

$course_id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM Course_Details WHERE course_id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$stmt->close();

header("Location: course_details.php");
$conn->close();
?>