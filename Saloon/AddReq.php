<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');

// Fetch saloon data for the header
$select="select * from tbl_saloon where saloon_id='".$_SESSION['sid']."'";
$res=$con->query($select);
$saloonData=$res->fetch_assoc();

if(isset($_POST["btn_insert"]))
{
$sub = $_POST["scl_subcategory"];			
$ins = "insert into tbl_liverequirements(salooncategory_id,livebooking_id) values('".$sub."','".$_GET['lid']."')";
	
	 if($con->query($ins))
	 {
		 ?>
		 <script>
        alert("Requirements added..")
		window.location="AddReq.php?lid=<?php echo $_GET['lid']; ?>"
        </script>
        <?php 
	 }
}

if(isset($_GET['live']))
{
	$del = "delete from tbl_liverequirements where livebooking_id=".$_GET['lid'];
	if($con->query($del))
	{
		?>
		<script>
        alert('Data Deleted');
		window.location="AddReq.php?lid=<?php echo $_GET['lid']; ?>"
        </script>
		<?php
	}
}
if(isset($_GET['liveid']))
{
$sell = $con->query("select * from tbl_liverequirements where livebooking_id=".$_GET['liveid']);
    if($sell->num_rows>0)
    {
        $total = 0;
        
        // Join liverequirements with salooncategory to fetch amount
        $s1 = "SELECT sc.salooncategory_amount 
            FROM tbl_liverequirements lr
            INNER JOIN tbl_salooncategory sc 
            ON lr.salooncategory_id = sc.salooncategory_id
            WHERE lr.livebooking_id = ".$_GET['liveid'];
        
        $r1 = $con->query($s1);
        while($d1 = $r1->fetch_assoc())
        {
            $total += $d1['salooncategory_amount'];
        }
        
        // Update livebooking amount
        $update = "UPDATE tbl_livebooking 
                SET livebooking_amount = '".$total."' 
                WHERE livebooking_id = ".$_GET['liveid'];
        
        if($con->query($update))
        {
            ?>
            <script>
            window.location="LiveBill.php?liveid=<?php echo $_GET['liveid']; ?>";
            </script>
            <?php
        }
    }
    else
    {
    echo "<script>alert('Please Select One Service');window.location='AddReq.php?lid=".$_GET['liveid']."'</script>";
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADD REQUEST</title>
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
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(5px);
        margin: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow-y: auto;
    }
    
    .page-container {
        max-width: 1000px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    h1 {
        color: #007bff;
        text-align: center;
        margin-bottom: 30px;
        font-size: 32px;
        border-bottom: 3px solid #007bff;
        padding-bottom: 15px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    
    table.form-table {
        width: 70%;
        margin: 0 auto 30px;
        background: #f8f9fa;
        border-radius: 8px;
        overflow: hidden;
    }
    
    th, td {
        padding: 15px;
        text-align: left;
        border: 1px solid #dee2e6;
    }
    
    th {
        background-color: #007bff;
        color: white;
        font-weight: 600;
    }
    
    tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    tr:hover {
        background-color: #e9ecef;
    }
    
    select, input[type="submit"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #ced4da;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 16px;
    }
    
    select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }
    
    input[type="submit"] {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        padding: 15px;
        transition: all 0.3s;
    }
    
    input[type="submit"]:hover {
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,123,255,0.3);
    }
    
    .complete-btn {
        display: inline-block;
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        color: white;
        padding: 15px 30px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        margin: 20px 0;
        transition: all 0.3s;
        text-align: center;
    }
    
    .complete-btn:hover {
        background: linear-gradient(135deg, #218838 0%, #155724 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40,167,69,0.3);
    }
    
    .delete-link {
        color: #dc3545;
        text-decoration: none;
        font-weight: 600;
        padding: 8px 15px;
        border-radius: 4px;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .delete-link:hover {
        background-color: #f8d7da;
        text-decoration: none;
        transform: scale(1.05);
    }
    
    .btn-container {
        text-align: center;
        margin: 30px 0;
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
            padding: 20px;
        }
        
        table.form-table {
            width: 100%;
        }
        
        h1 {
            font-size: 24px;
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
                <h1><i class="fas fa-plus-circle"></i> ADD LIVE SERVICE REQUIREMENTS</h1>
                
                <form id="form1" name="form1" method="post" action="">
                    <table class="form-table">
                        <tr>
                            <td>CATEGORY</td>
                            <td>
                                <label for="scl_category"></label>
                                <select name="scl_category" id="scl_category" onChange="getSubcategory(this.value)" required="required">
                                    <option value="">select category</option>
                                    <?php
                                    $sel="select * from tbl_category where category_status=1";
                                    $row = $con->query($sel);
                                    while($data = $row->fetch_assoc())
                                    {
                                    ?>
                                    <option value="<?php echo $data['category_id']?>">
                                        <?php echo $data['category_name'] ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>SUBCATEGORY</td>
                            <td>
                                <label for="scl_subcategory"></label>
                                <select name="scl_subcategory" id="scl_subcategory" required="required">
                                    <option value="">select subcategory</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" name="btn_insert" id="btn_insert" value="Insert Requirement" />
                            </td>
                        </tr>
                    </table>
                </form>
                
                <div class="btn-container">
                    <a href="AddReq.php?liveid=<?php echo $_GET['lid']; ?>" class="complete-btn">
                        <i class="fas fa-check-circle"></i> Complete Requirements
                    </a>
                </div>
                
                <table>
                    <tr>
                        <th>SlNo</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                    $i=0;
                    $sel = "select * from tbl_liverequirements l inner join tbl_salooncategory s on l.salooncategory_id=s.salooncategory_id inner join tbl_subcategory su on s.subcategory_id=su.subcat_id inner join tbl_category c on c.category_id=su.category_id where livebooking_id=".$_GET['lid'];
                    $res = $con->query($sel);
                    if($res->num_rows > 0) {
                        while($data = $res->fetch_assoc())
                        {
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['category_name']; ?></td>
                        <td><?php echo $data['subcat_name']; ?></td>
                        <td>
                            <a href="AddReq.php?live=<?php echo $data['livebooking_id']?>&lid=<?php echo $_GET['lid']; ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this requirement?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 30px; color: #6c757d;">
                            <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px;"></i><br>
                            No requirements added yet. Please add requirements using the form above.
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getSubcategory(cid) 
        {
            $.ajax({
            url:"../Assets/Ajaxpages/Ajaxbook.php?cid="+cid+"&saloon="+<?php echo $_SESSION['sid'];?>,
            success: function(result){
                $("#scl_subcategory").html(result);
            }
            });
        }
        
        // Add confirmation for delete actions
        document.addEventListener('DOMContentLoaded', function() {
            const deleteLinks = document.querySelectorAll('.delete-link');
            
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if(!confirm('Are you sure you want to delete this requirement?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>