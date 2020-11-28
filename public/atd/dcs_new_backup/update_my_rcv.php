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
$_SESSION['user_id']=$user_id;
  include('dbconnect.php');
  $type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
  $type=mysqli_fetch_array($type);
  if($type[0]=="admin")
    include("header_admin.php");
  else
    include("header.php");
?>
<script>
	
function update_val(x,student_id)
	{	
			var y=document.getElementsByName("total[]");
			var total=y[x].value;
			
			var z=document.getElementsByName("present[]");
			var present=z[x].value;
			
			
			
			//var x=document.getElementByName('total[]');
			//alert(total);
		
				var i=new XMLHttpRequest();
				
				i.onreadystatechange=function()
				{
					if(i.readyState==4 && i.status==200)
					{
						//document.getElementById("span_show").innerHTML=i.responseText;
						myObj = JSON.parse(i.responseText);

						alert("Attendance of "+ myObj.name+" is updated");	
					}
				};
				
				i.open("GET","update_attend_ajax.php?total=" + total + "&present=" + present + "&student_id=" + student_id,true);
				i.send();
	}



</script>

<?php
	
	
    include("dbconnect.php");
	//$user_id=$_SESSION['user_id'];
	$month=$_REQUEST['month_choice'];
	$year=$_REQUEST['year_choice'];
	//$sub_id=$_REQUEST['sub_id'];
	
	//$_SESSION['subject_id']=$sub_id;
	
$semester=$_REQUEST['sem_choice'];
$section=$_REQUEST['sec_choice'];
$sub_id=$_REQUEST['subject_id'];


	$sem_rs=mysqli_query($con,"select semester,subject_name from subject_master where subject_id=$sub_id");
	$sem_rs1=mysqli_fetch_array($sem_rs);
	$sem=$sem_rs1[0];
	$sub_name=$sem_rs1[1];
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$sem group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	$_SESSION['subject_id']=$sub_id;
	$class_batch=$_REQUEST['class_batch'];
	
	$month_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year");
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_id=$month_rs1[0];
	
	
	$_SESSION['month_id']=$month_id;
//	echo $month_id;
	/*
	$sub_rs=mysqli_query($con,"select subject_id from subject_master where semester=$semester && section=$section && subject_name=$subject");
	$sub_rs1=mysqli_fetch_array($sub_rs);
	$subject_id=$sub_rs1[0];
	*/
	
	if($class_batch==3)
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$sub_id and student_id in (select student_id from student_master where section='$section' and semester=$semester ) ") ;
		else
		$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$sub_id and student_id in (select student_id from student_master where section='$section' and semester=$semester  and class_batch=$class_batch) ") ;
	
	
$kount_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$sub_id");
$kount_rs1=mysqli_fetch_array($kount_rs);
$kount=$kount_rs1[0];


			echo "<input type='hidden' value='$kount' id='kount'>";	
	?>
  <form action="add_student_rcv.php" method="post" name="form1">
<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Update Attendance</h3></div>
    <?php
    if($class_batch==3)
    echo "<div class='panel-heading'><h3 class='panel-title' >Semester: $semester / Section : $section / Subject: $sub_name</h3></div>";
else
	    echo "<div class='panel-heading'><h3 class='panel-title' >Semester: $semester / Section : $section / Batch: $class_batch / Subject: $sub_name</h3></div>";

    ?>
    <div class='panel-body'>
   
   <div class="table-responsive">
	<table class="table">
	<tr>
		<th>SERIAL NO.</th>
    	<th>ROLL NO.</th>
    	<th >STUDENT NAME</th>
    	
        <th >TOTAL</th>
        <th >PRESENT</th>
        <th >UPDATE</th>
    </tr>
<?php
$i=0;
$serial=1;
    while($attendance_rs1=mysqli_fetch_array($attendance_rs))
	{	
	
		$stud_name_rs=mysqli_query($con,"select student_name,class_roll from student_master where student_id=$attendance_rs1[0]")or die(include("faculty_exception.php"));
		$stud_name_rs1=mysqli_fetch_array($stud_name_rs);
		if($attendance_rs1[1]!=0)
		$x=($attendance_rs1[2]/$attendance_rs1[1])*100;
		else
		$x=0;
	

		echo"<tr>";
		echo "<td align='center'>".$serial++."</td>";
			echo "<td align='center'>"."$stud_name_rs1[1]"."</td>";
			echo "<td align='center'>"."<input type='text'  name='stud_name[]' value='$stud_name_rs1[0]' class='formCSS' disabled='disabled'>"."</td>";
	
			echo "<td align='center'>"."<input type='number' name='total[]' value='$attendance_rs1[1]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='number' name='present[]' value='$attendance_rs1[2]' id='present[]' class='formCSS' >"."</td>";
			echo "<td align='center'>"."<input type='button' value='update' name='update_button[]' onclick='update_val($i,$attendance_rs1[0])' class='formButton'>"."</td>";
		echo "</tr>";
		
		$i++;
	}
	echo "</table>";
	echo "</div>";
?>
</div></div></div>
<?php
include("footer.php");
}
?>

<!--</div>
</body>
</html>-->