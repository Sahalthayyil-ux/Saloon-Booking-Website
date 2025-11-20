<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
$cid="";
$cname="";
if(isset($_POST["btn_submit"]))
{
	$category = $_POST["txt_cname"];
    $cid = $_POST["txt_id"];

	if($cid=="")
	{
	$selQry="select * from tbl_category where category_status=1 and category_name='".$category."'";
	$res=$con->query($selQry);
	if($data=$res->fetch_assoc())
	{
		?>
        <script>
		alert("category already exists");
		</script>
        <?php
	}
	else
	{
	$ins = "insert into tbl_category(category_name)
	values('".$category."')";
	
	if($con->query($ins))
	{
		?>
        <script>
        alert("Data inserted..")
		window.location="Category.php"
        </script>
        <?php	
	}
	}
}
else
{
$upQry="update tbl_category set category_name='".$category."' where category_id='".$cid."'";
if($con->query($upQry))
 {
		 ?>
		 <script>
        alert("Data updated..")
		window.location="Category.php"
        </script>
        <?php 
	  }
	
    }
 
}
 if(isset($_GET["delid"]))
 {
	$upQry="update tbl_category set category_status=0  where  category_id=('".$_GET['delid']."')";

if($con->query($upQry))
 {
	?>
    <script>
	alert("data deleted..")
	window.location="Category.php"
	</script>
    <?php


 }


}
 if(isset($_GET['edid']))
 {
 $sel="select * from tbl_category where category_id= '".$_GET['edid']."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();
 $cname=$data['category_name'];
 $cid=$data['category_id'];
 }
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f5f5;
        color: #000;
        line-height: 1.6;
        /* padding: 20px; */
    }
    
    .container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
    }
    
    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid #ddd;
    }
    
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        color: #000;
        font-size: 2.2rem;
        position: relative;
        padding-bottom: 15px;
        font-weight: bold;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: #1616eb;
        border-radius: 2px;
    }
    
    .form-container {
        margin-bottom: 30px;
    }
    
    .form-title {
        font-size: 1.4rem;
        color: #000;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #ddd;
        font-weight: bold;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #000;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        transition: all 0.3s;
        background: #faf9f9f3;
        color: #0a0a0ae8;
    }
    
    .form-control:focus {
        border-color: #1616eb;
        box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.2);
        outline: none;
        background-color: #fff;
    }
    
    .btn {
        display: inline-block;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }
    
    .btn-primary {
        background: #1616eb;
        color: white;
    }
    
    .btn-primary:hover {
        background: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(183, 28, 28, 0.3);
    }
    
    .btn-secondary {
        background: #333;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #000;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }
    
    .btn-action {
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 4px;
    }
    
    .btn-edit {
        background: #333;
        color: white;
    }
    
    .btn-edit:hover {
        background: #000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }
    
    .btn-delete {
        background: #1616eb;
        color: white;
    }
    
    .btn-delete:hover {
        background: #b71c1c;
        box-shadow: 0 4px 8px rgba(183, 28, 28, 0.3);
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .data-table th,
    .data-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .data-table th {
        background-color: #000;
        color: white;
        font-weight: 600;
    }
    
    .data-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .data-table tr:hover {
        background-color: #f1f1f1;
    }
    
    .action-cell {
        white-space: nowrap;
    }
    
    .action-cell a {
        margin-right: 8px;
        text-decoration: none;
    }
    
    .text-center {
        text-align: center;
    }
    
    .btn-group {
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    
    .no-data {
        text-align: center;
        padding: 30px;
        color: #666;
        font-style: italic;
    }
    
    .alert {
        padding: 12px 16px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-weight: 500;
    }
    
    .alert-error {
        background-color: #ffebee;
        color: #1616eb;
        border-left: 4px solid #1616eb;
    }
    
    .alert-success {
        background-color: #e8f5e9;
        color: #2e7d32;
        border-left: 4px solid #2e7d32;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .btn-group {
            flex-direction: column;
        }
        
        .data-table th,
        .data-table td {
            padding: 10px;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
    }
</style>
</head>

<body>
<div class="container">
    <h1 class="page-title">Category Management</h1>
    
    <div class="card form-container">
        <h2 class="form-title"><?php echo $cid ? 'Edit Category' : 'Add New Category'; ?></h2>
        <form name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_cname">Category Name</label>
                <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $cid ?>" />
                <input type="text" class="form-control" maxlength="20" name="txt_cname" id="txt_cname" value="<?php echo $cname ?>" required="required" placeholder="Enter category name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$"/>
            </div>
            
            <div class="btn-group">
                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary"><?php echo $cid ? 'Update' : 'Submit'; ?></button>
                <button type="reset" name="btn_submit2" id="btn_submit2" class="btn btn-secondary">Clear</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2 class="form-title">Category List</h2>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sel = "select * from tbl_category where category_status=1";
                    $row = $con->query($sel);
                    if($row && $row->num_rows > 0) {
                        while($data = $row->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $data["category_name"];?></td>
                        <td class="action-cell">
                            <a href="Category.php?edid=<?php echo $data['category_id']?>" class="btn btn-action btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="Category.php?delid=<?php echo $data['category_id'] ?>" class="btn btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="3" class="no-data">No categories found. Add your first category above.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.forms['form1'];
        const categoryInput = document.getElementById('txt_cname');
        
        form.addEventListener('submit', function(e) {
            if (!categoryInput.value.trim()) {
                e.preventDefault();
                alert('Please enter a category name');
                categoryInput.focus();
                return false;
            }
            
            const pattern = /^[A-Z]+[a-zA-Z ]*$/;
            if (!pattern.test(categoryInput.value)) {
                e.preventDefault();
                alert('Category name must start with a capital letter and contain only letters and spaces');
                categoryInput.focus();
                return false;
            }
        });
    });
</script>
</body>
</html>
<?php
include('Footer.php');
?>