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
		
		var m= document.getElementById("month_choice").value;
		var n= document.getElementById("year_choice").value;
		var x= document.getElementById("sec_choice").value;
		var y= document.getElementById("sem_choice").value;
		
		if(m==0)
		{
			alert("Month can't be EMPTY!");	
		}
		else if(n==0)
		{
			alert("Year can't be EMPTY!");	
		}
		else if(y==0)
		{
			alert("Semester can't be EMPTY!");	
		}
		else if(x==0)
		{
			alert("Section can't be EMPTY!");	
		}
		
			
		else
		{	
			
			document.form1.submit();
		}
	}
	function bring_subjects()
	{
			var sem=document.getElementById("sem_choice").value;
			var sec=document.getElementById("sec_choice").value;
			var year=document.getElementById("year_choice").value;			
			
			if(sem==0)
			{
				alert("Please select a valid SEMESTER value!");	
			}
			else if(sec==0)
			{
				alert("Please select a valid SECTION value!");	
			}
			
			else if(year==0)
			{
				alert("Please select a valid YEAR value!");	
			}
			
			else
			{
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_show").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","my_subject.php?semester=" + sem + "&section=" + sec,true);
			i.send();
			}
	}
	function bring_sub()
	{
			var sem=document.getElementById("sem_choice").value;
			var sec=document.getElementById("sec_choice").value;
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_show").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","update_ajax.php?semester=" + sem + "&section=" + sec,true);
			i.send();
	}
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
						document.getElementById("span_show").innerHTML=i.responseText;	
					}
				};
				
				i.open("GET","update_attend_ajax.php?total=" + total + "&present=" + present + "&student_id=" + student_id,true);
				i.send();
				alert("updation is successful");
	}
</script>


 <form action="update_attendance_rcv.php" method="post" name="form1">
<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Update Attendance</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>  
  
  <tr><td align="right">Month:</td>
  <td>
  <select name="month_choice" id="month_choice" class="formCSS">
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
 
        	
            
</select> </td>
  
 </tr>
<tr>

  <td align="right">Year:</td>
  <td>
  <select name="year_choice" class="formCSS" id="year_choice">
        	<option value="0">Select Year </option>
                 <?php
 	$fetch_month_ids=mysqli_query($con,"select distinct year from month_master where valid=1 ") or die(include("admin_exception.php"));
while($fetch_month_ids1=mysqli_fetch_array($fetch_month_ids))
{
	$year_val=$fetch_month_ids1[0];
	
	echo"<option value='$year_val'>"." $year_val "."</option>";
	
}
 
 
 ?>
            
		 </select>
  
  </td></tr> 
   <tr><td align="right">Semester:</td>
       <td>  <select name="sem_choice" id="sem_choice" onChange='bring_sub();' class="formCSS">
        	<option value="0">Select Semester </option>
           <?php
		   	$sems_rs=mysqli_query($con,"select semester from semester_master where keyw=1");
			while($sems_rs1=mysqli_fetch_array($sems_rs))
		   	{
				$semm=$sems_rs1[0];
				echo"<option value='$semm'>"."$semm"."</option>";	
				
			}
		   
		   ?>
		 </select> </td> </tr>      
         <tr>
	         <td align="right">Section:</td>
          <td><select name="sec_choice" id="sec_choice" onChange='bring_sub();' class="formCSS">
          	<option value="0">Select Section </option>
          	<option value="A"> A </option>
            <option value="B"> B </option>
          </select></td></tr>
       
  
	        
  			 <tr id="div_show" >
  				  
    		 </tr>
  
  
  
  <tr><td colspan="2" align="center"><input type="button" value="Submit" class="Button" onclick="form_feed_val();"></td></tr>
  
  
  </table>
</div></div></div>



  </form>

       

</div>
<?php

	include("footer.php");
}
?>
