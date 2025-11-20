<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
if(!isset($_SESSION['sid'])) {
    header("Location: ../Login.php");
    exit();
}

// Fetch saloon data for header
$select = "SELECT * FROM tbl_saloon WHERE saloon_id = '".$_SESSION['sid']."'";
$res = $con->query($select);
$saloonData = $res->fetch_assoc();

// Fetch package bookings
$i = 0;
$sel = "SELECT * FROM tbl_packagebooking m 
        INNER JOIN tbl_package p ON m.package_id = p.package_id 
        INNER JOIN tbl_user u ON m.user_id = u.user_id  
        INNER JOIN tbl_slot d ON m.slot_id = d.slot_id 
        WHERE d.saloon_id = '".$_SESSION['sid']."'";
$row = $con->query($sel);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package Bookings</title>
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
        display: flex;
        flex-direction: column;
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
        flex: 1;
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
    
    .nav-item.logout {
        margin-top: 20px;
        color: #e74c3c;
    }
    
    .nav-item.logout:hover {
        background: rgba(231, 76, 60, 0.1);
        border-left: 4px solid #e74c3c;
    }
    
    .content-area {
        flex: 1;
        padding: 20px;
        /* background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(5px); */
        margin: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
        overflow-y: scroll;
        height:600px;
    }
    
    .page-header {
        background: linear-gradient(90deg, #1a2a6c 0%, #2a4b8c 100%);
        color: white;
        text-align: center;
        padding: 25px 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }
    
    .page-header h1 {
        font-size: 32px;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }
    
    .page-header p {
        font-size: 16px;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }
    
    th, td {
        padding: 16px 20px;
        text-align: left;
        border: 1px solid #e2e8f0;
    }
    
    th {
        background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        font-weight: 600;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    tr:nth-child(even) {
        background-color: #f8fafc;
    }
    
    tr:hover {
        background-color: #f1f5f9;
    }
    
    td {
        color: #374151;
        font-size: 15px;
    }
    
    .status-cell {
        font-weight: 500;
    }
    
    .status-advance {
        color: #d97706;
        background-color: #fef3c7;
        padding: 8px 12px;
        border-radius: 4px;
        display: inline-block;
        font-weight: 600;
    }
    
    .status-completed {
        color: #059669;
        background-color: #d1fae5;
        padding: 8px 12px;
        border-radius: 4px;
        display: inline-block;
        font-weight: 600;
    }
    
    .status-pending {
        color: #dc2626;
        background-color: #fee2e2;
        padding: 8px 12px;
        border-radius: 4px;
        display: inline-block;
        font-weight: 600;
    }
    
    .view-bill-btn {
        display: inline-block;
        background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 500;
        font-size: 14px;
        margin-left: 10px;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2);
    }
    
    .view-bill-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }
    
    .amount {
        font-weight: 600;
        color: #1e40af;
    }
    
    .package-name {
        font-weight: 600;
        color: #1f2937;
    }
    
    .user-name {
        color: #4b5563;
        font-weight: 500;
    }
    
    .slot-time {
        background: #f1f5f9;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 14px;
        color: #4b5563;
        display: inline-block;
    }
    
    .no-bookings {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .no-bookings i {
        font-size: 64px;
        color: #d1d5db;
        margin-bottom: 20px;
    }
    
    .no-bookings h3 {
        font-size: 24px;
        margin-bottom: 15px;
        color: #4b5563;
    }
    
    @media (max-width: 1024px) {
        .content-area {
            padding: 20px;
            overflow-x: auto;
        }
        
        table {
            min-width: 900px;
        }
        
        th, td {
            padding: 14px 16px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            padding: 10px 0;
        }
        
        .page-header h1 {
            font-size: 26px;
        }
        
        .page-header p {
            font-size: 14px;
        }
        
        .view-bill-btn {
            display: block;
            margin: 10px 0 0 0;
            text-align: center;
        }
        
        .content-area {
            margin: 10px;
            padding: 15px;
        }
    }
</style>
</head>

<body>
    <div class="header">
        <h1 class="welcome">Salon Management System</h1>
        <p>Hai, <?php echo $saloonData['saloon_name']; ?></p>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <a href="Saloonhome.php" class="nav-item"><i class="fas fa-home"></i> Saloon Home</a>
            <a href="Profile.php" class="nav-item"><i class="fas fa-user"></i> Profile</a>
            <a href="Editprofile.php" class="nav-item"><i class="fas fa-edit"></i> Edit Profile</a>
            <a href="Addservices.php" class="nav-item"><i class="fas fa-concierge-bell"></i> Add Services</a>
            <a href="Slot.php" class="nav-item"><i class="fas fa-calendar-alt"></i> Slot</a>
            <a href="Package.php" class="nav-item"><i class="fas fa-box"></i> Package</a>
            <a href="Viewbooking.php" class="nav-item"><i class="fas fa-calendar-check"></i> View Booking</a>
            <a href="Viewpackagebooking.php" class="nav-item active"><i class="fas fa-tags"></i> View Package Booking</a>
            <a href="Addleave.php" class="nav-item"><i class="fas fa-bed"></i> Add Leave</a>
            <a href="changepsswd.php" class="nav-item"><i class="fas fa-key"></i> Change password</a>
            <a href="CreateBill.php" class="nav-item"><i class="fas fa-receipt"></i> Create Bill</a>
            <a href="../Logout.php" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        
        <div class="content-area">
            <div class="page-header">
                <h1>Package Bookings</h1>
                <p>View and manage all package bookings for your salon</p>
            </div>
            
            <?php
            if($row->num_rows > 0) {
            ?>
            <table>
                <tr>
                    <th width="50">SINO</th>
                    <th>PACKAGE NAME</th>
                    <th>USER NAME</th>
                    <th width="100">BOOKED DATE</th>
                    <th width="100">APPOINMENT DATE</th>
                    <th width="150">SLOT</th>
                    <th width="100">ADVANCE AMOUNT</th>
                    <th width="250">STATUS</th>
                </tr>
                <?php
                while($data = $row->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><span class="package-name"><?php echo $data["package_name"]; ?></span></td>
                    <td><span class="user-name"><?php echo $data["user_name"];?></span></td>
                    <td><?php echo date('d M Y', strtotime($data["packagebooking_date"])); ?></td>
                    <td><?php echo date('d M Y', strtotime($data["packagebooking_todate"])); ?></td>
                    <td><span class="slot-time"><?php echo date('h:i A', strtotime($data['slot_from'])) ?> - <?php echo date('h:i A', strtotime($data['slot_to'])) ?></span></td>
                    <td class="amount">₹<?php echo number_format($data["packagebooking_amount"], 2); ?></td>
                    <td class="status-cell">
                        <?php 
                        if($data['packagebooking_status'] == 1) {
                            echo '<span class="status-advance">Advance payment completed</span>';
                            echo '<a href="Packagebill.php?bid='.$data['packagebooking_id'].'" class="view-bill-btn">View Bill</a>';
                        } else if($data['packagebooking_status'] == 2) {
                            echo '<span class="status-completed">Payment completed</span>';
                            echo '<a href="Packagebill.php?bid='.$data['packagebooking_id'].'" class="view-bill-btn">View Bill</a>';
                        } else {
                            echo '<span class="status-pending">Payment not completed</span>';
                        }
                        ?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
            <?php
            } else {
            ?>
            <div class="no-bookings">
                <i>📦</i>
                <h3>No Package Bookings</h3>
                <p>You don't have any package bookings at the moment.</p>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script>
        // Add active state to current page link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop();
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                if (item.getAttribute('href') === currentPage) {
                    item.style.background = 'rgba(106, 17, 203, 0.1)';
                    item.style.color = '#6a11cb';
                    item.style.borderLeft = '4px solid #6a11cb';
                }
            });
            
            // Add animation to table rows
            const tableRows = document.querySelectorAll('table tr');
            tableRows.forEach((row, index) => {
                setTimeout(() => {
                    row.style.opacity = 1;
                    row.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>