<?php
session_start();
require 'config.php';

$error = ''; // Initialize error variable to store error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $rememberMe = isset($_POST['remember_me']); // Check if the 'remember me' checkbox is checked

    if (!empty($username) && !empty($password)) {
        // Check if the user is an admin or a regular user
        $user_check_sql = "SELECT * FROM users WHERE username = :username";
        $admin_check_sql = "SELECT * FROM admins WHERE adminUsername = :username";

        $user_stmt = $conn->prepare($user_check_sql);
        $admin_stmt = $conn->prepare($admin_check_sql);

        $user_stmt->bindParam(':username', $username);
        $admin_stmt->bindParam(':username', $username);

        $user_stmt->execute();
        $admin_stmt->execute();

        $user = $user_stmt->fetch();
        $admin = $admin_stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
         // Set session variables for the user  
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = 'user';

            // Set cookies only if 'Remember me' is checked
            if ($rememberMe) {
               setcookie("username", $user['username'], time() + (86400 * 30), "/");
               setcookie("role", 'user', time() + (86400 * 30), "/");
           }

            header("Location: view_packages.php");
            exit;
        } elseif ($admin && password_verify($password, $admin['adminPassword'])) {
            $_SESSION['username'] = $admin['adminUsername'];
            $_SESSION['role'] = 'admin';

            // Set cookies only if 'Remember me' is checked
            if ($rememberMe) {
               setcookie("username", $admin['adminUsername'], time() + (86400 * 30), "/");
               setcookie("role", 'admin', time() + (86400 * 30), "/");
           }

            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/login.css">


<script>
   document.addEventListener("DOMContentLoaded", function() {
      const pwShowHide = document.querySelectorAll(".pw_hide");
      pwShowHide.forEach((icon) => {
         icon.addEventListener("click", () => {
            let getPwInput = icon.parentElement.querySelector("input");
            if (getPwInput.type === "password") {
               getPwInput.type = "text";
               icon.classList.replace("uil-eye-slash", "uil-eye");
            } else {
               getPwInput.type = "password";
               icon.classList.replace("uil-eye", "uil-eye-slash");
            }
         });
      });
   });

   function validateForm() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            if (username === '' || password === '') {
               alert('All fields are required.');
               return false;
            }
            return true;
         }
</script>

</head>

<body style="background-image: url('images/b4.jpg');">

   <!-- header section starts  -->
   <section class="header">
      <a href="index.php" class="logo" style="font-weight:bold">Travel Management System</a>
      <nav class="navbar">
         <a href="index.php">home</a>
         <a href="about.php">about</a>
         <a href="view_packages.php">Packages</a>
         <?php if (isset($_SESSION['username'])) : ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
         <?php else : ?>
            <a href="login.php" class="active">Login</a>
            <a href="register.php">SignUp</a>
         <?php endif; ?>
      </nav>
      <div id="menu-btn" class="fas fa-bars"></div>
   </section>
   <!-- header section ends -->

   <!--login section-->

   <div class="login-form-wrapper">
      <div class="login-form_container">
         <h1>Login</h1>
         <?php if ($error) : ?>
            <p class="error"><?php echo $error; ?></p>
         <?php endif; ?>
         <form method="POST" onsubmit="return validateForm()">
            <div class="login-input_box">
               <input type="text" required placeholder="Username" id="username" name="username">
               <i class="uil uil-user user"></i>
            </div>
            <div class="login-input_box">
               <input type="password" required placeholder="Password" id="password" name="password">
               <i class="uil uil-lock password"></i>
               <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="login-option_field">
               <label class="login-checkbox">
               <input type="checkbox" name="remember_me"> Remember me
               </label>
            </div>
            <button type="submit" style="background: #247ba0; margin-top: 30px; width: 100%; padding: 10px 0;  border-radius: 10px; color: #fff; border: none;cursor: pointer;">Login</button>
            <div class="login_signup">
               <span>Don't have an account? <a href="register.php">Sign up</a></span>
            </div>
         </form>
      </div>
 
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
         <div class="credit"> created by <span>Web Design Team</span> | all rights reserved! </div>
      </section>
      <!-- footer section ends -->

      <!-- swiper js link  -->
      <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
      <!-- custom js file link  -->
      <script src="js/script.js"></script>
</body>

</html>
