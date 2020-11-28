<?php
ini_set('max_execution_time', 300);
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
		$user_id=$_SESSION['user_id'];
 
  include('dbconnect.php');
  $type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
  $type=mysqli_fetch_array($type);
  if($type[0]=="admin")
    include("header_admin.php");
  else
    include("header.php");

	include("dbconnect.php");
	$temp_semester=$_REQUEST['sem_choice'];
	$temp_section=$_REQUEST['sec_choice'];
	$subject_id=$_REQUEST['subject_id'];
	$teacher_id=$_REQUEST['teacher_id'];
	
	$_SESSION['subject_id']=$subject_id;
	$_SESSION['teacher_id']=$teacher_id;
	
	


echo "<form action='allot_subject_rcv.php' method='post' name='form1'>";
 echo "<div class='col-md-12'  >";
  echo "<div class='panel panel-primary'>";
    echo "<div class='panel-heading'><h3 class='panel-title' >Subject Allotment</h3></div>";
   echo " <div class='panel-body'>";
   echo "<table class='table'>";


echo "<tr>"."<td align='right'>"."Semester:"."</td>";
         echo "<td>".$temp_semester."</td>";       
 echo "</tr> ";       
    
  echo "<tr>"."<td align='right'>"."Section:"."</td>";
  echo  "<td>".$temp_section."</td>"."</tr>";
 echo "<tr>"."<th class='text-center'>"."Batch-:"."</th>"."<th class='text-center'>"."B1"."</th>"; 
 $subject_rs=mysqli_query($con,"select subject_id,subject_name from subject_master where semester=$temp_semester and either_batch=1")or die("aayush");
 	while($subject_rs1=mysqli_fetch_array($subject_rs))
			{
				$teacher_rs=mysqli_query($con,"select user_id,name from user_master where user_type='faculty' order by name ");
			
				
				echo "<tr>";
				echo "<td>"."<input type='text'  value='$subject_rs1[1]' name='subject_batcha[]' disabled>"."</td>";
				echo "<input type='hidden' value='$subject_rs1[0]' name='subject_id_batcha[]'>";	
				
				echo "<td>"."<select name='teacher_id_batcha[]'>";
					while($teacher_rs1=mysqli_fetch_array($teacher_rs))
					{
						echo "<option value='$teacher_rs1[0]'>".$teacher_rs1[1]."</option>";
					}
				echo"</select>"."</td>";
				
				echo "</tr>";
			} 
			echo "<tr>"."<th class='text-center'>"."Batch-:"."</th>"."<th class='text-center'>"."B2"."</th>"; ; 
 $subject_rs=mysqli_query($con,"select subject_id,subject_name from subject_master where semester=$temp_semester and either_batch=1")or die("aayush");
 	while($subject_rs1=mysqli_fetch_array($subject_rs))
			{
				$teacher_rs=mysqli_query($con,"select user_id,name from user_master where user_type='faculty' order by name ");
			
				
				echo "<tr>";
				echo "<td>"."<input type='text'  value='$subject_rs1[1]' name='subject_batchb[]' disabled>"."</td>";
				echo "<input type='hidden' value='$subject_rs1[0]' name='subject_id_batchb[]'>";	
				
				echo "<td>"."<select name='teacher_id_batchb[]'>";
					while($teacher_rs1=mysqli_fetch_array($teacher_rs))
					{
						echo "<option value='$teacher_rs1[0]'>".$teacher_rs1[1]."</option>";
					}
				echo"</select>"."</td>";
				
				echo "</tr>";
			} 
          echo "<td>"."<input type='hidden' value='$temp_semester' name='sem_choice'>"."</td>";
          echo "<td>"."<input type='hidden' value='$temp_section' name='sec_choice'>"."</td>";
         //echo "<td>"."<input type='hidden' value='$str' name='str'>"."</td>";
         //echo "<td>"."<input type='hidden' value='$c' name='count'>"."</td>";
        
echo"<tr>"."<td colspan='3' align='center'>"."<input type='submit' class='button' value='Submit'>"."</td>"."</tr>";
  echo "</table>";
  echo "</div></div></div>";
 echo" </form>";
include("footer.php");
}
?>