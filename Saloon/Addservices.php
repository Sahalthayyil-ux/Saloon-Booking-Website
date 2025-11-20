<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');

if(isset($_POST["btn_add"]))
{
	$amount = $_POST["txt_amount"];
	$cat = $_POST["sel_category"];
	$subcat = $_POST["sel_subcategory"];
	
$ins = "insert into tbl_salooncategory(saloon_id,subcategory_id,salooncategory_amount) values('".$_SESSION['sid']."','".$subcat."','".$amount."')";
	
	 if($con->query($ins))
	 {
		 ?>
		 <script>
        alert("Service added..")
		window.location="Addservices.php"
        </script>
        <?php 
	 }
	}
	if(isset($_GET["delid"]))
{
$del="delete from tbl_salooncategory where salooncategory_id='".$_GET["delid"]."'";


if($con->query($del))
 {
?>
    <script>
	alert("data deleted..")
	window.location="Addservices.php"
	</script>
    <?php
	}

}

// Fetch saloon data for header
$select="select * from tbl_saloon where saloon_id='".$_SESSION['sid']."'";
$res=$con->query($select);
$data=$res->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADD SERVICE</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-image: url("../Assets/Templates/Images/salon service.jpg");
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
        background-image: url("../Assets/Templates/Images/salon service.jpg");
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
    
    .nav-item.logout {
        margin-top: 20px;
        color: #e74c3c;
    }
    
    .nav-item.logout:hover {
        background: rgba(231, 76, 60, 0.1);
        border-left: 4px solid #e74c3c;
    }
    
    .content-container {
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
    
    .form-container {
        max-width: 1000px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    h1 {
        color: #007bff;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .form-section, .table-section {
        margin-bottom: 30px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    
    table.form-table {
        width: 60%;
        margin: 0 auto 20px;
    }
    
    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #dee2e6;
    }
    
    th {
        background-color: #007bff;
        color: white;
    }
    
    tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    select, input[type="text"], input[type="submit"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    input[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        padding: 10px;
    }
    
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    
    .delete-link {
        color: #dc3545;
        text-decoration: none;
        font-weight: bold;
    }
    
    .delete-link:hover {
        text-decoration: underline;
    }
    
    .section-title {
        color: #007bff;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            padding: 10px 0;
        }
        
        .content-container {
            margin: 10px;
            padding: 15px;
        }
        
        table.form-table {
            width: 100%;
        }
    }
</style>
</head>

<body>
    <div class="header">
        <h1 class="welcome" style="color:white;">Salon Management System</h1>
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
        
        <div class="content-container">
            <div class="form-container">
                <h1>ADD SALOON SERVICES</h1>
                
                <div class="form-section">
                    <h2 class="section-title">Add New Service</h2>
                    <form id="form1" name="form1" method="post" action="">
                      <table class="form-table">
                        <tr>
                          <td>CATEGORY</td>
                          <td><label for="sel_category"></label>
                            <select name="sel_category" id="sel_category" onChange="getSubcategory(this.value)" require="required">
                            <option value="">Select category</option>
                            <?php
                      $sel="select * from tbl_category where category_status=1";
                        $row = $con->query($sel);
                        while($data = $row->fetch_assoc())
                        
                        {
                      ?>
                      <option value="<?php echo $data['category_id']?>">
                      <?php echo $data['category_name'] ?></option>
                      <?php
                        }
                        ?>
                          </select></td>
                        </tr>
                        <tr>
                          <td>SUBCATEGORY</td>
                          <td><label for="sel_subcategory"></label>
                            <select name="sel_subcategory" id="sel_subcategory" required>
                            <option value="">Select subcategory</option>
                          </select></td>
                        </tr>
                        <tr>
                          <td>AMOUNT</td>
                          <td><label for="txt_amount"></label>
                          <input type="text" name="txt_amount" id="txt_amount" pattern="^\d+(\.\d{1,2})?$"
                      required title="allows only numbers"/></td>
                        </tr>
                        <tr>
                          <td colspan="2"><div align="center">
                            <input type="submit" name="btn_add" id="btn_add" value="ADD SERVICE" />
                          </div></td>
                        </tr>
                      </table>
                    </form>
                </div>
                
                <div class="table-section">
                    <h2 class="section-title">Current Services</h2>
                    <table>
                      <tr>
                        <th>SI NO</th>
                        <th>CATEGORY</th>
                        <th>SUBCATEGORY</th>
                        <th>AMOUNT</th>
                        <th>ACTION</th>
                      </tr>
                       <?php
                      $i = 0;
                        $sel="select * from tbl_salooncategory s inner join tbl_subcategory b on s.subcategory_id=b.subcat_id inner join tbl_category c on b.category_id=c.category_id where saloon_id='".$_SESSION['sid']."'";
                        $row = $con->query($sel);
                        while($data = $row->fetch_assoc())
                        {
                            $i++;
                          ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data["category_name"]; ?></td>
                        <td><?php echo $data["subcat_name"]; ?></td>
                        <td><input type="text" name="txt_amount" onchange="setAmount(this.value,'<?php echo $data['salooncategory_id']?>')" id="txt_amount" value="<?php echo $data["salooncategory_amount"]; ?>" style="width:100px;"></td>
                        <td><a href="Addservices.php?delid=<?php echo $data['salooncategory_id'] ?>" class="delete-link">Delete</a></td>
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
<script src="../Assets/JQ/jQuery.js"></script> 

<script>
    function setAmount(amt, sid) 
    {
        $.ajax({
        url:"../Assets/Ajaxpages/AjaxAmount.php?amt="+amt+"&sid="+sid,
        success: function(result){
            // $("#sel_subcategory").html(result);
            window.location.reload();
        }
        });
    }

    function getSubcategory(cid) 
    {
        $.ajax({
        url:"../Assets/Ajaxpages/Ajaxcategory.php?cid="+cid,
        success: function(result){
            $("#sel_subcategory").html(result);
        }
        });
    }
    
    // Highlight current page in navigation
    const currentPage = window.location.pathname.split('/').pop();
    document.querySelectorAll('.nav-item').forEach(item => {
        if (item.getAttribute('href') === currentPage) {
            item.classList.add('active');
        }
    });
</script>