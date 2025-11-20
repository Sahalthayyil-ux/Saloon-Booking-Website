<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$select="select * from tbl_saloon where saloon_id='".$_SESSION['sid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();
if(isset($_POST["btn_change"]))
{
$old = $_POST["txt_opass"];
$new = $_POST["txt_npass"];
$repass = $_POST["txt_repass"];
$dbpass = $data['saloon_password'];

if($dbpass == $old)
{
	if($new == $repass)
	{
		$upqry="update tbl_saloon set saloon_password='".$repass."' where saloon_id='".$_SESSION['sid']."'";
		if($con->query($upqry))
		{
		 ?>
		 <script>
        alert("password updated..")
		window.location="Profile.php"
        </script>
        <?php 
		}
	}
	else
	{
		 ?>
		 <script>
        alert("confirm password error..")
		window.location="changepsswd.php"
        </script>
        <?php 
	}
}
	else
	{
		 ?>
		 <script>
        alert("old password error..")
		window.location="changepsswd.php"
        </script>
        <?php 
	}
	

}

if(isset($_POST["btn_cancel"]))
{
    ?>
    <script>
    window.location="Profile.php"
    </script>
    <?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Saloon Change Password</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
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
    
    .content {
        flex: 1;
        padding: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .password-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        overflow: hidden;
    }
    
    .password-header {
        background-color: #1976d2;
        color: white;
        text-align: center;
        padding: 20px;
    }
    
    .password-header h2 {
        font-weight: 500;
    }
    
    .form-container {
        padding: 30px;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 12px 5px;
    }
    
    .form-table tr td:first-child {
        width: 40%;
        font-weight: 500;
        color: #1976d2;
    }
    
    input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border 0.3s;
    }
    
    input[type="password"]:focus {
        border-color: #1976d2;
        outline: none;
        box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
    }
    
    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    
    input[type="submit"] {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    #btn_change {
        background-color: #1976d2;
        color: white;
        margin-right: 10px;
    }
    
    #btn_change:hover {
        background-color: #1565c0;
    }
    
    #btn_cancel {
        background-color: #f5f5f5;
        color: #333;
        margin-left: 10px;
    }
    
    #btn_cancel:hover {
        background-color: #e0e0e0;
    }
    
    .password-requirements {
        background-color: #f9f9f9;
        border-left: 4px solid #1976d2;
        padding: 15px;
        margin-top: 20px;
        font-size: 14px;
        color: #555;
    }
    
    .password-requirements p {
        margin-bottom: 5px;
        font-weight: 500;
        color: #1976d2;
    }
    
    .password-requirements ul {
        padding-left: 20px;
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
            padding: 15px;
        }
        
        .form-table tr {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        
        .form-table tr td:first-child {
            width: 100%;
            margin-bottom: 5px;
        }
        
        .button-group {
            flex-direction: column;
        }
        
        #btn_change, #btn_cancel {
            margin: 5px 0;
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
            <div class="password-container">
                <div class="password-header">
                    <h2>Change Password</h2>
                </div>
                
                <div class="form-container">
                    <form id="form1" name="form1" method="post" action="">
                        <table class="form-table">
                            <tr>
                                <td>OLD PASSWORD</td>
                                <td>
                                    <label for="txt_opass"></label>
                                    <input type="password" name="txt_opass" id="txt_opass" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="txt_opass"/>
                                </td>
                            </tr>
                            <tr>
                                <td>NEW PASSWORD</td>
                                <td>
                                    <label for="txt_npass"></label>
                                    <input type="password" name="txt_npass" id="txt_npass" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="txt_npass" />
                                </td>
                            </tr>
                            <tr>
                                <td>RE-TYPE PASSWORD</td>
                                <td>
                                    <label for="txt_repass"></label>
                                    <input type="password" name="txt_repass" id="txt_repass" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="txt_repass"/>
                                </td>
                            </tr>
                        </table>
                        
                        <div class="button-group">
                            <input type="submit" name="btn_change" id="btn_change" value="Change Password" />
                            <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
                        </div>
                    </form>
                    
                    <div class="password-requirements">
                        <p>Password Requirements:</p>
                        <ul>
                            <li>At least 8 characters long</li>
                            <li>Contains at least one uppercase letter (A-Z)</li>
                            <li>Contains at least one lowercase letter (a-z)</li>
                            <li>Contains at least one number (0-9)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Highlight current page in navigation
        const currentPage = window.location.pathname.split('/').pop();
        document.querySelectorAll('.nav-item').forEach(item => {
            if (item.getAttribute('href') === currentPage) {
                item.classList.add('active');
            }
        });
    </script>
</body>
</html>