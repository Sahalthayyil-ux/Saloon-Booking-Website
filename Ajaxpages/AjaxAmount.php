<?php
include("../Connection/Connection.php");
$up = $con->query("update tbl_salooncategory set salooncategory_amount='".$_GET['amt']."' where salooncategory_id=".$_GET['sid'])
?>