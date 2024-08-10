<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Travel Agency :: Best Agency</title>
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
         <a href="index.php">home</a>
         <a href="about.php" class="active">about</a>
         <a href="view_packages.php">Packages</a>
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

   <!-- about section starts  -->
   <div class="heading" style="background:url(images/header-bg.jpg) no-repeat">
      <h1>about us</h1>
   </div>
   <section class="about">
      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>
      <div class="content">
         <h3>why choose us?</h3>
         <p>At Amazing Travels, we prioritize your satisfaction. Our dedicated team of travel experts is committed to providing personalized service and ensuring every detail of your trip is perfectly arranged.
            Travel with peace of mind knowing that our support team is available around the clock to assist you with any queries or emergencies during your trip.
         </p>
         <p>We understand that every traveler is unique. Our packages can be customized to match your individual interests, ensuring a truly personalized travel experience.</p>
         <div class="icons-container">
            <div class="icons">
               <i class="fas fa-map"></i>
               <span>top destinations</span>
            </div>
            <div class="icons">
               <i class="fas fa-headset"></i>
               <span>24/7 guide service</span>
            </div>
            <div class="icons">
               <i class="fas fa-hand-holding-usd"></i>
               <span>reasonable price</span>
            </div>
         </div>
      </div>
   </section>
   <!-- about section ends -->

   <!-- reviews section starts  -->
   <section class="reviews">
      <h1 class="heading-title"> clients reviews </h1>
      <div class="swiper reviews-slider">
         <div class="swiper-wrapper">
            <div class="swiper-slide slide">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>Kristy was very helpful at finding me a reasonably priced hotel and close to trams with short notice for the GC marathon weekend. Will definitely use this service again.</p>
               <h3>Tegan Killian</h3>
               <span>traveler</span>
               <img src="images/pic-4.png" alt="">
            </div>
            <div class="swiper-slide slide">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>As always great service,zero issues with connections.The best part of travel online is you can turn up at the airport with your passport and everything else is organised for you</p>
               <h3>Nora</h3>
               <span>traveler</span>
               <img src="images/pic-5.png" alt="">
            </div>
            <div class="swiper-slide slide">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>Package was fantastic value, documents were sent to us in a timely manner and our holiday went off without a hitch. everything was smoothly as can be! thank you</p>
               <h3>Adam Williamson</h3>
               <span>traveler</span>
               <img src="images/pic-6.png" alt="">
            </div>
            <div class="swiper-slide slide">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>As always great service,zero issues with connections.The best part of travel online is you can turn up at the airport with your passport and everything else is organised for you</p>
               <h3>Nora</h3>
               <span>traveler</span>
               <img src="images/pic-2.png" alt="">
            </div>
            <div class="swiper-slide slide">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>Kristy was very helpful at finding me a reasonably priced hotel and close to trams with short notice for the GC marathon weekend. Will definitely use this service again.</p>
               <h3>Tegan Killian</h3>
               <span>traveler</span>
               <img src="images/pic-1.png" alt="">
            </div>
            <div class="swiper-slide slide">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>Package was fantastic value, documents were sent to us in a timely manner and our holiday went off without a hitch. everything was smoothly as can be! thank you</p>
               <h3>Adam Williamson</h3>
               <span>traveler</span>
               <img src="images/pic-3.png" alt="">
            </div>
         </div>
      </div>
   </section>
   <!-- reviews section ends -->

   <!-- footer section starts  -->
   <button type="button" class="scroll-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></button>
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
   <!-- footer section ends -->

   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>