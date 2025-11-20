<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$aid="";
$aname="";
$aemail="";
$apass="";
if(isset($_POST["btn_submit"]))
{
	$name = $_POST["txt_name"];
	$email = $_POST["txt_email"];
	$password = $_POST["txt_password"];
	$aid= $_POST["txt_id"];
	
	if($aid=="")
	{
	$sel="select * from tbl_admin where admin_status=1 and admin_email='".$email."'";
	$res=$con->query($sel);
	if($data=$res->fetch_assoc())
	{
		?>
        <script>
		alert("email already exists");
		</script>
        <?php
	}
	else
	{
	$ins = "insert into
	tbl_admin(admin_name,admin_email,admin_password)
	 values('".$name."','".$email."','".$password."')";
	 
	 if($con->query($ins))
	 {
		 ?>
		 <script>
        alert("Data inserted..")
		window.location="Admin.php"
        </script>
        <?php 
	 }
	}
  }
  else
 {
	$upQry="update tbl_admin set admin_name='".$name."',admin_email='".$email."',admin_password='".$password."' where admin_id='".$aid."'";
   if($con->query($upQry))
  {
		 ?>
		 <script>
        alert("Data updated..")
		window.location="Admin.php"
        </script>
        <?php 
	  }
	
    }
 
}

if(isset($_GET["delid"]))
{
	$upQry="update tbl_admin set admin_status=0 where admin_id=('".$_GET['delid']."')";

if($con->query($upQry))
 {
	?>
    <script>
	alert("data deleted..")
	window.location="Admin.php"
	</script>
    <?php


 }


}
if(isset($_GET['edid']))
 {
 $sel="select * from tbl_admin where admin_id= '".$_GET['edid']."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();
 $aname=$data['admin_name'];
 $aid=$data['admin_id'];
 $aemail=$data['admin_email'];
 $apass=$data['admin_password'];
 }
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Management System</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        padding: 20px;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .header {
        text-align: center;
        margin-bottom: 30px;
        padding: 20px;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .header h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    
    .header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .form-container {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }
    
    .form-title {
        font-size: 1.5rem;
        color: #6a11cb;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    table.form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    table.form-table td {
        padding: 15px;
        vertical-align: top;
    }
    
    table.form-table tr {
        border-bottom: 1px solid #f0f0f0;
    }
    
    table.form-table tr:last-child {
        border-bottom: none;
    }
    
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 0 2px rgba(106, 17, 203, 0.2);
        outline: none;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    
    .data-table-container {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }
    
    table.data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    
    table.data-table th,
    table.data-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }
    
    table.data-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }
    
    table.data-table tr:hover {
        background-color: #f8f9fa;
    }
    
    .action-links a {
        display: inline-block;
        padding: 6px 12px;
        margin-right: 8px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .delete-link {
        background-color: #ff4757;
        color: white;
    }
    
    .delete-link:hover {
        background-color: #ff2e43;
    }
    
    .edit-link {
        background-color: #2ed573;
        color: white;
    }
    
    .edit-link:hover {
        background-color: #25c561;
    }
    
    .message {
        padding: 15px;
        margin: 20px 0;
        border-radius: 5px;
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
    
    @media (max-width: 768px) {
        table.form-table td {
            display: block;
            width: 100%;
        }
        
        .btn-submit {
            width: 100%;
        }
        
        .header h1 {
            font-size: 2rem;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Admin Management System</h1>
        <p>Create and manage administrator accounts</p>
    </div>

    <div class="form-container">
        <h2 class="form-title"><?php echo $aid ? 'Edit Admin' : 'Add New Admin'; ?></h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td width="20%"><label for="txt_name">Name</label></td>
                    <td>
                        <input type="hidden" name="txt_id" value="<?php echo $aid ?>" />
                        <input type="text" name="txt_name" id="txt_name" value="<?php echo $aname?>" required placeholder="Enter name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$"/>
                    </td>
                </tr>
                <tr>
                    <td><label for="txt_email">Email</label></td>
                    <td>
                        <input type="email" name="txt_email" id="txt_email" value="<?php echo $aemail?>" required="required" placeholder="Enter email" />
                    </td>
                </tr>
                <tr>
                    <td><label for="txt_password">Password</label></td>
                    <td>
                        <input type="password" name="txt_password" id="txt_password" value="<?php echo $apass?>" required="required" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div align="center">
                            <input type="submit" name="btn_submit" id="btn_submit" value="<?php echo $aid ? 'Update' : 'Register'; ?>" class="btn-submit" />
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="data-table-container">
        <h2 class="form-title">Admin List</h2>
        <table class="data-table">
            <tr>
                <th>SI_NO</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>ACTION</th>
            </tr>
            <?php
            $i = 0;
            $sel = "select * from tbl_admin where admin_status=1";
            $row = $con->query($sel);
            if($row && $row->num_rows > 0) {
                while($data = $row->fetch_assoc()) {
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data["admin_name"];?></td>
                <td><?php echo $data["admin_email"];?></td>
                <td>••••••••</td>
                <td class="action-links">
                    <a href="Admin.php?edid=<?php echo $data["admin_id"]?>" class="edit-link">Edit</a>
                    <a href="Admin.php?delid=<?php echo $data["admin_id"]?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</a>
                </td>
            </tr>
            <?php
                }
            } else {
            ?>
            <tr>
                <td colspan="5" align="center">No admin records found</td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<script>
    // Simple form validation enhancement
    document.getElementById('form1').addEventListener('submit', function(e) {
        const name = document.getElementById('txt_name').value;
        const email = document.getElementById('txt_email').value;
        const password = document.getElementById('txt_password').value;
        
        if(!name || !email || !password) {
            e.preventDefault();
            alert('All fields are required!');
            return false;
        }
        
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailPattern.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address!');
            return false;
        }
        
        const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        if(!passwordPattern.test(password)) {
            e.preventDefault();
            alert('Password must contain at least one number, one uppercase and lowercase letter, and be at least 8 characters long!');
            return false;
        }
    });
</script>
</body>
</html>