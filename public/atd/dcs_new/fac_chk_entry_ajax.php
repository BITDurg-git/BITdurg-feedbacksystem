
<?php
	include("dbconnect.php");
	//$user_id=$_REQUEST['userid'];
	$month=$_REQUEST['month'];
	$year=$_REQUEST['year'];
	$subject_id=$_REQUEST['subjectid'];
	$semester=$_REQUEST['semester'];
	//$class_batch=$_REQUEST['class_batch'];
	$month_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year='$year'");
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_id=$month_rs1[0];
	$sec=$_REQUEST['section'];
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	$class_batch=$_REQUEST['batch'];
	if($class_batch==3)
	$feed_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$subject_id and student_id in (select student_id from student_master where section='$sec' and semester=$semester)") or die("ERROR");
	else	
	$feed_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$subject_id and student_id in (select student_id from student_master where section='$sec' and semester=$semester and class_batch=$class_batch)") or die("ERROR");
	$feed_rs1=mysqli_fetch_array($feed_rs);
	$feed_count=$feed_rs1[0];
	//echo $feed_count
	$flag=0;
	if($feed_count!=0)
	{
    //echo "Data of $month $year of this subject is Already Entered";	
    
   //include("login_redirect2.php");
    //exit();
	$myobj=new stdClass();
	$myobj->val=1;
	$myJSON = json_encode($myobj);

	echo $myJSON;
	 
   }
	else
	{
	$myobj=new stdClass();
	$myobj->val=2;
	$myJSON = json_encode($myobj);

	echo $myJSON;		
	//echo "You haven't Entered Attendance of $month $year!! Please Proceed";	
	}
	?>
