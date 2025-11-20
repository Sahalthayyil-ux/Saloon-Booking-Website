<!-- <a href="Adminhome.php">Admin Home</a>
<a href="Category.php">Category</a>
<a href="Subcategory.php">Subcategory</a>
<a href="State.php">State</a>
<a href="District.php">District</a>
<a href="place.php">Place</a>
<a href="saloonlist.php">Salonlist</a>
<a href="userlist.php">Userlist</a>
<a href="Viewcomplaint.php">View complaint</a>
<a href="Viewfeedback.php">View feedback</a>
<a href="LeaveReport.php">LeaveReport</a>
<a href="SaloonPackageReport.php">SaloonPackageReport</a>
<a href="SaloonbookingReport.php">SalonbookingReport</a>
<a href="Report1.php">Main Report</a>
<a href="../Logout.php">Logout</a>
 -->

<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$select="select * from tbl_admin where admin_id='".$_SESSION['aid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();
?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
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
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <span a href="Adminhome.php" class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin</span>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../Assets/Templates/Admin/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">ADMIN</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="Adminhome.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>LOCATION</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="State.php" class="dropdown-item">State</a>
                            <a href="District.php" class="dropdown-item">District</a>
                            <a href="Place.php" class="dropdown-item">Place</a>
                        </div>
                    </div>
                    <a href="Category.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Category</a>
                    <a href="Subcategory.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Subcategory</a>
                    <a href="saloonlist.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>saloonlist</a>
                    <a href="userlist.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>userlist</a>
                    <a href="Viewcomplaint.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Viewcomplaint</a>
                    <a href="Viewfeedback.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Viewfeedback</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>REPORTS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="LeaveReport.php" class="dropdown-item">LeaveReport</a>
                            <a href="SaloonPackageReport.php" class="dropdown-item">SaloonPackageReport</a>
                            <a href="SaloonbookingReport.php" class="dropdown-item">SaloonbookingReport.php</a>
                            <a href="Report1.php" class="dropdown-item">MainReport</a>
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
                        <!-- <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="../Logout.php" class="dropdown-item">Log Out</a>
                        </div> -->
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">