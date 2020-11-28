
<?php
	session_start();
	include("dbconnect.php");
	$semester=$_REQUEST['semester'];
	$section=$_REQUEST['section'];
	$user_id=$_SESSION['user_id'];
	$class_batch=$_REQUEST['class_batch'];
	$year_batch=mysqli_query($con,"select distinct batch from student_master where semester=$semester");
	$year_batch=mysqli_fetch_array($year_batch);
	
	
	if($class_batch==3)
	$semsub_rs=mysqli_query($con,"select count(*) from teacher_subject_relation where ((teacher_id=$user_id) && (subject_id in (select subject_id from subject_master where semester=$semester and either_batch=0)) and section='$section' and year_batch=$year_batch[0]) ")or die("bhalu");
	else
	$semsub_rs=mysqli_query($con,"select count(*) from teacher_subject_relation where ((teacher_id=$user_id) && (subject_id in (select subject_id from subject_master where semester=$semester )) and section='$section' and batch=$class_batch  and year_batch=$year_batch[0]) ")or die("bhalu");
	$semsub_rs1=mysqli_fetch_array($semsub_rs);
	$counter=$semsub_rs1[0];
	
	//echo $user_id;
	//echo $counter;
			
		
			if($counter==0)
			die("Sorry,you haven't been alloted any subject to this section in this particular session!");

	

		
	if($class_batch==3)
		$subject_rs=mysqli_query($con,"select subject_id from teacher_subject_relation where teacher_id=$user_id and subject_id in (select subject_id from subject_master where semester=$semester and either_batch=0) and section='$section'  and year_batch=$year_batch[0]");
		else 
	$subject_rs=mysqli_query($con,"select subject_id from teacher_subject_relation where teacher_id=$user_id and subject_id in (select subject_id from subject_master where semester=$semester and either_batch=1) and section='$section' and batch=$class_batch  and year_batch=$year_batch[0]");
		echo "<table class='table'>
"."<tr>";	
			
			echo "<td align='center'>"."Subject:"."</td>"."<td>"."<select name='subject_id' id='subject' class='formCSS' onchange='check_entry();'>";
			
			echo "<option value='0'>"."----"."</option>";
			while($subject_rs1=mysqli_fetch_array($subject_rs))
			{
				//echo $subject_rs[0];
				$subname_rs=mysqli_query($con,"select subject_name from subject_master where (subject_id=$subject_rs1[0] && semester=$semester ) order by subject_name") or die("lkj");
				
				
				
					while($subname_rs1=mysqli_fetch_array($subname_rs))
					{
						echo "<option value='$subject_rs1[0]'>".$subname_rs1[0]."</option>";
					}
			
				
			
			} 
			echo"</select>"."</td>";
	
			echo "</tr>";
			
			echo"<tr>"."<td>"."</td>"."<td>"."<input type='button' value='Submit' class='button' id='validate' onclick='validation();' class='formButton' >"."</td>"."</tr>";
			echo "<tr>"."<td colspan=2 id='show_message'></td>"."</tr>";
	echo"</table>";
?>
