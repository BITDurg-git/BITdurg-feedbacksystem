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

?>




<?php
	
	
    include("dbconnect.php");
	$user_id=$_SESSION['user_id'];
	$month=$_REQUEST['month_choice'];
	$year=$_REQUEST['year_choice'];
	$subject_id=$_REQUEST['subject_id'];

	$_SESSION['subject_id']=$subject_id;
	


	$semester=$_REQUEST['sem_choice'];
	$section=$_REQUEST['sec_choice'];
	$class_batch=$_REQUEST['batch_choice'];
	$month_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year") or die("hello");
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_id=$month_rs1[0];
	
	
	$_SESSION['month_id']=$month_id;
	
	
	//mysqli_query($con,"delete from attendance_master where (month_id=$month_id && subject_id=$subject_id )") or die("error");
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	if($class_batch==3)
		mysqli_query($con,"delete from ".$batch_str." where subject_id=$subject_id and month_id=$month_id and student_id in (select student_id from student_master where semester=$semester and section='$section' ) ")or die("aaayush");
	else
	mysqli_query($con,"delete from ".$batch_str." where subject_id=$subject_id and month_id=$month_id and student_id in (select student_id from student_master where semester=$semester and section='$section' and class_batch='$class_batch') ")or die("aayush");

header("location:maps.php");
	
	
?>



<?php
	}
?>