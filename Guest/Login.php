<?php
include("../Assets/Connection/Connection.php");
// include('Header.php');
session_start();
if(isset($_POST["btn_submit"]))
{
	$email=$_POST['txt_email'];
	$password = $_POST['txt_password'];
	
	$userselect="select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
	$user=$con->query($userselect);
	
	$adminselect="select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
	$aser=$con->query($adminselect);
	
	$saloonselect="select * from tbl_saloon where saloon_email='".$email."' and saloon_password='".$password."'";
	$saser=$con->query($saloonselect);
	
	if($userdata=$user->fetch_assoc())
	{
		$_SESSION['uid']=$userdata['user_id'];
		header("location:../User/Homepage.php");
	}
	else if($admindata=$aser->fetch_assoc())
	{
		$_SESSION['aid']=$admindata['admin_id'];
		header("location:../Admin/Adminhome.php");
	}
	else if($saloondata=$saser->fetch_assoc())
	{
		if($saloondata['saloon_status']==0)
		{
			?>
			<script>
            alert("Regisration peding");
            window.location="Login.php"
            </script>
            <?php
		}
		else if($saloondata['saloon_status']==2)
		{
			?>
			<script>
            alert("Registration rejected :<?php echo $saloondata['saloon_reason']?>");
            window.location="Login.php"
            </script>
       	 	<?php
		}
		else
		{
			$_SESSION['sid']=$saloondata['saloon_id'];
			header("location:../Saloon/Saloonhome.php");
		}
		
	}
	else
	{
		?>
        <script>
		alert("invalid Login");
		window.location="Login.php"
        </script>
        <?php	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GLAMOR - Login to Your Account</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Base styles */
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
        backdrop-filter: blur(5px);
        /* filter: blur(8px); */
        color: #333;
        line-height: 1.6;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    /* Main content area */
    .content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    /* Container styling */
    .login-container {
        max-width: 450px;
        width: 100%;
        padding: 40px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }
    
    /* Decorative elements */
    .login-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #a29ad2ff, #bdb6e8ff, #a09ad2ff);
    }
    
    /* Header styling */
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-header h2 {
        color: #2e12cfff;
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 10px;
        letter-spacing: 0.5px;
    }
    
    .login-header p {
        color: #888;
        font-size: 16px;
    }
    
    /* Form styling */
    .login-form table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .login-form tr {
        margin-bottom: 20px;
        display: block;
    }
    
    .login-form td {
        padding: 8px 0;
        display: block;
    }
    
    .login-form td:first-child {
        font-weight: 500;
        color: #555;
        margin-bottom: 5px;
        font-size: 15px;
    }
    
    .input-group {
        position: relative;
    }
    
    .input-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
    }
    
    .login-form input[type="email"],
    .login-form input[type="password"] {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    .login-form input[type="email"]:focus,
    .login-form input[type="password"]:focus {
        border-color: #d29a9b;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 154, 155, 0.2);
    }
    
    /* Button styling */
    .btn-submit {
        background: linear-gradient(to right, #1613e0ff, #1503b4ff);
        color: white;
        border: none;
        padding: 14px 20px;
        width: 100%;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-top: 10px;
        box-shadow: 0 4px 10px rgba(210, 154, 155, 0.3);
    }
    
    .btn-submit:hover {
        background: linear-gradient(to right, #4f2af1ff, #1a074dff);
        box-shadow: 0 6px 15px rgba(210, 154, 155, 0.4);
        transform: translateY(-2px);
    }
    
    /* Links styling */
    .login-links {
        text-align: center;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: center;
        gap: 20px;
    }
    
    .login-links a {
        color: #a99ad2ff;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        padding: 8px 15px;
        border-radius: 6px;
        border: 1px solid #f1e7e8;
    }
    
    .login-links a:hover {
        color: #fff;
        background-color: #d29a9b;
        box-shadow: 0 4px 10px rgba(210, 154, 155, 0.3);
    }
    
    /* Footer styling */
    .login-footer {
        text-align: center;
        margin-top: 25px;
        color: #888;
        font-size: 14px;
    }
    
    /* Password requirement hint */
    .password-hint {
        font-size: 12px;
        color: #888;
        margin-top: 5px;
        display: block;
        padding-left: 5px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 500px) {
        .login-container {
            margin: 15px;
            padding: 30px 20px;
        }
        
        .login-links {
            flex-direction: column;
            gap: 10px;
        }
        
        .login-links a {
            justify-content: center;
        }
    }
    
    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .login-container {
        animation: fadeIn 0.5s ease-out;
    }
</style>
</head>

<body>
<div class="content">
    <div class="login-container">
        <div style="display: flex;flex-direction: column;">
            <div>
            <a href="../index.php" class="home" style="float: right;">Home</a>
        </div>
        <div class="login-header">
            <h2>WELCOME TO SALON</h2>
            <p>Sign in to your account</p>
        </div>
        </div>
        
        <form id="form1" name="form1" method="post" action="" class="login-form">
            <table>
                <tr>
                    <td>EMAIL</td>
                    <td>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email"  name="txt_email" id="txt_email" required maxlength="30" placeholder="Enter your email address"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt_password" id="txt_password" 
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                   maxlength="30"
                                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                                   placeholder="Enter your password"/>
                        </div>
                        <span class="password-hint">Must include uppercase, lowercase, number, and at least 8 characters</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Login" class="btn-submit"/>
                    </td>
                </tr>
            </table>
        </form>
        
        <div class="login-links">
            <a href="SaloonRegistration.php"><i class="fas fa-store"></i>&nbsp; Register as Saloon</a>
            <a href="UserRegistration.php"><i class="fas fa-user"></i>&nbsp; Register as User</a>
        </div>
        
        <div class="login-footer">
            &copy; <?php echo date('Y'); ?> Beauty Parlor System
        </div>
    </div>
</div>
</body>
</html>
<!-- <?php
include('Footer.php');
?> -->