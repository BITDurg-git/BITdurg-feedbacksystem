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
  include('dbconnect.php');
  $type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
  $type=mysqli_fetch_array($type);
  if($type[0]=="admin")
    include("header_admin.php");
  else
    include("header.php");
?>

<?php
include("dbconnect.php");
$section=$_REQUEST['section'];
$semester=$_REQUEST['sem_choice'];
$month=$_REQUEST['month_choice'];
$year=$_REQUEST['year_choice'];
$radio_choice=$_REQUEST['month'];
$boundary=$_REQUEST['boundary'];
$redlist=$_REQUEST['redlist'];

$month_res=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year")or die(include("admin_exception.php"));
$month_res1=mysqli_fetch_array($month_res);
$month_id=$month_res1[0];

//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";

//END of BATCH LOGIC
	

?>
<script>
	function printf()
	{
		old=document.getElementsByTagName("body").innerHTML;
		newc=document.getElementById("one").innerHTML;
	
		document.write("<html><body><div id='one'>" + newc + "</div></body></html>");
		window.print();
		//window.location.assign("admin_index.php");	
		
	}
	
	
	function open_adminR()
	{
		window.location.assign("admin_review.php");
	}
</script>


<div class="col-md-12" id="one"> 
<div class='panel panel-primary'>
	<form>
<input type="button" value="PRINT" onclick="printf();" class="formButton" style="position:absolute; left:10px; top:75px;"/>
</form>
<div class='panel-heading' ><h3 class='panel-title' align="center" >Bhilai Institute Of Technology</h3></div>
	 <div class='panel-heading'><h3 class='panel-title' align="center">Department Of Computer Science And Engineering</h3></div>
	 <div class='panel-heading'><h3 class='panel-title' align="center">
    
    <?php
	if($redlist==1)
	{
		$str="BELOW";	
	}
	else
	{
		$str="ABOVE";
	}
	 if($radio_choice==1)
    echo"<font size='2'>"."ATTENDANCE REPORT $str $boundary of SEMESTER : ".$semester." / "."MONTH : In ".$month." ".$year."</font>";
	else
		echo"<font size='2'>"."ATTENDANCE REPORT $str $boundary SEMESTER : ".$semester." / "."MONTH : Upto ".$month." ".$year."</font>";
	
	?>
	</h3></div>
	<div class="panel-body">

<div class='table-responsive' overflow='scroll'  >
 
   
    <table border="1" class="table" style='table-layout:auto; position:relative;margin-bottom:1%; margin-right:0%;' cellpadding="0">

<tr>
	<th class="text-center">S No.</th>
    <th  class="text-center">Roll No.</th>
    <th class="text-center">Student Name</th>
    <th center="text-center">Attendance(%)</th>
</tr>
	<!--<th style="background-color:#8fbc8f">Class Roll</th><th style="background-color:#8fbc8f">Student Name</th>-->


<?php
$flag=0;
if($radio_choice==1)
{
		$kount=count($section);		
		$ab=0;
		
		if($kount==1 || $kount==2)
		{
		
		$section1=$section[0];
		
		$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester order by subject_id");
		$j=0;
	
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
				$outof_res=mysqli_query($con,"select max(total_lectures) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$month_id");
				$outof_res1=mysqli_fetch_array($outof_res);
				$outof[$j]=$outof_res1[0];
				//echo $outof[$j];
				$j++;
		//		echo"<th style='background-color:#8fbc8f' width='50'>$temp_subject</th>";
		}
	//	echo"<th style='background-color:#8fbc8f'>Percentage</th>";
		//echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester ");
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		//echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th></th>"."<th colspan='10'>TOTAL</th>"."<th></th>"."</tr>";
		//echo"<tr style='background-color:#8fbc8f'>"."<th colspan='2'></th>";
		$i=0;
		
		$sum_outof=0;
		for($i;$i<=$count-1;$i++)
		{
			//echo"<th style='background-color:#8fbc8f;'>".$outof[$i]."</th>";
			$sum_outof +=$outof[$i];
		}
		//echo"<th>100%</th>";
		//echo"</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section1')");
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			//echo"<tr>";
			$sum_total1=0;
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
			
			
			
		//	$subject_res=mysqli_query($con,"select subject_id from ".$batch_str." where1 month_id=$month_id && student_id=$temp_student_id  order by subject_id")or die(include("admin_exception.php"));
			$subject_res=mysqli_query($con,"select subject_id from subject_master where semester=$semester order by subject_id");
			
			
			$sum_present=0;
			$xy=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_total1=0;
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id order by subject_id" )or die(include("admin_exception.php"));
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				$attendance_rs=mysqli_query($con,"select present,total_lectures from ".$batch_str." where month_id=$month_id && subject_id=$temp_subject_id && student_id=$temp_student_id  order by subject_id");
				$attendance_rs1=mysqli_fetch_array($attendance_rs);
							
				
				
				$kount_attendance_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$temp_subject_id && student_id=$temp_student_id order by subject_id");
				
				$kount_attendance_rs1=mysqli_fetch_array($kount_attendance_rs);
				
				if($kount_attendance_rs1[0]!=0)
				{
				  $temp_present=$attendance_rs1[0];
				  $temp_total1=$attendance_rs1[1];
				}
				else
				{
					$temp_present=0;	
					$temp_total1=0;
				}
				
				
				
				$present_array[$xy]=$temp_present;
				$total_lec[$xy]=$temp_total1;
				$xy++;
				//echo"<td>".$temp_present."</td>";
				
				$sum_present+=$temp_present;
				$sum_total1+=$temp_total1;
			}
			
			if($sum_total1!=0)
			{
				$perc=($sum_present/$sum_total1)*100;
			}
			else
			{
				$perc=0;	
			}
			
			
			
			if($redlist==1)
			{
					if($perc<$boundary)
					{	
						//echo"<tr bgcolor='#FF1C1C'>";
						//echo"<td align='center'>".$temp_class_roll."</td>";
						//echo"<td align='center'>".$temp_student_name."</td>";
						for($yz=0;$yz<$xy;$yz++)
						{
							//echo"<td align='center'>".$present_array[$yz]."</td>";	
						}
						
						
					$perc1[$ab]=number_format((float)$perc,2, '.', '');
					$sid[$ab]=$temp_student_id;
					$ab++;	
					//echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
					//echo"</tr>";
					}
			}
			
			if($redlist==2)
			{
					if($perc>=$boundary)
					{	
						//echo"<tr bgcolor='#FF1C1C'>";
						//echo"<td align='center'>".$temp_class_roll."</td>";
						//echo"<td align='center'>".$temp_student_name."</td>";
						for($yz=0;$yz<$xy;$yz++)
						{
							//echo"<td align='center'>".$present_array[$yz]."</td>";	
						}
						
						
					$perc1[$ab]=number_format((float)$perc,2, '.', '');
					$sid[$ab]=$temp_student_id;
					$ab++;	
					//echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
					//echo"</tr>";
					}
			}
			
			
		}

		}

		if($kount==2)
		{
		
		$section2=$section[1];
		
		
		
		$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester order by subject_id");
		$j=0;
	
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
				$outof_res=mysqli_query($con,"select max(total_lectures) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$month_id");
				$outof_res1=mysqli_fetch_array($outof_res);
				$outof[$j]=$outof_res1[0];
				//echo $outof[$j];
				$j++;
		//		echo"<th style='background-color:#8fbc8f' width='50'>$temp_subject</th>";
		}
	//	echo"<th style='background-color:#8fbc8f'>Percentage</th>";
		//echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester ");
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		//echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th></th>"."<th colspan='10'>TOTAL</th>"."<th></th>"."</tr>";
		//echo"<tr style='background-color:#8fbc8f'>"."<th colspan='2'></th>";
		$i=0;
		
		$sum_outof=0;
		for($i;$i<=$count-1;$i++)
		{
			//echo"<th style='background-color:#8fbc8f;'>".$outof[$i]."</th>";
			$sum_outof +=$outof[$i];
		}
		//echo"<th>100%</th>";
		//echo"</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section2' )");
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			//echo"<tr>";
			$sum_total1=0;
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
			
			
			
			//$subject_res=mysqli_query($con,"select subject_id from ".$batch_str." where month_id=$month_id && student_id=$temp_student_id  order by subject_id")or die(include("admin_exception.php"));
			
			$subject_res=mysqli_query($con,"select subject_id from subject_master where semester=$semester order by subject_id");
			
			
			$sum_present=0;
			$xy=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_total1=0;
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id order by subject_id" )or die(include("admin_exception.php"));
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				$attendance_rs=mysqli_query($con,"select present,total_lectures from ".$batch_str." where month_id=$month_id && subject_id=$temp_subject_id && student_id=$temp_student_id  order by subject_id");
				$attendance_rs1=mysqli_fetch_array($attendance_rs);
				
				$kount_attendance_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$temp_subject_id && student_id=$temp_student_id order by subject_id");
				
				$kount_attendance_rs1=mysqli_fetch_array($kount_attendance_rs);
				
				if($kount_attendance_rs1[0]!=0)
				{
				  $temp_present=$attendance_rs1[0];
				  $temp_total1=$attendance_rs1[1];
				}
				else
				{
					$temp_present=0;	
					$temp_total1=0;
				}
				
				
				
				$present_array[$xy]=$temp_present;
				$total_lec[$xy]=$temp_total1;
				$xy++;
				//echo"<td>".$temp_present."</td>";
				
				$sum_present+=$temp_present;
				$sum_total1+=$temp_total1;
			}
			if($sum_total1!=0)
			{
				$perc=($sum_present/$sum_total1)*100;
			}
			else
			{
				$perc=0;	
			}
			
			
			if($redlist==1)
			{
					if($perc<$boundary)
					{	
						//echo"<tr bgcolor='#FF1C1C'>";
						//echo"<td align='center'>".$temp_class_roll."</td>";
						//echo"<td align='center'>".$temp_student_name."</td>";
						for($yz=0;$yz<$xy;$yz++)
						{
							//echo"<td align='center'>".$present_array[$yz]."</td>";	
						}
						
						
					$perc1[$ab]=number_format((float)$perc,2, '.', '');
					$sid[$ab]=$temp_student_id;
					$ab++;	
					//echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
					//echo"</tr>";
					}
			}
			
			if($redlist==2)
			{
					if($perc>=$boundary)
					{	
						//echo"<tr bgcolor='#FF1C1C'>";
						//echo"<td align='center'>".$temp_class_roll."</td>";
						//echo"<td align='center'>".$temp_student_name."</td>";
						for($yz=0;$yz<$xy;$yz++)
						{
							//echo"<td align='center'>".$present_array[$yz]."</td>";	
						}
						
						
					$perc1[$ab]=number_format((float)$perc,2, '.', '');
					$sid[$ab]=$temp_student_id;
					$ab++;	
					//echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
					//echo"</tr>";
					}
			}
			
			
		}

	}


$new_count=count($perc1);
//sorting logic
for($b=0;$b<$new_count;$b++)
{
	$min=$perc1[$b];
	for($ca=$b+1;$ca<$new_count;$ca++)
	{
		if($perc1[$ca]<$min)
		{
			$min=$perc1[$ca];
			$t=$perc1[$ca];
			$perc1[$ca]=$perc1[$b];
			$perc1[$b]=$t;
			
			$t=$sid[$ca];
			$sid[$ca]=$sid[$b];
			$sid[$b]=$t;
				
		}	
	}
		
}

	for($b=0;$b<$new_count;$b++)
	{
	echo"<tr >";
		//echo $perc1[$b]." ".$sid[$b]."<br>";
		$stud_res=mysqli_query($con,"select student_name,class_roll from student_master where student_id = $sid[$b]");
		$stud_res1=mysqli_fetch_array($stud_res);
		echo "<td class='text-center'>".($b+1)."</td>";
		echo "<td class='text-center'>".$stud_res1[1]."</td>";
		echo"<td class='text-center'>".$stud_res1[0]."</td>";
		echo"<td class='text-center'>".$perc1[$b]."</td>";
	echo"</tr>";
	}

}


else if($radio_choice==2)
{
		$kount=count($section);		
		$ab=0;
		
		if($kount==1 || $kount==2)
		{
		
		$section1=$section[0];
		
		
		$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester  ");
		$j=0;
	
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
			
						$min_month_res=mysqli_query($con,"select min(month_id) from ".$batch_str);
							$min_month_res1=mysqli_fetch_array($min_month_res);
							$min_month=$min_month_res1[0];
							
							$month_set_res=mysqli_query($con,"select month_id from month_master where month_id<=$month_id && month_id>=$min_month");
							
							$sum_total_lectures=0;
					while($month_set_res1=mysqli_fetch_array($month_set_res))
					{
						$temp_month=$month_set_res1[0];
						$outof_res=mysqli_query($con,"select max(total_lectures) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$temp_month")or die(include("admin_exception.php"));
						$outof_res1=mysqli_fetch_array($outof_res);
						$sum_total_lectures+=$outof_res1[0];	
						
						
					}
					$outof[$j]=$sum_total_lectures;
					$j++;
		}
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester ");
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		
		$i=0;
		$sum_outof=0;
		for($i;$i<=$count-1;$i++)
		{
			//echo"<th style='background-color:#8fbc8f;'>".$outof[$i]."</th>";
			$sum_outof +=$outof[$i];
		}
		//echo"<th>100%</th>";
		//echo"</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section1' )");
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			//echo"<tr>";
			$sum_total1=0;
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
			
			
			
			//$subject_res=mysqli_query($con,"select subject_id from attendance_master where month_id=$month_id && student_id=$temp_student_id order by subject_id")or die(include("admin_exception.php"));
			
			$subject_res=mysqli_query($con,"select subject_id from subject_master where semester=$semester  order by subject_id");
			$sum_present=0;
			
			$xy=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_total1=0;
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id" );
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				$attendance_rs=mysqli_query($con,"select sum(present),sum(total_lectures) from ".$batch_str." where month_id<=$month_id && month_id>=$min_month && subject_id=$temp_subject_id && student_id=$temp_student_id group by student_id");
				$attendance_rs1=mysqli_fetch_array($attendance_rs);
							
				
				
				$kount_attendance_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id<=$month_id && month_id>=$min_month && subject_id=$temp_subject_id && student_id=$temp_student_id");
				
				$kount_attendance_rs1=mysqli_fetch_array($kount_attendance_rs);
				
				if($kount_attendance_rs1[0]!=0)
				{
				  $temp_present=$attendance_rs1[0];
				  $temp_total1=$attendance_rs1[1];
				}
				else
				{
					$temp_present=0;	
					$temp_total1=0;
				}
				
				
				
				$present_array[$xy]=$temp_present;
				$total_lec[$xy]=$temp_total1;
				$xy++;
				//echo"<td>".$temp_present."</td>";
				
				$sum_present+=$temp_present;
				$sum_total1+=$temp_total1;
			}
			
			if($sum_total1!=0)
			{
				$perc=($sum_present/$sum_total1)*100;
			}
			else
			{
				$perc=0;	
			}
			
			
			
			if($redlist==1)
			{
					if($perc<$boundary)
					{	
						//echo"<tr bgcolor='#FF1C1C'>";
						//echo"<td align='center'>".$temp_class_roll."</td>";
						//echo"<td align='center'>".$temp_student_name."</td>";
						for($yz=0;$yz<$xy;$yz++)
						{
							//echo"<td align='center'>".$present_array[$yz]."</td>";	
						}
						
						
					$perc1[$ab]=number_format((float)$perc,2, '.', '');
					$sid[$ab]=$temp_student_id;
					$ab++;	
					//echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
					//echo"</tr>";
					}
			}
			
			if($redlist==2)
			{
					if($perc>=$boundary)
					{	
						//echo"<tr bgcolor='#FF1C1C'>";
						//echo"<td align='center'>".$temp_class_roll."</td>";
						//echo"<td align='center'>".$temp_student_name."</td>";
						for($yz=0;$yz<$xy;$yz++)
						{
							//echo"<td align='center'>".$present_array[$yz]."</td>";	
						}
						
						
					$perc1[$ab]=number_format((float)$perc,2, '.', '');
					$sid[$ab]=$temp_student_id;
					$ab++;	
					//echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
					//echo"</tr>";
					}
			}
			
			
		}

		}

		if($kount==2)
		{
		
		$section2=$section[1];
		
		$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester  ");
		$j=0;
	
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
			
			
				$min_month_res=mysqli_query($con,"select min(month_id) from ".$batch_str);
					$min_month_res1=mysqli_fetch_array($min_month_res);
					$min_month=$min_month_res1[0];
					
					$month_set_res=mysqli_query($con,"select month_id from month_master where month_id<=$month_id && month_id>=$min_month");
					
					$sum_total_lectures=0;
					while($month_set_res1=mysqli_fetch_array($month_set_res))
					{
						$temp_month=$month_set_res1[0];
						$outof_res=mysqli_query($con,"select max(total_lectures) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$temp_month");
						$outof_res1=mysqli_fetch_array($outof_res);
						$sum_total_lectures+=$outof_res1[0];	
						
						
					}
					$outof[$j]=$sum_total_lectures;
				
				
				
				//echo $outof[$j];
				$j++;
			
			
			
				
		//		echo"<th style='background-color:#8fbc8f' width='50'>$temp_subject</th>";
		}
	//	echo"<th style='background-color:#8fbc8f'>Percentage</th>";
		//echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester ");
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		//echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th></th>"."<th colspan='10'>TOTAL</th>"."<th></th>"."</tr>";
		//echo"<tr style='background-color:#8fbc8f'>"."<th colspan='2'></th>";
		$i=0;
		
		$sum_outof=0;
		for($i;$i<=$count-1;$i++)
		{
			//echo"<th style='background-color:#8fbc8f;'>".$outof[$i]."</th>";
			$sum_outof +=$outof[$i];
		}
		//echo"<th>100%</th>";
		//echo"</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section2' )");
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			//echo"<tr>";
			$sum_total1=0;
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
			
			
			
			$subject_res=mysqli_query($con,"select subject_id from subject_master where semester=$semester  order by subject_id");
			$sum_present=0;
			
			$xy=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_total1=0;
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id" );
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				$attendance_rs=mysqli_query($con,"select sum(present),sum(total_lectures) from ".$batch_str." where  month_id<=$month_id && month_id>=$min_month && subject_id=$temp_subject_id && student_id=$temp_student_id  group by student_id")or die("Aayush");
				$attendance_rs1=mysqli_fetch_array($attendance_rs);
							
				
				
				$kount_attendance_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id<=$month_id && month_id>=$min_month && subject_id=$temp_subject_id && student_id=$temp_student_id");
				
				$kount_attendance_rs1=mysqli_fetch_array($kount_attendance_rs);
				
				
				if($kount_attendance_rs1[0]!=0)
				{
				  $temp_present=$attendance_rs1[0];
				  $temp_total1=$attendance_rs1[1];
				}
				else
				{
					$temp_present=0;	
					$temp_total1=0;
				}
				
				
				
				$present_array[$xy]=$temp_present;
				$total_lec[$xy]=$temp_total1;
				$xy++;
				//echo"<td>".$temp_present."</td>";
				
				$sum_present+=$temp_present;
				$sum_total1+=$temp_total1;
			}
			if($sum_total1!=0)
			{
				$perc=($sum_present/$sum_total1)*100;
			}
			else
			{
				$perc=0;	
			}
			
			
			if($redlist==1)
			{
					if($perc<$boundary)
					{	
						//echo"<tr bgcolor='#FF1C1C'>";
						//echo"<td align='center'>".$temp_class_roll."</td>";
						//echo"<td align='center'>".$temp_student_name."</td>";
						for($yz=0;$yz<$xy;$yz++)
						{
							//echo"<td align='center'>".$present_array[$yz]."</td>";	
						}
						
						
					$perc1[$ab]=number_format((float)$perc,2, '.', '');
					$sid[$ab]=$temp_student_id;
					$ab++;	
					//echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
					//echo"</tr>";
					}
			}
			
			if($redlist==2)
			{
					if($perc>=$boundary)
					{	
						//echo"<tr bgcolor='#FF1C1C'>";
						//echo"<td align='center'>".$temp_class_roll."</td>";
						//echo"<td align='center'>".$temp_student_name."</td>";
						for($yz=0;$yz<$xy;$yz++)
						{
							//echo"<td align='center'>".$present_array[$yz]."</td>";	
						}
						
						
					$perc1[$ab]=number_format((float)$perc,2, '.', '');
					$sid[$ab]=$temp_student_id;
					$ab++;	
					//echo"<td align='center'>".number_format((float)$perc,2, '.', '')."</td>";
					//echo"</tr>";
					}
			}
			
			
		}

		}

	$new_count=count($perc1);
//sorting logic
for($b=0;$b<$new_count;$b++)
{
	$min=$perc1[$b];
	for($ca=$b+1;$ca<$new_count;$ca++)
	{
		if($perc1[$ca]<$min)
		{
			$min=$perc1[$ca];
			$t=$perc1[$ca];
			$perc1[$ca]=$perc1[$b];
			$perc1[$b]=$t;
			
			$t=$sid[$ca];
			$sid[$ca]=$sid[$b];
			$sid[$b]=$t;
				
		}	
	}
		
}

	for($b=0;$b<$new_count;$b++)
	{
	echo"<tr >";
		//echo $perc1[$b]." ".$sid[$b]."<br>";
		$stud_res=mysqli_query($con,"select student_name,class_roll from student_master where student_id = $sid[$b]");
		$stud_res1=mysqli_fetch_array($stud_res);
		echo "<td class='text-center'>".($b+1)."</td>";
		echo "<td class='text-center'>".$stud_res1[1]."</td>";
		echo"<td class='text-center'>".$stud_res1[0]."</td>";
		echo"<td class='text-center'>".$perc1[$b]."</td>";
	echo"</tr>";
	}



	

}

?>
</table>
</div></div></div></div>
<?php
include("footer.php");
}
?> 