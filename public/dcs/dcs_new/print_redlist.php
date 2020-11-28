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
function form_feed_val()
	{
		
		var y= document.getElementById("month_choice").value;
		var z= document.getElementById("year_choice").value;
		var x= document.getElementById("sem_choice").value;
		//var m=document.getElementById("sec_choice").value;
		var w= document.getElementById("boundary").value;
		
		
		
		
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
			alert("Please Select A Valid Semester!");	
		}
		
		
		
		else if(w=='')
		{
			alert("Boundary Value Cannot be Empty!!");	
		}
		
		else
		{
			document.form1.submit();	
		}
		
	}
	</script>



	<form action="print_redlist_rcv.php" name="form1" method="post">
    <div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Generate Redlist</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>
    
   	
      <td align="right">Particular Month :</td><td><input type="radio" checked="checked" name="month" value="1"></td>
     </tr><tr>  <td align="right">Upto a Month :</td><td><input type="radio" name="month" value="2"></td>
     </tr>
     <tr>
<td align="right">Month:</td><td><select style="width:120px" id="month_choice" name="month_choice" class="formCSS">
<option value="0">------</option>


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
  </td>
 </tr> 
 <tr> 
  <td align="right">
 	Year:</td><td>
  <select style="width:120px" name="year_choice" id="year_choice" class="formCSS">
        	<option value="0">------ </option>
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
    	<td align="right">Semester:</td><td>
         <select style="width:120px" name="sem_choice" id="sem_choice" class="formCSS">
        	<option value="0"> ------ </option>
          <?php
		   	$sems_rs=mysqli_query($con,"select semester from semester_master where keyw=1");
			while($sems_rs1=mysqli_fetch_array($sems_rs))
		   	{
				$semm=$sems_rs1[0];
				echo"<option value='$semm'>"."$semm"."</option>";	
				
			}
		   
		   ?>
		 </select>        
         </td></tr>
         <tr>
         <td align="right">Section:
         </td><td>
         <input type="checkbox" name="section[]" value="A" checked="checked" />A
         <input type="checkbox" name="section[]" value="B" checked="checked" />B
         <input type="checkbox" name="section[]" value="C" checked="checked" />C
         
       
 		  </td>
    
    </tr>
    
       <tr><td align="right">Below :</td>
       
       <td>
     	<input type="radio" checked="checked" name="redlist" value="1"></td></tr>
       <tr> <td align="right"> Above :</td><td> <input type="radio" name="redlist" value="2"></td></tr>
       <tr><td align="right"> % Attendance :
    	</td>
        <td><input type="number" name="boundary" id="boundary" style="width:120px;"></td>
    </tr>
    
     <tr> 
     <td></td> 
        <td  align="right">
       <input  type="button" value="Submit" onclick="form_feed_val();" class="Button">
    	<td>
    </tr>
   
    </table>
</div>
</div></div>  
</form>
<?php
	include("footer.php");
}
?> 