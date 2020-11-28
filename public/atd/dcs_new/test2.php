<?php
include('dbconnect.php');
$old_faculty=mysqli_query($con,"select user_name,password,teacher_name from user1");
while($old_faculty1=mysqli_fetch_array($old_faculty))
{

	mysqli_query($con,"insert into user_master (login_name,password,name) values ('$old_faculty1[0]','$old_faculty1[1]','$old_faculty1[2]') ");



}

?>