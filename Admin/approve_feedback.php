<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "career_compass");
$id = $_GET['id'];
$conn->query("UPDATE Feedback SET approved = 1 WHERE feedback_id = $id");
header("Location: feedback_details.php");
$conn->close();
?>