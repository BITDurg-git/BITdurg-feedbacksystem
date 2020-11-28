<?php
session_start();
if(!session_id())
{
	session_start();
}
if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}
else
{
	$user_id=$_SESSION['user_id'];
include('dbconnect.php');
$user_id=$_SESSION['user_id'];
$newpass=$_REQUEST["newpass"];
mysqli_query($con,"update user_details set password='$newpass' where user_id=$user_id");
//header("location:maps.php");

}
?>
