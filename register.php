<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Trim input data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone_number = trim($_POST['mobile']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Initialize an array to store error messages
    $errors = [];

    // Check for empty fields
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }
    if (empty($phone_number)) {
        $errors['mobile'] = "Phone number is required.";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Confirm Password is required.";
    }

    // Validate email format
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate phone number
    if (!empty($phone_number) && !preg_match('/^\d{10}$/', $phone_number)) {
        $errors['mobile'] = "Invalid phone number. It must be 10 digits long.";
    }

    // Validate password strength
    if (!empty($password) && !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $errors['password'] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Check if the username already exists
        $check_sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bindParam(':username', $username);
        $check_stmt->execute();
        $username_exists = $check_stmt->fetchColumn();

        if ($username_exists) {
            $errors['username'] = "Username already exists. Please choose a different username.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, email_address, address, phone_number, password) VALUES (:username, :email, :address, :phone_number, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->bindParam(':password', $hashed_password);

            try {
                $stmt->execute();
                header('Location: login.php');
                exit();
            } catch (PDOException $e) {
                $errors['general'] = "Error: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
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
    </script>
</head>

<body style="background-image: url('./images/b4.jpg');">
    <!-- header section starts  -->
    <section class="header">
        <a href="index.php" class="logo" style="color: black;"> <strong>Travel Management System</strong> </a>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="view_packages.php">Packages</a>
            <a href="login.php">Login</a>
            <a href="register.php" class="active">Signup</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>
    <!-- header section ends -->

    <!--signup section-->
    <div class="signup-form_container">
        <h2>Sign Up</h2>
        <form action="register.php" method="post">
            <div class="signup-input_box">
                <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username ?? ''); ?>">
                <i class="uil uil-user username"></i>
                <?php if (!empty($errors['username'])) : ?>
                    <div class="error-message"><?php echo htmlspecialchars($errors['username']); ?></div>
                <?php endif; ?>
            </div>
            <div class="signup-input_box">
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                <i class="uil uil-envelope email"></i>
                <?php if (!empty($errors['email'])) : ?>
                    <div class="error-message"><?php echo htmlspecialchars($errors['email']); ?></div>
                <?php endif; ?>
            </div>
            <div class="signup-input_box">
                <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($address ?? ''); ?>">
                <i class="uil uil-map-marker address"></i>
                <?php if (!empty($errors['address'])) : ?>
                    <div class="error-message"><?php echo htmlspecialchars($errors['address']); ?></div>
                <?php endif; ?>
            </div>
            <div class="signup-input_box">
                <input type="text" name="mobile" placeholder="Phone Number" value="<?php echo htmlspecialchars($phone_number ?? ''); ?>">
                <i class="uil uil-phone phone"></i>
                <?php if (!empty($errors['mobile'])) : ?>
                    <div class="error-message"><?php echo htmlspecialchars($errors['mobile']); ?></div>
                <?php endif; ?>
            </div>
            <div class="signup-input_box">
                <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password ?? ''); ?>">
                <i class="uil uil-lock password"></i>
                <i class="uil uil-eye-slash pw_hide"></i>
                <?php if (!empty($errors['password'])) : ?>
                    <div class="error-message"><?php echo htmlspecialchars($errors['password']); ?></div>
                <?php endif; ?>
            </div>
            <div>
                <br><br>
            </div>
            <div class="signup-input_box">
                <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo htmlspecialchars($confirm_password ?? ''); ?>">
                <i class="uil uil-lock confirm_password"></i>
                <i class="uil uil-eye-slash pw_hide"></i>
                <?php if (!empty($errors['confirm_password'])) : ?>
                    <div class="error-message"><?php echo htmlspecialchars($errors['confirm_password']); ?></div>
                <?php endif; ?>
            </div>
            <button class="button" type="submit">Sign Up</button>
            <div class="login_signup">Already have an account? <a href="login.php">Login</a></div>
            <?php if (!empty($errors['general'])) : ?>
                <div class="error"><?php echo htmlspecialchars($errors['general']); ?></div>
            <?php endif; ?>
        </form>
    </div>

    <!--...-->

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