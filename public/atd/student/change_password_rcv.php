<?php
session_start();
include('dbconnect.php');
$user_id=$_SESSION['user_id'];
$newpass=$_REQUEST["newpass"];
mysqli_query($con,"update user_details set password='$newpass' where user_id=$user_id");
header("location:maps.php");


?>
