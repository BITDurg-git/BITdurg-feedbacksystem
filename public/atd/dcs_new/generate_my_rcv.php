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
  include('dbconnect.php');
  $type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
  $type=mysqli_fetch_array($type);
  if($type[0]=="admin")
    include("header_admin.php");
  else
    include("header.php");
?>
<script type="text/javascript">
	var old;
	var newc;

	function printf()
	{
		//window.print();
		
		old=document.getElementsByTagName("body").innerHTML;
		newc=document.getElementById("one").innerHTML;
	
		document.write("<html><body><div id='one'>" + newc + "</div></body></html>");
		window.print();
		
		//window.location.assign("admin_index.php");	
		
		//document.getElementByTagName("body").innerHTML=old;
		
	
	}
	
</script>
<?php
	
	$user_id=$_SESSION['user_id'];
	$month_choice=$_REQUEST['month_choice'];
	$year_choice=$_REQUEST['year_choice'];
	$subject_id=$_REQUEST['subject_id'];
	$class_batch=$_REQUEST['class_batch'];
	$section=$_REQUEST['sec_choice'];
	$month_id_res=mysqli_query($con,"select month_id from month_master where month_name='$month_choice' && year=$year_choice");
	$month_id_res1=mysqli_fetch_array($month_id_res);
	$month_id=$month_id_res1[0];
	
	
	$month_rs=mysqli_query($con,"select month_name,year from month_master where month_id=$month_id");
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_name=$month_rs1[0];
	$year=$month_rs1[1];
	
	$sub_rs=mysqli_query($con,"select semester,subject_name from subject_master where subject_id=$subject_id");
	$sub_rs1=mysqli_fetch_array($sub_rs);
	
	$sem=$sub_rs1[0];
	
	$sub=$sub_rs1[1];
	
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$sem group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	if($class_batch==3)
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$subject_id and student_id in (select student_id from student_master where section='$section' and semester=$sem ) ") ;
		else
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$subject_id and student_id in (select student_id from student_master where section='$section' and semester=$sem  and class_batch=$class_batch) ") ;

	
	
	echo "<div class='col-md-12'  id='one'>";
 echo " <div class='panel panel-primary'>";
 echo "<form>";
echo "<input type='button' value='PRINT' onclick='printf();' class='formButton' style='position:absolute; left:5px; top:75px;'/>";
echo "</form>";
   echo " <div class='panel-heading'><h3 class='panel-title' >Attendance Report</h3></div>";
if($class_batch==3)
    echo "<div class='panel-heading'><h3 class='panel-title' >Semester: $sem / Section : $section / Subject: $sub</h3></div>";
else
	    echo "<div class='panel-heading'><h3 class='panel-title' >Semester: $sem / Section : $section / Batch: $class_batch / Subject: $sub</h3></div>";  
	      echo "<div class='panel-body'>";
  echo "<div class='table-responsive'>";
   echo" <table class='table'> "; 

	?>
	<tr>
		<th class='text-center'>SERIAL NO.</th>
    	<th class='text-center'>ROLL NO.</th>
    	<th  class='text-center'>STUDENT NAME</th>
        <th  class='text-center'>TOTAL</th>
        <th  class='text-center'>PRESENT</th>
        <th  class='text-center'>PERCENTAGE</th>
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
	echo "</div></div></div></div>";
?>
<?php
	include("footer.php");
}
?>
