<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $user['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_id = $_POST['package_id'];
    $booking_date = $_POST['booking_date'];
    $guests = $_POST['guests'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Server-side validation
    $errors = [];
    if (empty($booking_date)) $errors[] = "Booking date is required.";
    if (empty($guests) || $guests <= 0) $errors[] = "Guests must be a positive number.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
    if (empty($address)) $errors[] = "Address is required.";
    if (empty($phone) || !preg_match('/^\d{10}$/', $phone)) $errors[] = "A valid phone number is required.";

    if (empty($errors)) {
        $sql = "INSERT INTO bookings (user_id, package_id, booking_date, guests, email, address, phone) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id, $package_id, $booking_date, $guests, $email, $address, $phone]);

        header('Location: dashboard.php');
        exit();
    }
}

$package_id = $_GET['id'];
$package_sql = "SELECT * FROM packages WHERE id=?";
$stmt = $conn->prepare($package_sql);
$stmt->execute([$package_id]);
$package = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Package</title>
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/book.css">
</head>

<body>

    <!-- Header section remains the same -->
    <section class="header">
        <a href="index.php" class="logo" style="font-weight:bold">Travel Management System </a>
        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="about.php">about</a>
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
    <!-- ... -->


    <!--booking section start-->
    <div class="booking-page-wrapper" style="background-image: url(images/b4.jpg);">
        <div class="book-package-container ">
            <h1>Book Package: <?php echo htmlspecialchars($package['name']); ?></h1>
            <?php if (!empty($errors)) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form method="POST" onsubmit="return validateForm()">
                <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package_id); ?>">
                <div class="form-group">
                    <label for="booking_date">Booking Date: </label>
                    <input type="date" id="booking_date" name="booking_date" required>
                </div>
                <div class="form-group">
                    <label for="guests">Guests: </label>
                    <input type="number" id="guests" name="guests" required>
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Address: </label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number: </label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <button type="submit">Book</button>
            </form>
        </div>
    </div>
    <!--...-->

    <!-- Footer section remains the same -->
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
    <!-- ... -->

    <script>
        function validateForm() {
            var bookingDate = document.getElementById('booking_date').value;
            var guests = document.getElementById('guests').value;
            var email = document.getElementById('email').value;
            var address = document.getElementById('address').value;
            var phone = document.getElementById('phone').value;
            if (bookingDate === '' || guests === '' || email === '' || address === '' || phone === '') {
                alert('All fields are required.');
                return false;
            }
            if (guests <= 0) {
                alert('Number of guests must be greater than zero.');
                return false;
            }
            return true;
        }
    </script>

    <!-- swiper js link  -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>