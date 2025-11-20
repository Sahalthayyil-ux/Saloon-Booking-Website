<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$said="";
$saname="";
$saemail="";
$sapass="";
$sid="";
if(isset($_POST["btn_submit"]))
{
	$name = $_POST["txt_name"];
	$email = $_POST["txt_email"];
	$state=$_POST['sel_state'];
	$password = $_POST["txt_pass"];
	$said= $_POST["txt_id"];
	
	if($said=="")
	{
	$sel="select * from tbl_subadmin where  subadmin_email='".$email."'";
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
	tbl_subadmin(subadmin_name,subadmin_email,state_id,subadmin_password)
	 values('".$name."','".$email."','".$state."','".$password."')";
	 
	 if($con->query($ins))
	 {
		 ?>
		 <script>
        alert("Data inserted..")
		window.location="Subadmin.php"
        </script>
        <?php 
	 }
	}
	}
	 else
 {
	$upQry="update tbl_subadmin set subadmin_name='".$name."',subadmin_email='".$email."',state_id='".$state."',subadmin_password='".$password."' where subadmin_id='".$said."'";
   if($con->query($upQry))
  {
		 ?>
		 <script>
        alert("Data updated..")
		window.location="Subadmin.php"
        </script>
        <?php 
	  }
	
    }
 
}

if(isset($_GET["delid"]))
{
$upQry="update tbl_subadmin set subadmin_status=0 where subadmin_id='".$_GET["delid"]."'";
if($con->query($upQry))
 {
	?>
    <script>
	alert("data deleted..")
	window.location="Subadmin.php"
	</script>
    <?php


 }


}
if(isset($_GET['edid']))
 {
 $sel="select * from tbl_subadmin where subadmin_id= '".$_GET['edid']."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();
 $saname=$data['subadmin_name'];
 $said=$data['subadmin_id'];
 $saemail=$data['subadmin_email'];
 $sapass=$data['subadmin_password'];
 $sid=$data['state_id'];
 }
 
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subadmin</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="hidden" name="txt_id" value="<?php echo $said ?>" />
      <input type="text" name="txt_name" id="txt_name" value="<?php echo $saname?>" require="required" placeholder="Enter name"  title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" value="<?php echo $saemail?>" required placeholder="Enter email" /></td>
    </tr>
    <tr>
      <td>State</td>
      <td><label for="sel_state"></label>
        <select name="sel_state" id="sel_state">
         <option>Select State</option>
  <?php
  $sel="select * from tbl_state where state_status=1";
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
      </select></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_pass"></label>
      <input type="password" name="txt_pass" id="txt_pass" value="<?php echo $sapass?>" required="required" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="txt_pass"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>SINO</td>
      <td>NAME</td>
      <td>EMAIL</td>
      <td>STATE</td>
      <td>PASSWORD</td>
      <td>ACTION</td>
    </tr>
    <?php
	$i = 0;
	$sel="select * from tbl_subadmin d INNER JOIN tbl_state s on d.state_id = s.state_id where subadmin_status=1";
	$row = $con->query($sel);
	while($data = $row->fetch_assoc())
	{
		$i++;
	  ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data["subadmin_name"];?></td>
      <td><?php echo $data["subadmin_email"];?></td>
      <td><?php echo $data["state_name"];?></td>
      <td><?php echo $data["subadmin_password"];?></td>
      <td><a href="Subadmin.php?delid=<?php echo $data["subadmin_id"]?>">Delete</a>
      	<a href="Subadmin.php?edid=<?php echo $data["subadmin_id"]?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
    
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>