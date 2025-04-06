<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

$matching_courses = [];
$age_error = "";
$show_results = false;

// Check if we need to scroll to #match after page reload
$scroll_to_match = false;
if (isset($_SESSION['scroll_to_match']) && $_SESSION['scroll_to_match'] === true) {
    $scroll_to_match = true;
    unset($_SESSION['scroll_to_match']); // Clear the flag after using it
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
    $education_level = isset($_POST['education_level']) ? $_POST['education_level'] : '';
    $stream = isset($_POST['stream']) ? $_POST['stream'] : '';
    $result = isset($_POST['result']) ? $_POST['result'] : '';
    $higher_education = isset($_POST['higher_education']) ? $_POST['higher_education'] : '';
    $field = isset($_POST['field']) ? $_POST['field'] : '';
    $qualification_level = isset($_POST['qualification_level']) ? $_POST['qualification_level'] : '';
    $study_mode = isset($_POST['study_mode']) ? $_POST['study_mode'] : '';

    // Validate age (16 <= age <= 26)
    if ($age < 16 || $age > 26) {
        $age_error = "Age must be between 16 and 26.";
    } else {
        // Prepare the query to match courses
        $query = "SELECT course_id, course_name, icon FROM course_details WHERE 
                  education_level = ? AND 
                  (stream = ? OR stream = 'All') AND 
                  result = ? AND 
                  higher_education = ? AND 
                  field = ? AND 
                  qualification_level = ? AND 
                  study_mode = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $education_level, $stream, $result, $higher_education, $field, $qualification_level, $study_mode);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $matching_courses[] = $row;
        }

        $stmt->close();
        $show_results = true;

        // Set session flag to scroll to #match after reload
        $_SESSION['scroll_to_match'] = true;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Path - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
        }
        /* CP 1 - Cover Section */
        .cover-section {
            padding: 20px 0;
            background: url('images/career-path-cover-image.jpg') no-repeat center center/cover;
            color: #333;
            position: relative;
        }
        .cover-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
        }
        .cover-section .container {
            position: relative;
        }
        .cover-section h2 {
            font-size: 52px;
            font-weight: 600;
            margin-top: 50px;
            margin-bottom: 20px;
        }
        .cover-section h2 span{
            color: #0057D9;
        }
        .cover-section p {
            color: #6c757d;
            font-size: 16px;
        }

        /* CP 2 - Career Path Form Section */
        .form-section {
            padding: 60px 0;
            background: #F5F7FA;
            justify-content: center;
            align-items: center;
        }
        .form-section .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        .form-section h2 {
            font-size: 36px;
            font-weight: 600;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .form-section .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 600px;
        }
        .form-section .form-label {
            font-weight: 500;
            color: #333;
        }
        .form-section .form-control,
        .form-section .form-select {
            border-radius: 5px;
            border: 1px solid #ced4da;
            font-size: 14px;
            padding: 10px;
        }
        .form-section .form-control:focus,
        .form-section .form-select:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }
        .form-section .btn-submit {
            background: #FFC107;
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-weight: 500;
            width: 100%;
            transition: background 0.3s;
            margin-top: 20px;
        }
        .form-section .btn-submit:hover {
            background: #e0a800;
        }
        .form-section .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        /* CP 3 - Matching Courses Section */
        .courses-section {
            padding: 80px 0;
            background: white;
        }
        .courses-section h2 {
            font-size: 52px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }
        .courses-section h2 span {
            color: #0057D9;
        }
        .courses-section p {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 40px;
        }
        .courses-section .image-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .courses-section .image-container img {
            width: 130%;
            position: relative;
        }
        .match{
            background-color:rgb(233, 236, 240);
            padding: 20px;
            border-radius: 25px;
        }
        .courses-section .course-list {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 15px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .courses-section .course-list:hover {
            transform: translateY(-5px);
        }
        .courses-section .course-list img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }
        .courses-section .course-list h5 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .courses-section h2 {
                font-size: 28px;
            }
            .courses-section p {
                font-size: 14px;
            }
            .courses-section .image-container {
                margin-bottom: 30px;
            }
            .courses-section .image-container img {
                max-width: 300px;
            }
            .courses-section .course-list {
                padding: 10px;
            }
            .courses-section .course-list img {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }
            .courses-section .course-list h5 {
                font-size: 14px;
            }
            .courses-section .image-container .circle {
                left: -100px;
                width: 350px;
                height: 100%;
                border-radius: 50%;
                z-index: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- CP 1: Cover Section -->
    <section class="cover-section">
        <div class="container">
        <div class="coverimg text-center">
            <img src="assets/img/cp cover.jpg" alt="Cover Image" class="img-fluid">
        </div>
            <h2 class="text-center"><span>Career</span> Path</h2>
            <p class="text-center">We analyze your academic background, interests, and career goals to suggest the most suitable university or technical college <br>courses. Our goal is to help you make informed decisions.</p>
        </div>
    </section>

    <!-- CP 2: Career Path Form Section -->
    <section class="form-section">
        <div class="container">
            
                    <div class="form-container">
                        <h2 class="text-center">Find Your Career Path</h2>
                        <form method="POST" id="careerForm">
                            <div class="mb-3">
                                <label for="age" class="form-label">Age:</label>
                                <input type="number" class="form-control" id="age" name="age" value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>" required>
                                <?php if ($age_error) { echo "<p class='error'>$age_error</p>"; } ?>
                            </div>
                            <div class="mb-3">
                                <label for="education_level" class="form-label">Education Level:</label>
                                <select class="form-select" id="education_level" name="education_level" required>
                                    <option value="">Select Education Level</option>
                                    <option value="OL" <?php echo (isset($_POST['education_level']) && $_POST['education_level'] == 'OL') ? 'selected' : ''; ?>>OL</option>
                                    <option value="AL" <?php echo (isset($_POST['education_level']) && $_POST['education_level'] == 'AL') ? 'selected' : ''; ?>>AL</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="stream" class="form-label">A/L Stream:</label>
                                <select class="form-select" id="stream" name="stream" required>
                                    <option value="">Select Stream</option>
                                    <option value="Technology" <?php echo (isset($_POST['stream']) && $_POST['stream'] == 'Technology') ? 'selected' : ''; ?>>Technology</option>
                                    <option value="Science" <?php echo (isset($_POST['stream']) && $_POST['stream'] == 'Science') ? 'selected' : ''; ?>>Science</option>
                                    <option value="Commerce" <?php echo (isset($_POST['stream']) && $_POST['stream'] == 'Commerce') ? 'selected' : ''; ?>>Commerce</option>
                                    <option value="Art" <?php echo (isset($_POST['stream']) && $_POST['stream'] == 'Art') ? 'selected' : ''; ?>>Art</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="result" class="form-label">A/L Pass or Fail:</label>
                                <select class="form-select" id="result" name="result" required>
                                    <option value="">Select Result</option>
                                    <option value="Pass" <?php echo (isset($_POST['result']) && $_POST['result'] == 'Pass') ? 'selected' : ''; ?>>Pass</option>
                                    <option value="Fail" <?php echo (isset($_POST['result']) && $_POST['result'] == 'Fail') ? 'selected' : ''; ?>>Fail</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="higher_education" class="form-label">Do you prefer:</label>
                                <select class="form-select" id="higher_education" name="higher_education" required>
                                    <option value="">Select Preference</option>
                                    <option value="University" <?php echo (isset($_POST['higher_education']) && $_POST['higher_education'] == 'University') ? 'selected' : ''; ?>>University</option>
                                    <option value="Vocational" <?php echo (isset($_POST['higher_education']) && $_POST['higher_education'] == 'Vocational') ? 'selected' : ''; ?>>Vocational</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="field" class="form-label">Preferred Career Field:</label>
                                <select class="form-select" id="field" name="field" required>
                                    <option value="">Select Field</option>
                                    <option value="IT" <?php echo (isset($_POST['field']) && $_POST['field'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                                    <option value="Engineering" <?php echo (isset($_POST['field']) && $_POST['field'] == 'Engineering') ? 'selected' : ''; ?>>Engineering</option>
                                    <option value="Management" <?php echo (isset($_POST['field']) && $_POST['field'] == 'Management') ? 'selected' : ''; ?>>Management</option>
                                    <option value="Language" <?php echo (isset($_POST['field']) && $_POST['field'] == 'Language') ? 'selected' : ''; ?>>Language</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qualification_level" class="form-label">Preferred Qualification Level:</label>
                                <select class="form-select" id="qualification_level" name="qualification_level" required>
                                    <option value="">Select Qualification Level</option>
                                    <option value="Diploma" <?php echo (isset($_POST['qualification_level']) && $_POST['qualification_level'] == 'Diploma') ? 'selected' : ''; ?>>Diploma</option>
                                    <option value="Degree" <?php echo (isset($_POST['qualification_level']) && $_POST['qualification_level'] == 'Degree') ? 'selected' : ''; ?>>Degree</option>
                                    <option value="Certificate" <?php echo (isset($_POST['qualification_level']) && $_POST['qualification_level'] == 'Certificate') ? 'selected' : ''; ?>>Certificate</option>
                                    <option value="HND" <?php echo (isset($_POST['qualification_level']) && $_POST['qualification_level'] == 'HND') ? 'selected' : ''; ?>>HND</option>
                                    <option value="Foundation" <?php echo (isset($_POST['qualification_level']) && $_POST['qualification_level'] == 'Foundation') ? 'selected' : ''; ?>>Foundation</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="study_mode" class="form-label">Study Mode:</label>
                                <select class="form-select" id="study_mode" name="study_mode" required>
                                    <option value="">Select Study Mode</option>
                                    <option value="Full time" <?php echo (isset($_POST['study_mode']) && $_POST['study_mode'] == 'Full time') ? 'selected' : ''; ?>>Full time</option>
                                    <option value="Part time" <?php echo (isset($_POST['study_mode']) && $_POST['study_mode'] == 'Part time') ? 'selected' : ''; ?>>Part time</option>
                                    <option value="Online" <?php echo (isset($_POST['study_mode']) && $_POST['study_mode'] == 'Online') ? 'selected' : ''; ?>>Online</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-submit" >Find My Career Path</button>
                        </form>
                    </div>
                </div>
    </section>

    <!-- CP 3: Matching Courses Section -->
    <section class="courses-section" id="match">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1 order-2">
                    <div class="image-container">
                        <img src="assets/img/career-path-image.png" alt="Career Path Image">
                    </div>
                </div>
                <div class="col-md-6 order-md-2 order-1">
                <h2 class="text-center"><span>Customized</span> Career <br>Guidance</h2>
                <p class="text-center">The system recommends a career path based on student inputs and suggests <br>relevant courses accordingly.</p>
                <div class="match">
                    <?php if ($show_results && !empty($matching_courses)) { ?>
                        <?php foreach ($matching_courses as $course) { ?>
                            <a href="course_details.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>" style="text-decoration: none; color: inherit;">
                                <div class="course-list d-flex align-items-center">
                                    <img src="images/<?php echo htmlspecialchars($course['icon']); ?>" alt="<?php echo htmlspecialchars($course['course_name']); ?>">
                                    <h5><?php echo htmlspecialchars($course['course_name']); ?></h5>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } elseif ($show_results && empty($matching_courses)) { ?>
                        <p>No matching courses found. Please adjust your inputs and try again.</p>
                    <?php } else { ?>
                        <p>Please submit the form to see your matching courses.</p>
                    <?php } ?>
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('careerForm').addEventListener('submit', function(event) {
        const ageInput = document.getElementById('age');
        const age = parseInt(ageInput.value);

        // Client-side age validation
        if (age < 16 || age > 26) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                icon: 'error',
                title: 'Invalid Age',
                text: 'Age must be between 16 and 26.',
                confirmButtonColor: '#007BFF',
                confirmButtonText: 'OK'
            });
        }
    });

    // Scroll to #match on page load if the form was submitted successfully
    window.onload = function() {
        <?php if ($scroll_to_match) { ?>
            document.getElementById('match').scrollIntoView({ behavior: 'smooth' });
        <?php } ?>
    };
</script>
</body>
</html>