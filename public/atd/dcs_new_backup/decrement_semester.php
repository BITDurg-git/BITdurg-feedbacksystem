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
	function incrementSem()
	{
			alert("Be cautious while Decrementing Semesters!!");
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("increment_msg").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","incrementSemajax.php",true);
			i.send();
	}
	
</script>	








<form action="decrement_semester_rcv.php" method="post">
<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Decrement Semester</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>
 
   <!--
   <tr><td align="center"><input type="radio" name="update_semester" value="1">Odd Semester to Even Semester</td></tr>
   <tr><td align="center"><input type="radio" name="update_semester" value="2">Even Semester to Odd Semester</td></tr>
   -->
   <tr><td align="center"><input type="button" name="callin" value="Check Semesters in Database!" class="Button" onClick="incrementSem();"></td></tr>
   <div id="increment_msg" class="col-md-12" style="font-weight:bolder; color:#F00; text-align: center;">
   </div>
   <tr><td align="center"><input type="submit" name="update" value="Decrement" class="Button"></td></tr>
</table>

</form>


</div><!--EO workBox-->

<?php
	include("footer.php");
}
?> 