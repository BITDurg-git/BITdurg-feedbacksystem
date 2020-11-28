<?php
session_start();
$username=$_REQUEST['login_name'];
$password=$_REQUEST['login_pwd'];
include("dbconnect.php");



$users=mysqli_query($con,"select user_id,login_name,password,user_type from user_master where login_name='$username'");
$user=mysqli_fetch_array($users);
		if($password==$user[2])
		{
			if($user[3]=="admin")
			{
				$_SESSION['user_id'] = $user[0];
				header("location:maps.php");
			}
			else
			{
				
				$val=mysqli_query($con,"select validate from user_master where user_id=$user[0]");
				$val_rs=mysqli_fetch_array($val);
				if($val_rs[0]==1)//first time updation is done
				{
						$_SESSION['user_id'] = $user[0];
						
						header("location:maps.php");

				}
				else
				{
						$_SESSION['user_id'] = $user[0];
						 header("location:first_time_update.php");

				}
			}


		}



?>

