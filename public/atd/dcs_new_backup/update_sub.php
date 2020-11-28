<?php
include('dbconnect.php');

$semester=$_REQUEST['semester'];
$subject_name=$_REQUEST['subject_name'];
$class_batch=$_REQUEST['class_batch'];
$subject_id=$_REQUEST['subject_id'];
//echo $student_id;
//echo "9999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999";

mysqli_query($con,"update subject_master set subject_name='$subject_name',semester='$semester',either_batch=$class_batch where subject_id=$subject_id");
//echo "aayush";


?>
