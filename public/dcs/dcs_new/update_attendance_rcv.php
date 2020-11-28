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
						myObj = JSON.parse(i.responseText);

						alert("Attendance of "+ myObj.name+" is updated");	
						//document.getElementById("span_show").innerHTML=i.responseText;	
					}
				};
				
				i.open("GET","update_attend_ajax.php?total=" + total + "&present=" + present + "&student_id=" + student_id,true);
				i.send();
				//alert("updation is successful");
	}
</script>


<?php
	
	
    include("dbconnect.php");
	$user_id=$_SESSION['user_id'];
	$month=$_REQUEST['month_choice'];
	$year=$_REQUEST['year_choice'];
	$subject_id=$_REQUEST['subject_id'];

	$_SESSION['subject_id']=$subject_id;
	


	$semester=$_REQUEST['sem_choice'];
	$section=$_REQUEST['sec_choice'];
	//$class_batch=$_REQUEST['batch'];
	$month_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year");
	$month_rs1=mysqli_fetch_array($month_rs);
	$month_id=$month_rs1[0];
	
	
	$_SESSION['month_id']=$month_id;
	//echo $month_id;
	
	//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	
	//echo $batch_str;
	$attendance_rs=mysqli_query($con,"select student_id,total_lectures,present from ".$batch_str." where month_id=$month_id && subject_id=$subject_id and student_id in (select student_id from student_master where semester=$semester and section='$section') order by student_id");
	
		
$kount_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$subject_id");
$kount_rs1=mysqli_fetch_array($kount_rs);
$kount=$kount_rs1[0];


			echo "<input type='hidden' value='$kount' id='kount'>";	


	//echo "Semester : $semester"."<br>";
	//echo "Section : $section"."<br>";
	
	?>
   
   
	<table class='table' id="update_attendance_table" style="margin-top: 2%;" >
	<tr bgcolor="#CCCCCC">
		<th class='text-center'>SERIAL NO.</th>
    	<th class='text-center'>STUDENT NAME</th>
        <th class='text-center'>TOTAL</th>
        <th class='text-center' colspan=2>PRESENT</th>
        
    </tr>
<?php
$i=0;
$serial=1;
    while($attendance_rs1=mysqli_fetch_array($attendance_rs))
	{	
	
		$stud_name_rs=mysqli_query($con,"select student_name from student_master where student_id=$attendance_rs1[0]") ; 
		$stud_name_rs1=mysqli_fetch_array($stud_name_rs);
		
		
		
		echo"<tr>";
		echo "<td align='center'>".$serial++."</td>";
			echo "<td align='center'>"."<input type='text' size='40' name='stud_name[]' value='$stud_name_rs1[0]' class='formCSS' disabled>"."</td>";
			echo "<td align='center'>"."<input type='number' name='total[]' value='$attendance_rs1[1]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='number' name='present[]' value='$attendance_rs1[2]' id='present[]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='button' value='update' name='update_button[]' onclick='update_val($i,$attendance_rs1[0])' class='formButton'>"."</td>";
		
		echo "</tr>";
		
		$i++;
	}
	echo "</table>";
?>

<?php
	include("footer.php");
}
?>