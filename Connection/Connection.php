<?php 
$server="localhost";
$username="root";
$password="";
$db="db_saloon";
$con = mysqli_connect($server,$username,$password,$db);

if(!$con)
{
	echo "error";
}



?>