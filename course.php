<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

// Initialize filter variables
$field = isset($_GET['field']) ? $_GET['field'] : '';
$qualification_level = isset($_GET['qualification_level']) ? $_GET['qualification_level'] : '';
$study_mode = isset($_GET['study_mode']) ? $_GET['study_mode'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Pagination variables
$limit = 4; // Number of courses per page (changed to 4 to match screenshot)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Build the query for filtering courses
$query = "SELECT * FROM course_details WHERE 1=1";
$params = [];
$types = '';

if (!empty($field) && $field != 'All') {
    $query .= " AND field = ?";
    $params[] = $field;
    $types .= 's';
}

if (!empty($qualification_level) && $qualification_level != 'All') {
    $query .= " AND qualification_level = ?";
    $params[] = $qualification_level;
    $types .= 's';
}

if (!empty($study_mode) && $study_mode != 'All') {
    $query .= " AND study_mode = ?";
    $params[] = $study_mode;
    $types .= 's';
}

if (!empty($search)) {
    $query .= " AND course_name LIKE ?";
    $params[] = "%$search%";
    $types .= 's';
}

// Get total number of courses for pagination
$count_query = str_replace("SELECT *", "SELECT COUNT(*)", $query);
$stmt = $conn->prepare($count_query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$total_courses = $stmt->get_result()->fetch_row()[0];
$total_pages = ceil($total_courses / $limit);

// Fetch courses for the current page
$query .= " LIMIT ? OFFSET ?";
$types .= 'ii';
$params[] = $limit;
$params[] = $offset;

$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Function to truncate description
function truncateDescription($text, $word_limit = 15) {
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
    <title>Courses - Career Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
        }

        /* Course 1 - Cover Section */
        .cover-section {
            padding: 80px 0;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .cover-section .wave {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 500 150" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,150 C150,50 350,150 500,50 L500,150 L0,150 Z" fill="rgba(0, 123, 255, 0.1)"/></svg>') no-repeat;
            background-size: cover;
        }

        .cover-section h1 {
            font-size: 48px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .cover-section p {
            color: #6c757d;
            font-size: 16px;
        }

        /* Course 2 - Filter and Courses Section */
        .courses-section {
            padding: 60px 0;
            background: white;
        }

        .courses-section .filter-section {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .courses-section .filter-section h5 {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            text-transform: uppercase;
            background: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .courses-section .filter-section .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .courses-section .filter-section .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            background: #f8f9fa;
        }

        .courses-section .filter-section .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .courses-section .filter-section .form-check {
            margin-bottom: 10px;
            background: rgb(235, 235, 235);
            padding: 10px;
            border-radius: 5px;
        }

        .courses-section .filter-section .form-check-label {
            font-size: 14px;
            color: #333;
        }

        .courses-section .filter-section .form-check-input {
            accent-color: #007BFF;
        }

        .courses-section .filter-section .clear-btn {
            background: transparent;
            border: 1px solid #dc3545;
            color: #dc3545;
            border-radius: 5px;
            padding: 8px 20px;
            font-size: 14px;
            transition: background 0.3s, color 0.3s;
            width: 100%;
            text-align: center;
        }

        .courses-section .filter-section .clear-btn:hover {
            background: #dc3545;
            color: white;
        }

        .courses-section h2 {
            font-size: 40px;
            font-weight: 600;
            color: #333;
            margin-bottom: 40px;
            text-align: center;
        }

        .courses-section h2 span {
            color: #0057D9;
        }

        .courses-section .course-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .courses-section .course-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .courses-section .course-card:hover {
            transform: translateY(-5px);
        }

        .courses-section .course-card img {
            width: 60px;
            height: 60px;
            margin-right: 20px;
        }

        .courses-section .course-card h5 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .courses-section .course-card p {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
            line-height: 1.5;
        }

        /* Pagination Styling */
        .courses-section .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            gap: 15px;
        }

        .courses-section .pagination .page-link {
            background: none;
            border: none;
            padding: 0;
            font-size: 20px;
            color: #007BFF;
            transition: color 0.3s;
        }

        .courses-section .pagination .page-link:hover {
            color: #0056b3;
        }

        .courses-section .pagination .page-link.disabled {
            color: #ccc;
            pointer-events: none;
        }

        .courses-section .pagination .dots {
            display: flex;
            gap: 8px;
        }

        .courses-section .pagination .dot {
            width: 10px;
            height: 10px;
            background: #ccc;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .courses-section .pagination .dot.active {
            background: #007BFF;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .courses-section .course-grid {
                grid-template-columns: 1fr;
            }

            .courses-section .course-card {
                padding: 15px;
            }

            .courses-section .course-card img {
                width: 50px;
                height: 50px;
                margin-right: 15px;
            }

            .courses-section .course-card h5 {
                font-size: 16px;
            }

            .courses-section .course-card p {
                font-size: 13px;
            }

            .courses-section h2 {
                font-size: 32px;
            }
        }

        @media (max-width: 576px) {
            .courses-section h2 {
                font-size: 28px;
            }

            .courses-section .course-card img {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }

            .courses-section .course-card h5 {
                font-size: 14px;
            }

            .courses-section .course-card p {
                font-size: 12px;
            }

            .courses-section .pagination .page-link {
                font-size: 16px;
            }

            .courses-section .pagination .dot {
                width: 8px;
                height: 8px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Course 1: Cover Section -->
    <section class="cover-section">
        <div class="container">
            <div class="coverimg text-center">
                <img src="assets/img/course cover.jpg" alt="Cover Image" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- Course 2: Filter and Courses Section -->
    <section class="courses-section">
        <div class="container">
            <div class="row">
                <!-- Filter Section -->
                <div class="col-md-4">
                    <div class="filter-section">
                        <h5>FILTER BY</h5>
                        <form method="GET" id="filterForm">
                            <div class="search-box">
                                <input type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>">
                                <i class="fas fa-search"></i>
                            </div>

                            <h5>Preferred Career Field</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="field" id="fieldAll" value="All" <?php echo ($field == 'All' || $field == '') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="fieldAll">All</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="field" id="fieldIT" value="IT" <?php echo ($field == 'IT') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="fieldIT">IT</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="field" id="fieldManagement" value="Management" <?php echo ($field == 'Management') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="fieldManagement">Management</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="field" id="fieldEngineering" value="Engineering" <?php echo ($field == 'Engineering') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="fieldEngineering">Engineering</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="field" id="fieldLanguage" value="Language" <?php echo ($field == 'Language') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="fieldLanguage">Language</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="field" id="fieldOther" value="Other" <?php echo ($field == 'Other') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="fieldOther">Other</label>
                            </div>

                            <h5>Preferred Qualification Level</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="qualification_level" id="qualAll" value="All" <?php echo ($qualification_level == 'All' || $qualification_level == '') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="qualAll">All</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="qualification_level" id="qualCertificate" value="Certificate" <?php echo ($qualification_level == 'Certificate') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="qualCertificate">Certificate</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="qualification_level" id="qualDiploma" value="Diploma" <?php echo ($qualification_level == 'Diploma') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="qualDiploma">Diploma</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="qualification_level" id="qualHND" value="HND" <?php echo ($qualification_level == 'HND') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="qualHND">HND</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="qualification_level" id="qualDegree" value="Degree" <?php echo ($qualification_level == 'Degree') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="qualDegree">Degree</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="qualification_level" id="qualFoundation" value="Foundation" <?php echo ($qualification_level == 'Foundation') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="qualFoundation">Foundation</label>
                            </div>

                            <h5>Course Study Mode</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="study_mode" id="modeAll" value="All" <?php echo ($study_mode == 'All' || $study_mode == '') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="modeAll">All</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="study_mode" id="modePartTime" value="Part time" <?php echo ($study_mode == 'Part time') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="mode-Part time">Part-time</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="study_mode" id="modeFullTime" value="Full time" <?php echo ($study_mode == 'Full time') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="modeFullTime">Full-time</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="study_mode" id="modeOnline" value="Online" <?php echo ($study_mode == 'Online') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="modeOnline">Online</label>
                            </div>

                            <button type="button" class="clear-btn mt-3" onclick="window.location.href='course.php'">Clear</button>
                        </form>
                    </div>
                </div>

                <!-- Courses Section -->
                <div class="col-md-8">
                    <h2 class="text-center"><span>Suggested</span> Areas</h2>
                    <?php if (empty($courses)) { ?>
                        <p>No courses found. Please adjust your filters and try again.</p>
                    <?php } else { ?>
                        <div class="course-grid">
                            <?php foreach ($courses as $course) { ?>
                                <a href="course_details.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>" style="text-decoration: none; color: inherit;">
                                    <div class="course-card d-flex align-items-center">
                                        <img src="images/<?php echo htmlspecialchars($course['icon']); ?>" alt="<?php echo htmlspecialchars($course['course_name']); ?>">
                                        <div>
                                            <h5><?php echo htmlspecialchars($course['course_name']); ?></h5>
                                            <p><?php echo htmlspecialchars(truncateDescription($course['course_description'], 15)); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1) { ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link <?php echo ($page <= 1) ? 'disabled' : ''; ?>" href="course.php?page=<?php echo $page - 1; ?>&field=<?php echo urlencode($field); ?>&qualification_level=<?php echo urlencode($qualification_level); ?>&study_mode=<?php echo urlencode($study_mode); ?>&search=<?php echo urlencode($search); ?>" aria-label="Previous">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item dots">
                                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                        <span class="dot <?php echo ($i == $page) ? 'active' : ''; ?>"></span>
                                    <?php } ?>
                                </li>
                                <li class="page-item">
                                    <a class="page-link <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>" href="course.php?page=<?php echo $page + 1; ?>&field=<?php echo urlencode($field); ?>&qualification_level=<?php echo urlencode($qualification_level); ?>&study_mode=<?php echo urlencode($study_mode); ?>&search=<?php echo urlencode($search); ?>" aria-label="Next">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.form-check-input').forEach(input => {
            input.addEventListener('change', () => {
                document.getElementById('filterForm').submit();
            });
        });
    </script>
</body>
</html>