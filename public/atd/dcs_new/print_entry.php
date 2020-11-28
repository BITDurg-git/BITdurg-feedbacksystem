<?php
	

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
    //include("dcs_header.php");
	//include("back_button_faculty.php");
	$user_id=$_SESSION['user_id'];
	$month_id=$_SESSION['month_id'];
	$subject_id=$_SESSION['subject_id'];
	$sec=$_SESSION['section'];
	$month_rs=mysqli_query($con,"select month_name,year from month_master where month_id=$month_id");
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_name=$month_rs1[0];
	$year=$month_rs1[1];
	$class_batch=$_SESSION['class_batch'];
	$sub_rs=mysqli_query($con,"select semester,subject_name from subject_master where subject_id=$subject_id");
	$sub_rs1=mysqli_fetch_array($sub_rs);
	
	$sem=$sub_rs1[0];
	//$sec=$sub_rs1[1];
	$sub=$sub_rs1[1];
	
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$sem group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	
	if($class_batch==3)
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$subject_id and student_id in (select student_id from student_master where section='$sec' and semester=$sem ) ") ;
		else
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$subject_id and student_id in (select student_id from student_master where section='$sec' and semester=$sem  and class_batch=$class_batch) ") ;
	
/*	
	else if($sem==3)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from third_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==3)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from third_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==4)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from fourth_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==5)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from fifth_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==6)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from sixth_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==7)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from seventh_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
	else if($sem==8)
	{
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from eight_sem where month_id=$month_id && subject_id=$subject_id") or die("couldnot fetch");
	}
*/	

echo "<div style='position:absolute; left:400px; top:10px;'>";	
	echo "<b>"."Attendance of $month_name $year"."</b>"."<br>";
	
echo"</div>";
	?>
   <div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Attendance Report of <?php echo "$month_name $year ";?></h3></div>
     <div class='panel-heading'><h3 class='panel-title' > 
     	<?php
     	if($class_batch==3)
    echo "<div class='panel-heading'><h3 class='panel-title' >Semester: $sem / Section : $sec / Subject: $sub</h3></div>";
else
	    echo "<div class='panel-heading'><h3 class='panel-title' >Semester: $sem / Section : $sec / Batch: $class_batch / Subject: $sub</h3></div>"; 
    ?></h3></div>
    <div class='panel-body'>
	<div class='table-responsive'>
	<table class="table">
	<tr >
		<th class="text-center">SERIAL NO.</th>
    	<th class="text-center">ROLL NO.</th>
    	<th class="text-center">STUDENT NAME</th>
        <th class="text-center">TOTAL</th>
        <th class="text-center">PRESENT</th>
        <th class="text-center">PERCENTAGE</th>
    </tr>
<?php
$serial=1;
    while($attendance_rs1=mysqli_fetch_array($attendance_rs))
	{	
	
		$stud_name_rs=mysqli_query($con,"select student_name,class_roll from student_master where student_id=$attendance_rs1[0]");
		$stud_name_rs1=mysqli_fetch_array($stud_name_rs);
		
		if($attendance_rs1[1]!=0)
		{
			$x=($attendance_rs1[2]/$attendance_rs1[1])*100;
		}
		else
		{
			$x=0;
		}
		
		echo"<tr>";
		echo "<td align='center'>".$serial++."</td>";
			echo "<td align='center'>"."$stud_name_rs1[1]"."</td>";
			
			echo "<td align='center'>"."$stud_name_rs1[0]"."</td>";
			echo "<td align='center'>"."$attendance_rs1[1]"."</td>";
			echo "<td align='center'>"."$attendance_rs1[2]"."</td>";
			echo "<td align='center'>".number_format((float)$x,2, '.', '')."</td>";
		echo "</tr>";
	}
	echo "</table>";
include("footer.php");
}
?>