<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');

// Fetch salon data
$select = "select * from tbl_saloon where saloon_id='".$_SESSION['sid']."'";
$res = $con->query($select);
$data = $res->fetch_assoc();

// Handle live booking form submission
if(isset($_POST['btn_add']))
{
    $insert = "insert into tbl_livebooking(livebooking_username,livebooking_usercontact,livebooking_date) value('".$_POST['txt_name']."','".$_POST['txt_contact']."',curdate())";
    if($con->query($insert))
    {
        $liveid = $con->insert_id;
        ?>
        <script>
        window.location="AddReq.php?lid=<?php echo $liveid; ?>"
        </script>
        <?php
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Live Booking - Salon Management System</title>
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
    
    .content {
        flex: 1;
        padding: 30px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }
    
    .booking-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 500px;
        overflow: hidden;
        margin-top: 20px;
    }
    
    .booking-header {
        background-color: #1e40af;
        color: white;
        text-align: center;
        padding: 25px 20px;
    }
    
    .booking-header h2 {
        font-weight: 600;
        font-size: 24px;
        letter-spacing: 0.5px;
    }
    
    .form-container {
        padding: 30px;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table tr {
        border-bottom: 1px solid #e5e7eb;
    }
    
    .form-table tr:last-child {
        border-bottom: none;
    }
    
    .form-table td {
        padding: 15px 5px;
    }
    
    .form-table tr td:first-child {
        width: 30%;
        font-weight: 600;
        color: #1e40af;
    }
    
    input[type="text"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 16px;
        transition: all 0.3s;
        background-color: #f9fafb;
    }
    
    input[type="text"]:focus {
        border-color: #1e40af;
        outline: none;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
    }
    
    input[type="submit"] {
        background-color: #1e40af;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 14px 25px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
        width: 100%;
        letter-spacing: 0.5px;
    }
    
    input[type="submit"]:hover {
        background-color: #1e3a8a;
        transform: translateY(-2px);
    }
    
    input[type="submit"]:active {
        transform: translateY(0);
    }
    
    .submit-cell {
        padding-top: 25px;
        text-align: center;
    }
    
    .info-text {
        text-align: center;
        margin-top: 20px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.5;
    }
    
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            padding: 10px 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .nav-item {
            padding: 10px 15px;
            border-left: none;
            border-bottom: 4px solid transparent;
        }
        
        .nav-item:hover, .nav-item.active {
            border-left: none;
            border-bottom: 4px solid #6a11cb;
        }
        
        .content {
            padding: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .form-container {
            padding: 20px;
        }
        
        .form-table tr {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
            border-bottom: none;
        }
        
        .form-table tr td:first-child {
            width: 100%;
            margin-bottom: 5px;
            padding-bottom: 0;
        }
        
        .booking-header h2 {
            font-size: 20px;
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
            <a href="Profile.php" class="nav-item"><i class="fas fa-user"></i> Profile</a>
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
            <div class="booking-container">
                <div class="booking-header">
                    <h2>New Live Booking</h2>
                </div>
                
                <div class="form-container">
                    <form id="form1" name="form1" method="post" action="">
                        <table class="form-table">
                            <tr>
                                <td>Name</td>
                                <td>
                                    <label for="txt_name"></label>
                                    <input type="text" name="txt_name" id="txt_name" required maxlength="20" placeholder="Enter name"  title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" />
                                </td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td>
                                    <label for="txt_contact"></label>
                                    <input type="text" name="txt_contact" id="txt_contact" required required pattern="^(?:\+91|0)?[6-9]\d{9}$" title="Allows only 10 numbers" placeholder="Enter contact number"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="submit-cell">
                                    <input type="submit" name="btn_add" id="btn_add" value="Create Booking" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    
                    <!-- <div class="info-text">
                        <p>After creating the booking, you will be redirected to add service requirements.</p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple animation for the booking container
        document.addEventListener('DOMContentLoaded', function() {
            const bookingContainer = document.querySelector('.booking-container');
            bookingContainer.style.opacity = 0;
            bookingContainer.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                bookingContainer.style.transition = 'opacity 0.5s, transform 0.5s';
                bookingContainer.style.opacity = 1;
                bookingContainer.style.transform = 'translateY(0)';
            }, 100);
            
            // Add active class to current page in navigation
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