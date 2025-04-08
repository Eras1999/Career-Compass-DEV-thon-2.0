<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Career Compass</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        /* About 1 - Hero Section */
        .hero-section {
            padding: 60px 0;
            background: #F5F7FA;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .hero-section p {
            color: #6c757d;
            font-size: 16px;
            margin-top: 20px;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .hero-section .cover-image img {
            width: 70%;
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }

        /* About 2 - About Us Details Section */
        .about-details {
            padding: 60px 0;
            background: white;
        }

        .about-details h2 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .about-details h2 span {
            color: #007BFF;
        }

        .about-details p {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .about-details .feature-box {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: 100px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .about-details .feature-box i {
            font-size: 24px;
            margin-right: 15px;
            color: #fff;
            background: #007BFF;
            border-radius: 100px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .about-details .feature-box.vision i {
            background: #FFC107;
        }

        .about-details .feature-box.mission i {
            background: #ff6f61;
        }

        .about-details .feature-box.why i {
            background: #007BFF;
        }

        .about-details .feature-box h5 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .about-details .feature-box p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 0;
        }

        .about-details .images img {
            width: 100%;
            border-radius: 15px;
        }

        /* Collaboration Section */
        .collaboration-section {
            padding: 80px 0;
            background: #F5F7FA;
        }

        .collaboration-section .image-container {
            position: relative;
            height: 100%;
        }

        .collaboration-section .bottom-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }

        .collaboration-section .top-image-container {
            position: absolute;
            top: 80px;
            right: -300px;
            width: 400px;
            height: 250px;
        }

        .collaboration-section .top-image {
            width: 100%;
            height: 100%;
            border: solid 10px #fff;
            object-fit: cover;
            border-radius: 15px;
        }

        .collaboration-section .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgb(255, 255, 255);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s;
        }

        .collaboration-section .play-button i {
            color: rgb(216, 216, 216);
            font-size: 20px;
        }

        .collaboration-section .play-button:hover {
            background: #e65b50;
        }

        /* Feedback Section */
        .feedback-section {
            padding: 30px 0;
            background: #F5F7FA;
        }

        .feedback {
            gap: 20px;
            /* Space between h5 and button */
        }

        .feedback h5 {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin: 0;
            /* Remove default margin to align properly */
        }

        .feedback .feedback-btn {
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            /* Space between icon and text */
            transition: background 0.3s;
        }

        .feedback .feedback-btn i {
            font-size: 16px;
        }

        .feedback .feedback-btn:hover {
            background: #0056b3;
            color: #fff;
        }

        /* About 3 - Our Team Section */
        .team-section {
            padding: 60px 0;
            background: white;
        }

        .team-section h2 {
            font-size: 52px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .team-section p {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .team-section .team-member {
            text-align: center;
        }

        .team-section .team-member img {
            width: 100%;
            max-width: 200px;
            height: 300px;
            border-radius: 100px;
            margin-bottom: 15px;
            background: #DDE8F7;
        }

        .team-section .team-member h5 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        /* Responsive Adjustments */
        /* Tablet (768px - 991px) */
        @media (max-width: 991px) {

            /* About 1 - Hero Section */
            .hero-section {
                padding: 40px 0;
            }

            .hero-section h1 {
                font-size: 36px;
            }

            .hero-section p {
                font-size: 14px;
                margin-bottom: 30px;
            }

            .hero-section .cover-image img {
                width: 80%;
            }

            /* About 2 - About Us Details Section */
            .about-details {
                padding: 40px 0;
            }

            .about-details h2 {
                font-size: 28px;
            }

            .about-details p {
                font-size: 14px;
            }

            .about-details .feature-box {
                padding: 12px 15px;
            }

            .about-details .feature-box i {
                font-size: 20px;
                width: 35px;
                height: 35px;
            }

            .about-details .feature-box h5 {
                font-size: 16px;
            }

            .about-details .feature-box p {
                font-size: 13px;
            }

            /* Collaboration Section */
            .collaboration-section {
                padding: 60px 0;
            }

            .collaboration-section .bottom-image {
                height: 350px;
            }

            .collaboration-section .top-image-container {
                top: 60px;
                right: -200px;
                width: 300px;
                height: 200px;
            }

            .collaboration-section .play-button {
                width: 40px;
                height: 40px;
            }

            .collaboration-section .play-button i {
                font-size: 16px;
            }

            /* Feedback Section */
            .feedback-section {
                padding: 20px 0;
            }

            .feedback {
                gap: 15px;
            }

            .feedback h5 {
                font-size: 16px;
            }

            .feedback .feedback-btn {
                padding: 8px 18px;
                font-size: 14px;
            }

            .feedback .feedback-btn i {
                font-size: 14px;
            }

            /* About 3 - Our Team Section */
            .team-section {
                padding: 40px 0;
            }

            .team-section h2 {
                font-size: 40px;
            }

            .team-section p {
                font-size: 14px;
                margin-bottom: 30px;
            }

            .team-section .team-member img {
                max-width: 180px;
                height: 270px;
            }

            .team-section .team-member h5 {
                font-size: 16px;
            }
        }

        /* Mobile (≤767px) */
        @media (max-width: 767px) {

            /* About 1 - Hero Section */
            .hero-section {
                padding: 30px 0;
            }

            .hero-section h1 {
                font-size: 28px;
            }

            .hero-section p {
                font-size: 13px;
                margin-bottom: 20px;
            }

            .hero-section .cover-image img {
                width: 90%;
            }

            /* About 2 - About Us Details Section */
            .about-details {
                padding: 30px 0;
            }

            .about-details h2 {
                font-size: 24px;
            }

            .about-details p {
                font-size: 13px;
            }

            .about-details .feature-box {
                padding: 10px 12px;
            }

            .about-details .feature-box i {
                font-size: 18px;
                width: 30px;
                height: 30px;
                margin-right: 10px;
            }

            .about-details .feature-box h5 {
                font-size: 15px;
            }

            .about-details .feature-box p {
                font-size: 12px;
            }

            /* Collaboration Section */
            .collaboration-section {
                padding: 40px 0;
            }

            .collaboration-section .image-container {
                position: static;
                margin-bottom: 20px;
            }

            .collaboration-section .bottom-image {
                height: 300px;
            }

            .collaboration-section .top-image-container {
                position: static;
                width: 100%;
                height: 200px;
                margin: 0 auto;
            }

            .collaboration-section .play-button {
                width: 35px;
                height: 35px;
            }

            .collaboration-section .play-button i {
                font-size: 14px;
            }

            /* Feedback Section */
            .feedback-section {
                padding: 15px 0;
            }

            .feedback {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .feedback h5 {
                font-size: 14px;
            }

            .feedback .feedback-btn {
                padding: 6px 16px;
                font-size: 13px;
            }

            .feedback .feedback-btn i {
                font-size: 12px;
            }

            /* About 3 - Our Team Section */
            .team-section {
                padding: 30px 0;
            }

            .team-section h2 {
                font-size: 28px;
            }

            .team-section p {
                font-size: 13px;
                margin-bottom: 20px;
            }

            .team-section .team-member img {
                max-width: 150px;
                height: 220px;
            }

            .team-section .team-member h5 {
                font-size: 14px;
            }
        }

        /* Small Mobile (≤576px) */
        @media (max-width: 576px) {

            /* About 1 - Hero Section */
            .hero-section {
                padding: 20px 0;
            }

            .hero-section h1 {
                font-size: 24px;
            }

            .hero-section p {
                font-size: 12px;
                margin-bottom: 15px;
            }

            .hero-section .cover-image img {
                width: 100%;
            }

            /* About 2 - About Us Details Section */
            .about-details {
                padding: 20px 0;
            }

            .about-details h2 {
                font-size: 20px;
            }

            .about-details p {
                font-size: 12px;
            }

            .about-details .feature-box {
                padding: 8px 10px;
            }

            .about-details .feature-box i {
                font-size: 16px;
                width: 25px;
                height: 25px;
                margin-right: 8px;
            }

            .about-details .feature-box h5 {
                font-size: 14px;
            }

            .about-details .feature-box p {
                font-size: 11px;
            }

            /* Collaboration Section */
            .collaboration-section {
                padding: 30px 0;
            }

            .collaboration-section .bottom-image {
                height: 250px;
            }

            .collaboration-section .top-image-container {
                height: 150px;
            }

            .collaboration-section .play-button {
                width: 30px;
                height: 30px;
            }

            .collaboration-section .play-button i {
                font-size: 12px;
            }

            /* Feedback Section */
            .feedback-section {
                padding: 10px 0;
            }

            .feedback h5 {
                font-size: 13px;
            }

            .feedback .feedback-btn {
                padding: 5px 14px;
                font-size: 12px;
            }

            .feedback .feedback-btn i {
                font-size: 11px;
            }

            /* About 3 - Our Team Section */
            .team-section {
                padding: 20px 0;
            }

            .team-section h2 {
                font-size: 24px;
            }

            .team-section p {
                font-size: 12px;
                margin-bottom: 15px;
            }

            .team-section .team-member img {
                max-width: 120px;
                height: 180px;
            }

            .team-section .team-member h5 {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- About 1: Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="cover-image text-center">
                <img src="assets/img/about cover.jpg" alt="About Cover Image">
            </div>
            <br>
            <p class="text-center">Career Compass is a dedicated platform helping Sri Lankan students navigate their
                education and career choices after O/Ls and A/Ls. We provide personalized <br>recommendations for
                universities and technical colleges.</p>
        </div>
    </section>

    <!-- About Details Section -->
    <section class="about-details">
        <div class="container">
            <!-- First Row: Heading and Paragraphs in 3 Columns -->
            <div class="row content-row">
                <div class="col-md-4 col-sm-6">
                    <h2><span>Introduction</span> To Best <br>Career Guidance !</h2>
                </div>
                <div class="col-md-4 col-sm-6">
                    <p>Career Compass is a Sri Lankan educational platform, guiding students in choosing university,
                        degree, and technical courses through personalized recommendations.</p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <p>Career Compass connects students with the right educational opportunities through data-driven
                        insights, expert advice, and a diverse range of courses, empowering their academic and career
                        growth.</p>
                </div>
            </div>
            <!-- Second Row: Feature Boxes in 3 Columns -->
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="feature-box vision">
                        <i class="fas fa-eye"></i>
                        <div>
                            <h5>Vision</h5>
                            <p>To be the leading platform guiding students from school to higher education with reliable
                                advice and career insights.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="feature-box mission">
                        <i class="fas fa-bullseye"></i>
                        <div>
                            <h5>Mission</h5>
                            <p>To guide students in choosing the best education and career paths with expert advice and
                                insights.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="feature-box why">
                        <i class="fas fa-question-circle"></i>
                        <div>
                            <h5>Why Choose Us</h5>
                            <p>We provide personalized insights, expert advice, and reliable career guidance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Collaboration Section -->
    <section class="collaboration-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <div class="image-container">
                        <img src="assets/img/collaboration-image.png" class="bottom-image" alt="Collaboration Image">
                        <div class="top-image-container">
                            <img src="assets/img/vr-image.jpg" class="top-image" alt="VR Image">
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="feedback-section">
        <div class="container">
            <div class="feedback d-flex align-items-center justify-content-center">
                <h5>We value your feedback—please share your thoughts with us.</h5>
                <a href="feedback.php" class="btn btn-submit feedback-btn">
                    <i class="fas fa-comment-dots"></i> Feedback
                </a>
            </div>
        </div>
    </section>

    <!-- About 3: Our Team Section -->
    <section class="team-section">
        <div class="container">
            <center><span class="pill-text">OUR TEAM</span></center>
            <h2 class="text-center">Our Exclusive Team</h2>
            <p class="text-center">Career Compass is powered by passionate experts in career guidance, education, tech,
                and support. We work together to help students find their perfect career path with ease.</p>
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="team-member">
                        <img src="assets/img/team1.png" alt="Tynisha Obey">
                        <h5>Tynisha Obey</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="team-member">
                        <img src="assets/img/team2.png" alt="Johnnie Jock">
                        <h5>Johnnie Jock</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="team-member">
                        <img src="assets/img/team3.png" alt="Krishna Barbe">
                        <h5>Krishna Barbe</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="team-member">
                        <img src="assets/img/team4.png" alt="Charlotte Hanlin">
                        <h5>Charlotte Hanlin</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>