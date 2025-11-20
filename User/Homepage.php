<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$select="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Saloon Booking System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d47a1;
            --accent: #ffd54f;
            --light: #f5f7fa;
            --dark: #333;
            --gray: #666;
            --white: #fff;
            --shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .dashboard-container {
            display: flex;
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            padding: 20px;
            gap: 25px;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 25px 0;
            display: flex;
            flex-direction: column;
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        
        .user-profile {
            text-align: center;
            padding: 0 25px 25px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
        
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 32px;
            font-weight: 600;
        }
        
        .user-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .user-email {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .sidebar-nav {
            flex: 1;
        }
        
        .nav-item {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--dark);
            transition: var(--transition);
            border-left: 4px solid transparent;
        }
        
        .nav-item:hover, .nav-item.active {
            background: rgba(26, 115, 232, 0.05);
            border-left-color: var(--primary);
            color: var(--primary);
        }
        
        .nav-item i {
            width: 24px;
            margin-right: 15px;
            font-size: 18px;
        }
        
        .logout-item {
            margin-top: auto;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 15px;
            padding: 30px;
            color: var(--white);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        
        .welcome-banner h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }
        
        .welcome-banner p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
            max-width: 600px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 10px;
        }
        
        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            transition: var(--transition);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 20px;
            margin-right: 15px;
        }
        
        .stat-info {
            flex: 1;
        }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
            margin-top: 5px;
        }
        
        .quick-actions {
            background: var(--white);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow);
        }
        
        .section-title {
            font-size: 1.4rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .action-card {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        
        .action-card:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }
        
        .action-card i {
            font-size: 24px;
            margin-bottom: 10px;
            display: block;
        }
        
        .recent-activity {
            background: var(--white);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow);
            flex: 1;
        }
        
        .activity-list {
            list-style: none;
        }
        
        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(26, 115, 232, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-right: 15px;
            font-size: 16px;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .activity-time {
            font-size: 0.85rem;
            color: var(--gray);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            color: var(--gray);
            font-size: 0.9rem;
            background: var(--white);
            margin-top: 30px;
            border-top: 1px solid #eee;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                position: static;
            }
            
            .sidebar-nav {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 10px;
            }
            
            .nav-item {
                border-left: none;
                border-bottom: 3px solid transparent;
                justify-content: center;
                text-align: center;
                flex-direction: column;
                padding: 15px 10px;
            }
            
            .nav-item:hover, .nav-item.active {
                border-left-color: transparent;
                border-bottom-color: var(--primary);
            }
            
            .nav-item i {
                margin-right: 0;
                margin-bottom: 8px;
                font-size: 20px;
            }
            
            .logout-item {
                grid-column: 1 / -1;
                margin-top: 20px;
                border-top: 1px solid #eee;
                padding-top: 20px;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .welcome-banner h1 {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 480px) {
            .actions-grid {
                grid-template-columns: 1fr;
            }
            
            .dashboard-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="user-profile">
                <div class="avatar">
                    <?php echo substr($data['user_name'], 0, 1); ?>
                </div>
                <h2 class="user-name"><?php echo $data['user_name']; ?></h2>
                <p class="user-email"><?php echo $data['user_email'] ?? 'user@example.com'; ?></p>
            </div>
            
            <nav class="sidebar-nav">
                <a href="Homepage.php" class="nav-item active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="Viewsaloon.php" class="nav-item">
                    <i class="fas fa-cut"></i>
                    <span>View Saloon</span>
                </a>
                <a href="Mybooking.php" class="nav-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>My Bookings</span>
                </a>
                <a href="mypackagebooking.php" class="nav-item">
                    <i class="fas fa-gift"></i>
                    <span>Package Booking</span>
                </a>
                <a href="ViewRequirements.php" class="nav-item">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Requirements</span>
                </a>
                <a href="Userprofile.php" class="nav-item">
                    <i class="fas fa-user-circle"></i>
                    <span>Profile</span>
                </a>
                <a href="usercp.php" class="nav-item">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                </a>
                <a href="feedback.php" class="nav-item">
                    <i class="fas fa-comment-dots"></i>
                    <span>Feedback</span>
                </a>
                <a href="Complaint.php" class="nav-item">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Complaint</span>
                </a>
                <a href="../Logout.php" class="nav-item logout-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <section class="welcome-banner">
                <h1>Welcome back, <?php echo $data['user_name']; ?>!</h1>
                <p>Here's an overview of your appointments and salon activities.</p>
            </section>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">3</div>
                        <div class="stat-label">Upcoming Appointments</div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">4.8</div>
                        <div class="stat-label">Average Rating</div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">2</div>
                        <div class="stat-label">Active Packages</div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">12</div>
                        <div class="stat-label">Total Visits</div>
                    </div>
                </div>
            </div>
            
            <section class="quick-actions">
                <h2 class="section-title">
                    <i class="fas fa-bolt"></i>
                    Quick Actions
                </h2>
                
                <div class="actions-grid">
                    <a href="Viewsaloon.php" class="action-card">
                        <i class="fas fa-cut"></i>
                        <div>Book Service</div>
                    </a>
                    
                    <a href="Mybooking.php" class="action-card">
                        <i class="fas fa-calendar-check"></i>
                        <div>View Bookings</div>
                    </a>
                    
                    <a href="mypackagebooking.php" class="action-card">
                        <i class="fas fa-gift"></i>
                        <div>Packages</div>
                    </a>
                    
                    <a href="feedback.php" class="action-card">
                        <i class="fas fa-comment-dots"></i>
                        <div>Give Feedback</div>
                    </a>
                </div>
            </section>
            
            <section class="recent-activity">
                <h2 class="section-title">
                    <i class="fas fa-history"></i>
                    Recent Activity
                </h2>
                
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Appointment Confirmed</div>
                            <div class="activity-time">Haircut at Style Studio - Tomorrow at 2:00 PM</div>
                        </div>
                    </li>
                    
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Rating Submitted</div>
                            <div class="activity-time">You rated your last visit 5 stars</div>
                        </div>
                    </li>
                    
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Package Renewed</div>
                            <div class="activity-time">Premium Haircare package extended</div>
                        </div>
                    </li>
                    
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Profile Updated</div>
                            <div class="activity-time">Your contact information was changed</div>
                        </div>
                    </li>
                </ul>
            </section>
        </main>
    </div>
    
    <footer class="footer">
        <p>&copy; 2023 Saloon Booking System. All rights reserved. | Designed for your convenience</p>
    </footer>
</body>
</html>