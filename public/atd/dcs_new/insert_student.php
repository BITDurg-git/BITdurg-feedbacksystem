<?php

session_start();
if(!session_id())
{
	session_start();
}
if(!isset($_SESSION['batch']))
{
	header("location:login.php");
}
else
{


include("dbconnect.php");
$stud_name=$_REQUEST['stud_name'];
$class_roll=$_REQUEST['class_roll'];
$univ=$_REQUEST['univ_roll'];

$semester=3;


$section=$_SESSION['section'];
$number_of_students=$_SESSION['number_of_students'];
$batch=$_SESSION['batch'];
$batch_class=$_SESSION['batch_class'];



$str="";
for($i=0;$i<$number_of_students-1;$i++)
{
	$str=$str."("."'".$univ[$i]."'".",".$class_roll[$i].","."'".$stud_name[$i]."'".","."$semester".","."'"."$section"."'".",".$batch.",".$batch_class.")".",";
	
}

$str=$str."("."'".$univ[$i]."'".",".$class_roll[$i].","."'".$stud_name[$i]."'".","."$semester".","."'"."$section"."'".",".$batch.",".$batch_class.")";

$final_str=$str;
echo $str;

//mysqli_query($con,"insert into student_master(class_roll,student_name,semester,section,batch,class_batch) values".$final_str)or die("aayush");

//header("location:maps.php");
//include("admin_redirect.php");
}
?>