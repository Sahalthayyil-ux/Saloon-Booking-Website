<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');

// Fetch salon data for header
$select = "select * from tbl_saloon where saloon_id='".$_SESSION['sid']."'";
$res = $con->query($select);
$salonData = $res->fetch_assoc();
// Fetch bookings data
$i = 0;
$sel = "select * from tbl_booking b INNER JOIN tbl_requirements r on b.booking_id=r.booking_id inner join tbl_salooncategory s on r.salooncategory_id=s.salooncategory_id inner join tbl_user u on b.user_id=u.user_id where s.saloon_id='".$_SESSION['sid']."' group by r.booking_id";
$row = $con->query($sel);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Bookings</title>
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
    
    .nav-item.logout {
        margin-top: 20px;
        color: #e74c3c;
    }
    
    .nav-item.logout:hover {
        background: rgba(231, 76, 60, 0.1);
        border-left: 4px solid #e74c3c;
    }
    
    .nav-item.active {
        background: rgba(106, 17, 203, 0.1);
        color: #6a11cb;
        border-left: 4px solid #6a11cb;
    }
    
    .content {
        flex: 1;
        padding: 30px;
        /* background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(5px); */
        margin: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow-y: auto;
        max-height: calc(100vh - 160px);
    }
    
    .page-header {
        background: linear-gradient(90deg, #1a2a6c 0%, #2a4b8c 100%);
        color: white;
        text-align: center;
        padding: 25px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
    
    .booking-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .booking-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }
    
    .booking-header {
        background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .booking-header h3 {
        font-size: 22px;
        font-weight: 600;
        margin: 0;
    }
    
    .status {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
    
    .status.completed {
        background-color: #10b981;
    }
    
    .status.advance {
        background-color: #f59e0b;
        color: #1f2937;
    }
    
    .status.pending {
        background-color: #ef4444;
    }
    
    .status.paid {
        background-color: #10b981;
    }
    
    .booking-body {
        padding: 30px;
    }
    
    .booking-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .detail-group {
        padding: 15px;
        background: #f8fafc;
        border-radius: 8px;
        border-left: 4px solid #1e40af;
    }
    
    .detail-label {
        font-weight: 600;
        color: #4b5563;
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
    }
    
    .detail-value {
        font-size: 18px;
        color: #1f2937;
        font-weight: 500;
    }
    
    .requirements-section {
        margin-top: 25px;
    }
    
    .requirements-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .requirements-header h4 {
        color: #1e40af;
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
        border: none;
        cursor: pointer;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(30, 64, 175, 0.3);
    }
    
    .view-bill {
        background: linear-gradient(90deg, #059669 0%, #10b981 100%);
        margin-left: 10px;
    }
    
    .view-bill:hover {
        box-shadow: 0 6px 16px rgba(5, 150, 105, 0.3);
    }
    
    .requirements-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .requirements-table th {
        background-color: #1e40af;
        color: white;
        padding: 16px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 16px;
    }
    
    .requirements-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        color: #374151;
    }
    
    .requirements-table tr:last-child td {
        border-bottom: none;
    }
    
    .requirements-table tr:nth-child(even) {
        background-color: #f9fafb;
    }
    
    .requirements-table tr:hover {
        background-color: #f3f4f6;
    }
    
    .no-bookings {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .no-bookings i {
        font-size: 64px;
        color: #d1d5db;
        margin-bottom: 20px;
    }
    
    .no-bookings h3 {
        color: #4b5563;
        margin-bottom: 15px;
        font-size: 24px;
    }
    
    .no-bookings p {
        color: #6b7280;
        max-width: 500px;
        margin: 0 auto;
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
            margin: 10px;
            padding: 20px;
        }
        
        .booking-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .booking-details {
            grid-template-columns: 1fr;
        }
        
        .requirements-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .action-btn, .view-bill {
            width: 100%;
            margin: 5px 0;
            justify-content: center;
        }
    }
</style>
</head>

<body>
    <div class="header">
        <h1 class="welcome">Salon Management System</h1>
        <p>Hai, <?php echo $salonData['saloon_name']; ?></p>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <a href="Saloonhome.php" class="nav-item"><i class="fas fa-home"></i> Saloon Home</a>
            <a href="Profile.php" class="nav-item"><i class="fas fa-user"></i> Profile</a>
            <a href="Editprofile.php" class="nav-item"><i class="fas fa-edit"></i> Edit Profile</a>
            <a href="Addservices.php" class="nav-item"><i class="fas fa-concierge-bell"></i> Add Services</a>
            <a href="Slot.php" class="nav-item"><i class="fas fa-calendar-alt"></i> Slot</a>
            <a href="Package.php" class="nav-item"><i class="fas fa-box"></i> Package</a>
            <a href="Viewbooking.php" class="nav-item active"><i class="fas fa-calendar-check"></i> View Booking</a>
            <a href="Viewpackagebooking.php" class="nav-item"><i class="fas fa-tags"></i> View Package Booking</a>
            <a href="Addleave.php" class="nav-item"><i class="fas fa-bed"></i> Add Leave</a>
            <a href="changepsswd.php" class="nav-item"><i class="fas fa-key"></i> Change password</a>
            <a href="CreateBill.php" class="nav-item"><i class="fas fa-receipt"></i> Create Bill</a>
            <a href="../Logout.php" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        
        <div class="content">
            <div class="page-header">
                <h1><i class="fas fa-calendar-check"></i> Booking Management</h1>
                <p>View and manage all customer bookings for your salon</p>
            </div>
            
            <?php
            if($row->num_rows > 0) {
                while($data = $row->fetch_assoc())
                {
                    $i++;
                    ?>
                    <div class="booking-card">
                        <div class="booking-header">
                            <h3>Booking #<?php echo $i; ?> - <?php echo $data["user_name"]; ?></h3>
                            <div class="status <?php 
                                if($data['booking_status'] == 2) echo 'advance';
                                else if($data['booking_status'] == 3) echo 'paid';
                                else echo 'pending';
                            ?>">
                            <?php 
                                if($data['booking_status'] == 2)
                                {
                                    echo "Advance Paid";
                                }
                                else if($data['booking_status'] == 3)
                                {
                                    echo "Payment Completed";
                                }
                                else
                                {
                                    echo "Pending";
                                }
                            ?>
                            </div>
                        </div>
                        <div class="booking-body">
                            <div class="booking-details">
                                <div class="detail-group">
                                    <span class="detail-label">Customer Name</span>
                                    <div class="detail-value"><?php echo $data["user_name"]; ?></div>
                                </div>
                                <div class="detail-group">
                                    <span class="detail-label">Booked Date</span>
                                    <div class="detail-value"><?php echo date('d M Y', strtotime($data["booking_date"])); ?></div>
                                </div>
                                <div class="detail-group">
                                    <span class="detail-label">Appoinment Date</span>
                                    <div class="detail-value"><?php echo date('d M Y', strtotime($data["booking_todate"])); ?></div>
                                </div>
                                <div class="detail-group">
                                    <span class="detail-label">Advance Amount</span>
                                    <div class="detail-value">₹<?php echo number_format($data["booking_amount"], 2); ?></div>
                                </div>
                            </div>
                            
                            <div class="requirements-section">
                                <div class="requirements-header">
                                    <h4><i class="fas fa-list-check"></i> Service Requirements</h4>
                                    <div>
                                        <?php
                                        if($data["booking_status"] != 3)
                                        {
                                        ?>
                                        <a href="Requirements.php?bid=<?php echo $data['booking_id']; ?>" class="action-btn">
                                            <i class="fas fa-plus-circle"></i> Add Requirements
                                        </a>
                                        <?php
                                        }
                                        else {
                                        ?>
                                        <a href="bill.php?bid=<?php echo $data['booking_id']?>" class="action-btn view-bill">
                                            <i class="fas fa-receipt"></i> View Bill
                                        </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <table class="requirements-table">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Time Slot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $scl = "select * from tbl_requirements r 
                                                inner join tbl_salooncategory s on r.salooncategory_id=s.salooncategory_id 
                                                inner join tbl_subcategory b on s.subcategory_id=b.subcat_id 
                                                inner join tbl_category c on b.category_id=c.category_id 
                                                inner join tbl_slot t on r.slot_id=t.slot_id 
                                                where booking_id='".$data['booking_id']."'";
                                        $bow = $con->query($scl);
                                        
                                        while($reqData = $bow->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><strong><?php echo $reqData['category_name']; ?></strong> - <?php echo $reqData['subcat_name']; ?></td>
                                            <td><?php echo date('h:i A', strtotime($reqData['slot_from'])) ?> to <?php echo date('h:i A', strtotime($reqData['slot_to'])) ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
            ?>
                <div class="no-bookings">
                    <i class="fas fa-calendar-times"></i>
                    <h3>No Bookings Yet</h3>
                    <p>You don't have any bookings at the moment. New bookings will appear here once customers book your services.</p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script>
        // Simple animation for booking cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.booking-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = 1;
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
            
            // Add active state management for sidebar
            const currentPage = window.location.pathname.split('/').pop();
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                if (item.getAttribute('href') === currentPage) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>