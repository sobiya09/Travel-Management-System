<?php
session_start();
include('config.php');
$packages_sql = "SELECT * FROM packages";
$stmt = $conn->query($packages_sql);
$packages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Packages</title>
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/view_package.css">
</head>

<body>

    <!-- header section starts  -->
    <section class="header">
        <a href="index.php" class="logo" style="font-weight:bold">Travel Management System </a>
        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="about.php">about</a>
            <a href="view_packages.php" class="active">Packages</a>
            <?php if (isset($_SESSION['username'])) : ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else : ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>
    <!-- header section ends -->

    <!--packages section-->
    <div class="packages-container">
        <?php foreach ($packages as $package) { ?>
            <div class="package-card">
                <img src="<?php echo htmlspecialchars($package['image_url']); ?>" alt="Package Image">
                <h2><?php echo htmlspecialchars($package['name']); ?></h2>
                <p><?php echo htmlspecialchars($package['description']); ?></p>
                <strong>
                    <p>Price: Rs.<?php echo htmlspecialchars($package['price']); ?></p>
                </strong>
                <div class="actions">
                    <a href="book.php?id=<?php echo htmlspecialchars($package['id']); ?>" class="book-link">Book Now</a>
                </div>
            </div>
        <?php } ?>
    </div>
<!--...-->

<!--footer section-->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>quick links</h3>
                <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
                <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
                <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
                <a href="book.php"> <i class="fas fa-angle-right"></i> Sign up</a>
            </div>
            <div class="box">
                <h3>extra links</h3>
                <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
                <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
                <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
                <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
            </div>
            <div class="box">
                <h3>contact info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +94 766401537 </a>
                <a href="#"> <i class="fas fa-phone"></i> +94 222221599 </a>
                <a href="#" style="text-transform: none;"> <i class="fas fa-envelope"></i> travelweb27@gmail.com </a>
                <a href="#"> <i class="fas fa-map"></i> Colombo, SriLanka- 1215 </a>
            </div>
            <div class="box">
                <h3>follow us</h3>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
                <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            </div>
        </div>
        <div class="credit"> designed by <span>Web Design Team</span> | all rights reserved! </div>
    </section>
<!--...-->
    <script>
        // confirm user's action
        document.addEventListener('DOMContentLoaded', function() {
            const bookLinks = document.querySelectorAll('.book-link');
            bookLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    if (!confirm('Are you sure you want to book this package?')) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>

    <!-- swiper js link  -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>