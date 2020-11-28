<?php
session_start();
include('dbconnect.php');
$name=$_REQUEST['name'];
$prof=$_REQUEST['prof'];
$contact=$_REQUEST['contact'];
$email=$_REQUEST['email'];
$ques_no=$_REQUEST['sec'];
$response=$_REQUEST['response'];
$user_id=$_SESSION['user_id'];


mysqli_query($con,"update user_master set name='$name',email='$email',contact='$contact',sec_ans='$response',validate=1,security_question=$ques_no  where user_id=$user_id ");



header("location:maps.php");


?>
