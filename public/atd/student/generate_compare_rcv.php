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
?>
	
<?php
include("dbconnect.php");
$pa_rs=mysqli_query($con,"select student_name,university_rollno,class_roll,semester,section,batch,class_batch from student_master where student_id=$user_id");
$pa_rs1=mysqli_fetch_array($pa_rs);


$section=$pa_rs1[4];
$semester=$pa_rs1[3];
$month=$_REQUEST['month_choice'];
$year=$_REQUEST['year_choice'];
//$radio_choice=$_REQUEST['month'];


//$month_res=mysqli_query($con,"select month_id from month_master where month_name='$month' && year=$year");
//$month_res1=mysqli_fetch_array($month_res);
//$month_id=$month_res1[0];

//BATCH DETERMINING LOGIC
	$batch_rs=mysqli_query($con,"select batch,semester from student_master where semester=$semester group by semester");
	$batch_rs1=mysqli_fetch_array($batch_rs);
	$str_sem=$batch_rs1[1];
	$str_batch=$batch_rs1[0];
	$batch_str=$str_sem.$str_batch."attd";
	//END of BATCH LOGIC
	//echo $batch_str;
	

?>

<div class='table-responsive' overflow='scroll'  >
 
   
    <table class="table" style='table-layout:auto; position:relative;margin-bottom:1%; margin-right:0%;' cellpadding="0">
	
    
<tr>    <th class='text-center' ><font size="3">Month</font></th><th class='text-center'><font size="3">Percentage</font></th>
<?php



	
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
				//echo"<th  width='50'>"."<font size='3'>".$temp_subject."</font>"."</th>";
		}
          //echo"<th >"."<font size='3'>"."Total Lectures"."</font>"."</th>";  // Change 1
          for($p=$month_id;$p>=1;$p--)
          {
                 $month_res=mysqli_query($con,"select month_name from month_master where month_id=$p" );
                  $month_res1=mysqli_fetch_array($month_res);
                  $month1=$month_res1[0];
                
            	echo"<th  width='70'>"."<font size='3'>"."Percent-".$month1."</font>"."</th>";
		       }
    echo"</tr>";
		
		$count_res=mysqli_query($con,"select count(*) from subject_master where semester=$semester  ");
		$count_res1=mysqli_fetch_array($count_res);
		$count=$count_res1[0];
		//echo"<tr style='background-color:#8fbc8f'>"."<th></th>"."<th></th>"."<th colspan='11'>TOTAL</th>"."<th></th>"."</tr>";
		echo"<tr >"."<th colspan='2' class='text-right'>"."<font size='2'>"."TOTAL"."</font>"."</th>";
		$i=0;
		
		$sum_outof=0;
		for($i=0;$i<=$count-1;$i++)
		{
			//echo"<th style='background-color:#8fbc8f;'>"."<font size='2'>".$outof[$i]."</font>"."</th>";
			$sum_outof +=$outof[$i];
		}
                //echo"<th>"."<font size='2'>".$sum_outof."</th>";  // Change 2
	  for($p=$month_id;$p>=1;$p--)
  	echo"<th>"."<font size='2'>"."100%"."</th>";
		echo"</tr>";
		
		
			
		
		$student_res=mysqli_query($con,"select student_name,class_roll,student_id from student_master where (semester=$semester && section='$section') order by class_roll");
		
		
		
		while($student_res1=mysqli_fetch_array($student_res))
		{
			$sum_total1=0;
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
			$subject_res=mysqli_query($con,"select subject_id from subject_master where semester=$semester order by subject_id");
			
	    
        $sum_present=0;
			  $xy=0;
      while($subject_res1=mysqli_fetch_array($subject_res))
			{	
				$temp_total1=0;
				$temp_subject_id=$subject_res1[0];
				$subject_name_res=mysqli_query($con,"select subject_name from subject_master where subject_id=$temp_subject_id" );
				$subject_name_res1=mysqli_fetch_array($subject_name_res);
				$temp_subject_name=$subject_name_res1[0];
				
				$attendance_rs=mysqli_query($con,"select present,total_lectures from ".$batch_str." where month_id=$month_id && subject_id=$temp_subject_id && student_id=$temp_student_id order by subject_id");
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
			
			if($perc<70)
			{	
				echo"<tr >";
				echo"<td align='center'>"."<font size='2'>".$temp_class_roll."</font>"."</td>";
				echo"<td align='left'>"."<font size='2'>".$temp_student_name."</font>"."</td>";
				/*for($yz=0;$yz<$xy;$yz++)
				{
				  if($outof[$yz]>$total_lec[$yz])
				  {	
					//echo"<td align='center'>"."<font size='2'>".$present_array[$yz]."/".$total_lec[$yz]."</font>"."</td>";	
				  }
				  else
				  {
					//echo"<td align='center'>"."<font size='2'>".$present_array[$yz]."</font>"."</td>";	  
				  }
				}*/
				
				
			//echo"<td align='center'>"."<font size='2'>".$sum_present."</font>"."</td>";   // Change 3	
			echo"<td class='danger' align='center'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			}
			else
			{
					echo"<tr >";
				echo"<td align='center'>"."<font size='2'>".$temp_class_roll."</font>"."</td>";
				echo"<td align='left'>"."<font size='2'>".$temp_student_name."</font>"."</td>";
				//for($yz=0;$yz<$xy;$yz++)
				//{
				//	if($outof[$yz]>$total_lec[$yz])
				  //	{	
					//	echo"<td align='center'>"."<font size='2'>".$present_array[$yz]."/".$total_lec[$yz]."</font>"."</td>";	
				  	//}
				  	//else
				  	//{
					//	echo"<td align='center'>"."<font size='2'>".$present_array[$yz]."</font>"."</td>";	  
				  	//}
				//}
				
				
				
			//echo"<td align='center'>"."<font size='2'>".$sum_present."</font>"."</td>";   // Change 4	
			echo"<td class='info' align='center'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			}
			  
		for($p=$month_id-1;$p>=1;$p--)
    {
      $sum_total1=0;
			$temp_student_name=$student_res1[0];
			$temp_class_roll=$student_res1[1];
			$temp_student_id=$student_res1[2];
			
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
				
				$attendance_rs=mysqli_query($con,"select present,total_lectures from ".$batch_str." where month_id=$p && subject_id=$temp_subject_id && student_id=$temp_student_id order by subject_id");
				$attendance_rs1=mysqli_fetch_array($attendance_rs);
				
				
				$kount_attendance_rs=mysqli_query($con,"select count(*) from ".$batch_str." where month_id=$p && subject_id=$temp_subject_id && student_id=$temp_student_id order by subject_id");
				
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
     	echo"<td align='center' class='danger'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
			}
      else
      {
    
      echo"<td align='center'class='info'>"."<font size='2'>".number_format((float)$perc,2, '.', '')."</font>"."</td>";
      }
    
    }	
    echo"</tr>";
		
    
    }






	include("footer.php");
}
?> 
