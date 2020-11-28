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
<script>
	function form_feed_val()
	{
		var x= document.getElementById("sec_choice").value;
		
		var m= document.getElementById("sem_choice").value;
		
		var y= document.getElementById("month_choice").value;
		var z= document.getElementById("year_choice").value;
		
		
		if(y==0)
		{
			alert("Please Select A Valid Month!");	
		}
		
		else if(z==0)
		{
			alert("Please Select A Valid Year!");	
		}
		
		else if(x==0)
		{
			alert("Please enter a Valid Semester!");
		}
		
		else if(m==0)
		{
			alert("Please Select A Valid Section!");	
		}
		
		
		else
		{
			document.form1.submit();	
		}
		
	}
	</script>

	<form action="remedial_class_rcv.php" name="form1" method="post">
<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Remedial Class List</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>


    <tr>	
      <td align="right">Particular Month:</td><td><input type="radio" checked="checked" name="month" value="1" ></td></tr>
      <tr>
      <td align="right">Overall Upto:</td><td><input type="radio" name="month" value="2" ></td>
     </tr>
     <tr>
<td align="right">Month:</td><td><select id="month_choice"  name="month_choice" class="formCSS">
        	<option value="0">Select Month</option>
             <?php
 	$fetch_month_ids=mysqli_query($con,"select month_id,month_name from month_master where valid=1 ") or die(include("admin_exception.php"));
while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
{
	$month_idd=$fetch_month_ids1[0];
	$month_namme=$fetch_month_ids1[1];
	echo"<option value='$month_namme'>"." $month_namme "."</option>";
	
}
 
 
 ?>
 
		 </select>
  </td></tr>
  <tr>
  <td align="right">
 	Year:</td>
    <td>
  <select name="year_choice" id="year_choice" class="formCSS">
        	<option value="0">Select Year</option>
                       <?php
 	$fetch_month_ids=mysqli_query($con,"select distinct year from month_master where valid=1 ") or die(include("admin_exception.php"));
while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
{
	$year_val=$fetch_month_ids1[0];
	
	echo"<option value='$year_val'>"." $year_val "."</option>";
	
}
 
 
 ?>
            
		 </select>
    </td>
    </tr>
    <tr>
    	<td align="right">Semester:</td>
         <td><select name="sem_choice" id="sem_choice" class="formCSS">
        	<option value="0">Select Semester</option>
             <?php
		   	$sems_rs=mysqli_query($con,"select semester from semester_master where keyw=1");
			while($sems_rs1=mysqli_fetch_array($sems_rs))
		   	{
				$semm=$sems_rs1[0];
				echo"<option value='$semm'>"."$semm"."</option>";	
				
			}
		   
		   ?>
		 </select>        
         </td>
<tr>    <td align="right">
         Section:</td>
         <td>
          <select name="sec_choice" id="sec_choice" class="formCSS">
          	<option value="0" >Select Section</option>
          	<option value="A"> A </option>
            <option value="B"> B </option>
          </select>
 		  </td>
    
    </tr>
    
     <tr>  
        <td colspan="2" align="center">
       <input class='button' type="button" value="Submit" onclick="form_feed_val();" >
    	</td>
    </tr>
    </table>
</div></div></div></form>
  
 
  

<?php
include("footer.php");
}
?> 