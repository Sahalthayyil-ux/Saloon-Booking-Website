<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');

// Fetch saloon data for the header
$select="select * from tbl_saloon where saloon_id='".$_SESSION['sid']."'";
$res=$con->query($select);
$saloonData=$res->fetch_assoc();

if(isset($_POST["btn_add"]))
{
	$date=$_POST["txt_date"];
	$sel="select * from tbl_leave where leave_date='".$date."' and saloon_id='".$_SESSION['sid']."'";
	$res=$con->query($sel);
	if($data=$res->fetch_assoc())
	{
		?>
        <script>
		alert("leave already added");
		</script>
        <?php	
	}
	else
	{	
	$ins = "insert into tbl_leave(leave_date,saloon_id) values('".$date."','".$_SESSION['sid']."')";
	
	 if($con->query($ins))
	 {
		 ?>
		 <script>
        alert("Holiday added..")
		window.location="Addleave.php"
        </script>
        <?php 
	 }
	}
	}
	if(isset($_GET["delid"]))
{
$del="delete from tbl_leave where leave_id='".$_GET["delid"]."'";


if($con->query($del))
 {
?>
    <script>
	alert("holiday removed..")
	window.location="Addleave.php"
	</script>
    <?php
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Leave Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Arial, sans-serif;
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
        /* background: rgba(255, 255, 255, 0.8); */
        /* backdrop-filter: blur(5px); */
        margin: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow-y: scroll;
        height:600px;
    }
    
    .page-container {
        width: 100%;
        max-width: 1000px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }
    
    .page-header {
        background: #1a56db;
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .page-header h1 {
        font-size: 28px;
        margin-bottom: 5px;
    }
    
    .content {
        padding: 30px;
    }
    
    .form-container {
        background: white;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }
    
    .form-title {
        color: #1a56db;
        font-size: 22px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #1a56db;
        display: inline-block;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 15px;
        vertical-align: middle;
    }
    
    .form-table tr td:first-child {
        font-weight: 600;
        color: #1a56db;
        width: 120px;
    }
    
    input[type="date"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 6px;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    input[type="date"]:focus {
        border-color: #1a56db;
        outline: none;
        box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.2);
    }
    
    .btn {
        background: #1a56db;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn:hover {
        background: #0d3eab;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    
    .btn i {
        margin-right: 8px;
    }
    
    .table-container {
        background: white;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table th {
        background: #1a56db;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    .data-table td {
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .data-table tr:nth-child(even) {
        background: #f8fafc;
    }
    
    .data-table tr:hover {
        background: #f1f5f9;
    }
    
    .action-link {
        color: #e53e3e;
        text-decoration: none;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 4px;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .action-link:hover {
        background: #fed7d7;
        transform: scale(1.05);
    }
    
    .action-link i {
        margin-right: 5px;
    }
    
    .no-records {
        text-align: center;
        padding: 30px;
        color: #64748b;
        font-style: italic;
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
        
        .page-container {
            width: 100%;
        }
        
        .content {
            padding: 15px;
        }
        
        .form-table td {
            display: block;
            width: 100%;
        }
        
        .form-table tr td:first-child {
            width: 100%;
            padding-bottom: 5px;
        }
        
        .data-table {
            font-size: 14px;
        }
        
        .data-table th, 
        .data-table td {
            padding: 10px;
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
            <div class="page-container">
                <div class="page-header">
                    <h1><i class="fas fa-calendar-times"></i> Leave Management</h1>
                    <p>Manage your salon holidays and time off</p>
                </div>
                
                <div class="content">
                    <div class="form-container">
                        <h2 class="form-title"><i class="fas fa-plus-circle"></i> Add New Holiday</h2>
                        <form id="form1" name="form1" method="post" action="">
                            <table class="form-table">
                                <tr>
                                    <td>DATE</td>
                                    <td>
                                        <input type="date" name="txt_date" id="txt_date" min="<?php echo date('Y-m-d')?>" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div align="center">
                                            <button type="submit" name="btn_add" id="btn_add" class="btn">
                                                <i class="fas fa-plus"></i> ADD HOLIDAY
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    
                    <div class="table-container">
                        <h2 class="form-title"><i class="fas fa-list"></i> Scheduled Holidays</h2>
                        <table class="data-table">
                            <tr>
                                <th>SI NO</th>
                                <th>DATE</th>
                                <th>ACTION</th>
                            </tr>
                            <?php
                            $i = 0;
                            $sel = "select * from tbl_leave where saloon_id='".$_SESSION['sid']."'";
                            $row = $con->query($sel);
                            
                            if($row->num_rows > 0) {
                                while($data = $row->fetch_assoc()) {
                                    $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo date('F j, Y', strtotime($data["leave_date"])); ?></td>
                                <td>
                                    <a href="Addleave.php?delid=<?php echo $data['leave_id'] ?>" class="action-link">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="3" class="no-records">
                                    <i class="fas fa-calendar-check" style="font-size: 48px; margin-bottom: 15px;"></i>
                                    <br>
                                    No holidays scheduled yet. Add your first holiday using the form above.
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
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const deleteLinks = document.querySelectorAll('.action-link');
            
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if(!confirm('Are you sure you want to delete this holiday?')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Set focus to date field
            document.getElementById('txt_date').focus();
        });
    </script>
</body>
</html>