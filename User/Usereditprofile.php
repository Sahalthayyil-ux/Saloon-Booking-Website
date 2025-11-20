<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
$select="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();
if(isset($_POST["btn_submit"]))
{
$name = $_POST["txt_name"];
$email = $_POST["txt_email"];
$contact = $_POST["txt_contact"];

$upQry="update tbl_user set user_name='".$name."',user_email='".$email."',user_contact='".$contact."' where user_id='".$_SESSION['uid']."'";
if($con->query($upQry))
 {
		 ?>
		 <script>
        alert("Profile updated successfully!")
		window.location="Usereditprofile.php"
        </script>
        <?php 
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Profile</title>
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
  
  input[type="text"], input[type="email"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border 0.3s;
  }
  
  input[type="text"]:focus,
  input[type="email"]:focus {
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
    <h2>Edit Profile</h2>
  </div>
  
  <div class="form-container">
    <div class="password-requirements">
      <strong>Edit Profile Requirements:</strong>
      <ul>
        <li>Name Must start with a capital letter and contain only letters and spaces</li>
        <li>Number  10-digit number starting with 6, 7, 8, or 9</li>
        <!-- <li>Contains at least one uppercase letter</li>
        <li>Contains at least one lowercase letter</li> -->
      </ul>
    </div>
    <form id="form1" name="form1" method="post" action="">
      <table class="form-table">
        <tr>
          <td class="label">Name</td>
          <td>
            <input type="text" name="txt_name" maxlength="15" id="txt_name" value="<?php echo $data['user_name']; ?>" 
                   title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
                   pattern="^[A-Z]+[a-zA-Z ]*$" required />
            <!-- <span class="validation-note">Must start with a capital letter and contain only letters and spaces</span> -->
          </td>
        </tr>
        <tr>
          <td class="label">Email</td>
          <td>
            <input type="email" name="txt_email" id="txt_email" value="<?php echo $data['user_email']; ?>" 
                   required placeholder="Enter email" />
          </td>
        </tr>
        <tr>
          <td class="label">Contact</td>
          <td>
            <input type="text" name="txt_contact" id="txt_contact" value="<?php echo $data['user_contact']; ?>" 
                   required pattern="^[6-9]\d{9}$" title="Allows only 10 numbers starting with 6-9" />
            <!-- <span class="validation-note">10-digit number starting with 6, 7, 8, or 9</span> -->
          </td>
        </tr>
        <tr>
          <td colspan="2" class="button-container">
            <input type="submit" name="btn_submit" id="btn_submit" value="Update Profile" />
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