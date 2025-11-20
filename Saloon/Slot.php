<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$sid="";
$slotfrom="";
$slotto="";

// Check if saloon is logged in
if(!isset($_SESSION['sid'])) {
    header("Location: ../Login.php");
    exit();
}

$saloon_id = $_SESSION['sid'];

// Fetch saloon data for sidebar
$select_saloon = "SELECT * FROM tbl_saloon WHERE saloon_id = '" . $con->real_escape_string($saloon_id) . "'";
$res_saloon = $con->query($select_saloon);
$saloon_data = $res_saloon->fetch_assoc();

if(isset($_POST["btn_add"]))
{
	$slotfrom = $_POST["txt_from"];
	$slotto = $_POST["txt_to"];
	$sid = $_POST["txt_id"];
	
	if($sid == "")
	{
	$selQry="select * from tbl_slot where slot_status=1 and slot_from='".$slotfrom."' and slot_to='".$slotto."' and saloon_id='".$_SESSION['sid']."'";
	$res=$con->query($selQry);
	if($res->num_rows>0)
	{
		?>
        <script>
		alert("slot already booked");
		</script>
        <?php
	}
	else
	{
	$ins = "insert into tbl_slot(slot_from,slot_to,saloon_id) values('".$slotfrom."','".$slotto."','".$_SESSION['sid']."')";
	
	 if($con->query($ins))
	 {
		 ?>
		 <script>
        alert("slot inserted..")
		window.location="Slot.php"
        </script>
        <?php 
	 }
	}
}
 else
{
$upQry="update tbl_slot set slot_from='".$slotfrom."',slot_to='".$slotto."' where slot_id='".$sid."'";
if($con->query($upQry))
 {
		 ?>
		 <script>
        alert("slot updated..")
		window.location="Slot.php"
        </script>
        <?php 
	  }
	
    }
 
}
if(isset($_GET['delid']))
{
	$upQry="update tbl_slot set slot_status=0 where slot_id=('".$_GET['delid']."')";

if($con->query($upQry))
 {
	?>
    <script>
	alert("slot deleted..")
	window.location="Slot.php"
	</script>
    <?php
 }
 
 }
 if(isset($_GET['edid']))
 {
 $sel="select * from tbl_slot where slot_id= '".$_GET['edid']."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();
 $slotfrom = $data["slot_from"];
 $slotto = $data["slot_to"];
 $sid=$data['slot_id'];
 }
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Slot Management</title>
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
        /* background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(5px); */
        margin: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow-y: scroll;
        height:600px;
    }
    
    .content-container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .content-header {
        background: linear-gradient(90deg, #1a2a6c 0%, #2a4b8c 100%);
        color: white;
        text-align: center;
        padding: 25px 20px;
    }
    
    .content-header h1 {
        font-size: 28px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .form-section, .table-section {
        margin-bottom: 40px;
        padding: 30px;
    }
    
    .section-title {
        color: #1e40af;
        border-bottom: 2px solid #1e40af;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-size: 22px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    
    table.form-table {
        width: 60%;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    th, td {
        padding: 15px;
        text-align: left;
        border: 1px solid #e2e8f0;
    }
    
    th {
        background-color: #1e40af;
        color: white;
        font-weight: 600;
    }
    
    tr:nth-child(even) {
        background-color: #f8fafc;
    }
    
    input[type="time"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 6px;
        font-size: 16px;
        transition: border 0.3s;
        background-color: #f8fafc;
    }
    
    input[type="time"]:focus {
        border-color: #1e40af;
        outline: none;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
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
        transition: background-color 0.3s;
        width: 100%;
    }
    
    input[type="submit"]:hover {
        background-color: #1e3a8a;
    }
    
    .submit-cell {
        text-align: center;
        padding-top: 20px;
    }
    
    .action-link {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 500;
        margin-right: 8px;
        transition: all 0.3s;
    }
    
    .delete-link {
        background-color: #e53e3e;
        color: white;
        
    }
    
    .delete-link:hover {
        background-color: #c53030;
    }
    
    .edit-link {
        background-color: #38a169;
        color: white;
    }
    
    .edit-link:hover {
        background-color: #2f855a;
    }
    
    .time-display {
        font-weight: 600;
        color: #2d3748;
        background: #f0fff4;
        padding: 5px 12px;
        border-radius: 4px;
        border: 1px solid #c6f6d5;
    }
    
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            padding: 10px 0;
        }
        
        table.form-table {
            width: 100%;
        }
        
        .content {
            padding: 20px;
        }
        
        th, td {
            padding: 10px;
        }
        
        .action-link {
            display: block;
            margin-bottom: 5px;
            text-align: center;
        }
    }
</style>
</head>

<body>
    <div class="header">
        <h1 class="welcome">Salon Management System</h1>
        <p>Hai, <?php echo $saloon_data['saloon_name']; ?></p>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <a href="Saloonhome.php" class="nav-item"><i class="fas fa-home"></i> Saloon Home</a>
            <a href="Profile.php" class="nav-item"><i class="fas fa-user"></i> Profile</a>
            <a href="Editprofile.php" class="nav-item"><i class="fas fa-edit"></i> Edit Profile</a>
            <a href="Addservices.php" class="nav-item"><i class="fas fa-concierge-bell"></i> Add Services</a>
            <a href="Slot.php" class="nav-item active"><i class="fas fa-calendar-alt"></i> Slot</a>
            <a href="Package.php" class="nav-item"><i class="fas fa-box"></i> Package</a>
            <a href="Viewbooking.php" class="nav-item"><i class="fas fa-calendar-check"></i> View Booking</a>
            <a href="Viewpackagebooking.php" class="nav-item"><i class="fas fa-tags"></i> View Package Booking</a>
            <a href="Addleave.php" class="nav-item"><i class="fas fa-bed"></i> Add Leave</a>
            <a href="changepsswd.php" class="nav-item"><i class="fas fa-key"></i> Change password</a>
            <a href="CreateBill.php" class="nav-item"><i class="fas fa-receipt"></i> Create Bill</a>
            <a href="../Logout.php" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        
        <div class="content">
            <div class="content-container">
                <div class="content-header">
                    <h1>Slot Management</h1>
                </div>
                
                <div class="form-section">
                    <h2 class="section-title"><?php echo $sid ? 'Edit Time Slot' : 'Add New Time Slot'; ?></h2>
                    <form id="form1" name="form1" method="post" action="">
                        <table class="form-table">
                            <tr>
                                <td width="120">FROM TIME</td>
                                <td>
                                    <label for="txt_from"></label>
                                    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $sid ?>" />
                                    <input type="time" name="txt_from" id="txt_from" value="<?php echo $slotfrom ?>" required="required"/>
                                </td>
                            </tr>
                            <tr>
                                <td>TO TIME</td>
                                <td>
                                    <label for="txt_to"></label>
                                    <input type="time" name="txt_to" id="txt_to" value="<?php echo $slotto ?>" required="required"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="submit-cell">
                                    <input type="submit" name="btn_add" id="btn_add" value="<?php echo $sid ? 'Update Slot' : 'Add Slot'; ?>" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                
                <div class="table-section">
                    <h2 class="section-title">Existing Time Slots</h2>
                    <table>
                        <tr>
                            <th width="60">SI NO</th>
                            <th>FROM TIME</th>
                            <th>TO TIME</th>
                            <th width="180">ACTION</th>
                        </tr>
                        <?php
                        $i = 0;
                        $sel="select * from tbl_slot where slot_status=1 and saloon_id='".$_SESSION['sid']."'";
                        $row = $con->query($sel);
                        
                        if($row->num_rows > 0) {
                            while($data = $row->fetch_assoc())
                            {
                                $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><span class="time-display"><?php echo date("h:i A", strtotime($data["slot_from"])); ?></span></td>
                            <td><span class="time-display"><?php echo date("h:i A", strtotime($data["slot_to"])); ?></span></td>
                            <td>
                                <a href="Slot.php?delid=<?php echo $data['slot_id'] ?>" class="action-link delete-link">Delete</a>
                                <a href="Slot.php?edid=<?php echo $data['slot_id']?>" class="action-link edit-link">Edit</a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px; color: #718096;">
                                No time slots available. Please add your first time slot.
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>