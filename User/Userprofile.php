<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
$select="select * from tbl_user u INNER JOIN tbl_place p on u.place_id=p.place_id INNER JOIN tbl_district d on p.district_id=d.district_id  where user_id='".$_SESSION['uid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Profile</title>
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
  
  .profile-container {
    max-width: 800px;
    margin: 30px auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .profile-header {
    background: #1a5276;
    color: white;
    padding: 25px;
    text-align: center;
  }
  
  .profile-header h2 {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
  }
  
  .profile-content {
    padding: 30px;
  }
  
  .profile-info {
    width: 100%;
    border-collapse: collapse;
  }
  
  .profile-info tr {
    border-bottom: 1px solid #eaeaea;
  }
  
  .profile-info td {
    padding: 15px 10px;
  }
  
  .profile-info tr:last-child {
    border-bottom: none;
  }
  
  .info-label {
    font-weight: 600;
    color: #2c3e50;
    width: 30%;
    vertical-align: top;
  }
  
  .info-value {
    color: #34495e;
  }
  
  .profile-photo {
    text-align: center;
    padding: 20px 0;
  }
  
  .profile-photo img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  }
  
  .action-buttons {
    text-align: center;
    margin-top: 30px;
  }
  
  .btn {
    display: inline-block;
    padding: 12px 25px;
    margin: 0 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
  }
  
  .btn-edit {
    background: #3498db;
    color: white;
  }
  
  .btn-edit:hover {
    background: #2980b9;
  }
  
  .btn-change {
    background: #2ecc71;
    color: white;
  }
  
  .btn-change:hover {
    background: #27ae60;
  }
  
  .section-title {
    background: #f8f9fa;
    padding: 15px;
    margin: 20px 0 10px;
    border-left: 4px solid #3498db;
    font-weight: 600;
    color: #2c3e50;
  }
  
  @media (max-width: 768px) {
    .profile-container {
      margin: 15px;
      width: auto;
    }
    
    .profile-info td {
      display: block;
      width: 100%;
    }
    
    .info-label {
      width: 100%;
      padding-bottom: 5px;
      font-size: 14px;
      color: #7f8c8d;
    }
    
    .btn {
      display: block;
      width: 80%;
      margin: 10px auto;
    }
  }
</style>
</head>

<body>
<div class="profile-container">
  <div class="profile-header">
    <h2>User Profile</h2>
    <p>View and manage your account information</p>
  </div>
  
  <div class="profile-content">
    <div class="profile-photo">
      <img src="../Assets/Files/User/Photo/<?php echo $data["user_photo"];?>" alt="Profile Photo" />
    </div>
    
    <div class="section-title">Personal Information</div>
    <table class="profile-info">
      <tr>
        <td class="info-label">Name</td>
        <td class="info-value"><?php echo $data['user_name'];?></td>
      </tr>
      <tr>
        <td class="info-label">Email</td>
        <td class="info-value"><?php echo $data['user_email'];?></td>
      </tr>
      <tr>
        <td class="info-label">Contact</td>
        <td class="info-value"><?php echo $data['user_contact'];?></td>
      </tr>
    </table>
    
    <div class="section-title">Location Information</div>
    <table class="profile-info">
      <tr>
        <td class="info-label">District</td>
        <td class="info-value"><?php echo $data['district_name'];?></td>
      </tr>
      <tr>
        <td class="info-label">Place</td>
        <td class="info-value"><?php echo $data['place_name'];?></td>
      </tr>
    </table>
    
    <div class="action-buttons">
      <a href="Usereditprofile.php" class="btn btn-edit">Edit Profile</a>
      <a href="usercp.php" class="btn btn-change">Change Password</a>
    </div>
  </div>
</div>
</body>
</html>
<?php
include('Footer.php');
?>