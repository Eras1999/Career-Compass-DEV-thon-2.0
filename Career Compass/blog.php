<?php
session_start();
$conn = new mysqli("localhost", "root", "", "career_compass");

// Function to truncate content
function truncateContent($text, $word_limit = 30)
{
    $words = explode(' ', $text);
    if (count($words) > $word_limit) {
        return implode(' ', array_slice($words, 0, $word_limit)) . '...';
    }
    return $text;
}

// Fetch the latest blog post (BL 2)
$latest_query = "SELECT id, title, content, image, created_at, views FROM blog ORDER BY created_at DESC LIMIT 1";
$latest_result = $conn->query($latest_query);
$latest_post = $latest_result->fetch_assoc();

// Fetch recent posts (BL 3)
$recent_query = "SELECT id, title, content, image, created_at, views FROM blog ORDER BY created_at DESC LIMIT 4 OFFSET 1";
$recent_result = $conn->query($recent_query);
$recent_posts = [];
while ($row = $recent_result->fetch_assoc()) {
    $recent_posts[] = $row;
}

// Fetch popular posts (BL 4)
$popular_query = "SELECT id, title, content, image, created_at, views FROM blog WHERE is_popular = 1 ORDER BY views DESC LIMIT 6";
$popular_result = $conn->query($popular_query);
$popular_posts = [];
while ($row = $popular_result->fetch_assoc()) {
    $popular_posts[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Career Compass</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
        }

        /* BL 1 - Cover Section */
        .cover-section {
            padding: 0 0;
            background: white;
            text-align: center;
        }

        .cover-section img {
            max-width: 100%;
            height: auto;
        }

        .cover-section h1 {
            font-size: 48px;
            font-weight: 500;
            color: #007BFF;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .cover-section p {
            font-size: 15px;
            color: #6c757d;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* BL 2 - Latest Blog Post */
        .latest-section {
            padding: 60px 0;
            background: #f8f9fa;
        }

        .latest-section .post-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .latest-section .post-image {
            width: 100%;
            height: 500px;
            /* Allow natural height */
            object-fit: cover;
            opacity: 0.7;
            /* Full opacity */
        }

        .latest-section .post-content {
            position: relative;
            /* Change from absolute positioning */
            top: auto;
            left: auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            max-width: 60%;
            /* Allow it to fill its container */
        }

        .latest-section .post-meta {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .latest-section .post-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .latest-section .post-excerpt {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .latest-section .read-more {
            background: #fff;
            color: #007BFF;
            border: 1px solid #007BFF;
            /* Add blue border */
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .latest-section .read-more:hover {
            background: #0056b3;
        }

        /* BL 3 - Recent Posts */
        .recent-section {
            padding: 60px 0;
            background: white;
        }

        .recent-section h3 {
            font-size: 35px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            display: inline-block;
            /* Allow button to be on same line */
        }

        .recent-section .view-all {
            background: #FFD700;
            /* Yellow background like in Image 2 */
            color: black;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background 0.3s;
            float: right;
            text-decoration: none;
            display: inline-block;
        }

        .recent-section .view-all:hover {
            background: #0056b3;
        }

        .recent-section .post-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .recent-section .post-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
        }

        .recent-section .post-content {
            padding: 25px;
        }

        .recent-section .post-meta {
            font-size: 4px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .recent-section .post-title {
            font-size: 22px;
            font-weight: 900;
            color: #333;
            margin-bottom: 25px;
        }

        .recent-section .post-excerpt {
            font-size: 14px;
            color: #555;
            margin-bottom: 25px;
        }

        .recent-section .read-more {
            background: #fff;
            color: #007BFF;

            border-radius: 5px;
            padding: 8px 15px;
            font-weight: 500;
            transition: background 0.3s;
            text-decoration: underline;
            display: inline-block;
        }

        .recent-section .read-more:hover {
            background: #0056b3;
            color: #fff;
            text-decoration: none;
        }


        /* BL 4 - Popular Posts */
        .popular-section {
            padding: 20px 0;
            background: #f8f9fa;
        }

        .popular-section h3 {
            font-size: 35px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            display: inline-block;
            /* Allow button to be on same line */
        }

        .popular-section .view-all {
            background: #FFD700;
            /* Yellow background like in Image 2 */
            color: black;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background 0.3s;
            float: right;
            display: inline-block;
        }

        .popular-section .post-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .popular-section .post-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .popular-section .post-content {
            padding: 15px;
        }

        .popular-section .post-meta {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .popular-section .post-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .popular-section .post-excerpt {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .popular-section .read-more {
            background: #fff;
            color: #007BFF;
            border-radius: 5px;
            padding: 8px 15px;
            font-weight: 500;
            transition: background 0.3s;
            text-decoration: underline;
            display: inline-block;
        }


        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .latest-section .post-image {
                height: 200px;
            }

            .recent-section .post-image,
            .popular-section .post-image {
                height: 150px;
            }

            .recent-section .view-all,
            .popular-section .view-all {
                float: none;
                display: block;
                margin: 20px auto;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- BL 1: Cover Section -->
    <section class="cover-section">
        <div class="container">
            <img src="assets/img/blog-cover-image.png" alt="Blog Cover Image">
            <h1>Blogs</h1>
            <p>Discover insightful blogs on career guidance, industry trends, and educational opportunities to help you
                make informed decisions<br> about your future. Stay updated with expert advice, success stories, and
                valuable resources tailored to your career aspirations.</p>
        </div>
    </section>

    <!-- BL 2: Latest Blog Post -->
    <section class="latest-section">
        <div class="container">
            <?php if ($latest_post) { ?>
                <div class="post-card">
                    <img src="images/<?php echo htmlspecialchars($latest_post['image']); ?>" class="post-image"
                        alt="<?php echo htmlspecialchars($latest_post['title']); ?>">
                    <div class="post-content">
                        <div class="post-meta">
                            <span><?php echo date('d-May-Y', strtotime($latest_post['created_at'])); ?></span> |
                            <span>View: <?php echo htmlspecialchars($latest_post['views']); ?></span>
                        </div>
                        <h2 class="post-title"><?php echo htmlspecialchars($latest_post['title']); ?></h2>
                        <p class="post-excerpt">
                            <?php echo htmlspecialchars(truncateContent($latest_post['content'], 30)); ?></p>
                        <a href="blog_details.php?blog_id=<?php echo htmlspecialchars($latest_post['id']); ?>"
                            class="read-more">Read More</a>
                    </div>
                </div>
            <?php } else { ?>
                <p>No blog posts available.</p>
            <?php } ?>
        </div>
    </section>

    <!-- BL 3: Recent Posts -->
    <section class="recent-section">
        <div class="container">
            <h3>Our Recent Post</h3>
            <a href="blog.php?section=recent" class="view-all">View All</a>
            <div class="row">
                <?php if (!empty($recent_posts)) { ?>
                    <!-- First Recent Post (Two Columns) -->
                    <div class="col-md-12 mb-4">
                        <div class="post-card row">
                            <div class="col-md-6 p-0">
                                <img src="images/<?php echo htmlspecialchars($recent_posts[0]['image']); ?>"
                                    class="post-image" alt="<?php echo htmlspecialchars($recent_posts[0]['title']); ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="post-content">

                                    <h4 class="post-title"><?php echo htmlspecialchars($recent_posts[0]['title']); ?></h4>
                                    <p class="post-excerpt">
                                        <?php echo htmlspecialchars(truncateContent($recent_posts[0]['content'], 70)); ?>
                                    </p>
                                    <a href="blog_details.php?blog_id=<?php echo htmlspecialchars($recent_posts[0]['id']); ?>"
                                        class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Next Three Recent Posts (Three Columns) -->
                    <?php for ($i = 1; $i < min(4, count($recent_posts)); $i++) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="post-card">
                                <img src="images/<?php echo htmlspecialchars($recent_posts[$i]['image']); ?>" class="post-image"
                                    alt="<?php echo htmlspecialchars($recent_posts[$i]['title']); ?>">
                                <div class="post-content">


                                    <h4 class="post-title"><?php echo htmlspecialchars($recent_posts[$i]['title']); ?></h4>
                                    <p class="post-excerpt">
                                        <?php echo htmlspecialchars(truncateContent($recent_posts[$i]['content'], 25)); ?></p>
                                    <a href="blog_details.php?blog_id=<?php echo htmlspecialchars($recent_posts[$i]['id']); ?>"
                                        class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-12">
                        <p>No recent posts available.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- BL 4: Popular Posts -->
    <section class="popular-section">
        <div class="container">
            <h3>Popular Post</h3>
            <a href="blog.php?section=popular" class="view-all">View All</a>
            <div class="row">
                <?php if (!empty($popular_posts)) { ?>
                    <?php foreach ($popular_posts as $post) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="post-card">
                                <img src="images/<?php echo htmlspecialchars($post['image']); ?>" class="post-image"
                                    alt="<?php echo htmlspecialchars($post['title']); ?>">
                                <div class="post-content">
                                    <div class="post-meta">
                                        <span><?php echo date('d-May-Y', strtotime($post['created_at'])); ?></span> |
                                        <span>View: <?php echo htmlspecialchars($post['views']); ?></span>
                                    </div>
                                    <h4 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h4>
                                    <p class="post-excerpt">
                                        <?php echo htmlspecialchars(truncateContent($post['content'], 15)); ?></p>
                                    <a href="blog_details.php?blog_id=<?php echo htmlspecialchars($post['id']); ?>"
                                        class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-12">
                        <p>No popular posts available.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>