

<?php
ini_set('max_execution_time', 300);
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
	include("dbconnect.php");
	$temp_semester=$_REQUEST['sem_choice'];
	$temp_section=$_REQUEST['sec_choice'];
	$year_batch=mysqli_query($con,"select distinct batch from student_master where semester=$temp_semester");
	$year_batch=mysqli_fetch_array($year_batch);
	//$str=$_REQUEST['str'];
	$teacher_id=$_SESSION['teacher_id'];
	$subject_id=$_SESSION['subject_id'];
	$str="";
	$c=count($subject_id);
	for($i=0;$i<$c-1;$i++)
	{
			$str=$str."(".$subject_id[$i].",".$teacher_id[$i].","."'".$temp_section."'".","."'".$year_batch[0]."'"."),";
	}
	$str=$str."(".$subject_id[$i].",".$teacher_id[$i].","."'".$temp_section."'".","."'".$year_batch[0]."'".")";
	
	echo $str;
	//echo $str;

	mysqli_query($con,"insert into teacher_subject_relation(subject_id,teacher_id,section,year_batch) values".$str) or die("aayush");




	$subject_id=$_REQUEST['subject_id_batcha'];
	$teacher_id=$_REQUEST['teacher_id_batcha'];
	
	$c=count($subject_id);
	
	$str="";
	for($i=0;$i<$c-1;$i++)
	{
			$str=$str."(".$subject_id[$i].",".$teacher_id[$i].","."'".$temp_section."'".","."1".","."'".$year_batch[0]."'"."),";
	}
	$str=$str."(".$subject_id[$i].",".$teacher_id[$i].","."'".$temp_section."'".","."1".","."'".$year_batch[0]."'".")";
	//echo $str;

mysqli_query($con,"insert into teacher_subject_relation(subject_id,teacher_id,section,batch,year_batch) values".$str) or die("senpai");

	$subject_id=$_REQUEST['subject_id_batchb'];
	$teacher_id=$_REQUEST['teacher_id_batchb'];
	
	$d=count($subject_id);
	$str="";
	for($i=0;$i<$d-1;$i++)
	{
			$str=$str."(".$subject_id[$i].",".$teacher_id[$i].","."'".$temp_section."'".","."2".","."'".$year_batch[0]."'"."),";
	}
	$str=$str."(".$subject_id[$i].",".$teacher_id[$i].","."'".$temp_section."'".","."2".","."'".$year_batch[0]."'".")";
	//echo $str;
	mysqli_query($con,"insert into teacher_subject_relation(subject_id,teacher_id,section,batch,year_batch) values".$str) or die("senpai");
	
	
	header("location:maps.php");
?>

<?php
include("footer.php");
}
?>