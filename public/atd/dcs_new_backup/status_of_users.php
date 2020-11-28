<?php

session_start();
$user_id=$_SESSION['user_id'];
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

	
	include('dbconnect.php');
	$type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
	$type=mysqli_fetch_array($type);
	if($type[0]=="admin")
		include("header_admin.php");
	else
		include("header.php");

	
	include('dbconnect.php');

	echo "<div class='col-md-12'  >";
	echo "<div class='panel panel-primary'>";
	echo "<div class='panel-heading'><h3 class='panel-title' >Status Of Users</h3></div>";
	echo "<div class='panel-body'>";
	echo "<table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>";
	echo "<tr>"."<th>"."<h3 class='panel-title' >"."User name"."</h3>"."</th>"."<th>"."<h3 class='panel-title' >"."Lock Status of User"."</h3>"."</th>"."<th>"."<h3 class='panel-title' >"."Action"."</h3>"."</th>"."</tr>";
	$i=0;
	$user_rs=mysqli_query($con,"select name,whether_locked,user_id from user_master where user_type='faculty' ");
	while($user=mysqli_fetch_array($user_rs))
	{
		

	echo "<tr>"."<td>".$user[0]."</td>";
	echo"<td>";                            

	if($user[1]==1)
		echo "Locked";
	else
		echo "Not Locked";

	echo "</td>";
	echo "<td>";
	if($user[1]==1)
	echo "<input type='button' value='unlock'onclick='change($user[2],$i);' class='button' name='button[]' >"."</td>"."</tr>";
	else
		echo "<input type='button' value='lock' onclick='change($user[2],$i);'  class='button' name='button[]' >"."</td>"."</tr>";

   $i++;
   }
	echo "</table>";
	echo "</div>";
	echo "</div";
	echo "</div>";	
}
?>
<script type="text/javascript">
function change(x,y)
{
var p=document.getElementsByName("button[]");
var stat=p[y].value;

var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
			{
					 
					alert(i.responseText);	
					document.location.reload(true);
				}
			};
			
			i.open("GET","status_of_users_1.php?user=" + x + "&stat=" + stat ,true);
			i.send();
	
			 


}





</script>
