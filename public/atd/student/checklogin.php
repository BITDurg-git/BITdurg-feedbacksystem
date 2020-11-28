<?php
session_start();
$username=$_REQUEST['login_name'];
$password=$_REQUEST['login_pwd'];
//echo $username;
//echo $password;
include("dbconnect.php");
$users=mysqli_query($con,"select student_id from student_master where university_rollno='$username' ") or die("aayush");
$user=mysqli_fetch_array($users);
$_SESSION['user_id'] = $user[0];
header("location:maps.php");

?>

