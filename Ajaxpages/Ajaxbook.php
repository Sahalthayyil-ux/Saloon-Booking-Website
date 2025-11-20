<title>ajaxbook</title>
<option>..select...</option>
<?php
include("../Connection/Connection.php");
  $sel="select * from tbl_salooncategory s inner join tbl_subcategory b on s.subcategory_id=b.subcat_id  where saloon_id='".$_GET['saloon']."' and category_id=".$_GET['cid'];
	$row = $con->query($sel);
	while($data = $row->fetch_assoc())
	{
  ?>
<option 
  value="<?php echo $data['salooncategory_id']?>">
  <?php echo $data['subcat_name'] ?> - <?php echo $data['salooncategory_amount'] ?></option>
  <?php
	}
	?>
