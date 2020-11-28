<?php
$user=$_REQUEST['user'];
$stat=$_REQUEST['stat'];
include('dbconnect.php');
$user_name=mysqli_query($con,"select name from user_master where user_id=$user");
$user_name=mysqli_fetch_array($user_name);
if(!strcmp($stat,"lock"))
{
mysqli_query($con,"update user_master set whether_locked=1 where user_id=$user ");
echo $user_name[0]." is Locked";
}
else
{
mysqli_query($con,"update user_master set whether_locked=0 where user_id=$user ");
echo $user_name[0]." is UnLocked";
}
?>