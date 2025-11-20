<title>ajaxcat</title>
<option>..select...</option>
<?php
include("../Connection/Connection.php");
  $sel="select * from tbl_subcategory where subcategory_status=1 and category_id=".$_GET['cid'];
	$row = $con->query($sel);
	while($data = $row->fetch_assoc())
	{
  ?>
<option 
  value="<?php echo $data['subcat_id']?>">
  <?php echo $data['subcat_name'] ?></option>
  <?php
	}
	?>
