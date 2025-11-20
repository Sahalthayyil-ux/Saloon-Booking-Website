<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$sel = "select max(requirements_id), slot_id from tbl_requirements where booking_id=".$_GET['bid'];
$row = $con->query($sel);
$data = $row->fetch_assoc();

if(isset($_GET['addid']))
{
	$ins = "insert into tbl_requirements(slot_id,salooncategory_id,booking_id) values('".$data['slot_id']."','".$_GET['addid']."','".$_GET['bid']."')";
	if($con->query($ins))
	{
		?>
		<script>
        alert("Requirements Added");
		window.location = "Viewbooking.php"
        </script>
		<?php
	}
}

// Fetch saloon data for the header
$select="select * from tbl_saloon where saloon_id='".$_SESSION['sid']."'";
$res=$con->query($select);
$saloonData=$res->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Requirements</title>
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
    
    .content-area {
        flex: 1;
        padding: 30px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(5px);
        margin: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow-y: auto;
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
    
    .dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }
    
    .card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }
    
    .card-header {
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .card-header h3 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    
    .card-body {
        padding: 25px;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f1f1f1;
    }
    
    .detail-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .detail-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 14px;
    }
    
    .detail-value {
        color: #2d3748;
        font-weight: 500;
        text-align: right;
    }
    
    .price {
        font-size: 18px;
        font-weight: 700;
        color: #2b6cb0;
    }
    
    .action-btn {
        display: block;
        background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        text-decoration: none;
        padding: 14px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s;
        text-align: center;
        margin-top: 20px;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
    }
    
    .action-btn:hover {
        background: linear-gradient(90deg, #1e3a8a 0%, #2563eb 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(30, 64, 175, 0.3);
    }
    
    .icon {
        font-size: 24px;
        margin-right: 10px;
        vertical-align: middle;
    }
    
    .footer {
        text-align: center;
        margin-top: 40px;
        padding: 20px;
        color: #718096;
        font-size: 14px;
    }
    
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .empty-state i {
        font-size: 64px;
        color: #cbd5e0;
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        color: #4a5568;
        margin-bottom: 15px;
        font-size: 24px;
    }
    
    .empty-state p {
        color: #718096;
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
        
        .content-area {
            margin: 10px;
            padding: 15px;
        }
        
        .dashboard {
            grid-template-columns: 1fr;
        }
        
        .page-header h1 {
            font-size: 26px;
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
            <?php
            $currentPage = basename($_SERVER['PHP_SELF']);
            ?>
            <a href="Saloonhome.php" class="nav-item <?php echo $currentPage == 'Saloonhome.php' ? 'active' : ''; ?>">
                <i class="fas fa-home"></i> Saloon Home
            </a>
            <a href="Profile.php" class="nav-item <?php echo $currentPage == 'Profile.php' ? 'active' : ''; ?>">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="Editprofile.php" class="nav-item <?php echo $currentPage == 'Editprofile.php' ? 'active' : ''; ?>">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
            <a href="Addservices.php" class="nav-item <?php echo $currentPage == 'Addservices.php' ? 'active' : ''; ?>">
                <i class="fas fa-concierge-bell"></i> Add Services
            </a>
            <a href="Slot.php" class="nav-item <?php echo $currentPage == 'Slot.php' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-alt"></i> Slot
            </a>
            <a href="Package.php" class="nav-item <?php echo $currentPage == 'Package.php' ? 'active' : ''; ?>">
                <i class="fas fa-box"></i> Package
            </a>
            <a href="Viewbooking.php" class="nav-item <?php echo $currentPage == 'Viewbooking.php' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-check"></i> View Booking
            </a>
            <a href="Viewpackagebooking.php" class="nav-item <?php echo $currentPage == 'Viewpackagebooking.php' ? 'active' : ''; ?>">
                <i class="fas fa-tags"></i> View Package Booking
            </a>
            <a href="Addleave.php" class="nav-item <?php echo $currentPage == 'Addleave.php' ? 'active' : ''; ?>">
                <i class="fas fa-bed"></i> Add Leave
            </a>
            <a href="changepsswd.php" class="nav-item <?php echo $currentPage == 'changepsswd.php' ? 'active' : ''; ?>">
                <i class="fas fa-key"></i> Change password
            </a>
            <a href="CreateBill.php" class="nav-item <?php echo $currentPage == 'CreateBill.php' ? 'active' : ''; ?>">
                <i class="fas fa-receipt"></i> Create Bill
            </a>
            <a href="../Logout.php" class="nav-item logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        
        <div class="content-area">
            <div class="page-header">
                <h1><i class="fas fa-concierge-bell icon"></i>Service Requirements</h1>
                <p>Add services to complete the booking requirements</p>
            </div>
            
            <div class="dashboard">
                <?php
                $i = 0;
                $sel="select * from tbl_salooncategory s inner join tbl_subcategory b on s.subcategory_id=b.subcat_id inner join tbl_category c on b.category_id=c.category_id where saloon_id='".$_SESSION['sid']."'";
                $row = $con->query($sel);
                
                if($row->num_rows > 0) {
                    while($data = $row->fetch_assoc())
                    {
                        $i++;
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h3><?php echo $data["category_name"]; ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-list-alt"></i> Subcategory:</span>
                                <span class="detail-value"><?php echo $data["subcat_name"]; ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-tag"></i> Amount:</span>
                                <span class="detail-value price">₹<?php echo number_format($data["salooncategory_amount"], 2); ?></span>
                            </div>
                            <a href="Requirements.php?addid=<?php echo $data['salooncategory_id'] ?>&bid=<?php echo $_GET['bid']?>" class="action-btn">
                                <i class="fas fa-plus-circle"></i> ADD REQUIREMENT
                            </a>
                        </div>
                    </div>
                <?php
                    }
                } else {
                ?>
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <h3>No Services Available</h3>
                        <p>You haven't added any services to your salon yet. Add services to make them available for bookings.</p>
                    </div>
                <?php
                }
                ?>
            </div>
            
            <div class="footer">
                <p>&copy; <?php echo date('Y'); ?> Salon Management System | Booking ID: <?php echo $_GET['bid']; ?></p>
            </div>
        </div>
    </div>

    <script>
        // Simple animation for cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = 1;
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>