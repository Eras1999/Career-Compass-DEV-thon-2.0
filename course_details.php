<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

// Get the course ID from the URL
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Fetch the selected course
$course = null;
if ($course_id > 0) {
    $query = "SELECT * FROM course_details WHERE course_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();
    $stmt->close();
}

// Fetch related courses (based on field or institute)
$related_courses = [];
if ($course) {
    $field = $course['field'];
    $institute_name = $course['institute_name'];
    $query = "SELECT course_id, course_name, institute_name, icon FROM course_details 
              WHERE (field = ? OR institute_name = ?) AND course_id != ? LIMIT 3";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $field, $institute_name, $course_id);
    $stmt->execute();
    $related_courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Function to truncate description
function truncateDescription($text, $word_limit = 100) {
    $words = explode(' ', $text);
    if (count($words) > $word_limit) {
        return implode(' ', array_slice($words, 0, $word_limit)) . '...';
    }
    return $text;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
        }
        /* CD 1 - Cover Section */
        .cover-section {
            padding: 80px 0;
            background: white;
            text-align: center;
            background:rgb(255, 255, 255);
        }
        .cover-section img {
            max-width: 60%;
            height: auto;
        }

        /* CD 2 - Course Info Section */
.info-section {
    margin-bottom: 40px;
    background:rgb(255, 255, 255);
    display: flex; 
    justify-content: center; 
    align-items: center; 
    flex-direction: column; 
}

.course-title {
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 100px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    padding: 25px;
    margin-bottom: 50px;
    transition: transform 0.3s;
    width: 100%;
}

.course-title:hover {
    transform: translateY(-5px);
}

.course-title img {
    width: 70px;
    height: 70px;
    margin-right: 25px;
}

.course-title h2 {
    font-size: 40px;
    font-weight: bold;
    color: #0057D9;
    margin: 0;
}
        .info-section .institute-image {
            border-radius: 15px;
            width: 100%;
            height: auto;
        }
        .info-section .institute-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-top: 10px;
        }
        .info-section .course-name {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .info-section .save-btn {
            background-color: #fff;
            color: #0056b3;
            border: none;
            border-radius: 50px;
            border: solid 1px #0056b3;
            padding: 4px 20px;
            font-weight: 500;
            transition: background 0.3s;
        }
        .info-section .save-btn:hover {
            background: #0056b3;
            color: #fff;
        }
        .info-section .description {
            font-size: 16px;
            color: #333;
        }

        /* CD 3 - Career Opportunities and What You'll Learn */
        .opportunities-section {
            padding: 60px 0;
            background: #f8f9fa;
        }
        .opportunities-section h3 {
            font-size: 32px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
        .opportunities-section ul {
            list-style-type: none;
            padding: 0;
        }
        .opportunities-section ul li {
            font-size: 15px;
            color: #333;
            margin-bottom: 10px;
            position: relative;
            padding-left: 20px;
        }
        .opportunities-section ul li:before {
            content: '•';
            position: absolute;
            left: 0;
            color: #007BFF;
            font-size: 20px;
        }

        .modules-section {
    padding: 60px 0;
    background: white;
}

.modules-section h3 {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 30px;
    text-align: left;
    text-transform: uppercase;
}

.accordion {
    background: #F5F7FA;
    border-radius: 10px;
    border: none;
}

.accordion-item {
    background: #F5F7FA;
    border: none;
    border-bottom: 1px solid #e0e0e0;
}

.accordion-item:last-child {
    border-bottom: none;
}

.accordion-button {
    background: #F5F7FA !important;
    color: #333 !important;
    font-size: 16px;
    font-weight: 600;
    padding: 15px 20px;
    border: none;
    box-shadow: none !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.accordion-button:not(.collapsed) {
    background: #F5F7FA !important;
    color: #333 !important;
}

.accordion-button::after {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23333'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
    width: 1rem;
    height: 1rem;
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23333'%3E%3Cpath fill-rule='evenodd' d='M1.646 11.354a.5.5 0 0 0 .708 0L8 5.707l5.646 5.647a.5.5 0 0 0 .708-.708l-6-6a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 0 .708z'/%3E%3C/svg%3E");
}

.semester-title {
    flex-grow: 1;
}

.lecture-info {
    font-size: 14px;
    color: #6c757d;
    margin-left: 10px;
}

.accordion-body {
    padding: 15px 20px;
    background: #F5F7FA;
}

.accordion-body p {
    font-size: 15px;
    color: #555;
    margin: 5px 0;
    line-height: 1.6;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .modules-section h3 {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .accordion-button {
        font-size: 14px;
        padding: 12px 15px;
    }

    .lecture-info {
        font-size: 12px;
    }

    .accordion-body p {
        font-size: 14px;
    }
}

        /* CD 5 - Related Courses Section */
        .related-section {
            padding: 60px 0;
            background: #f8f9fa;
        }
        .related-section h3 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
        .related-section .course-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .related-section .course-card img {
            width: 70px;
            height: 70px;
            margin-bottom: 20px;
        }
        .related-section .course-card .institute-name {
            font-size: 16px;
            font-weight: 600;
            color: #0057D9;
            margin-bottom: 5px;
        }
        .related-section .course-card .course-name {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }
        .related-section .view-more-btn {
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background 0.3s;
            display: block;
            margin: 20px auto 0;
        }
        .related-section .view-more-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- CD 1: Cover Section -->
    <section class="cover-section">
        <div class="container">
            <img src="assets/img/course-details-cover-image.jpg" alt="Course Details Cover Image">
        </div>
    </section>

    <!-- CD 2: Course Info Section -->
    <?php if ($course) { ?>
    <section class="info-section">
        <div class="container">
            <div class="course-title justify-item-center">
                <img src="images/<?php echo htmlspecialchars($course['icon']); ?>" alt="<?php echo htmlspecialchars($course['course_name']); ?>">
                <h2><?php echo htmlspecialchars($course['course_name']); ?></h2>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <img src="assets/img/course-details-image.png" class="institute-image" alt="Institute Image">
                    <div class="institute-name"><?php echo htmlspecialchars($course['institute_name']); ?></div>
                    <div class="course-name"><?php echo htmlspecialchars($course['course_name']); ?></div>
                    <button class="save-btn">Save</button>
                </div>
                <div class="col-md-1">
                    
                </div>
                <div class="col-md-7">
                    <p class="description"><?php echo htmlspecialchars(truncateDescription($course['course_description'])); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CD 3: Career Opportunities and What You'll Learn -->
    <section class="opportunities-section">
        <div class="container">
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-5">
                    <h3>Career Opportunities</h3>
                    <ul>
                        <?php
                        $opportunities = explode("\n", $course['career_opportunity']);
                        foreach ($opportunities as $opportunity) {
                            if (trim($opportunity)) {
                                echo "<li>" . htmlspecialchars(trim($opportunity)) . "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-5">
                    <h3>What You'll Learn</h3>
                    <ul>
                        <?php
                        $learn_items = explode("\n", $course['what_you_learn']);
                        foreach ($learn_items as $item) {
                            if (trim($item)) {
                                echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

       <!-- CD 4: Modules Section -->
<section class="modules-section">
    <div class="container">
        <h3>Modules</h3>
        <div class="accordion" id="modulesAccordion">
            <?php
            $semesters = [
                'Semester 1' => 'module_semester1',
                'Semester 2' => 'module_semester2',
                'Semester 3' => 'module_semester3',
                'Semester 4' => 'module_semester4',
                'Semester 5' => 'module_semester5',
                'Semester 6' => 'module_semester6',
                'Semester 7' => 'module_semester7',
                'Semester 8' => 'module_semester8'
            ];

            $index = 0; // For unique IDs in the accordion
            foreach ($semesters as $semester_name => $column_name) {
                // Check if the column exists in the course data and has non-empty content
                if (isset($course[$column_name]) && !empty(trim($course[$column_name]))) {
                    $modules = explode("\n", $course[$column_name]);
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                            <button class="accordion-button <?php echo $index === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $index; ?>">
                                <span class="semester-title"><?php echo htmlspecialchars($semester_name); ?></span>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#modulesAccordion">
                            <div class="accordion-body">
                                <?php
                                foreach ($modules as $module) {
                                    if (trim($module)) {
                                        echo "<p>" . htmlspecialchars(trim($module)) . "</p>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $index++;
                }
            }
            ?>
        </div>
    </div>
</section>

    <!-- CD 5: Related Courses Section -->
    <section class="related-section">
        <div class="container">
            <h3>Related Courses</h3>
            <div class="row">
                <?php foreach ($related_courses as $related_course) { ?>
                    <div class="col-md-4">
                        <a href="course_details.php?course_id=<?php echo htmlspecialchars($related_course['course_id']); ?>" style="text-decoration: none; color: inherit;">
                            <div class="course-card">
                                <img src="images/<?php echo htmlspecialchars($related_course['icon']); ?>" alt="<?php echo htmlspecialchars($related_course['course_name']); ?>">
                                <div class="institute-name"><?php echo htmlspecialchars($related_course['institute_name']); ?></div>
                                <div class="course-name"><?php echo htmlspecialchars($related_course['course_name']); ?></div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <button onclick="window.location.href='course.php?field=<?php echo urlencode($course['field']); ?>'" class="view-more-btn">View More</button>
        </div>
    </section>
    <?php } else { ?>
    <section class="info-section">
        <div class="container">
            <p>Course not found. Please select a valid course.</p>
        </div>
    </section>
    <?php } ?>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>