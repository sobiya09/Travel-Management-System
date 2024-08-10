<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $user['id'];

$bookings_sql = "SELECT bookings.*, packages.name FROM bookings JOIN packages ON bookings.package_id = packages.id WHERE bookings.user_id = :user_id";
$stmt = $conn->prepare($bookings_sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$bookings_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Packages</title>
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
<!-- header section starts  -->
<section class="header">
   <a href="home.php" class="logo" style="font-weight:bold">Travel Management System</a>
   <nav class="navbar">
      <a href="index.php">home</a>
      <a href="about.php">about</a>
      <a href="view_packages.php">Packages</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>
</section>
<!-- header section ends -->

<!--dashboard section start-->

    <div class="dashboard-container">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
        <h2>Your Bookings</h2>
        <div class="bookings-container">
            <?php foreach ($bookings_result as $booking) { ?>
            <div class="booking-card">
                <h3><?php echo htmlspecialchars($booking['name']); ?></h3>
                <p>Booking Date: <?php echo htmlspecialchars($booking['booking_date']); ?></p>
                <p>Guests: <?php echo htmlspecialchars($booking['guests']); ?></p>
                <p>Email: <?php echo htmlspecialchars($booking['email']); ?></p>
                <p>Address: <?php echo htmlspecialchars($booking['address']); ?></p>
                <p>Phone: <?php echo htmlspecialchars($booking['phone']); ?></p>
                <div class="actions">
                    <a href="update_booking.php?id=<?php echo $booking['id']; ?>">Update</a>
                    <a href="cancel_booking.php?id=<?php echo $booking['id']; ?>">Delete</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

<!--dashboard sections end-->

<!-- footer section starts  -->
<section class="footer">
   <div class="box-container">
      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="view_packages.php"> <i class="fas fa-angle-right"></i> package</a>
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
         <a href="#"> <i class="fas fa-map"></i> Colombo, SriLanka- 1215  </a>
      </div>
      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
      </div>
   </div>
   <div class="credit"> created by <span>Web Design Team</span> | all rights reserved! </div>
</section>
<!-- footer section ends -->


<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
