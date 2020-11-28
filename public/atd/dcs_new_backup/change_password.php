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
<script>
function verify()
{
var oldpass=document.getElementById("pass").value;
var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
			{
					 
					document.getElementById("change").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","change_password_1.php?oldpass=" + oldpass ,true);
			i.send();
	
			

}
var a=0;
function end()
{
var newpass=document.getElementById("newpass").value;
var newpass1=document.getElementById("newpass1").value;
if(a==1)
{
document.form1.submit();
exit();
}

if(!newpass.localeCompare(newpass1))
{
	document.getElementById('newpass1').style.borderColor = "green";
    a=1;
    alert("Are you sure you want to continue!");
}
else
	{
		document.getElementById('newpass1').style.borderColor = "red";
		alert("both passwords does not match");
	}


}



	</script>

<html>
<head>
<!-- include css -->
</head>

<body>


	<div class="col-md-12" >
		
			<div class="panel panel-primary">
			<div class='panel-heading'><h3 class='panel-title' >Change Your Password</h3></div>
			<div class="panel-body">
<form action="change_password_rcv.php" name="form1" method="post">
<div id="change">
<table>
	
	
	<tr><td>Enter your old Password : </td><td><input type="textr" name="pass" id="pass" required></td></tr>
	<tr ><td></td><td><input type="button" value="ENTER" onclick="verify();" ></td></tr>

</table>
</div>
</form>
</div>
</div>
<script>

	</script>

	</script>
</form>

</body>
<?php
include("footer.php");
}
?>