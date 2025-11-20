<option value="">..select...</option>
<?php
include("../Connection/Connection.php");
  $sel="select * from tbl_district where district_status=1 and state_id='".$_GET['sid']."' ORDER BY district_name ASC";
	$row = $con->query($sel);
	while($data = $row->fetch_assoc())
	{
  ?>
  <option 
  value="<?php echo $data['district_id']?>">
  <?php echo $data['district_name'] ?></option>
  <?php
	}
	?>

