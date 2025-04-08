<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

// Fetch approved feedback for the Reviews section
$query = "SELECT * FROM feedback WHERE approved = 1 ORDER BY created_at DESC";
$result = $conn->query($query);
$feedbacks = [];
while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;
}

// Group feedback into sets of 3 for each carousel slide
$feedback_groups = array_chunk($feedbacks, 3);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Career Compass</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter Tight', sans-serif;
            background: #f4f7fc;
        }

        .pill-text {
            display: inline-block;
            padding: 2px 15px;
            border: 1px solid #ccc;
            color: #6c757d;
            border-radius: 50px;
            font-size: 14px;
        }

        /* Home 1 - Hero Section */
        .hero-section {
            padding: 60px 0;
            background: white;
        }

        .hero-section h1 {
            font-size: 55px;
            font-weight: 600;
            color: #333;
        }

        .hero-section h1 span {
            color: #0057D9;
        }

        .hero-section p {
            color: #6c757d;
            font-size: 16px;
            margin: 20px 0;
        }

        .hero-section .btn-join {
            background: #FFC107;
            color: #0057D9;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 500;
            margin-right: 10px;
        }

        .hero-section .btn-join:hover {
            background: #0057D9;
            color: #fff;
        }

        .hero-section .btn-see {
            background: transparent;
            color: rgb(0, 0, 0);
            border: 1px solid rgb(0, 0, 0);
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 500;
        }

        .hero-section .btn-see:hover {
            background: #0057D9;
            color: white;
        }

        .hero-section .stats {
            margin-top: 40px;
        }

        .hero-section .stats h5 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .hero-section .stats p {
            color: #6c757d;
            font-size: 14px;
            margin: 5px 0 0;
        }

        .hero-section .stats .avatars img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: -10px;
            border: 2px solid white;
        }

        .hero-section .stats .avatars img:first-child {
            margin-left: 0;
        }

        .coverimg img {
            margin-top: 25px;
            height: 350px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Home 2 - What We Do Section */
        .what-we-do {
            padding: 60px 0;
            color: #000;
            position: relative;
        }

        .what-we-do::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .what-we-do .container {
            position: relative;
        }

        .what-we-do h2 {
            font-size: 52px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .what-we-do p {
            color: #6c757d;
            font-size: 16px;
            margin: 20px 0;
        }

        .what-we-do .feature-box {
            background: white;
            border-radius: 10px;
            padding: 20px 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: left;
            min-height: 150px;
            /* Ensure consistent height */
        }

        .what-we-do .feature-box.bluebox {
            background: #007AFF;
        }

        .what-we-do .feature-box .icon-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .what-we-do .feature-box i {
            color: #007BFF;
            font-size: 24px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e6f0fa;
            border-radius: 50%;
        }

        .what-we-do .feature-box.bluebox i {
            color: white;
            background: rgba(255, 255, 255, 0.2);
        }

        .what-we-do .feature-box h5 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .what-we-do .feature-box.bluebox h5,
        .what-we-do .feature-box.bluebox p {
            color: white;
        }

        .what-we-do .feature-box p {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .what-we-do .feature-box {
                min-height: auto;
                /* Allow height to adjust on smaller screens */
            }

            .what-we-do .feature-box .icon-header {
                gap: 10px;
            }

            .what-we-do .feature-box i {
                font-size: 20px;
                width: 35px;
                height: 35px;
            }

            .what-we-do .feature-box h5 {
                font-size: 16px;
            }

            .what-we-do .feature-box p {
                font-size: 13px;
            }
        }

        @media (max-width: 576px) {
            .what-we-do h2 {
                font-size: 36px;
            }

            .what-we-do p {
                font-size: 14px;
            }

            .what-we-do .feature-box {
                padding: 15px;
            }
        }

        /* Home 3 - Popular Courses Section */
        .courses-section {
            padding: 60px 0;
            background: white;
        }

        .courses-section h2 {
            font-size: 52px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .courses-section h2 span {
            color: #FFC107;
        }

        .courses-section p {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .courses-section .course-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .courses-section .course-card:hover {
            transform: translateY(-5px);
        }

        .courses-section .course-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .courses-section .course-card .card-body {
            padding: 20px;
        }

        .courses-section .course-card h5 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .courses-section .course-card p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 0;
        }

        .courses-section .course-card .btn {
            color: #0057D9;
            padding: 10px 0;
            font-weight: 500;
            margin-top: 10px;
        }

        /* Home 4 - Reviews Section */
        .reviews-section {
            padding: 60px 0;
            background: white;
        }

        .reviews-section h2 {
            font-size: 52px;
            font-weight: 600;
            color: #333;
            margin-bottom: 0;
        }

        .reviews-section h2 span {
            color: #FFC107;
        }

        .reviews-section .carousel {
            position: relative;
        }

        .reviews-section .carousel-controls {
            display: flex;
            gap: 10px;
        }

        .reviews-section .carousel-control-prev,
        .reviews-section .carousel-control-next {
            position: static;
            width: 40px;
            height: 40px;
            background: #007BFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reviews-section .carousel-control-prev-icon,
        .reviews-section .carousel-control-next-icon {
            background-size: 20px;
        }

        .reviews-section .carousel-item {
            padding: 0 15px;
        }

        .reviews-section .review-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        .reviews-section .review-card:hover {
            background: #014FC3;
            color: white;
        }

        .reviews-section .review-card.blue {
            background: #014FC3;
            color: white;
        }

        .reviews-section .review-card p {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .reviews-section .review-card .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .reviews-section .review-card img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .reviews-section .review-card h5 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .reviews-section .review-card .title {
            font-size: 14px;
            color: #6c757d;
        }

        .reviews-section .review-card.blue .title {
            color: white;
        }

        .reviews-section .carousel-indicators {
            bottom: -40px;
        }

        .reviews-section .carousel-indicators [data-bs-target] {
            background: #014FC3;
            width: 10px;
            margin: 0 5px;
            padding: 2px;
            border-radius: 100px;
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .reviews-section h2 {
                font-size: 28px;
            }

            .reviews-section .carousel-control-prev,
            .reviews-section .carousel-control-next {
                width: 35px;
                height: 35px;
            }

            .reviews-section .review-card {
                padding: 15px;
            }

            .reviews-section .review-card p {
                font-size: 13px;
            }

            .reviews-section .review-card img {
                width: 50px;
                height: 50px;
            }

            .reviews-section .review-card h5 {
                font-size: 14px;
            }

            .reviews-section .review-card .title {
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            .reviews-section h2 {
                font-size: 24px;
            }

            .reviews-section .d-flex {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .reviews-section .carousel-controls {
                justify-content: center;
            }

            .reviews-section .carousel-indicators {
                bottom: -30px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Home 1: Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <h1>Navigate Your <span>Future</span> with <br><span>Confidence!</span></h1>
                    <p>Career Compass guides you to the right career path after O/Ls and A/Ls with tailored
                        recommendations for careers, <br>degrees, and courses. Explore your options and make informed
                        decisions for a brighter future!</p>
                    <div>
                        <a href="course.php" class="btn btn-join">Join Course</a>
                        <a href="https://youtu.be/x_d9BUB3050" target="_blank" class="btn btn-see">See How It Works</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="coverimg text-center">
            <img src="assets/img/home cover.jpg" alt="Cover Image" class="img-fluid">
        </div>
    </section>

    <!-- Home 2: What We Do Section -->
    <section class="what-we-do" id="how-it-works">
        <div class="container">
            <center><span class="pill-text">WHY US</span></center>

            <h2 class="text-center">What Career Compass Do?</h2>
            <p class="text-center">Career Compass guides students in discovering suitable career paths, degrees, and
                courses by providing <br>personalized recommendations based on their qualifications and interests.</p>
            <br>
            <div class="text-center">
                <img src="assets/img/what we do.png" alt="Cover Image" class="img-fluid">
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="feature-box">
                        <div class="icon-header">
                            <i class="fas fa-desktop"></i>
                            <h5>Career's Digital <br>Platform</h5>
                        </div>
                        <p>A web-based system for personalized course recommendations based on student details.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="feature-box bluebox">
                        <div class="icon-header">
                            <i class="fas fa-user-graduate"></i>
                            <h5>Student <br>Profile Input</h5>
                        </div>
                        <p>This system lets students enter details to get course recommendations and explore career
                            paths interactively.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="feature-box">
                        <div class="icon-header">
                            <i class="fas fa-book"></i>
                            <h5>Course <br>Recommendation</h5>
                        </div>
                        <p>The platform analyzes student data and suggests suitable university degrees or technical
                            diplomas.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="feature-box">
                        <div class="icon-header">
                            <i class="fas fa-graduation-cap"></i>
                            <h5>Career <br>Path Visualization</h5>
                        </div>
                        <p>Students explore careers through courses, gaining job insights, salaries, and industry
                            demand.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="feature-box bluebox">
                        <div class="icon-header">
                            <i class="fas fa-search"></i>
                            <h5>Institution <br>Selection</h5>
                        </div>
                        <p>Students explore career paths with insights into jobs, salaries, and industry demand based on
                            their courses.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="feature-box">
                        <div class="icon-header">
                            <i class="fas fa-hands-helping"></i>
                            <h5>Guidance & <br>Support</h5>
                        </div>
                        <p>The platform offers career counseling, scholarships, and application guidance for informed
                            decisions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Home 3: Popular Courses Section -->
    <section class="courses-section">
        <div class="container">
            <center><span class="pill-text">COURSES</span></center>
            <h2 class="text-center">Popular <span>Courses</span></h2>
            <p class="text-center">The Courses section of Career Compass provides a wide range of educational programs,
                <br>helping students choose the right course to match their career goals and interests.</p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="course-card">
                        <img src="assets/img/course1.jpg" alt="Web Development">
                        <div class="card-body">
                            <h5>Web Development After O/Ls</h5>
                            <p>Learn web development with HTML, CSS, JS, and more. Build websites and start a tech
                                career.</p>
                            <a href="#" class="btn">Learn More &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="course-card">
                        <img src="assets/img/course2.jpg" alt="BSc in Software Engineering">
                        <div class="card-body">
                            <h5>BSc (Hons) in Software Engineering</h5>
                            <p>Focus on software development, programming, and system design, building a strong
                                foundation.</p>
                            <a href="#" class="btn">Learn More &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="course-card">
                        <img src="assets/img/course3.jpg" alt="BA in Interior Design">
                        <div class="card-body">
                            <h5>BA (Hons) in Interior Design</h5>
                            <p>Learn spatial design, planning, principles, and aesthetics to create functional spaces.
                            </p>
                            <a href="#" class="btn">Learn More &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="course-card">
                        <img src="assets/img/course4.jpg" alt="Diploma in Nursing">
                        <div class="card-body">
                            <h5>Diploma in Nursing Degree</h5>
                            <p>A 3-year course with lessons, summer training, and internships for 3rd graders.</p>
                            <a href="#" class="btn">Learn More &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="course-card">
                        <img src="assets/img/course5.jpg" alt="Fashion Designing">
                        <div class="card-body">
                            <h5>Fashion Designing Degree</h5>
                            <p>Learn design, textiles, fashion trends, illustration, and techniques.</p>
                            <a href="#" class="btn">Learn More &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="course-card">
                        <img src="assets/img/course6.jpg" alt="UI/UX Design">
                        <div class="card-body">
                            <h5>UI/UX Design</h5>
                            <p>Undergraduate course in UI/UX design, focusing on user experience and interface.</p>
                            <a href="#" class="btn">Learn More &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews-section">
        <div class="container">
            <span class="pill-text">REVIEWS</span>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Real <span>Experience,</span><br> Real Success</h2>
                <div class="carousel-controls">
                    <button class="carousel-control-prev" type="button" data-bs-target="#reviewsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#reviewsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach ($feedback_groups as $index => $group) { ?>
                        <button type="button" data-bs-target="#reviewsCarousel" data-bs-slide-to="<?php echo $index; ?>"
                            class="<?php echo $index === 0 ? 'active' : ''; ?>"
                            aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                            aria-label="Slide <?php echo $index + 1; ?>"></button>
                    <?php } ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($feedback_groups as $group_index => $group) { ?>
                        <div class="carousel-item <?php echo $group_index === 0 ? 'active' : ''; ?>">
                            <div class="row">
                                <?php foreach ($group as $index => $feedback) { ?>
                                    <div class="col-md-4 col-sm-6 mb-4">
                                        <div class="review-card <?php echo $index === 0 ? 'blue' : ''; ?>">
                                            <p><?php echo htmlspecialchars($feedback['message']); ?></p>
                                            <div class="user-info">
                                                <img src="<?php echo $feedback['image'] ? htmlspecialchars($feedback['image']) : 'images/default-user.jpg'; ?>"
                                                    alt="<?php echo htmlspecialchars($feedback['full_name']); ?>">
                                                <div>
                                                    <h5><?php echo htmlspecialchars($feedback['full_name']); ?></h5>
                                                    <p class="title"><?php echo htmlspecialchars($feedback['position']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>