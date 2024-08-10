<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

require 'config.php';

$sql = "SELECT COUNT(*) as user_count FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user_count = $stmt->fetch(PDO::FETCH_ASSOC)['user_count']; // Fetch the user count

$sqlbook = "SELECT COUNT(*) as book_count FROM bookings";
$stmtbook = $conn->prepare($sqlbook);
$stmtbook->execute();
$book_count = $stmtbook->fetch(PDO::FETCH_ASSOC)['book_count']; // Fetch the booking count

// Query to get the number of bookings for each package
$sqlPackages = "SELECT packages.name, COUNT(bookings.id) as booking_count 
                FROM bookings 
                JOIN packages ON bookings.package_id = packages.id 
                GROUP BY packages.name";
$stmtPackages = $conn->prepare($sqlPackages);
$stmtPackages->execute();
$package_data = $stmtPackages->fetchAll(PDO::FETCH_ASSOC);

// Initialize arrays to store package names and booking counts
$package_names = array();
$booking_counts = array();

// Loop through the package data to populate the arrays
foreach ($package_data as $data) {
    $package_names[] = $data['name'];
    $booking_counts[] = $data['booking_count'];
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="./css/adminDashboard.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Script tag to include Chart.js for creating charts and graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Script tag to include jQuery library for handling JavaScript events and DOM manipulations -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div>
        <div id="adminDashboardMainContainer">
            <div id="adminDashboard_slidebar">
                <h3 id="adminDashboard_logo">Travel Management System</h3>
                <div id="adminDashboard_slidebar_user">
                    <img src="./images/user.jpg" alt="User Image" id="userImage"><br><br>
                    <span id="userName"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <div id="userDetails">
                        <a href="admin_dashboard.php"><i class="fas fa-phone"></i><span class="menuText"> +94 766401537 </span></a>
                        <a href="admin_dashboard.php"><i class="fas fa-envelope"></i><span class="menuText"> travelweb27@gmail.com</span></a>
                        <a href="admin_dashboard.php"><i class="fas fa-map"></i><span class="menuText"> Colombo, SriLanka- 1215 </span></a>
                    </div>
                </div>
                <div class="adminDashboard_slidebar_menus">
                    <div class="adminDashboard_menu_lists">
                        <li>
                            <a href="javascript:void(0);" id="dashboardBtn"><i class="fa-solid fa-gauge"></i><span class="menuText"> Dashboard</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" id="usersBtn"><i class="fa-solid fa-users"></i><span class="menuText"> Users</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" id="bookingsBtn"><i class="fa-solid fa-book"></i><span class="menuText"> Bookings</span></a>
                        </li>
                    </div>
                </div>
            </div>
            <div id="adminDashboard_content_container">
                <div class="adminDashboard_topNav">
                    <a href="" id="toggleBtn"><i class="fa-solid fa-bars"></i></a>
                    <a href="logout.php" id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i> Log Out </a>
                </div>
                <div class="adminDashboard_content">
                    <div class="adminDashboard_content_main">
                        <div id="usersSection" class="dashboardSection" style="display: none;">
                            <h2>Users</h2>
                            <div id="userDetailsSection"></div>
                        </div>
                        <div id="bookingsSection" class="dashboardSection" style="display: none;">
                            <h2>Bookings</h2>
                            <div id="bookingDetailsSection"></div>
                        </div>
                        <div id="dashboardSection" class="dashboardSection">
                            <div id="details" class="dashboardSubSection">
                                <h2>Users Count</h2>
                                <p><?php echo $user_count; ?></p>
                            </div>
                            <div id="details" class="dashboardSubSection">
                                <h2>Bookings Count</h2>
                                <p><?php echo $book_count; ?></p>
                            </div>
                            <div id="details" class="dashboardSubSection">
                                <canvas id="barChart"></canvas>
                            </div>
                            <div id="details" class="dashboardSubSection">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var sideBarIsOpen = true;
        document.getElementById('toggleBtn').addEventListener("click", function(event) {
            event.preventDefault();

            if (sideBarIsOpen) {
                document.getElementById('adminDashboard_slidebar').style.width = '8%';
                document.getElementById('adminDashboard_content_container').style.width = '92%';
                document.getElementById('adminDashboard_logo').style.fontSize = '15px';
                document.getElementById('userImage').style.width = '40px';
                document.getElementById('userImage').style.height = '40px';
                document.getElementById('userName').style.fontSize = '15px';

                var menuIcons = document.getElementsByClassName('menuText');
                for (var i = 0; i < menuIcons.length; i++) {
                    menuIcons[i].style.display = 'none';
                }
                document.getElementsByClassName('adminDashboard_slidebar_menus')[0].style.textAlign = 'center';
                sideBarIsOpen = false;
            } else {
                document.getElementById('adminDashboard_slidebar').style.width = '20%';
                document.getElementById('adminDashboard_content_container').style.width = '80%';
                document.getElementById('adminDashboard_logo').style.fontSize = '25px';
                document.getElementById('userImage').style.width = '90px';
                document.getElementById('userImage').style.height = '80px';
                document.getElementById('userName').style.fontSize = '20px';

                var menuIcons = document.getElementsByClassName('menuText');
                for (var i = 0; i < menuIcons.length; i++) {
                    menuIcons[i].style.display = 'inline-block';
                }
                document.getElementsByClassName('adminDashboard_menu_lists')[0].style.textAlign = 'left';
                sideBarIsOpen = true;
            }
        });

        // Initialize the bar chart using Chart.js
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($package_names); ?>,
                datasets: [{
                    label: '# of Bookings',
                    data: <?php echo json_encode($booking_counts); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
        // Initialize the pie chart using Chart.js
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($package_names); ?>,
                datasets: [{
                    label: '# of Bookings',
                    data: <?php echo json_encode($booking_counts); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        // Handle button clicks to load users and bookings
        document.getElementById('usersBtn').addEventListener('click', function() {
            loadSection('users');
        });

        document.getElementById('bookingsBtn').addEventListener('click', function() {
            loadSection('bookings');
        });

        document.getElementById('dashboardBtn').addEventListener('click', function() {
            loadSection('dashboard');
        });

        function loadSection(section) {
            // Hide all sections
            var sections = document.getElementsByClassName('dashboardSection');
            for (var i = 0; i < sections.length; i++) {
                sections[i].style.display = 'none';
            }

            // Show the selected section
            if (section === 'users') {
                document.getElementById('usersSection').style.display = 'block';
                fetchUserDetails();
            } else if (section === 'bookings') {
                document.getElementById('bookingsSection').style.display = 'block';
                fetchBookingDetails();
            } else if (section === 'dashboard') {
                document.getElementById('dashboardSection').style.display = 'block';
            }
        }

        function fetchUserDetails() {
            $.ajax({
                url: 'fetch_users.php',
                method: 'GET',
                success: function(data) {
                    $('#userDetailsSection').html(data);
                }
            });
        }

        function fetchBookingDetails() {
            $.ajax({
                url: 'fetch_bookings.php',
                method: 'GET',
                success: function(data) {
                    $('#bookingDetailsSection').html(data);
                }
            });
        }
    </script>
</body>

</html>