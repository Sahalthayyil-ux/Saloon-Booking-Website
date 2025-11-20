<option value="">...select...</option>
<?php 
include("../Connection/Connection.php");
$selslot = "select s.slot_id, s.slot_from, s.slot_to from tbl_slot s where slot_status=1 and saloon_id='".$_GET["sid"]."' and ((select count(*) from tbl_packagebooking p where packagebooking_todate='".$_GET['date']."' and packagebooking_status=1 and p.slot_id=s.slot_id) + (select count(*) from tbl_requirements r inner join tbl_booking b on r.booking_id=b.booking_id where r.slot_id=s.slot_id and b.booking_todate='".$_GET['date']."' )) < 5";
	$slotres = $con->query($selslot);
	while($slotdata = $slotres->fetch_assoc())
	{
		?>
        <option
        value="<?php echo $slotdata['slot_id']?>">
        <?php echo $slotdata['slot_from'] ?> - <?php echo $slotdata['slot_to'] ?></option>
  <?php
	}
?>