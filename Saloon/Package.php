<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');

// Fetch salon data for sidebar
$select="select * from tbl_saloon where saloon_id='".$_SESSION['sid']."'";
$res=$con->query($select);
$salon_data=$res->fetch_assoc();

if(isset($_POST["btn_add"]))
{
	$name = $_POST["txt_name"];
	$amount = $_POST["txt_amount"];
	$description = $_POST["txt_des"];
	$photo = $_FILES["file_photo"] ['name'];
	$path= $_FILES["file_photo"] ['tmp_name'];
	move_uploaded_file($path,'../Assets/Files/saloon/package/'.$photo);
	
	if($_SESSION['sid'] != "")
	{
	$ins = "insert into tbl_package(package_name,package_amount,package_description,package_photo,saloon_id) values('".$name."','".$amount."','".$description."','".$photo."','".$_SESSION['sid']."')";
	
	 if($con->query($ins))
	 {
		 ?>
		 <script>
        alert("package added..")
		window.location="Package.php"
        </script>
        <?php 
	 }
	}
}

if(isset($_GET['delid']))
{
	$upQry="update tbl_package set package_status=0 where package_id=('".$_GET['delid']."')";

if($con->query($upQry))
 {
	?>
    <script>
	alert("package deleted..")
	window.location="Package.php"
	</script>
    <?php
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package Management</title>
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
        min-height: calc(100vh - 120px);
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
    
    .content {
        flex: 1;
        padding: 30px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        margin: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow-y: scroll;
        height:600px;
    }
    
    
    .form-section, .table-section {
        margin-bottom: 40px;
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
        width: 80%;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        overflow: hidden;
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
    
    input[type="text"], textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 6px;
        font-size: 16px;
        transition: border 0.3s;
        background-color: #f8fafc;
    }
    
    input[type="text"]:focus, textarea:focus {
        border-color: #1e40af;
        outline: none;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }
    
    input[type="file"] {
        padding: 10px 0;
        width: 100%;
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
        width: 200px;
    }
    
    input[type="submit"]:hover {
        background-color: #1e3a8a;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .submit-cell {
        text-align: center;
        padding-top: 20px;
    }
    
    .package-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e2e8f0;
    }
    
    .action-link {
        color: #e53e3e;
        text-decoration: none;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s;
        display: inline-block;
    }
    
    .action-link:hover {
        background-color: #fed7d7;
        transform: translateY(-1px);
    }
    
    .input-hint {
        font-size: 12px;
        color: #718096;
        margin-top: 5px;
        display: block;
    }
    
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        color: #2d3748;
    }
    
    .page-title i {
        color: #6a11cb;
        margin-right: 10px;
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
            margin: 10px;
        }
        
        th, td {
            padding: 10px;
        }
        
        .package-image {
            width: 100px;
            height: 100px;
        }
    }
</style>
</head>

<body>
    <div class="header">
        <h1 class="welcome">Salon Management System</h1>
        <p>Hai, <?php echo $salon_data['saloon_name']; ?></p>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <a href="Saloonhome.php" class="nav-item"><i class="fas fa-home"></i> Saloon Home</a>
            <a href="Profile.php" class="nav-item"><i class="fas fa-user"></i> Profile</a>
            <a href="Editprofile.php" class="nav-item"><i class="fas fa-edit"></i> Edit Profile</a>
            <a href="Addservices.php" class="nav-item"><i class="fas fa-concierge-bell"></i> Add Services</a>
            <a href="Slot.php" class="nav-item"><i class="fas fa-calendar-alt"></i> Slot</a>
            <a href="Package.php" class="nav-item active"><i class="fas fa-box"></i> Package</a>
            <a href="Viewbooking.php" class="nav-item"><i class="fas fa-calendar-check"></i> View Booking</a>
            <a href="Viewpackagebooking.php" class="nav-item"><i class="fas fa-tags"></i> View Package Booking</a>
            <a href="Addleave.php" class="nav-item"><i class="fas fa-bed"></i> Add Leave</a>
            <a href="changepsswd.php" class="nav-item"><i class="fas fa-key"></i> Change password</a>
            <a href="CreateBill.php" class="nav-item"><i class="fas fa-receipt"></i> Create Bill</a>
            <a href="../Logout.php" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        
        <div class="content">
            <h1 class="page-title"><i class="fas fa-box"></i>Package Management</h1>
            
            <div class="form-section">
                <h2 class="section-title">Add New Package</h2>
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <table class="form-table">
                        <tr>
                            <td width="150">NAME</td>
                            <td>
                                <label for="txt_name"></label>
                                <input type="text" name="txt_name" id="txt_name" required maxlength="35" placeholder="Enter package name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$"/>
                                <span class="input-hint">Must start with capital letter and contain only letters and spaces</span>
                            </td>
                        </tr>
                        <tr>
                            <td>AMOUNT</td>
                            <td>
                                <label for="txt_amount"></label>
                                <input type="text" name="txt_amount" id="txt_amount" required pattern="^\d+(\.\d{1,2})?$" title="Allows only numbers" placeholder="Enter package amount"/>
                                <span class="input-hint">Enter amount in numbers (e.g., 100 or 99.99)</span>
                            </td>
                        </tr>
                        <tr>
                            <td>PHOTO</td>
                            <td>
                                <label for="file_photo"></label>
                                <input type="file" name="file_photo" id="file_photo" required accept="image/*" />
                                <span class="input-hint">Accepted formats: JPG, PNG, GIF</span>
                            </td>
                        </tr>
                        <tr>
                            <td>DESCRIPTION</td>
                            <td>
                                <label for="txt_des"></label>
                                <textarea name="txt_des" id="txt_des" cols="45" rows="5" required placeholder="Enter package description"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="submit-cell">
                                <input type="submit" name="btn_add" id="btn_add" value="Add Package" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            
            <div class="table-section">
                <h2 class="section-title">Existing Packages</h2>
                <table>
                    <tr>
                        <th width="50">SINO</th>
                        <th>NAME</th>
                        <th width="100">AMOUNT</th>
                        <th width="160">PHOTO</th>
                        <th>DESCRIPTION</th>
                        <th width="100">ACTION</th>
                    </tr>
                    <?php
                    $i = 0;
                    $sel="select * from tbl_package where package_status=1 and saloon_id='".$_SESSION['sid']."'";
                    $row = $con->query($sel);
                    if($row->num_rows > 0) {
                        while($data = $row->fetch_assoc())
                        {
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data["package_name"]; ?></td>
                        <td>$<?php echo $data["package_amount"]; ?></td>
                        <td><img src="../Assets/Files/saloon/package/<?php echo $data["package_photo"];?>" class="package-image" /></td>
                        <td><?php echo $data["package_description"]; ?></td>
                        <td><a href="Package.php?delid=<?php echo $data['package_id'] ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this package?')">Delete</a></td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px; color: #718096;">
                            No packages found. Add your first package above.
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Add confirmation for delete actions
        document.addEventListener('DOMContentLoaded', function() {
            const deleteLinks = document.querySelectorAll('.action-link');
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to delete this package?')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Form validation enhancement
            const form = document.getElementById('form1');
            form.addEventListener('submit', function(e) {
                const nameInput = document.getElementById('txt_name');
                const amountInput = document.getElementById('txt_amount');
                const fileInput = document.getElementById('file_photo');
                
                // Validate name pattern
                const namePattern = /^[A-Z]+[a-zA-Z ]*$/;
                if (!namePattern.test(nameInput.value)) {
                    alert('Package name must start with a capital letter and contain only letters and spaces.');
                    nameInput.focus();
                    e.preventDefault();
                    return false;
                }
                
                // Validate amount pattern
                const amountPattern = /^\d+(\.\d{1,2})?$/;
                if (!amountPattern.test(amountInput.value)) {
                    alert('Please enter a valid amount (numbers only, with optional decimal places).');
                    amountInput.focus();
                    e.preventDefault();
                    return false;
                }
                
                // Validate file type
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                    if (!validTypes.includes(file.type)) {
                        alert('Please select a valid image file (JPG, PNG, GIF).');
                        fileInput.focus();
                        e.preventDefault();
                        return false;
                    }
                }
            });
        });
    </script>
</body>
</html>