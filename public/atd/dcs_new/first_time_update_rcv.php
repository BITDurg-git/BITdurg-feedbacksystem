<?php
session_start();
include('dbconnect.php');
$name=$_REQUEST['name'];
$prof=$_REQUEST['prof'];
$contact=$_REQUEST['contact'];
$email=$_REQUEST['email'];
$sec=$_REQUEST['sec'];
$response=$_REQUEST['response'];
$user_id=$_SESSION['user_id'];
$pass=$_REQUEST['pass'];
$username=$_REQUEST['username'];
mysqli_query($con,"update user_master set name='$name',security_question=$sec, password='$pass',email='$email',contact='$contact',sec_ans='$response',validate=1,profession='$prof',login_name='$username'  where user_id=$user_id ");



 header("location:first_upload_image.php");


?>