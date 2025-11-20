<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Saloon Booking System</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="../Assets/JQ/jQuery.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }
    
    body {
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
    }
    
    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
        text-align: center;
        color: #1a73e8;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e6e6e6;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    
    .form-table td {
        padding: 12px 15px;
    }
    
    .form-table tr:nth-child(even) {
        background-color: #f2f7ff;
    }
    
    .form-label {
        color: #1a1a1a;
        font-weight: bold;
        width: 30%;
    }
    
    select, input[type="date"], input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    
    select:focus, input[type="date"]:focus {
        outline: none;
        border-color: #1a73e8;
        box-shadow: 0 0 5px rgba(26, 115, 232, 0.3);
    }
    
    input[type="submit"] {
        background-color: #1a73e8;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        padding: 12px;
        transition: background-color 0.3s;
    }
    
    input[type="submit"]:hover {
        background-color: #0d5bba;
    }
    
    .submit-cell {
        text-align: center;
        padding-top: 20px;
    }
    
    .notification {
        padding: 10px;
        margin: 15px 0;
        border-radius: 4px;
        text-align: center;
    }
    
    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Book Your Appointment</h1>
    
    <?php
    include("../Assets/Connection/Connection.php");
    include('SessionValidation.php');
    
    if(isset($_POST['btn_submit'])) {
        $main = "select * from tbl_booking b inner join tbl_requirements r on b.booking_id=r.booking_id inner join tbl_salooncategory sc on r.salooncategory_id=sc.salooncategory_id where sc.saloon_id!='".$_GET['rid']."' and user_id='".$_SESSION["uid"]."' and booking_status='0'";
        $mainres = $con->query($main);
        if($mainres->num_rows > 0){
            echo '<div class="notification error">Please make the payment for your previous salon booking.</div>';
            echo '<script>setTimeout(function(){ window.location = "Viewsaloon.php"; }, 5000);</script>';
            exit();
        }
        else{
            $selqry = "select * from tbl_booking where user_id='".$_SESSION["uid"]."' and booking_status='0'";
            $result = $con->query($selqry);
            
            if($result->num_rows > 0) {
                if($row = $result->fetch_assoc()) {
                    $bid = $row["booking_id"];
                    $insQry1 = "insert into tbl_requirements(salooncategory_id,booking_id,slot_id)values('".$_POST["scl_subcategory"]."','".$bid."','".$_POST['scl_slot']."')";
                    
                    if($con->query($insQry1)) {
                        echo '<div class="notification success">Service added to your booking successfully!</div>';
                        echo '<script>setTimeout(function(){ window.location = "Viewsaloon.php"; }, 2000);</script>';
                    } else {
                        echo '<div class="notification error">Error adding service. Please try again.</div>';
                    }
                }
            } else {
                $insQry = "insert into tbl_booking(user_id,booking_date,booking_todate)values('".$_SESSION["uid"]."',curdate(),'".$_POST['txt_date']."')";
                
                if($con->query($insQry)) {
                    $selqry1 = "select MAX(booking_id) as id from tbl_booking";
                    $result = $con->query($selqry1);
                    
                    if($row = $result->fetch_assoc()) {
                        $bid = $row["id"];
                        $selqry = "select * from tbl_requirements where booking_id='".$bid."'and salooncategory_id='".$_POST["scl_subcategory"]."'";
                        $result = $con->query($selqry);
                        
                        if($result->num_rows > 0) {
                            echo '<div class="notification error">This service has already been added to your booking.</div>';
                            echo '<script>setTimeout(function(){ window.location = "Viewsaloon.php"; }, 2000);</script>';
                        } else {
                            $insQry1 = "insert into tbl_requirements(salooncategory_id,booking_id,slot_id)values('".$_POST["scl_subcategory"]."','".$bid."','".$_POST['scl_slot']."')";
                            
                            if($con->query($insQry1)) {
                                echo '<div class="notification success">Booking created successfully!</div>';
                                echo '<script>setTimeout(function(){ window.location = "Viewsaloon.php"; }, 2000);</script>';
                            } else {
                                echo '<div class="notification error">Error creating booking. Please try again.</div>';
                            }
                        }
                    }
                }
            }
        }
    }
    
    $leave_dates = []; 
    $saloon_id = $_GET['rid'];
    $query = "SELECT leave_date FROM tbl_leave WHERE saloon_id = $saloon_id";
    $result = $con->query($query);
    
    while ($row = $result->fetch_assoc()) {
        $leave_dates[] = $row['leave_date'];
    }
    
    $leave_dates_json = json_encode($leave_dates);
    ?>
    
    <form id="form1" name="form1" method="post" action="">
        <table class="form-table">
            <tr>
                <td class="form-label">CATEGORY</td>
                <td>
                    <select name="scl_category" id="scl_category" onChange="getSubcategory(this.value)" required="required">
                        <option value="">Select Category</option>
                        <?php
                        $sel = "select * from tbl_category where category_status=1";
                        $row = $con->query($sel);
                        while($data = $row->fetch_assoc()) {
                            echo '<option value="'.$data['category_id'].'">'.$data['category_name'].'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="form-label">SUBCATEGORY</td>
                <td>
                    <select name="scl_subcategory" id="scl_subcategory" required="required">
                        <option value="">Select Subcategory</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="form-label">DATE</td>
                <td>
                    <input type="date" name="txt_date" id="txt_date" onChange="getSlot(this.value,'<?php echo $_GET['rid'];  ?>')" required />
                </td>
            </tr>
            <tr>
                <td class="form-label">SLOT</td>
                <td>
                    <select name="scl_slot" id="scl_vslot" required="required">
                        <option value="">Select Time Slot</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="submit-cell">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Book Now" />
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    function getSubcategory(cid) {
        $.ajax({
            url: "../Assets/Ajaxpages/Ajaxbook.php?cid="+cid+"&saloon="+<?php echo $_GET['rid']?>,
            success: function(result) {
                $("#scl_subcategory").html(result);
            }
        });
    }
    
    function getSlot(date, sid) {
        $.ajax({
            url: "../Assets/Ajaxpages/Ajaxslot.php?sid="+sid+"&date="+date,
            success: function(result) {
                $("#scl_vslot").html(result);
            }
        });
    }
    
    flatpickr("#txt_date", {
        minDate: new Date().fp_incr(1), // Tomorrow onwards
        disable: <?php echo $leave_dates_json; ?>, // Disable only leave dates
        onChange: function(selectedDates, dateStr, instance) {
            getSlot(dateStr, '<?php echo $_GET['rid']; ?>');
        }
    });
</script>
</body>
</html>