<?php
session_start();
if(!isset($_SESSION['aid']))
{
    header("Location:../Guest/Login.php");
}
?>