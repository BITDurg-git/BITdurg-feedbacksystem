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
  
    include("header.php");
    $pa_rs=mysqli_query($con,"select student_name,university_rollno,class_roll,semester,section,batch,class_batch from student_master where student_id=$user_id");
$pa_rs1=mysqli_fetch_array($pa_rs);


$section=$pa_rs1[4];
$semester=$pa_rs1[3];
?>
	
<?php
include("dbconnect.php");
//$section=$_REQUEST['sec_choice'];
//$semester=$_REQUEST['sem_choice'];
$month=$_REQUEST['month_choice'];
$year=$_REQUEST['year_choice'];
$radio_choice=$_REQUEST['month'];
//$batch_class=$_REQUEST['batch'];
$month_res=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year")or die(include("admin_exception.php"));
$month_res1=mysqli_fetch_array($month_res);
$month_id=$month_res1[0];

//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//echo $batch_str;
	//END of BATCH LOGIC
	

?>
<script>
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



<div class="col-md-12" id="one"> 
<div class='panel panel-primary'>
	
<div class='panel-heading' ><h3 class='panel-title' align="center" >Bhilai Institute Of Technology</h3></div>
	 <div class='panel-heading'><h3 class='panel-title' align="center">Department Of Computer Science And Engineering</h3></div>
    
    <div class='panel-heading'><h3 class='panel-title' align="center">
    <?php
    if($radio_choice==1)
    echo"<font size='2'>"."ATTENDANCE REPORT : SEMESTER : ".$semester." / "." SECTION : ".$section." / "."MONTH : IN ".$month." ".$year."</font>";
	else
		echo"<font size='2'>"."ATTENDANCE REPORT : SEMESTER : ".$semester." / "." SECTION : ".$section."/"."MONTH : Upto ".$month." ".$year."</font>";
	?>
	</h3></div>

<div class="panel-body">

<div class='table-responsive' overflow='scroll'  >
 
   
    <table class="table" style='table-layout:auto; position:relative;margin-bottom:1%; margin-right:0%;' cellpadding="0">
	
     
	
	
    <tr style="  font-weight:600;" align="center"><th colspan="2"></th><th colspan="6" class="text-center"><font size="3">THEORY</font></th><th colspan="4" class="text-center"><font size="2">LAB</font></th><th colspan="1"><th colspan="5" class="text-center"><font size="3" >Tutorials</font></th><th colspan=2></th></tr>
<tr>    <th ><font size="3">Class Roll</font></th><th  width="50%"><font size="3">Student Name</font></th>






<?php
$flag=0;

if($radio_choice==1)
{
	
		$subject_names_res=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$semester order by subject_id")or die("aayush");
		$j=0;
		while($subject_names_res1=mysqli_fetch_array($subject_names_res))
		{		
				$temp_subject=$subject_names_res1[0];
				$temp_subject_id=$subject_names_res1[1];
				//echo $batch_str;
				$outof_res=mysqli_query($con,"select max(total_lectures) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$month_id and student_id =$user_id ")or die("aayush");
				
				
				$outof_res1=mysqli_fetch_array($outof_res);
				$outof[$j]=$outof_res1[0];
				//echo $outof[$j];
				$j++;
				echo"<th  width='50'>"."<font size='3'>".$temp_subject."</font>"."</th>";
		}
		echo"<th >"."<font size='3'>"."Total Lectures"."</font>"."</th>";
		echo"<th >"."<font size='3'>"."Percentage"."</font>"."</th>";
		echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester  ")or die("aayush");
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		//echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th></th>"."<th colspan='11'>TOTAL</th>"."<th></th>"."</tr>";
		echo"<tr style='background-color:#8fbc8f'>"."<th colspan='2' class='text-right'>"."<font size='2' >"."TOTAL"."</font>"."</th>";
		$i=0;
		
		$sum_outof=0;
		for($i=0;$i<=$count-1;$i++)
		{
			echo"<th >"."<font size='2'>".$outof[$i]."</font>"."</th>";
			$sum_outof +=$outof[$i];
		}
		echo"<th class='text-center'>"."<font size='2'>".$sum_outof."</th>";
		echo"<th class='text-center'>"."<font size='2'>"."100%"."</th>";
		echo"</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section' and student_id = $user_id) order by class_roll")or die("aayush");
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			$sum_total1=0;
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			$subject_res=mysqli_query($con,"select subject_id from subject_master where semester=$semester order by subject_id")or die(include("admin_exception.php"));
			
			
			$sum_present=0;
			$xy=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{	
				$temp_total1=0;
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id" )or die(include("admin_exception.php"));
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				$attendance_rs=mysqli_query($con,"select present,total_lectures from ".$batch_str." where month_id=$month_id && subject_id=$temp_subject_id && student_id=$temp_student_id order by subject_id")or die(include("admin_exception.php"));
				$attendance_rs1=mysqli_fetch_array($attendance_rs);
				
				
				$kount_attendance_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$month_id && subject_id=$temp_subject_id && student_id=$temp_student_id order by subject_id")or die(include("admin_exception.php"));
				
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
			
			if($perc<70)
			{	
				echo"<tr class='danger' >";
				echo"<td  class='text-center'>"."<font size='2'>".$temp_class_roll."</font>"."</td>";
				echo"<td  align='center' class='text-center'>"."<font size='2'>".$temp_student_name."</font>"."</td>";
				for($yz=0;$yz<$xy;$yz++)
				{
				  if($outof[$yz]>$total_lec[$yz])
				  {	
					echo"<td  align ='center' class='text-center'>"."<font size='2'>".$present_array[$yz]."/".$total_lec[$yz]."</font>"."</td>";	
				  }
				  else
				  {
					echo"<td  align='center' class='text-center'>"."<font size='2'>".$present_array[$yz]."</font>"."</td>";	  
				  }
				}
				
				
				echo"<td align='center' class='text-center'>"."<font size='2'>".$sum_present."</font>"."</td>";
			echo"<td align='center' class='text-center'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			echo"</tr>";
			}
			else
			{
					echo"<tr class='info' >";
				echo"<td  class='text-center'>"."<font size='2'>".$temp_class_roll."</font>"."</td>";
				echo"<td align='left' class='text-center'>"."<font size='2'>".$temp_student_name."</font>"."</td>";
				for($yz=0;$yz<$xy;$yz++)
				{
					if($outof[$yz]>$total_lec[$yz])
				  	{	
						echo"<td  class='text-center'>"."<font size='2'>".$present_array[$yz]."/".$total_lec[$yz]."</font>"."</td>";	
				  	}
				  	else
				  	{
						echo"<td  class='text-center'>"."<font size='2'>".$present_array[$yz]."</font>"."</td>";	  
				  	}
				}
				
				
				
				echo"<td  class='text-center'>"."<font size='2'>".$sum_present."</font>"."</td>";
			echo"<td  class='text-center'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			echo"</tr>";
			}
			
			
		}

}

else if($radio_choice==2)
{
	
	

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
						$outof_res=mysqli_query($con,"select max(total_lectures) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$temp_month and student_id =$user_id")or die("aayush");
						$outof_res1=mysqli_fetch_array($outof_res);
						$sum_total_lectures+=$outof_res1[0];	

						
						
					}
					$outof[$j]=$sum_total_lectures;
				
				
				
				//echo $outof[$j];
				$j++;
				echo"<th  width='50'>"."<font size='3'>".$temp_subject."</font>"."</th>";
		}
		echo"<th >"."<font size='3'>"."Total Lectures"."</font>"."</th>";
		echo"<th >"."<font size='3'>"."Percentage"."</font>"."</th>";
		echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester  ");
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		//echo"<tr>"."<th style='background-color:#8fbc8f'></th>"."<th style='background-color:#8fbc8f'></th>"."<th style='background-color:#8fbc8f' colspan='11'>"."<font size='2'>"."TOTAL"."</font>"."</th>"."<th style='background-color:#8fbc8f'></th>"."</tr>";
		echo"<tr >"."<th></th>"."<th class='text-right'>"."<font size='3'>"."TOTAL"."</font>"."</th>";
		$i=0;
		
		$sum_outof=0;
		for($i;$i<=$count-1;$i++)
		{
			echo"<th >"."<font size='3'>".$outof[$i]."</font>"."</th>";
			$sum_outof +=$outof[$i];
		}
		echo"<th class='text-center'>"."<font size='3'>".$sum_outof."</font>"."</th>";
		echo"<th class='text-center'>"."<font size='3'>"."100%"."</font>"."</th>"."</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section' and student_id=$user_id) order by class_roll");
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			echo"<tr>";
			
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			//echo"<td>".$temp_class_roll."</td>";
			//echo"<td>".$temp_student_name."</td>";
		$subject_res=mysqli_query($con,"select subject_id from subject_master where semester=$semester order by subject_id");
			
			
			
				
			$sum_present=0;
			$cumm_individual_total=0;
			$mn=0;
			while($subject_res1=mysqli_fetch_array($subject_res))
			{
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id order by subject_id" );
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
					
				$month_set_ress=mysqli_query($con,"select month_id from month_master where month_id<=$month_id && month_id>=$min_month");
					
					
				
				
				$sum_present_lectures=0;
				$sum_individual_total=0;
				//while($attendance_rs1=mysqli_fetch_array($attendance_rs))
				while($month_set_ress1=mysqli_fetch_array($month_set_ress))
				{
						$temp_month_idd=$month_set_ress1[0];
						
						$present_res=mysqli_query($con,"select present,total_lectures from ".$batch_str." where subject_id=$temp_subject_id && month_id=$temp_month_idd && student_id=$temp_student_id order by subject_id")or die(include("admin_exception.php"));
						$present_res1=mysqli_fetch_array($present_res);
						
						
						$kount_present_res=mysqli_query($con,"select count(*) from ".$batch_str." where subject_id=$temp_subject_id && month_id=$temp_month_idd && student_id=$temp_student_id order by subject_id")or die(include("admin_exception.php"));
						$kount_present_res1=mysqli_fetch_array($kount_present_res);
						
						if($kount_present_res1[0]!=0)
						{
							$sum_present_lectures+=$present_res1[0];
							$sum_individual_total+=$present_res1[1];
						}
						else
						{
							$sum_present_lectures+=0;
							$sum_individual_total+=0;
								
						}
					
				}
				
			{
				
				
				
			
			}
				//$temp_present=$attendance_rs1[0];
				
				$present_array2[$mn]=$sum_present_lectures;
				$total_array2[$mn]=$sum_individual_total;
						
				$mn++;
				//echo"<td>".$sum_present_lectures."</td>";
				$sum_present+=$sum_present_lectures;
				$cumm_individual_total+=$sum_individual_total;
		}

		if($cumm_individual_total!=0)
		{
			$perc=($sum_present/$cumm_individual_total)*100;
		}
		else
		{
			$perc=0;	
		}
			if($perc<70)
			{	
				echo"<tr class='danger'>";
				echo"<td  class='text-center'>"."<font size='2'>".$temp_class_roll."</font>"."</td>";
				echo"<td align='center' class='text-center' >"."<font size='2'>".$temp_student_name."</font>"."</td>";
				
				if($cumm_individual_total<$sum_outof)
				{	
					for($yz=0;$yz<$mn;$yz++)
					{
						echo"<td  align='center' class='text-center'>"."<font size='2'>".$present_array2[$yz]."/".$total_array2[$yz]."</font>"."</td>";	
					}
				}
				else
				{
					for($yz=0;$yz<$mn;$yz++)
					{
						
						echo"<td  align='center' class='text-center'>"."<font size='2'>".$present_array2[$yz]."</font>"."</td>";	
					}
				}
				
				echo"<td align='center' class='text-center'>"."<font size='2'>".$sum_present."</font>"."</td>";
			echo"<td align='center' class='text-center''>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			echo"</tr>";
			}
			else
			{
					echo"<tr class='info'>";
				echo"<td  class='text-center'>"."<font size='2'>".$temp_class_roll."</font>"."</td>";
				echo"<td align='left' class='text-center'>"."<font size='2'>".$temp_student_name."</font>"."</td>";
				
				if($cumm_individual_total<$sum_outof)
				{	
					for($yz=0;$yz<$mn;$yz++)
					{
						echo"<td class='text-center'>"."<font size='2'>".$present_array2[$yz]."/".$total_array2[$yz]."</font>"."</td>";	
					}
				}
				else
				{
					for($yz=0;$yz<$mn;$yz++)
					{
						echo"<td  class='text-center'>"."<font size='2'>".$present_array2[$yz]."</font>"."</td>";	
					}
				}
				
				
				echo"<td  class='text-center'>"."<font size='2'>".$sum_present."</font>"."</td>";
			echo"<td  class='text-center'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			echo"</tr>";
			}
		}
	
	
	
}


//position:absolute; top:1400px; left:100px; width:200px; margin-bottom:30px;"

//position:absolute; left:800px; top:1400px; width:250px; margin-bottom:30px;"
?>
	



</table>

</div>
</div>
</div>
</div>



<?php
	include("footer.php");
}
?> 