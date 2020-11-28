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
     $pa_rs=mysqli_query($con,"select student_name,university_rollno,class_roll,semester,section,batch,class_batch from student_master where student_id=$user_id");
	   $pa_rs1=mysqli_fetch_array($pa_rs);
		echo "<h1 align='center'>WELCOME ".$pa_rs1[0]."</h1>";
     ?>
     
     </div>
     <div class="col-md-2"></div>
     </div>
     <div class="row">
     	<div class="col-md-12">
	     		
     	<table class=table>
     		<tr><th class=text-center>Name</th><td><?php echo $pa_rs1[0]?></td></tr>
     	    <tr><th class=text-center>University Roll no.</th><td><?php echo $pa_rs1[1]?></td></tr>
              <tr><th class=text-center>Class Roll no.</th><td><?php echo $pa_rs1[2]?></td></tr>
              <tr><th class=text-center>Semester</th><td><?php echo $pa_rs1[3]?></td></tr>
              <tr><th class=text-center>Section</th><td><?php echo $pa_rs1[4]?></td></tr>
              <tr><th class=text-center>Batch</th><td><?php echo $pa_rs1[6]?></td></tr>
     		
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
