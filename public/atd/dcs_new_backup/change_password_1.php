<?php
session_start();
include('dbconnect.php');
$user_id=$_SESSION['user_id'];
$oldpass=$_REQUEST["oldpass"];
$pass=mysqli_query($con,"select password from user_master where user_id=$user_id ");
$pass=mysqli_fetch_array($pass);

if($oldpass!=$pass[0])
{
	echo "<table >";
	echo "<tr>"."<th colspan='2'>"."Change Password"."</th>"."</tr>";
	
	echo "<tr>"."<td>"." Password :" ."</td>"."<td>"."<font color='red'>"."Password entered is incorrect "."</font>"."</td>"."</tr>";
	
}
else
{
	
	
	echo "<table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>";
	
echo "<tr>"."<td>"."Enter your New Password :" ."</td>"."<td>"."<input type='password' name='newpass' id='newpass' required>"."</td>"."</tr>";
echo "<tr>"."<td>"."Re-enter your New Password :" ."</td>"."<td>"."<input type='password' name='newpass1' id='newpass1' required>"."</td>"."</tr>";
echo "<tr>"."<td>"."</td>"."<td>"."<input type ='button' value='submit' onclick='end();'>"."</td>"."</tr>";
echo "</table>";
echo "</div>";
}

?>
