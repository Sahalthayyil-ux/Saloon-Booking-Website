<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
$select="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();
if(isset($_POST["btn_change"]))
{
$old = $_POST["txt_opass"];
$new = $_POST["txt_npass"];
$repass = $_POST["txt_repass"];
$dbpass = $data['user_password'];

if($dbpass == $old)
{
	if($new == $repass)
	{
		$upqry="update tbl_user set user_password='".$repass."' where user_id='".$_SESSION['uid']."'";
		if($con->query($upqry))
		{
		 ?>
		 <script>
        alert("Password updated successfully!")
		window.location="Userprofile.php"
        </script>
        <?php 
		}
	}
	else
	{
		 ?>
		 <script>
        alert("New password and confirm password do not match!")
        </script>
        <?php 
	}
}
	else
	{
		 ?>
		 <script>
        alert("Current password is incorrect!")
        </script>
        <?php 
	}
}

if(isset($_POST["btn_cancel"]))
{
	header("Location: Userprofile.php");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  
  body {
    background-color: #f5f7fa;
    color: #2c3e50;
    line-height: 1.6;
    padding: 20px;
  }
  
  .containerx {
    max-width: 500px;
    margin: 30px auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .header {
    background: #1a5276;
    color: white;
    padding: 20px;
    text-align: center;
  }
  
  .header h2 {
    font-size: 24px;
    font-weight: 600;
  }
  
  .form-container {
    padding: 30px;
  }
  
  .form-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .form-table tr {
    border-bottom: 1px solid #eaeaea;
  }
  
  .form-table td {
    padding: 15px 10px;
  }
  
  .form-table tr:last-child {
    border-bottom: none;
  }
  
  .label {
    font-weight: 600;
    color: #2c3e50;
    width: 40%;
  }
  
  input[type="password"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border 0.3s;
  }
  
  input[type="password"]:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
  }
  
  .button-group {
    text-align: center;
    margin-top: 20px;
  }
  
  input[type="submit"] {
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    margin: 0 10px;
  }
  
  #btn_change {
    background: #1a5276;
    color: white;
  }
  
  #btn_change:hover {
    background: #2c3e50;
  }
  
  #btn_cancel {
    background: #e74c3c;
    color: white;
  }
  
  #btn_cancel:hover {
    background: #c0392b;
  }
  
  .password-requirements {
    background: #f8f9fa;
    border-left: 4px solid #3498db;
    padding: 15px;
    margin: 20px 0;
    border-radius: 0 5px 5px 0;
    font-size: 14px;
    color: #2c3e50;
  }
  
  .password-requirements ul {
    margin-left: 20px;
  }
  
  @media (max-width: 600px) {
    .container {
      margin: 15px;
      width: auto;
    }
    
    .form-table td {
      display: block;
      width: 100%;
    }
    
    .label {
      width: 100%;
      margin-bottom: 5px;
    }
    
    input[type="submit"] {
      width: 100%;
      margin: 5px 0;
    }
  }
</style>
</head>

<body>
<div class="containerx">
  <div class="header">
    <h2>Change Password</h2>
  </div>
  
  <div class="form-container">
    <div class="password-requirements">
      <strong>Password Requirements:</strong>
      <ul>
        <li>At least 8 characters long</li>
        <li>Contains at least one number</li>
        <li>Contains at least one uppercase letter</li>
        <li>Contains at least one lowercase letter</li>
      </ul>
    </div>
    
    <form id="form1" name="form1" method="post" action="">
      <table class="form-table">
        <tr>
          <td class="label">Current Password</td>
          <td>
            <input type="password" name="txt_opass" id="txt_opass" 
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" 
                   required />
          </td>
        </tr>
        <tr>
          <td class="label">New Password</td>
          <td>
            <input type="password" name="txt_npass" id="txt_npass" 
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" 
                   required />
          </td>
        </tr>
        <tr>
          <td class="label">Confirm Password</td>
          <td>
            <input type="password" name="txt_repass" id="txt_repass" 
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" 
                   required />
          </td>
        </tr>
        <tr>
          <td colspan="2" class="button-group">
            <input type="submit" name="btn_change" id="btn_change" value="Change Password" />
            <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>
<?php
include('Footer.php');
?>