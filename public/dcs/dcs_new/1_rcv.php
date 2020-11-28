<?php
 ini_set('max_execution_time', 300);

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
  include("dbconnect.php");
$a=$_POST['aayush'];
mysqli_query($con,"update admincontrols set attendanceoption=$a"); 
header('location:maps.php');
}
?>

 