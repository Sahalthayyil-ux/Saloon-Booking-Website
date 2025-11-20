<?php
include('SessionValidation.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saloon Booking System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo {
            font-size: 2.5rem;
            color: #1a73e8;
            margin-bottom: 10px;
        }
        
        .logo i {
            margin-right: 10px;
        }
        
        h1 {
            color: #1a1a1a;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        
        .nav-container {
            background: linear-gradient(135deg, #ffffff 0%, #e6f0ff 100%);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
            border: 1px solid #e0e0e0;
        }
        
        .nav-menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            list-style: none;
            padding: 0;
        }
        
        .nav-item {
            flex-grow: 1;
            text-align: center;
            border-right: 1px solid #d0e2fd;
            transition: all 0.3s ease;
        }
        
        .nav-item:last-child {
            border-right: none;
        }
        
        .nav-item:hover {
            background-color: rgba(26, 115, 232, 0.1);
        }
        
        .nav-link {
            display: block;
            padding: 20px 15px;
            text-decoration: none;
            color: #4a4a4a;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link i {
            margin-right: 8px;
            font-size: 18px;
            vertical-align: middle;
            color: #1a73e8;
        }
        
        .nav-link:hover {
            color: #1a73e8;
            transform: translateY(-2px);
        }
        
        .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            width: 60%;
            height: 3px;
            background-color: #1a73e8;
            border-radius: 3px;
        }
        
        .active {
            background-color: rgba(26, 115, 232, 0.15);
            color: #1a73e8;
        }
        
        .active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            width: 60%;
            height: 3px;
            background-color: #1a73e8;
            border-radius: 3px;
        }
        
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e0e0e0;
        }
        
        .content h2 {
            color: #1a73e8;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e6f0ff;
        }
        
        .content p {
            line-height: 1.6;
            margin-bottom: 15px;
            color: #444;
        }
        
        @media (max-width: 900px) {
            .nav-menu {
                flex-direction: column;
            }
            
            .nav-item {
                border-right: none;
                border-bottom: 1px solid #d0e2fd;
            }
            
            .nav-item:last-child {
                border-bottom: none;
            }
        }
        
        @media (max-width: 600px) {
            .logo {
                font-size: 2rem;
            }
            
            .nav-link {
                padding: 15px 10px;
                font-size: 14px;
            }
            
            .nav-link i {
                display: block;
                margin: 0 auto 5px;
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <i class="fas fa-spa"></i>Salon
            </div>
            <h1>Saloon Booking System</h1>
            <p class="subtitle">Book your beauty treatments with ease</p>
        </header>
        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <nav class="nav-container">
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="Homepage.php" class="nav-link <?php if($current_page == 'Homepage.php'){echo 'active';} ?>">
                <i class="fas fa-home"></i> Home Page
            </a>
        </li>
        <li class="nav-item">
            <a href="Viewsaloon.php" class="nav-link <?php if($current_page == 'Viewsaloon.php'){echo 'active';} ?>">
                <i class="fas fa-store"></i> View Saloon
            </a>
        </li>
        <li class="nav-item">
            <a href="Mybooking.php" class="nav-link <?php if($current_page == 'Mybooking.php'){echo 'active';} ?>">
                <i class="fas fa-calendar-check"></i> My Booking
            </a>
        </li>
        <li class="nav-item">
            <a href="mypackagebooking.php" class="nav-link <?php if($current_page == 'mypackagebooking.php'){echo 'active';} ?>">
                <i class="fas fa-gift"></i> My Package Booking
            </a>
        </li>
        <li class="nav-item">
            <a href="ViewRequirements.php" class="nav-link <?php if($current_page == 'ViewRequirements.php'){echo 'active';} ?>">
                <i class="fas fa-clipboard-list"></i> View Requirements
            </a>
        </li>
        <li class="nav-item">
            <a href="Userprofile.php" class="nav-link <?php if($current_page == 'Userprofile.php'){echo 'active';} ?>">
                <i class="fas fa-user"></i> User Profile
            </a>
        </li>
        <li class="nav-item">
            <a href="usercp.php" class="nav-link <?php if($current_page == 'usercp.php'){echo 'active';} ?>">
                <i class="fas fa-key"></i> Change Password
            </a>
        </li>
        <li class="nav-item">
            <a href="feedback.php" class="nav-link <?php if($current_page == 'feedback.php'){echo 'active';} ?>">
                <i class="fas fa-comment"></i> Feedback
            </a>
        </li>
        <li class="nav-item">
            <a href="Complaint.php" class="nav-link <?php if($current_page == 'Complaint.php'){echo 'active';} ?>">
                <i class="fas fa-exclamation-circle"></i> Complaint
            </a>
        </li>
        <li class="nav-item">
            <a href="../Logout.php" class="nav-link">
                <i class="fa fa-sign-out-alt me-2"></i> Logout
            </a>
        </li>
    </ul>
</nav>

        
        <!-- <div class="content">
            <h2>Welcome to Our Beauty Salon</h2>
            <p>We are dedicated to providing you with the best beauty and wellness services. Our team of professional stylists and beauticians are here to help you look and feel your best.</p>
            <p>Use the navigation menu above to book appointments, view your profile, manage your bookings, or provide feedback on our services.</p>
            <p>Thank you for choosing us for your beauty needs!</p>
        </div> -->
    </div>

    <script>
        // Simple JavaScript to handle active state
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>