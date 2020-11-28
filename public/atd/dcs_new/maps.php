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
<div class="container">

<div class="row">


<div class="col-md-1" >
	

</div>
<div class="col-md-10" style="background-color: #fff;">
	<div class="row" >
	 <div class="col-md-2"></div>
	 <div class="col-md-8">
	 <?php
     $pa_rs=mysqli_query($con,"select name from user_master where user_id=$user_id");
	   $pa_rs1=mysqli_fetch_array($pa_rs);
		echo "<h2>WELCOME ".$pa_rs1[0]."</h2>";
     ?>
     
     </div>
     <div class="col-md-2"></div>
     </div>
     <div class="row">
     	<div class="col-md-12">
	     		<h3 class='text-center'">Subjects Alloted To You</h3>
     	<table class=table>
     		<th class=text-center>Subject Name</th>
     		<th class=text-center>Semester</th>
     		<th class=text-center>Section</th>
     		<th class=text-center>Batch</th>
     		<?php
     		if($type[0]=="admin")
     			echo "<tr><td colspan=4>Your Are The Admin!!!</td></tr>";
     		else
     		{
     		$data=mysqli_query($con,"select subject_id,section,batch from teacher_subject_relation where teacher_id=$user_id");
     		while($data_rs=mysqli_fetch_array($data))
     		{
     			$subject=mysqli_query($con,"select subject_name,semester from subject_master where subject_id=$data_rs[0]");
     			$subject_rs=mysqli_fetch_array($subject);
     			echo "<tr><td class='text-center'>".$subject_rs[0]."</td><td>".$subject_rs[1]."</td><td>".$data_rs[1]."</td>";
     			if($data_rs[2]=='NULL')
     				echo "<td>Whole Class</td>";
     			else
     				echo "<td>Batch- ".$data_rs[2]."</td>";


     		}
     	}

     		?>
     	</table>


     	</div>
     	


     </div>


</div>
<div class="col-md-1" ">
	

</div>

</div>
</div>
           




           






<?php

include("footer.php");
}

?>
