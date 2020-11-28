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

<?php
	$semester=$_REQUEST['semester'];
	//$section=$_REQUEST['section'];
?>

<script>
function update_val(x,subject_id)
	{	
		
			var y=document.getElementsByName("subject_name[]");
			var subject=y[x].value;
			
			//alert(stud_name);
			var y=document.getElementsByName("semester[]");
			var semester=y[x].value;
			
			
			var z=document.getElementsByName("class_batch[]");
			var class_batch=z[x].value;
			//alert(student_id);
			
			//var x=document.getElementByName('total[]');
			//alert(total);
		
				var i=new XMLHttpRequest();
				
				i.onreadystatechange=function()
				{
					if(i.readyState==4 && i.status==200)
					{
						//document.getElementById("span_show").innerHTML=i.responseText;	
						//alert(i.responseText);
					}
				};
				
				i.open("GET","update_sub.php?semester=" + semester + "&class_batch="+class_batch+"&subject_id="+subject_id + "&subject_name="+ subject,true);
				i.send();
				alert("updation is successful");
				document.location.reload(true);
	}
</script>	
	<div class='table-responsive'>
		<div class='col-md-12'>

	<table class='table'>
	<tr >
    	<th class='text-center'>Subject Name</th>
    	<th class='text-center'>Semester</th>
        
        <th class='text-center'>Having Batch system?</th>
        <th></th>
        
    </tr>
	
<?php	
	$stud_rs=mysqli_query($con,"select subject_id,subject_name,semester,either_batch from subject_master where semester=$semester") ;
	$i=0;
		
	while($stud_rs1=mysqli_fetch_array($stud_rs))
	{
		echo"<tr>";
			
			echo "<td align='center'>"."<input type=text  name=subject_name[] value=$stud_rs1[1]> "."</td>";
			//echo "<td align='center'>"."<input type='text' size='40' name='stud_name[]' value='$stud_rs1[2]' class='formCSS'>"."</td>";
			
			echo "<td align='center'>"."<input type='number' name='semester[]' value='$stud_rs1[2]' class='formCSS'>"."</td>";
			
			echo "<td align='center'><select name=class_batch[]>";
			if($stud_rs1[3]==0)
				{echo "<option value=0 selected=selected >NO</option>";
				echo "<option value=1>YES</option>";}
			else
				{echo "<option value=1 selected=selected>YES</option>";
				echo "<option value=0>NO</option>";}
			//echo "<td align='center'>"."<input type='number' name='class_batch[]' value='$stud_rs1[4]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='button' value='update' name='update_button[]' onclick='update_val($i,$stud_rs1[0])' class='Button'>"."</td>";
		echo "</tr>";
		
		$i++;
	}
	
?>
</table>
</div>
</div>
<?php

include("footer.php");
}
?>	