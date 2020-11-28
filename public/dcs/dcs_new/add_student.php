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
<script>
	function count_student()
	{
			var sem=document.getElementById("sem_choice").value;
			var sec=document.getElementById("sec_choice").value;
			var batch=document.getElementById("batch").value;
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_count").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","countStudentAJAX.php?semester=" + sem + "&section=" + sec + "&batch=" + batch,true);
			i.send();
	}
    
	
	
	
	
	function show_table()
	{
			var sem=document.getElementById("sem_choice").value;
			var sec=document.getElementById("sec_choice").value;
			var new_stud=document.getElementById("new_stud").value;
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_show").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","newstud_detail.php?semester=" + sem + "&section=" + sec + "&new_stud=" + new_stud,true);
			i.send();
	}
    
	function form_feed_val()
	{
		var x= document.getElementById("sec_choice").value;
		var y= document.getElementById("sem_choice").value;
		var z= document.getElementById("batch").value;
		var w= document.getElementById("new_stud").value;
		
		if(z==0)
		{
			alert("Section can't be EMPTY!");	
		}
		else if(y==0)
		{
			alert("Semester can't be EMPTY!");	
		}
		else if(x==0)
		{
			alert("Batch can't be EMPTY!");	
		}
		else if(w=='')
		{
			alert("Number of students can't be EMPTY!");	
		}
			
		else
		{	
			show_table();
			//document.form1.submit();
		}
	}
	function form_feed_val2()
	{	
		
		var i=document.getElementById("total").value;
		var j;
		var flag=0;
	
		var y= document.getElementsByName("stud_name[]");
		for(j=0;j<i;j++)
		{
			if(y[j].value=='')
			{
				alert("Student Name cannot be EMPTY!");
				flag=1;
				break;
			}
			
		}
		 if(flag==0)
		 {
		
				document.form1.submit();
		 }
		
	}

	
</script>


<form action="add_student_rcv.php" method="post" name="form1">
<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Add New Student</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>




<tr>
 <td align="right">Batch:</td>
 <td> <select name="batch" id="batch" class="formCSS">
 <?php
 	$years=mysqli_query($con,"select distinct batch from student_master  ")or die(include("admin_exception"));
	echo"<option value='0'> ---- </option>";
	while($years_rs1=mysqli_fetch_array($years))
	{
		$YEAR=$years_rs1[0];
	echo"<option value='$YEAR'>". $YEAR ."</option>";
	}
 ?>
        
        	
            

		 </select></td>        
         </tr>



<tr>
 <td align="right">Semester:</td>
        <td> <select name="sem_choice" id="sem_choice" class="formCSS">
        	<option value="0"> ---- </option>
             <?php
		   	$sems_rs=mysqli_query($con,"select semester from semester_master where keyw=1");
			while($sems_rs1=mysqli_fetch_array($sems_rs))
		   	{
				$semm=$sems_rs1[0];
				echo"<option value='$semm'>"."$semm"."</option>";	
				
			}
		   
		   ?>
		 </select></td>        
         </tr>
        <tr>
        <td align="right"> Section:</td>
        <td>
          <select name="sec_choice" id="sec_choice"  class="formCSS">
          	<option value="0"> -- </option>
            <option value="A"> A </option>
            <option value="B"> B </option>
          </select></td>
        </tr>
         <tr>
        <td align="right"> Batch Class:</td>
        <td>
          <select name="batch_class" id="batch_class"  class="formCSS">
          	<option value="1"> B1 </option>
            <option value="2"> B2 </option>
         
          </select></td>
        </tr>

        
  <tr><td align="right">        
       Number of Students:</td><td><input type="number" name="number_student" id="new_stud" class="formCSS">
 </td></tr>


<tr><td align="center" colspan="3"><input type="button" value="Show Form" onClick="form_feed_val();" class="button">
</td></tr>
</table>
</div>
</div>
</div>

<div id="div_show" class="col-md-12">
</div>

</form>

</div><!--EO workBox-->			
<div id="div_count" class='col-md-12'>
</div>


<?php
	include("footer.php");
}
?> 


