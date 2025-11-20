<?php
session_start();
include("../Connection/Connection.php");
?>
<?php

    if ($_GET["action"]=="Delete") {
        $id = $_GET["id"];
        $delQry = "delete from tbl_requirements where requirements_id='" .$id. "'";
        $con->query($delQry);
    }
?>