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
var flag=0;
var label=0;
	function confirm()
	{
			var studcount=document.getElementById("studcount").value;
			var x=document.getElementsByName("outof[]");
			var p=document.getElementsByName("present[]");
			
			var i;
			for(i=0;i<=studcount-1;i++)
			{
				
				if(parseInt(p[i].value) > parseInt(x[i].value) )
				{
			//		alert("Present must be less than Total");
					label=0;
					alert("Present must be less than Total in row number " + (i+1)  );
					break;
					
				}
				else
				{
					label=1;	
				}
			



			}
			if(label==1)
				{
					enable_button();
				document.form1.submit();
				}
			
		
	}
	function checkPresent(z)
		{	
		
		
			var t=document.getElementById("num1").value;
			var studcount=document.getElementById("studcount").value;
			var x=document.getElementsByName("outof[]");
			var p=document.getElementsByName("present[]");
			
		alert (t);
			if(z.value>t)
			{
				alert("Present must be less than Total");
			}	
			/*
		
			for(i=0;i<=studcount-1;i++)
			{
				
				if(p[i].value>t)
				{
					alert("Present must be less than Total");
					break;
				}
				else if(p[i].value<=t)
				{
						
				}	
			
			}*/
		}
		function enable_button()
		{
			//var x=document.getElementById("num1");
			
			var studcount=document.getElementById("studcount").value;
			
			var i=1;
			
			var y=document.getElementsByName("outof[]");
			for(i=0;i<=studcount-1;i++)
			{
				y[i].disabled = false;	
			}
			//fill();
		}
		function disable_button()
		{
			var studcount=document.getElementById("studcount").value;
			var i=1;
			
			var y=document.getElementsByName("outof[]");
			for(i=0;i<=studcount-1;i++)
			{
				y[i].disabled = true;	
			}
				
		}
		function fill()
		{
			var x=document.getElementById("num1");
			var studcount=document.getElementById("studcount").value;
			//alert(studcount);
			var i=1;
			
			var y=document.getElementsByName("outof[]");
			for(i=0;i<=studcount-1;i++)
			{
				y[i].value=x.value;	
			}

		}
	</script>
<?php

$choice=$_REQUEST['choice'];
$year=$_REQUEST['year_choice'];
$month=$_REQUEST['month_choice'];
$_SESSION['sem']=$_REQUEST['sem_choice'];
$semester=$_REQUEST['sem_choice'];
$section=$_REQUEST['sec_choice'];
$subject_id=$_REQUEST['subject_id'];
$_SESSION['subject_id']=$subject_id;
$class_batch=$_REQUEST['class_batch'];
//echo $subject_id;
$_SESSION['section']=$section;
$_SESSION['class_batch']=$class_batch;
?>
<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Enter Attendance</h3></div>
    <div class='panel-body'>
<table class='table'>
	<tr>
<?php
if($choice==1)	
echo "<th class='text-right'>"."Total Lectures in ". $month."</th>"."<th style='color:#000'>"." <input type='number' id='num1' name='num1' onkeyup='fill();' onfocus='enable_button();'>"."</td>"; //change aayush
else
echo "<th class='text-right'>"."Total Lectures up to ". $month."</th>"."<th>"." <input type='number' id='num1' name='num1' onkeyup='fill();' onfocus='enable_button();'>"."</th>";//change aayush
?>	
</tr>
</table>
<?php



$monthid_rs=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year");
$monthid_rs1=mysqli_fetch_array($monthid_rs);
$month_id=$monthid_rs1[0];

$_SESSION['month_id']=$month_id;
if($class_batch==3)
$student_rs=mysqli_query($con,"select class_roll,student_name,student_id from student_master where semester=$semester && section='$section' order by class_roll");
else
$student_rs=mysqli_query($con,"select class_roll,student_name,student_id from student_master where semester=$semester && section='$section' and class_batch=$class_batch order by class_roll");
if($class_batch==3)
$studcount_rs=mysqli_query($con,"select count(*) from student_master where semester=$semester && section='$section'") or die(include("faculty_exception.php"));
else
	$studcount_rs=mysqli_query($con,"select count(*) from student_master where semester=$semester && section='$section' and class_batch=$class_batch");
$studcount_rs1=mysqli_fetch_array($studcount_rs);
$studcount=$studcount_rs1[0];
//echo "$studcount_rs1[0]";
if($choice==1)
{

	echo "<form name='form1' action='insert_attendance.php' method='post'>";
}
else
{
	echo "<form name='form1' action='intermediate_attendance.php' method='post'>";	
}

echo "<input type='hidden' id='studcount' value='$studcount' name='studcount'>";
echo "<div class='table-responsive'>";
echo "<table class='table'>";
?>
	<tr >
    	<th class='text-center'>Serial No.</th>
    	<th class='text-center'>Class Roll Number</th>
        <th class='text-center'>Student Name</th>
        <th class='text-center'>Present</th>
        <th class='text-center'>Total Lectures</th>
    </tr>
<?php
$serial=1;
		while($student_rs1=mysqli_fetch_array($student_rs))
		{
			if($semester==3)
			{
			echo "<tr>";
				echo"<td>".$serial++."</td><td align='center'>".$student_rs1[0]."</td>"."<td>".$student_rs1[1]."</td>"."<td>"."<input type='number' value='0' class='present' name='present[]' >"."</td>"."<td>"."<input type='number' id='outof' name='outof[]' draggable='false'>"."</td>";
			echo "</tr>";
			
			
			echo"<input type='hidden' name='student_id[]' value='$student_rs1[2]'>";	
			}
			else
			{
				echo "<tr>";
				echo"<td>".$serial++."</td><td align='center'>".$student_rs1[0]."</td>"."<td>".$student_rs1[1]."</td>"."<td>"."<input type='number' value='0' class='present' name='present[]' onfocus='disable_button();'>"."</td>"."<td>"."<input type='number' id='outof' name='outof[]' draggable='false' disabled='disabled'>"."</td>";
			echo "</tr>";
			
			
			echo"<input type='hidden' name='student_id[]' value='$student_rs1[2]'>";	
				
			}
		}
		
			echo "<tr>"."<td>"."</td>"."<td colspan='5' align='left'>"."<input type='button' onclick='confirm();' class='button' value='SUBMIT' class='formButton'>"."</td>"."</tr>";

echo "</table>";
echo "</div>";
echo "</form>";



include("footer.php");
}
?>