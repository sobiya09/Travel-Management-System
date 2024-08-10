<?php
session_start();
include('config.php'); // Include the database connection

// Fetch packages from the database
$packages_sql = "SELECT * FROM packages LIMIT 3"; // Limit to 3 packages for the home page
$packages_stmt = $conn->prepare($packages_sql);
$packages_stmt->execute();
$packages_result = $packages_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Travel Management System</title>
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   

</head>
<body>
<!-- header section starts  -->
<section class="header">
   <a href="index.php" class="logo" style="font-weight:bold">Travel Management System </a>
   <nav class="navbar">
      <a href="index.php" class="active">home</a>
      <a href="about.php">about</a>
      <a href="view_packages.php">Packages</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            
        <?php endif; ?>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>
</section>
<!-- header section ends -->
 
<!-- home section starts  -->
<section class="home">
   <div class="swiper home-slider">
      <div class="swiper-wrapper">
         <div class="swiper-slide slide" style="background:url(images/homeslide-1.jpg)no-repeat">
            <div class="content">
               <span style="color:aliceblue">search, express, travel</span>
               <h3>travel around the universe</h3>
               <a href="about.php" class="btn">See more</a>
            </div>
         </div>
         <div class="swiper-slide slide" style="background:url(images/homeslide-2.jpg) no-repeat">
            <div class="content">
               <span style="color:aliceblue">search, express, travel</span>
               <h3>express the new destination</h3>
               <a href="view_packages.php" class="btn">See more</a>
            </div>
         </div>
         <div class="swiper-slide slide" style="background:url(images/home-slide-3.jpg) no-repeat">
            <div class="content">
               <span style="color:aliceblue">search, express, tour</span>
               <h3>make your tour effective</h3>
               <a href="view_packages.php" class="btn">See more</a>
            </div>
         </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
   </div>
</section>
<!-- home section ends -->
<!-- services section starts  -->
<section class="services">
   <h1 class="heading-title"> our services </h1>
   <div class="box-container">
      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>tour guide</h3>
      </div>
      <div class="box">
         <img src="images/icon-6.png" alt="">
         <h3>camping</h3>
      </div>
      <div class="box">
         <img src="images/icon-1.png" alt="">
         <h3>adventure</h3>
      </div>
      <div class="box">
         <img src="images/icon-3.png" alt="">
         <h3>trekking</h3>
      </div>
      <div class="box">
         <img src="images/icon-5.png" alt="">
         <h3>off road</h3>
      </div>
      <div class="box">
         <img src="images/icon-4.png" alt="">
         <h3>camp fire</h3>
      </div>
   </div>
</section>
<!-- services section ends -->
<!-- home about section starts  -->
<section class="home-about">
   <div class="image">
      <img src="images/about.jpg" alt="">
   </div>
   <div class="content">
      <h3>about us</h3>
      <p>Welcome to Amazing Travels – your trusted tour operator and travel agent in Sri Lanka.
          We specialize in providing exceptional travel experiences with a wide range of international and domestic travel packages at unbeatable prices.
          Whether you're planning a honeymoon, an adventure, or a relaxing getaway, our tailored travel packages ensure your journey is memorable and stress-free. 
          Discover the world with us and create unforgettable memories...</p>
      <a href="about.php" class="btn">read more</a>
   </div>
</section>
<!-- home about section ends -->
<!-- home packages section starts  -->
<section class="home-packages">
   <h1 class="heading-title"> our packages </h1>
   <div class="box-container">
      <?php foreach ($packages_result as $package) { ?>
      <div class="box">
         <div class="image">
            <img src="<?php echo $package['image_url']; ?>" alt="Package Image">
         </div>
         <div class="content">
            <h3><?php echo $package['name']; ?></h3>
            <p><?php echo $package['description']; ?></p>
            <h2>Price: <?php echo $package['price']; ?></h2>
            <a href="book.php?id=<?php echo $package['id']; ?>" class="btn">book now</a>
         </div>
      </div>
      <?php } ?>
   </div>
   <div class="load-more"> <a href="view_packages.php" class="btn">See more packages</a> </div>
</section>
<!-- home packages section ends -->

<button type="button" class="scroll-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></button>
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