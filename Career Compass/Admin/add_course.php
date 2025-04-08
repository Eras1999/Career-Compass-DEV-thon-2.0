<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "career_compass");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $education_level = $_POST['education_level'];
    $stream = $_POST['stream'];
    $result = $_POST['result'];
    $higher_education = $_POST['higher_education'];
    $field = $_POST['field'];
    $qualification_level = $_POST['qualification_level'];
    $study_mode = $_POST['study_mode'];
    $institute_name = $_POST['institute_name'];
    $icon = $_FILES['icon']['name'];
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $career_opportunity = $_POST['career_opportunity'];
    $what_you_learn = $_POST['what_you_learn'];
    $module_semester1 = $_POST['module_semester1'];
    $module_semester2 = $_POST['module_semester2'];
    $module_semester3 = $_POST['module_semester3'];
    $module_semester4 = $_POST['module_semester4'];
    $module_semester5 = $_POST['module_semester5'];
    $module_semester6 = $_POST['module_semester6'];
    $module_semester7 = $_POST['module_semester7'];
    $module_semester8 = $_POST['module_semester8'];

    // Handle icon upload
    $target = "../images/" . basename($icon);
    if (move_uploaded_file($_FILES['icon']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO Course_Details (education_level, stream, result, higher_education, field, qualification_level, study_mode, institute_name, icon, course_name, course_description, career_opportunity, what_you_learn, module_semester1, module_semester2, module_semester3, module_semester4, module_semester5, module_semester6, module_semester7, module_semester8) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssssssssssss", $education_level, $stream, $result, $higher_education, $field, $qualification_level, $study_mode, $institute_name, $icon, $course_name, $course_description, $career_opportunity, $what_you_learn, $module_semester1, $module_semester2, $module_semester3, $module_semester4, $module_semester5, $module_semester6, $module_semester7, $module_semester8);
        $stmt->execute();
        $stmt->close();
        header("Location: course_details.php");
    } else {
        echo "Failed to upload icon.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course - Career Compass</title>
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

        /* Form */
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
    <!-- Header -->
    <div class="header">
        <img src="../images/cclogo.jpg" alt="Career Compass Logo">
        <div class="admin-info">
            <span>ssadmin</span>
            <a href="logout.php" class="btn btn-sm">Logout</a>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="users_details.php"><i class="fas fa-users"></i> Users Details</a>
        <a href="course_details.php" class="active"><i class="fas fa-book"></i> Course Details</a>
        <a href="contact_details.php"><i class="fas fa-envelope"></i> Contact Details</a>
        <a href="blog_details.php"><i class="fas fa-blog"></i> Blog Details</a>
        <a href="feedback_details.php"><i class="fas fa-comment"></i> Feedback Details</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Add New Course</h2>
        <p>Create a new course here.</p>
        <div class="form-container">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="education_level" class="form-label">Education Level</label>
                        <select class="form-control" id="education_level" name="education_level" required>
                            <option value="AL">AL</option>
                            <option value="OL">OL</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stream" class="form-label">Stream</label>
                        <select class="form-control" id="stream" name="stream" required>
                            <option value="Science">Science</option>
                            <option value="Technology">Technology</option>
                            <option value="Commerce">Commerce</option>
                            <option value="Art">Art</option>
                            <option value="All">All</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="result" class="form-label">Result</label>
                        <select class="form-control" id="result" name="result" required>
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="higher_education" class="form-label">Higher Education</label>
                        <select class="form-control" id="higher_education" name="higher_education" required>
                            <option value="University">University</option>
                            <option value="Vocational">Vocational</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="field" class="form-label">Field</label>
                        <select class="form-control" id="field" name="field" required>
                            <option value="IT">IT</option>
                            <option value="Management">Management</option>
                            <option value="Engineering">Engineering</option>
                            <option value="Language">Language</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qualification_level" class="form-label">Qualification Level</label>
                        <select class="form-control" id="qualification_level" name="qualification_level" required>
                            <option value="Degree">Degree</option>
                            <option value="Diploma">Diploma</option>
                            <option value="HND">HND</option>
                            <option value="Certificate">Certificate</option>
                            <option value="Foundation">Foundation</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="study_mode" class="form-label">Study Mode</label>
                        <select class="form-control" id="study_mode" name="study_mode" required>
                            <option value="Full time">Full time</option>
                            <option value="Part time">Part time</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="institute_name" class="form-label">Institute Name</label>
                        <input type="text" class="form-control" id="institute_name" name="institute_name" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="file" class="form-control" id="icon" name="icon" required>
                </div>
                <div class="mb-3">
                    <label for="course_name" class="form-label">Course Name</label>
                    <input type="text" class="form-control" id="course_name" name="course_name" required>
                </div>
                <div class="mb-3">
                    <label for="course_description" class="form-label">Course Description</label>
                    <textarea class="form-control" id="course_description" name="course_description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="career_opportunity" class="form-label">Career Opportunity</label>
                    <textarea class="form-control" id="career_opportunity" name="career_opportunity" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="what_you_learn" class="form-label">What You Learn</label>
                    <textarea class="form-control" id="what_you_learn" name="what_you_learn" rows="3" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="module_semester1" class="form-label">Module Semester 1</label>
                        <textarea class="form-control" id="module_semester1" name="module_semester1" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="module_semester2" class="form-label">Module Semester 2</label>
                        <textarea class="form-control" id="module_semester2" name="module_semester2" rows="2"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="module_semester3" class="form-label">Module Semester 3</label>
                        <textarea class="form-control" id="module_semester3" name="module_semester3" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="module_semester4" class="form-label">Module Semester 4</label>
                        <textarea class="form-control" id="module_semester4" name="module_semester4" rows="2"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="module_semester5" class="form-label">Module Semester 5</label>
                        <textarea class="form-control" id="module_semester5" name="module_semester5" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="module_semester6" class="form-label">Module Semester 6</label>
                        <textarea class="form-control" id="module_semester6" name="module_semester6" rows="2"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="module_semester7" class="form-label">Module Semester 7</label>
                        <textarea class="form-control" id="module_semester7" name="module_semester7" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="module_semester8" class="form-label">Module Semester 8</label>
                        <textarea class="form-control" id="module_semester8" name="module_semester8" rows="2"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-submit">Add Course</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>