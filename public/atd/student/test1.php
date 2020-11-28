<?php

$username='3012215002';
$password='3012215002';

$myObj= new stdClass;
include("dbconnect.php");
$locked=0;$user_id=0;$device_locked;
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
