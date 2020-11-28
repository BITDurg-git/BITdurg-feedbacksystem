<?php

$username=$_REQUEST['login_name'];
$password=$_REQUEST['password'];

$myObj= new stdClass;
include("dbconnect.php");
$users=mysqli_query($con,"select university_rollno from student_master where university_rollno='$password' ");
$user=mysqli_fetch_array($users);
	
if($username==$user[0] )
{
		if($password==$user[0])
		{
			$user_id=$user[0];
			$myObj->val = 1;
		
		}
		else
		$myObj->val = 2;
}
else
$myObj->val = 2;


$json1=json_encode($myObj);
echo $json1;		

	




?>
