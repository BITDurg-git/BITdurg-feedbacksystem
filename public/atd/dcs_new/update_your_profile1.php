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
	<div class="col-md-12" >
		
			<div class="panel panel-primary">
			<div class='panel-heading'><h3 class='panel-title' >My Personal Details</h3></div>
			<div class="panel-body">
	
<form action="update_your_profile.php" method="post">
<table>
	
	<tr><td>Full Name : </td><td>
<?php
                $user_name=mysqli_query($con,"select name from user_master where user_id=$user_id");
                $user_name_rs=mysqli_fetch_array($user_name);
                echo $user_name_rs[0];
	?>
</td></tr>
	<tr><td>Profession: </td><td>
	<?php
	$pid=mysqli_query($con,"select profession from user_master where user_id=$user_id");
	$pid=mysqli_fetch_array($pid);
	echo $pid[0];
	?>
	</td></tr>
	<tr><td>Contact No. : </td><td>
		<?php
	$pid=mysqli_query($con,"select contact from user_master where user_id=$user_id");
	$pid=mysqli_fetch_array($pid);
	echo $pid[0];
	?>
	</td></tr>
	<tr><td>Email Address:</td><td>

		<?php
	$pid=mysqli_query($con,"select email from user_master where user_id=$user_id");
	$pid=mysqli_fetch_array($pid);
	echo $pid[0];
	?>
	</td></tr>
	<tr><td>Security Question : </td>
		<td>

			<?php
		
			$ques=mysqli_query($con,"select question from security_questions where question_no in (select security_question from user_master where user_id=$user_id)");
			$ques1=mysqli_fetch_array($ques);
			echo $ques1[0];
			

			

			?>
</td></tr>
<tr><td>Your Answer:</td><td>

<?php
	$pid=mysqli_query($con,"select sec_ans from user_master where user_id=$user_id");
	$pid=mysqli_fetch_array($pid);
	echo $pid[0];
	?>



	</td></tr>
<tr><td></td><td><input type="submit" value='edit' class='button'></td></tr>
</table>

</form>
</div>
</div>
</body>
<?php
include("footer.php");
}
?>