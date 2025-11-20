<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
$subcatid="";
$subcatname="";
$cid ="";
if(isset($_POST["btn_submit"]))
{
	$subcat = $_POST["txt_sub"];
	$category = $_POST['sel_cat'];
	$subcatid = $_POST["txt_id"];
	
	if($subcatid == "")
	{
	$selQry="select * from tbl_subcategory where subcategory_status=1 and subcat_name='".$subcat."'";
	$res=$con->query($selQry);
	if($data=$res->fetch_assoc())
	{
		?>
        <script>
		alert("subcategory already exist");
		</script>
        <?php
	}
	else
	{
	$ins = "insert into tbl_subcategory(subcat_name,category_id) values('".$subcat."','".$category."')";
	
	 if($con->query($ins))
	 {
		 ?>
		 <script>
        alert("Data inserted..")
		window.location="Subcategory.php"
        </script>
        <?php 
	 }
	}
	}
	 else
	{
$upQry="update tbl_subcategory set subcat_name='".$subcat."',category_id='".$category."' where subcat_id='".$subcatid."'";
if($con->query($upQry))
 {
		 ?>
		 <script>
        alert("Data updated..")
		window.location="Subcategory.php"
        </script>
        <?php 
	  }
	
    }
 
}
if(isset($_GET['delid']))
{
	$upQry="update tbl_subcategory set subcategory_status=0 where subcat_id=('".$_GET['delid']."')";

if($con->query($upQry))
 {
	?>
    <script>
	alert("data deleted..")
	window.location="Subcategory.php"
	</script>
    <?php
 }
 
 }
  if(isset($_GET['edid']))
 {
 $sel="select * from tbl_Subcategory where subcat_id= '".$_GET['edid']."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();
 $subcatname=$data['subcat_name'];
 $subcatid=$data['subcat_id'];
 $cid=$data['category_id'];
 }
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subcategory Management</title>
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
        /* padding: 20px; */
    }
    
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        padding: 30px;
    }
    
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        color: #000;
        font-size: 28px;
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
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        border-left: 4px solid #1616eb;
    }
    
    .form-title {
        font-size: 1.4rem;
        color: #000;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #ddd;
        font-weight: bold;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .form-table td {
        padding: 15px;
    }
    
    .form-label {
        font-weight: bold;
        color: #000;
    }
    
    select, input[type="text"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        transition: all 0.3s;
        background: #fff;
        color: #000;
    }
    
    select:focus, input[type="text"]:focus {
        border-color: #1616eb;
        box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.2);
        outline: none;
    }
    
    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
        margin: 0 5px;
    }
    
    .btn-primary {
        background: #1616eb;
        color: white;
    }
    
    .btn-primary:hover {
        background: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(183, 28, 28, 0.3);
    }
    
    .btn-secondary {
        background: #333;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #000;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    
    .data-container {
        margin-top: 30px;
    }
    
    .data-title {
        font-size: 1.4rem;
        color: #000;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #ddd;
        font-weight: bold;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    
    .data-table th,
    .data-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
    }
    
    .data-table th {
        background-color: #000;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .data-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .data-table tr:hover {
        background-color: #ffeeee;
    }
    
    .action-cell {
        white-space: nowrap;
    }
    
    .action-link {
        text-decoration: none;
        margin: 0 5px;
        padding: 6px 12px;
        border-radius: 3px;
        transition: all 0.3s;
        font-weight: 500;
        display: inline-block;
    }
    
    .action-delete {
        background: #ffebee;
        border: 1px solid #1616eb;
        color: #1616eb;
    }
    
    .action-delete:hover {
        background: #1616eb;
        color: white;
    }
    
    .action-edit {
        background: #f5f5f5;
        border: 1px solid #333;
        color: #000;
    }
    
    .action-edit:hover {
        background: #333;
        color: white;
    }
    
    .no-data {
        text-align: center;
        padding: 30px;
        color: #666;
        font-style: italic;
    }
    
    .center-buttons {
        text-align: center;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .form-table td {
            display: block;
            width: 100%;
            padding: 10px;
        }
        
        .data-table {
            font-size: 14px;
        }
        
        .data-table th,
        .data-table td {
            padding: 10px;
        }
        
        .action-cell {
            white-space: normal;
        }
        
        .action-link {
            display: block;
            margin: 5px 0;
            text-align: center;
        }
        
        .btn {
            display: block;
            width: 100%;
            margin: 10px 0;
        }
    }
</style>
</head>

<body>
<div class="container">
    <h1 class="page-title">Subcategory Management</h1>
    
    <div class="form-container">
        <h2 class="form-title"><?php echo $subcatid ? 'Edit Subcategory' : 'Add New Subcategory'; ?></h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td width="120" class="form-label">Category</td>
                    <td>
                        <select name="sel_cat" id="sel_cat" required="required">
                            <option value="">Select Category</option>
                            <?php
                            $sel="select * from tbl_category where category_status=1 ORDER BY category_name ASC";
                            $row = $con->query($sel);
                            while($data = $row->fetch_assoc())
                            {
                            ?>
                            <option 
                            <?php
                            if($cid == $data['category_id'])
                            {
                                echo"selected";
                            }
                            ?>
                            value="<?php echo $data['category_id']?>">
                            <?php echo $data['category_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="form-label">Subcategory</td>
                    <td>
                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $subcatid?>" />
                        <input type="text" name="txt_sub" maxlength="25" id="txt_sub" value="<?php echo $subcatname?>" required placeholder="Enter subcategory name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z &/]*$"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center-buttons">
                        <input type="submit" name="btn_submit" id="btn_submit" value="<?php echo $subcatid ? 'Update' : 'Submit'; ?>" class="btn btn-primary" />
                        <input type="reset" name="btn_clear" id="btn_clear" value="Clear" class="btn btn-secondary" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="data-container">
        <h2 class="data-title">Subcategory List</h2>
        <table class="data-table">
            <tr>
                <th width="50">S.No</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th width="150">Actions</th>
            </tr>
            <?php
            $i = 0;
            $sel="select * from tbl_subcategory d INNER JOIN tbl_category s on d.category_id = s.category_id where subcategory_status=1 ORDER BY category_name ASC";
            $row = $con->query($sel);
            
            if($row && $row->num_rows > 0) {
                while($data = $row->fetch_assoc())
                {
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data["category_name"];?></td>
                <td><?php echo $data["subcat_name"];?></td>
                <td class="action-cell">
                    <a href="Subcategory.php?edid=<?php echo $data['subcat_id']?>" class="action-link action-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="Subcategory.php?delid=<?php echo $data['subcat_id'] ?>" class="action-link action-delete" onclick="return confirm('Are you sure you want to delete this subcategory?')">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php
                }
            } else {
            ?>
            <tr>
                <td colspan="4" class="no-data">No subcategories found. Add your first subcategory above.</td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.forms['form1'];
        const subcatInput = document.getElementById('txt_sub');
        const categorySelect = document.getElementById('sel_cat');
        
        form.addEventListener('submit', function(e) {
            if (categorySelect.value === "") {
                e.preventDefault();
                alert('Please select a category');
                categorySelect.focus();
                return false;
            }
            
            if (!subcatInput.value.trim()) {
                e.preventDefault();
                alert('Please enter a subcategory name');
                subcatInput.focus();
                return false;
            }
            
            const pattern = /^[A-Z]+[a-zA-Z &/]*$/;
            if (!pattern.test(subcatInput.value)) {
                e.preventDefault();
                alert('Subcategory name must start with a capital letter and contain only letters and spaces');
                subcatInput.focus();
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