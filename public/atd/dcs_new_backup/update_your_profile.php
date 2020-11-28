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
			<div class='panel-heading'><h3 class='panel-title' >Update your Personal Details</h3></div>
			<div class="panel-body">
	
<form action="update_your_profile_rcv.php" method="post">
<table>
	
	<tr><td>Full Name : </td><td><input type="text" name="name" id="name" required  value=

<?php
                $user_name=mysqli_query($con,"select name from user_master where user_id=$user_id");
                $user_name_rs=mysqli_fetch_array($user_name);
                echo json_encode($user_name_rs[0]);
	?>
></td></tr>
	<tr><td>Profession: </td><td><input type="text" name="prof" id="prof" required  value= 

	<?php
	$pid=mysqli_query($con,"select profession from user_master where user_id=$user_id");
	$pid=mysqli_fetch_array($pid);
	echo json_encode($pid[0]);
	?>
	></td></tr>
	<tr><td>Contact No. : </td><td><input type="text" name="contact" id="contact" required value=
		<?php
	$pid=mysqli_query($con,"select contact from user_master where user_id=$user_id");
	$pid=mysqli_fetch_array($pid);
	echo json_encode($pid[0]);
	?>
	></td></tr>
	<tr><td>Email Address:</td><td><input type="text" name="email"  id="email" required  value=

		<?php
	$pid=mysqli_query($con,"select email from user_master where user_id=$user_id");
	$pid=mysqli_fetch_array($pid);
	echo json_encode($pid[0]);
	?>
	></td></tr>
	<tr><td>Security Question : </td>
		<td><select name="sec"  id="sec" >

			<?php
			$res=mysqli_query($con,"select security_question from user_master where user_id=$user_id");
			$res=mysqli_fetch_array($res);
			//echo "<option> $res[0]</option>";
			$ques=mysqli_query($con,"select question_no,question from security_questions");
			while($ques1=mysqli_fetch_array($ques))
			{
				if($res[0]==$ques1[0])
					echo "<option value=$ques1[0] selected='selected'>".$ques1[1]."</option>";
				else
					echo "<option value=$ques1[0] >".$ques1[1]."</option>";


			}
			

			

			?>
</select></td></tr>
<tr><td>Your Answer:</td><td><input type="text" name="response"  id="response" required value= 

<?php
	$pid=mysqli_query($con,"select sec_ans from user_master where user_id=$user_id");
	$pid=mysqli_fetch_array($pid);
	echo json_encode($pid[0]);
	?>



	></td></tr>
<tr><td></td><td><input type="submit" value='Update' class='button'></td></tr>
</table>

</form>
</div>
</div>
</body>
<?php
include("footer.php");

}
?>