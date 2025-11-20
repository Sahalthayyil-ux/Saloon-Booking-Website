<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');  

// Fetch salon data for sidebar
$select="select * from tbl_saloon u INNER JOIN tbl_place p on u.place_id=p.place_id INNER JOIN tbl_district d on p.district_id=d.district_id  where saloon_id='".$_SESSION['sid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salon Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-image: url("../Assets/Templates/Images/salon bg image.jpg");
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        color: #333;
        min-height: 100vh;
    }
    
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("../Assets/Templates/Images/salon bg image.jpg");
        background-size: cover;
        background-position: center;
        filter: blur(8px);
        z-index: -1;
    }
    
    .header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .welcome {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .container {
        display: flex;
        min-height: calc(100vh - 120px);
    }
    
    .sidebar {
        width: 250px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 20px 0;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .nav-item {
        display: flex;
        align-items: center;
        padding: 15px 25px;
        color: #444;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .nav-item i {
        margin-right: 12px;
        font-size: 18px;
        width: 24px;
        text-align: center;
    }
    
    .nav-item:hover {
        background: rgba(106, 17, 203, 0.1);
        color: #6a11cb;
        border-left: 4px solid #6a11cb;
    }
    
    .nav-item.active {
        background: rgba(106, 17, 203, 0.15);
        color: #6a11cb;
        border-left: 4px solid #6a11cb;
    }
    
    .nav-item.logout {
        margin-top: 20px;
        color: #e74c3c;
    }
    
    .nav-item.logout:hover {
        background: rgba(231, 76, 60, 0.1);
        border-left: 4px solid #e74c3c;
    }
    
    .content {
        flex: 1;
        padding: 30px;
        /* background: rgba(255, 255, 255, 0.9); */
        /* backdrop-filter: blur(5px); */
        margin: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        display: flex;
        justify-content: center;
        align-items: flex-start;
        overflow-y: scroll;
        height:700px;
    }
    
    .profile-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        overflow: hidden;
    }
    
    .profile-header {
        background: linear-gradient(90deg, #1a2a6c 0%, #2a4b8c 100%);
        color: white;
        text-align: center;
        padding: 30px 20px;
    }
    
    .profile-header h1 {
        font-size: 28px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .profile-content {
        padding: 30px;
    }
    
    .profile-image {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .profile-image img {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #e2e8f0;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .profile-image img:hover {
        transform: scale(1.05);
    }
    
    .info-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    
    .info-table tr {
        border-bottom: 1px solid #e2e8f0;
        transition: background-color 0.3s ease;
    }
    
    .info-table tr:hover {
        background-color: #f8fafc;
    }
    
    .info-table tr:last-child {
        border-bottom: none;
    }
    
    .info-table td {
        padding: 18px 15px;
        vertical-align: top;
    }
    
    .info-table tr td:first-child {
        width: 30%;
        font-weight: 600;
        color: #1e40af;
        background-color: #f8fafc;
    }
    
    .info-table tr td:last-child {
        color: #4a5568;
    }
    
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 14px 28px;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        text-align: center;
        min-width: 180px;
        gap: 8px;
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
    }
    
    .action-btn.change-pw {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .action-btn.change-pw:hover {
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }
    
    .salon-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }
    
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .stat-number {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 14px;
        opacity: 0.9;
    }
    
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            padding: 10px 0;
        }
        
        .content {
            padding: 20px;
            margin: 10px;
        }
        
        .info-table tr {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 15px;
        }
        
        .info-table tr td:first-child {
            width: 100%;
            padding-bottom: 5px;
            background-color: transparent;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .action-btn {
            width: 100%;
            max-width: 300px;
        }
        
        .profile-image img {
            width: 150px;
            height: 150px;
        }
        
        .salon-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>

<body>
    <div class="header">
        <h1 class="welcome">Salon Management System</h1>
        <p>Hai, <?php echo $data['saloon_name']; ?></p>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <a href="Saloonhome.php" class="nav-item"><i class="fas fa-home"></i> Saloon Home</a>
            <a href="Profile.php" class="nav-item active"><i class="fas fa-user"></i> Profile</a>
            <a href="Editprofile.php" class="nav-item"><i class="fas fa-edit"></i> Edit Profile</a>
            <a href="Addservices.php" class="nav-item"><i class="fas fa-concierge-bell"></i> Add Services</a>
            <a href="Slot.php" class="nav-item"><i class="fas fa-calendar-alt"></i> Slot</a>
            <a href="Package.php" class="nav-item"><i class="fas fa-box"></i> Package</a>
            <a href="Viewbooking.php" class="nav-item"><i class="fas fa-calendar-check"></i> View Booking</a>
            <a href="Viewpackagebooking.php" class="nav-item"><i class="fas fa-tags"></i> View Package Booking</a>
            <a href="Addleave.php" class="nav-item"><i class="fas fa-bed"></i> Add Leave</a>
            <a href="changepsswd.php" class="nav-item"><i class="fas fa-key"></i> Change password</a>
            <a href="CreateBill.php" class="nav-item"><i class="fas fa-receipt"></i> Create Bill</a>
            <a href="../Logout.php" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        
        <div class="content">
            <div class="profile-container">
                <div class="profile-header">
                    <h1><i class="fas fa-user-circle"></i> Salon Profile</h1>
                </div>
                
                <div class="profile-content">
                    <div class="profile-image">
                        <img src="../Assets/Files/User/logo/<?php echo $data["saloon_logo"];?>" alt="Salon Logo" />
                    </div>
                    
                    <table class="info-table">
                        <tr>
                            <td>NAME</td>
                            <td><?php echo $data['saloon_name'];?></td>
                        </tr>
                        <tr>
                            <td>EMAIL</td>
                            <td><?php echo $data['saloon_email'];?></td>
                        </tr>
                        <tr>
                            <td>CONTACT</td>
                            <td><?php echo $data['saloon_contact'];?></td>
                        </tr>
                        <tr>
                            <td>ADDRESS</td>
                            <td><?php echo $data['saloon_address'];?></td>
                        </tr>
                        <tr>
                            <td>DISTRICT</td>
                            <td><?php echo $data['district_name'];?></td>
                        </tr>
                        <tr>
                            <td>PLACE</td>
                            <td><?php echo $data['place_name'];?></td>
                        </tr>
                    </table>
                    
                    <!-- Optional: Add some statistics cards -->
                    <div class="salon-stats">
                        <div class="stat-card">
                            <div class="stat-number">25</div>
                            <div class="stat-label">Today's Appointments</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">156</div>
                            <div class="stat-label">Total Clients</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">4.8</div>
                            <div class="stat-label">Average Rating</div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="Editprofile.php" class="action-btn">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                        <a href="changepsswd.php" class="action-btn change-pw">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to profile image
            const profileImage = document.querySelector('.profile-image img');
            profileImage.style.opacity = '0';
            profileImage.style.transform = 'scale(0.8)';
            
            setTimeout(() => {
                profileImage.style.transition = 'all 0.5s ease';
                profileImage.style.opacity = '1';
                profileImage.style.transform = 'scale(1)';
            }, 100);
            
            // Add hover effect to table rows
            const tableRows = document.querySelectorAll('.info-table tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
            
            // Add loading animation to action buttons
            const actionButtons = document.querySelectorAll('.action-btn');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 500);
                    e.preventDefault();
                });
            });
        });
    </script>
</body>
</html>