<option value="">..select...</option>
<?php
include("../Connection/Connection.php");
  $sel="select * from tbl_place where place_status=1 and district_id='".$_GET['did']."' ORDER BY place_name ASC";
	$row = $con->query($sel);
	while($data = $row->fetch_assoc())
	{
  ?>
  <option 
  value="<?php echo $data['place_id']?>">
  <?php echo $data['place_name'] ?></option>
  <?php
	}
	?>

