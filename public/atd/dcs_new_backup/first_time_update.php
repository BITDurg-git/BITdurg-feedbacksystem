<?php


session_start();
if(!session_id())
{
	session_start();
}
if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}
else
{
	$user_id=$_SESSION['user_id'];
	
	include('dbconnect.php');
	$type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
	$type=mysqli_fetch_array($type);
	if($type[0]=="admin")
		include("header_admin.php");
	else
		include("header.php");
?>

<html>
<head>
<!-- include css -->
</head>

<body>
<form action="first_time_update_rcv.php" method="post">
<<div class='col-md-12'  >
	<div class='panel panel-primary'>
		<div class='panel-heading'><h3 class='panel-title' >Update Your Profile</h3></div>
		<div class='panel-body'>
			<table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>
	
	
	<tr><td>Full Name : </td><td><input type="text" name="name" id="name" required ></td></tr>

	<tr><td>Profession: </td><td><input type="text" name="prof" id="prof" required ></td></tr>
	<tr><td>Contact No. : </td><td><input type="text" name="contact" id="contact" required ></td></tr>
	<tr><td>Email Address:</td><td><input type="text" name="email"  id="email" required></td></tr>
	<tr><td>Security Questions : </td>
		<td><select name="sec">
			<?php
			$question=mysqli_query($con,"select question_no,question from security_questions");
			while($ques=mysqli_fetch_array($question))
			echo "<option value='$ques[0]' >".$ques[1]."</option>";

			?></select></td></tr>
<tr><td>Your Answer:</td><td><input type="text" name="response"  id="response" required></td></tr>
<tr><td>New User Name:</td><td><input type=username "  name="username"  id="username" required></td></tr>
<tr><td>New Password:</td><td><input type="password"  name="pass"  id="pass" required></td></tr>
<tr><td></td><td><input  type="submit"></td></tr>
</table>
</div>
</div>
</div>


</form>
</body>
<?php
include("footer.php");
}
?>