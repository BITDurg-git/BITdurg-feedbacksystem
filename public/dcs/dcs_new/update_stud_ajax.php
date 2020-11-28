<?php
include('dbconnect.php');
$croll=$_REQUEST['croll'];
$stud_name=$_REQUEST['stud_name'];
$section=$_REQUEST['section'];
$semester=$_REQUEST['semester'];
$batch=$_REQUEST['batch'];
$class_batch=$_REQUEST['class_batch'];
$student_id=$_REQUEST['student_id'];
//echo $student_id;
//echo "9999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999";

mysqli_query($con,"update student_master set class_roll=$croll,student_name='$stud_name',semester=$semester,section='$section',batch=$batch,class_batch=$class_batch where student_id=$student_id");



?>
