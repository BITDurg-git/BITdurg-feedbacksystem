<?php

$username=$_REQUEST['login_name'];
$password=$_REQUEST['password'];
$count=$_REQUEST['count'];
$myObj= new stdClass;
include("dbconnect.php");
$locked=0;$user_id=0;$device_locked;

$users=mysqli_query($con,"select count(*) from user_master where  login_name='$username'");
$users=mysqli_fetch_array($users);
if($users==0)
{

$myObj->val = 0;

}
else
{
	$users=mysqli_query($con,"select user_id,login_name,password,whether_locked from user_master where login_name='$username' ");

	$a=0;$b=0;
$user=mysqli_fetch_array($users);

	if($username==$user[1] )
	{   $b=1;
		$locked=$user[3];
		$user_id=$user[0];
		if($password==$user[2])
		{
			$user_id=$user[0];
			$a=1;
		
		}
	}

$user=mysqli_fetch_array($users);
if($a==0)
{
	$myObj->val = 0;
	if($count<=3)
	{
		if($b==1 &&$locked!=1)
		{
			$myObj->val = 0;
		}
		else if ($b==1 && $locked==1)
		{
			$myObj->val = 3;
		}
		
	}
	else
	{
		if($b==1)
		{
		mysqli_query($con,"update user_master set whether_locked=1 where user_id=$user_id ");
		$myObj->val = 2;
		}	
	}
	$json1=json_encode($myObj);
	echo $json1;




}
else
{
	
		if($locked==1)
			$myObj->val = 3;
		//else if($device_locked==1)
			//$myObj->val = 4;
		else
		{
			//mysqli_query($con,"update user_details set device_locked=1 where user_id=$user_id ");
			$myObj->val = 1;


		}
		$json1=json_encode($myObj);
	echo $json1;		

	
}

}

?>
