<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');

// Check if user is logged in
if(!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$sel = "select * from tbl_package where package_id='".$_GET['pid']."'";
$row = $con->query($sel);
$data = $row->fetch_assoc();
$amt = (float)$data["package_amount"] * 0.1;
$amount = $data["package_amount"];

if(isset($_POST["btn_add"])) {
    $pbtodate = $_POST["txt_date"];
    $slotid = $_POST["scl_vslot"];
    
    $ins = "insert into tbl_packagebooking(packagebooking_date,packagebooking_todate,user_id,package_id,slot_id,packagebooking_amount,packagebooking_totalamount) values(curdate(),'".$pbtodate."','".$_SESSION['uid']."','".$_GET['pid']."','".$slotid."','".$amt."','".$amount."')";
    
    if($con->query($ins)) {
        echo "<script>alert('Booking confirmed successfully!'); window.location='mypackagebooking.php';</script>";
    } else {
        echo "<script>alert('Error occurred while booking. Please try again.');</script>";
    }
}

// Get leave dates for the saloon
$leave_dates = []; 
$saloon_id = $data['saloon_id'];
$query = "SELECT leave_date FROM tbl_leave WHERE saloon_id = $saloon_id";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
    $leave_dates[] = $row['leave_date'];
}
$leave_dates_json = json_encode($leave_dates);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Your Package</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f7fa;
        color: #333;
        line-height: 1.6;
    }
    
    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }
    
    header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 20px 0;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }
    
    .logo {
        font-size: 24px;
        font-weight: bold;
    }
    
    .package-info {
        background-color: white;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .package-title {
        color: #2c3e50;
        margin-bottom: 15px;
        font-size: 28px;
    }
    
    .package-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .detail-item i {
        margin-right: 10px;
        color: #6a11cb;
        width: 20px;
    }
    
    .booking-form-container {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .form-title {
        color: #2c3e50;
        margin-bottom: 25px;
        font-size: 24px;
        text-align: center;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table tr {
        border-bottom: 1px solid #eee;
    }
    
    .form-table td {
        padding: 15px 10px;
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        width: 30%;
    }
    
    input[type="date"], select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border 0.3s;
    }
    
    input[type="date"]:focus, select:focus {
        border-color: #6a11cb;
        outline: none;
        box-shadow: 0 0 0 2px rgba(106, 17, 203, 0.2);
    }
    
    .btn-add {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        display: block;
        margin: 30px auto 0;
        min-width: 150px;
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    
    .price-info {
        background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
        color: white;
        border-radius: 10px;
        padding: 20px;
        margin-top: 30px;
        text-align: center;
    }
    
    .price-title {
        font-size: 18px;
        margin-bottom: 10px;
    }
    
    .price-amount {
        font-size: 28px;
        font-weight: bold;
    }
    
    .deposit-note {
        font-size: 14px;
        margin-top: 5px;
        opacity: 0.9;
    }
    
    footer {
        text-align: center;
        margin-top: 40px;
        padding: 20px;
        color: #7f8c8d;
        font-size: 14px;
    }
    
    @media (max-width: 768px) {
        .package-details {
            grid-template-columns: 1fr;
        }
        
        .form-label {
            width: 100%;
            display: block;
            margin-bottom: 5px;
        }
        
        .header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .logo {
            margin-bottom: 10px;
        }
    }
</style>
</head>
<body>
<div class="container">
    <header>
        <div class="header-content">
            <div class="logo"><i class="fas fa-spa"></i> BeautySalon</div>
            <h1>Package Booking</h1>
        </div>
    </header>
    
    <div class="package-info">
        <h2 class="package-title"><?php echo $data['package_name']; ?></h2>
        <div class="package-details">
            <!-- <div class="detail-item"><i class="fas fa-clock"></i> <strong>Duration:</strong> <?php echo $data['package_duration']; ?> minutes</div>
            <div class="detail-item"><i class="fas fa-star"></i> <strong>Category:</strong> <?php echo $data['package_description']; ?></div>
            <div class="detail-item"><i class="fas fa-scissors"></i> <strong>Services:</strong> <?php echo $data['package_name']; ?></div> -->
            <div class="detail-item"><i class="fas fa-file-alt"></i> <strong>Details:</strong> <?php echo $data['package_description']; ?></div>
        </div>
    </div>
    
    <div class="booking-form-container">
        <h2 class="form-title">Book Your Appointment</h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td class="form-label">Select Date:</td>
                    <td>
                        <input type="date" name="txt_date" id="txt_date" onChange="getSlot(this.value,'<?php echo $data['saloon_id']; ?>')" required="required"/>
                    </td>
                </tr>
                <tr>
                    <td class="form-label">Available Slots:</td>
                    <td>
                        <select name="scl_vslot" id="scl_vslot" required="required">
                            <option value="">Select a slot</option>
                        </select>
                    </td>
                </tr>
            </table>
            
            <div class="price-info">
                <div class="price-title">Total Package Price</div>
                <div class="price-amount">₹<?php echo $amount; ?></div>
                <div class="deposit-note">10% deposit (₹<?php echo $amt; ?>) required to confirm booking</div>
            </div>
            
            <button type="submit" name="btn_add" id="btn_add" class="btn-add">
                <i class="fas fa-calendar-check"></i> Confirm Booking
            </button>
        </form>
    </div>
    
    <footer>
        <p>© <?php echo date('Y'); ?> BeautySalon. All rights reserved.</p>
    </footer>
</div>

<script src="../Assets/JQ/jQuery.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    function getSlot(date,sid) {
        $.ajax({
            url: "../Assets/Ajaxpages/Ajaxslot.php?sid="+sid+"&date="+date,
            success: function(result){
                $("#scl_vslot").html(result);
            }
        });
    }
    
    flatpickr("#txt_date", {
        minDate: new Date().fp_incr(1), // Tomorrow onwards
        disable: <?php echo $leave_dates_json; ?>, // Disable only leave dates
        onChange: function(selectedDates, dateStr, instance) {
            getSlot(dateStr, '<?php echo $data['saloon_id']; ?>');
        }
    });
</script>
</body>
</html>