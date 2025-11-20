<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$select="select * from tbl_admin where admin_id='".$_SESSION['aid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();

// Get counts for dashboard stats
$user_count = $con->query("SELECT COUNT(*) as count FROM tbl_user")->fetch_assoc()['count'];
$salon_count = $con->query("SELECT COUNT(*) as count FROM tbl_saloon")->fetch_assoc()['count'];
$feedback_count = $con->query("SELECT COUNT(*) as count FROM tbl_feedback")->fetch_assoc()['count'];
$complaint_count = $con->query("SELECT COUNT(*) as count FROM tbl_complaint")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../Assets/Templates/Admin/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../Assets/Templates/Admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../Assets/Templates/Admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Templates/Admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/Templates/Admin/css/style.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4b6cb7;
            --secondary-color: #182848;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }
        
        .stat-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.3s;
        }
        .stat-card:hover::before {
            opacity: 1;
        }
        .welcome-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 12px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }
        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255,255,255,0.1);
            transform: rotate(30deg);
        }
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.9;
            transition: transform 0.3s;
        }
        .stat-card:hover .stat-icon {
            transform: scale(1.1);
        }
        .user-card { 
            border-left-color: var(--primary-color); 
            background: linear-gradient(135deg, rgba(78, 115, 223, 0.1), rgba(78, 115, 223, 0.05));
        }
        .salon-card { 
            border-left-color: var(--success-color); 
            background: linear-gradient(135deg, rgba(28, 200, 138, 0.1), rgba(28, 200, 138, 0.05));
        }
        .feedback-card { 
            border-left-color: var(--info-color); 
            background: linear-gradient(135deg, rgba(54, 185, 204, 0.1), rgba(54, 185, 204, 0.05));
        }
        .complaint-card { 
            border-left-color: var(--warning-color); 
            background: linear-gradient(135deg, rgba(246, 194, 62, 0.1), rgba(246, 194, 62, 0.05));
        }
        
        /* Improved dropdown visibility
        .dropdown-menu {
            background: #2a3a4f !important;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        } */
        .dropdown-item {
            color: #1a78d6ff !important;
            padding: 10px 20px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .dropdown-item:hover {
            background: rgba(78, 115, 223, 0.2) !important;
            color: #fff !important;
            border-left-color: var(--primary-color);
            padding-left: 25px;
        }
        
        /* Quick action buttons */
        .quick-action-btn {
            transition: all 0.3s;
            border-radius: 10px;
            border: none;
            position: relative;
            overflow: hidden;
        }
        .quick-action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .quick-action-btn:hover::before {
            left: 100%;
        }
        .quick-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        
        /* Calendar styling */
        .calendar-container {
            border-radius: 10px;
        }
        
        /* Improved typography */
        .stat-card h6 {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .stat-card p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }
        
        /* Card number animation */
        .counter {
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="Adminhome.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin Panel</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../Assets/Templates/Admin/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $data['admin_name']; ?></h6>
                        <span>Administrator</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="Adminhome.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-map-marker-alt me-2"></i>LOCATION</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="State.php" class="dropdown-item">State</a>
                            <a href="District.php" class="dropdown-item">District</a>
                            <a href="Place.php" class="dropdown-item">Place</a>
                        </div>
                    </div>
                    <a href="Category.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Category</a>
                    <a href="Subcategory.php" class="nav-item nav-link"><i class="fa fa-list-alt me-2"></i>Subcategory</a>
                    <a href="saloonlist.php" class="nav-item nav-link"><i class="fa fa-store me-2"></i>Salon List</a>
                    <a href="userlist.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>User List</a>
                    <a href="Viewcomplaint.php" class="nav-item nav-link"><i class="fa fa-exclamation-circle me-2"></i>View Complaints</a>
                    <a href="Viewfeedback.php" class="nav-item nav-link"><i class="fa fa-comment me-2"></i>View Feedback</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>REPORTS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="LeaveReport.php" class="dropdown-item">Leave Report</a>
                            <a href="SaloonPackageReport.php" class="dropdown-item">Salon Package Report</a>
                            <a href="SaloonbookingReport.php" class="dropdown-item">Salon Booking Report</a>
                            <a href="Report1.php" class="dropdown-item">Main Report</a>
                        </div>
                    </div>
                    <a href="../Logout.php" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="Adminhome.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link " data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../Assets/Templates/Admin/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $data['admin_name']; ?></span>
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Welcome & Stats Section Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="welcome-section">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-5 mb-2">Welcome back, <?php echo $data['admin_name']; ?>!</h1>
                            <p class="mb-0">Here's what's happening with your salon management system today.</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <i class="fas fa-user-cog fa-4x opacity-25"></i>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Users Card -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-card bg-secondary rounded d-flex align-items-center justify-content-between p-4 user-card">
                            <div class="ms-3">
                                <p class="mb-2">Total Users</p>
                                <h6 class="mb-0 counter"><?php echo $user_count; ?></h6>
                            </div>
                            <div class="stat-icon text-primary">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Salons Card -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-card bg-secondary rounded d-flex align-items-center justify-content-between p-4 salon-card">
                            <div class="ms-3">
                                <p class="mb-2">Total Salons</p>
                                <h6 class="mb-0 counter"><?php echo $salon_count; ?></h6>
                            </div>
                            <div class="stat-icon text-success">
                                <i class="fa fa-store"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feedback Card -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-card bg-secondary rounded d-flex align-items-center justify-content-between p-4 feedback-card">
                            <div class="ms-3">
                                <p class="mb-2">Feedback Received</p>
                                <h6 class="mb-0 counter"><?php echo $feedback_count; ?></h6>
                            </div>
                            <div class="stat-icon text-info">
                                <i class="fa fa-comment"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Complaints Card -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-card bg-secondary rounded d-flex align-items-center justify-content-between p-4 complaint-card">
                            <div class="ms-3">
                                <p class="mb-2">Complaints</p>
                                <h6 class="mb-0 counter"><?php echo $complaint_count; ?></h6>
                            </div>
                            <div class="stat-icon text-warning">
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Welcome & Stats Section End -->

            <!-- Calendar & Recent Activity Section Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4 calendar-container">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calendar</h6>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 col-xl-8">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Quick Actions</h6>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6 col-md-4">
                                    <a href="userlist.php" class="btn btn-primary w-100 d-flex flex-column align-items-center py-3 quick-action-btn">
                                        <i class="fa fa-users fa-2x mb-2"></i>
                                        <span>Manage Users</span>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <a href="saloonlist.php" class="btn btn-success w-100 d-flex flex-column align-items-center py-3 quick-action-btn">
                                        <i class="fa fa-store fa-2x mb-2"></i>
                                        <span>Manage Salons</span>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <a href="Viewcomplaint.php" class="btn btn-warning w-100 d-flex flex-column align-items-center py-3 quick-action-btn">
                                        <i class="fa fa-exclamation-circle fa-2x mb-2"></i>
                                        <span>View Complaints</span>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <a href="Viewfeedback.php" class="btn btn-info w-100 d-flex flex-column align-items-center py-3 quick-action-btn">
                                        <i class="fa fa-comment fa-2x mb-2"></i>
                                        <span>View Feedback</span>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <a href="Category.php" class="btn btn-secondary w-100 d-flex flex-column align-items-center py-3 quick-action-btn">
                                        <i class="fa fa-th fa-2x mb-2"></i>
                                        <span>Categories</span>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <a href="Report1.php" class="btn btn-dark w-100 d-flex flex-column align-items-center py-3 quick-action-btn">
                                        <i class="fa fa-chart-bar fa-2x mb-2"></i>
                                        <span>Reports</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Calendar & Recent Activity Section End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/Templates/Admin/lib/chart/chart.min.js"></script>
    <script src="../Assets/Templates/Admin/lib/easing/easing.min.js"></script>
    <script src="../Assets/Templates/Admin/lib/waypoints/waypoints.min.js"></script>
    <script src="../Assets/Templates/Admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../Assets/Templates/Admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../Assets/Templates/Admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../Assets/Templates/Admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Assets/Templates/Admin/js/main.js"></script>
    
    <script>
        // Simple counter animation for stats
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200; // The lower the slower
            
            counters.forEach(counter => {
                const animate = () => {
                    const value = +counter.innerText;
                    const data = +counter.innerText;
                    
                    if (value < data) {
                        counter.innerText = Math.ceil(value + 1);
                        setTimeout(animate, 1);
                    } else {
                        counter.innerText = data;
                    }
                };
                
                animate();
            });
        });
    </script>
</body>
</html>