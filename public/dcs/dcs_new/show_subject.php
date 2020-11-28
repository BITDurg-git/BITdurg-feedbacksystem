<?php
	include("dbconnect.php");
	$semester=$_REQUEST['semester'];
	$section=$_REQUEST['section'];
	
	$subject_rs=mysqli_query($con,"select subject_id,subject_name from subject_master where semester=$semester and either_batch=0 ") or die("SENPAI");
	
	echo "<div class='table-responsive'>";
	echo"<table class='table'>";
	//	echo"<form name='form1'>";
			echo "<tr>"."<th>"."SUBJECTS"."</th>"."<th>"."</th>"."<th colspan='2'>"."FACULTY"."</th>"."</tr>";
			
			while($subject_rs1=mysqli_fetch_array($subject_rs))
			{
				$teacher_rs=mysqli_query($con,"select user_id,name from user_master where user_type='faculty' order by name ");
				
				
				echo "<tr>";
				echo "<td>"."<input type='text'  value='$subject_rs1[1]' name='subject[]' disabled>"."</td>";
				echo "<td>"."<input type='hidden' value='$subject_rs1[0]' name='subject_id[]'>"."</td>";	
				
				echo "<td>"."<select name='teacher_id[]'>";
					while($teacher_rs1=mysqli_fetch_array($teacher_rs))
					{
						echo "<option value='$teacher_rs1[0]'>".$teacher_rs1[1]."</option>";
					}
				echo"</select>"."</td>";
				
				echo "</tr>";
			} 
		
		echo"<tr>"."<td colspan='3' align='center'>"."<input type='submit' class='button' value='Proceed'>"."</td>"."</tr>";
	echo"</table>";
	echo "</div>";
?>
