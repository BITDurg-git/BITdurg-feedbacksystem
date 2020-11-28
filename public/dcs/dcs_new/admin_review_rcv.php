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
	
	include('dbconnect.php');
	$type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
	$type=mysqli_fetch_array($type);
	if($type[0]=="admin")
		include("header_admin.php");
	else
		include("header.php");


?>
<div class="col-md-12" >
		
			<div class="panel panel-primary">
			<div class='panel-heading'><h3 class='panel-title' >Review Attendance</h3></div>
			

<?php

$year=$_REQUEST['year_choice'];
$month=$_REQUEST['month_choice'];
$semester=$_REQUEST['sem_choice'];
$section=$_REQUEST['sec_choice'];
$class_batch=$_REQUEST['batch'];
$monthid_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year") or die(include("admin_exception.php"));
$monthid_rs1=mysqli_fetch_array($monthid_rs);
$month_id=$monthid_rs1[0];
echo "<div class='panel-heading'><h3 class='panel-title' >Semester: $semester / section:- $section / Batch:- ";
if($class_batch==3)
	echo "Whole class";
else
	echo "Batch:- $class_batch";

echo " / month:- $month</h3></div>";
echo "<div class='panel-body'>";
echo"<table class='Table' >";
echo "<tr>";
echo"<th colspan='2'>"."Faculty - Subject"."</th>"."<th>"."Feed Status"."</th>";
echo "</tr>";
 if($class_batch==3)
 $subject_rs=mysqli_query($con,"select subject_id from subject_master where semester=$semester and either_batch=0") or die(include("admin_exception.php"));	
else
$subject_rs=mysqli_query($con,"select subject_id from subject_master where semester=$semester and either_batch=1") or die(include("admin_exception.php"));
while($subject_rs1=mysqli_fetch_array($subject_rs))
{
	 if($class_batch==3)
	$subject_teacher_rs=mysqli_query($con,"select name from user_master where user_id in (select teacher_id from teacher_subject_relation where subject_id=$subject_rs1[0] and section='$section' and batch=3)");
else
	$subject_teacher_rs=mysqli_query($con,"select name from user_master where user_id in (select teacher_id from teacher_subject_relation where subject_id=$subject_rs1[0] and section='$section' and batch='$class_batch')");
	$subject_teacher_rs1=mysqli_fetch_array($subject_teacher_rs);
	$teacher_name=$subject_teacher_rs1[0];
	
	$subject_name=mysqli_query($con,"select subject_name from subject_master where subject_id=$subject_rs1[0]");
	$subject_name1=mysqli_fetch_array($subject_name);
	$subject_name_result=$subject_name1[0];
	
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester	group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
		
	if($class_batch==3)
	$abc=mysqli_query($con,"select count(distinct subject_id) from ".$batch_str." where month_id=$month_id && subject_id=$subject_rs1[0] and  student_id in (select student_id from student_master where semester=$semester and section='$section' ) ") or die(include("admin_exception.php"));
	else	
	$abc=mysqli_query($con,"select count(distinct subject_id) from ".$batch_str." where month_id=$month_id && subject_id=$subject_rs1[0] and  student_id in (select student_id from student_master where semester=$semester and section='$section' and class_batch='$class_batch') ") or die(include("admin_exception.php"));
	$abc2=mysqli_fetch_array($abc);

	if($abc2[0]==0)
	{
		$a=0;	
	}
	else
	{
		$a=1;	
	}
	echo"<tr>";
	if($a==1)
	{
		echo"<td colspan='2' style='width:80%;' align='center'>"."$teacher_name"." - "."$subject_name_result"."</td>";
		echo"<td align='center'>"."<img src='images/right.png' style='width:20px; height:20px; position:relative;'>"."</td>";
	}
	else if($a==0)
	{
		echo"<td colspan='2' style='width:80%;' align='center'>"."$teacher_name"." - "."$subject_name_result"."</td>";
		echo"<td align='center'>"."<img src='images/wrong.png' style='width:20px; height:20px; position:relative;'>"."</td>";
			
	}
	echo"</tr>";	
}


echo "</table>";
?>

</div>
<?php
include("footer.php");
}
?>