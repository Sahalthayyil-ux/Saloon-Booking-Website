<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY BOOKING</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
        color: #333;
    }
    .booking-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .booking-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 25px;
        overflow: hidden;
        transition: transform 0.3s ease;
        border: 1px solid #e0e0e0;
    }
    .booking-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .booking-header {
        background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
        color: white;
        padding: 18px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .booking-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }
    .booking-amount {
        background-color: rgba(255,255,255,0.2);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    .booking-details {
        padding: 25px;
    }
    .detail-row {
        display: flex;
        margin-bottom: 12px;
        align-items: center;
    }
    .detail-label {
        font-weight: 600;
        width: 160px;
        color: #555;
        font-size: 14px;
    }
    .detail-value {
        flex: 1;
        font-size: 14px;
        color: #333;
    }
    .payment-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 5px;
    }
    .payment-completed {
        background-color: #e6f7ee;
        color: #28a745;
    }
    .payment-pending {
        background-color: #fff0f0;
        color: #dc3545;
    }
    .payment-partial {
        background-color: #fff3cd;
        color: #856404;
    }
    .requirements {
        margin-top: 20px;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }
    .requirements-title {
        font-weight: 600;
        margin-bottom: 15px;
        color: #1a1a1a;
        font-size: 15px;
        display: flex;
        align-items: center;
    }
    .requirements-title:before {
        content: "⎯";
        margin-right: 10px;
        color: #1a73e8;
        font-weight: bold;
    }
    .requirement-item {
        background-color: #f9f9f9;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        transition: background-color 0.2s;
        border-left: 3px solid #1a73e8;
    }
    .requirement-item:hover {
        background-color: #f0f0f0;
    }
    .req-category {
        font-weight: 600;
        margin-right: 15px;
        color: #1a73e8;
        font-size: 14px;
    }
    .req-subcategory {
        margin-right: 15px;
        color: #555;
        font-size: 14px;
    }
    .req-slot {
        background-color: #e6f0ff;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        color: #1a73e8;
    }
    .no-bookings {
        text-align: center;
        padding: 50px;
        color: #666;
        font-size: 16px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }
    .status-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px dashed #ddd;
    }
    /* Button Styles */
    .payment-button {
        display: inline-block;
        margin-top: 8px;
        padding: 8px 16px;
        background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
        color: white;
        text-decoration: none;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(26, 115, 232, 0.2);
        border: none;
        cursor: pointer;
    }
    
    .payment-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(26, 115, 232, 0.3);
    }
    
    .view-bill {
        display: inline-block;
        margin-top: 8px;
        margin-left: 8px;
        padding: 8px 16px;
        background: #f8f9fa;
        color: #1a73e8;
        text-decoration: none;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }
    
    .view-bill:hover {
        background: #e6f0ff;
        transform: translateY(-2px);
        color: #0d47a1;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
</style>
</head>

<body>
<div class="booking-container">
    <?php
    $i = 0;
    $sel = "select * from tbl_booking b inner join tbl_requirements r on b.booking_id=r.booking_id inner join tbl_salooncategory s on r.salooncategory_id=s.salooncategory_id where booking_status > 0 and user_id='".$_SESSION['uid']."'";
    $row = $con->query($sel);
    
    if ($row->num_rows == 0) {
        echo '<div class="no-bookings">You have no bookings yet.</div>';
    } else {
        while($bookingData = $row->fetch_assoc()) {
            $i++;
    ?>
    <div class="booking-card">
        <div class="booking-header">
            <h3>Booking #<?php echo $i; ?></h3>
            <div class="booking-amount">
                <?php echo "₹" . $bookingData["booking_amount"]; ?>
            </div>
        </div>
        <div class="booking-details">
            <div class="detail-row">
                <div class="detail-label">Booking Date:</div>
                <div class="detail-value"><?php echo date('d M Y', strtotime($bookingData["booking_date"])); ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Booking To Date:</div>
                <div class="detail-value"><?php echo date('d M Y', strtotime($bookingData["booking_todate"])); ?></div>
            </div>
            
            <div class="status-container">
                <div>
                    <div class="detail-label">Payment Status:</div>
                    <?php if($bookingData['booking_status'] == 1): ?>
                        <div class="payment-status payment-pending">
                            Payment Pending
                        </div>
                        <div class="action-buttons">
                            <a href="payment.php?bid=<?php echo $bookingData['booking_id']?>" class="payment-button">Make Payment</a>
                            <a href="bill.php?bid=<?php echo $bookingData['booking_id']?>" class="view-bill">View Bill</a>
                        </div>
                    <?php elseif($bookingData['booking_status'] == 2): ?>
                        <div class="payment-status payment-partial">
                            Advance Paid (₹<?php echo $bookingData['booking_amount']; ?>)
                        </div>
                        <div class="action-buttons">
                            <a href="bill.php?bid=<?php echo $bookingData['booking_id']?>" class="view-bill">View Bill</a>
                        </div>
                    <?php elseif($bookingData['booking_status'] == 3): ?>
                        <div class="payment-status payment-completed">
                            Payment Completed
                        </div>
                        <div class="action-buttons">
                            <a href="Rating.php?pid=<?php echo $bookingData['saloon_id']?>" class="view-bill">Rate</a>
                            <a href="bill.php?bid=<?php echo $bookingData['booking_id']?>" class="view-bill">View Bill</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="requirements">
                <div class="requirements-title">Services Booked</div>
                <?php
                $scl = "select * from tbl_requirements r 
                        inner join tbl_salooncategory s on r.salooncategory_id=s.salooncategory_id 
                        inner join tbl_subcategory b on s.subcategory_id=b.subcat_id 
                        inner join tbl_category c on b.category_id=c.category_id 
                        inner join tbl_slot t on r.slot_id=t.slot_id 
                        where booking_id='".$bookingData['booking_id']."'";
                $bow = $con->query($scl);
                
                while($reqData = $bow->fetch_assoc()) {
                ?>
                <div class="requirement-item">
                    <div class="req-category"><?php echo $reqData["category_name"]; ?></div>
                    <div class="req-subcategory"><?php echo $reqData["subcat_name"]; ?></div>
                    <div class="req-slot"><?php echo date('h:i A', strtotime($reqData['slot_from'])) ?> - <?php echo date('h:i A', strtotime($reqData['slot_to'])) ?></div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php 
        }
    }
    ?>
</div>
</body>
</html>
<?php
include('Footer.php');
?>