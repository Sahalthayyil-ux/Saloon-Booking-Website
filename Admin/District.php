<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
$did="";
$dname="";
$sid="";
if(isset($_POST["btn_submit"]))
{
	$district = $_POST["txt_dname"];
	$state=$_POST['sel_state'];
	$did = $_POST["txt_id"];
	
	if($did == "")
	{
	$selQry="select * from tbl_district where district_status=1 and district_name='".$district."'";
	$res=$con->query($selQry);
	if($data=$res->fetch_assoc())
	{
		?>
        <script>
		alert("District already exist");
		</script>
        <?php
	}
	else
	{
	$ins = "insert into tbl_district(district_name,state_id) values('".$district."','".$state."')";
	
	if($con->query($ins))
	{
		?>
        <script>
        alert("Data inserted..")
		window.location="District.php"
        </script>
        <?php	
	  }
	}
}
else
{
$upQry="update tbl_district set district_name='".$district."',state_id='".$state."' where district_id='".$did."'";
if($con->query($upQry))
 {
		 ?>
		 <script>
        alert("Data updated..")
		window.location="District.php"
        </script>
        <?php 
	  }
	
    }
 
}
if(isset($_GET["delid"]))
{
$upQry="update tbl_district set district_status=0 where district_id=('".$_GET['delid']."')";

if($con->query($upQry))
 {
	?>
    <script>
	alert("data deleted..")
	window.location="District.php"
	</script>
    <?php


 }


}
 if(isset($_GET['edid']))
 {
 $sel="select * from tbl_district where district_id= '".$_GET['edid']."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();
 $dname=$data['district_name'];
 $did=$data['district_id'];
 $sid=$data['state_id'];
 }
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  
  body {
    background-color: #f5f5f5;
    color: #333;
    /* padding: 20px; */
  }
  
  .container {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    padding: 20px;
  }
  
  h2 {
    color: #1616eb;
    text-align: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #1616eb;
  }
  
  .form-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
  }
  
  .form-table td {
    padding: 12px;
  }
  
  .form-table tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  .form-label {
    font-weight: bold;
    color: #333;
  }
  
  input[type="text"], select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
  }
  
  input[type="text"]:focus, select:focus {
    outline: none;
    border-color: #1616eb;
    box-shadow: 0 0 5px rgba(211, 47, 47, 0.3);
  }
  
  .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s;
  }
  
  .btn-submit {
    background-color: #1616eb;
    color: white;
  }
  
  .btn-submit:hover {
    background-color: #b71c1c;
  }
  
  .btn-clear {
    background-color: #333;
    color: white;
    margin-left: 10px;
  }
  
  .btn-clear:hover {
    background-color: #111;
  }
  
  .data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  .data-table th, .data-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  .data-table th {
    background-color: #1616eb;
    color: white;
    font-weight: bold;
  }
  
  .data-table tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  .data-table tr:hover {
    background-color: #f1f1f1;
  }
  
  .action-link {
    color: #1616eb;
    text-decoration: none;
    margin-right: 10px;
    padding: 5px 10px;
    border-radius: 3px;
    transition: all 0.3s;
  }
  
  .action-link:hover {
    background-color: #1616eb;
    color: white;
  }
  
  .action-delete {
    color: #1616eb;
  }
  
  .action-edit {
    color: #333;
  }
  
  .center-buttons {
    text-align: center;
  }
</style>
</head>

<body>
<div class="container">
  <h2>DISTRICT MANAGEMENT</h2>
  
  <form id="form1" name="form1" method="post" action="District.php">
    <table class="form-table">
      <tr>
        <td width="120" class="form-label">State Name</td>
        <td>
          <select name="sel_state" required>
            <option value="">Select State</option>
            <?php
            $sel="select * from tbl_state where state_status=1 ORDER BY state_name ASC";
            $row = $con->query($sel);
            while($data = $row->fetch_assoc())
            {
            ?>
            <option 
            <?php
            if($sid == $data['state_id'])
            {
              echo"selected";
            }
            ?>
            value="<?php echo $data['state_id']?>">
            <?php echo $data['state_name'] ?></option>
            <?php
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td class="form-label">District</td>
        <td>
          <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $did ?>" />
          <input type="text" name="txt_dname" maxlength="15" id="txt_dname" value="<?php echo $dname ?>" required placeholder="Enter district name" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="center-buttons">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-submit" />
          <input type="reset" name="btn_submit2" id="btn_submit2" value="Clear" class="btn btn-clear" />
        </td>
      </tr>
    </table>
  </form>

  <table class="data-table">
    <tr>
      <th width="50">SINO</th>
      <th>STATE</th>
      <th>DISTRICT</th>
      <th width="150">ACTIONS</th>
    </tr>
    <?php
    $i = 0;
    $sel="select * from tbl_district d INNER JOIN tbl_state s on d.state_id = s.state_id where district_status=1 ORDER BY state_name ASC";
    $row = $con->query($sel);
    while($data = $row->fetch_assoc())
    {
      $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data["state_name"];?></td>
        <td><?php echo $data["district_name"];?></td>
        <td>
          <a href="District.php?delid=<?php echo $data['district_id'] ?>" class="action-link action-delete" onclick="return confirm('Are you sure you want to delete this district?')">Delete</a>
          <a href="District.php?edid=<?php echo $data['district_id']?>" class="action-link action-edit">Edit</a>
        </td>
      </tr>
      <?php
    }
    ?>
  </table>
</div>
</body>
</html>
<?php
include('Footer.php');
?>