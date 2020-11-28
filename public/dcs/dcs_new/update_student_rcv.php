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
	$section=$_REQUEST['section'];
?>

<script>
function update_val(x,student_id)
	{	
			var y=document.getElementsByName("croll[]");
			var croll=y[x].value;
			
			var z=document.getElementsByName("stud_name[]");
			var stud_name=z[x].value;
			//alert(stud_name);
			var y=document.getElementsByName("semester[]");
			var semester=y[x].value;
			
			var z=document.getElementsByName("section[]");
			var section=z[x].value;
			var y=document.getElementsByName("batch[]");
			var batch=y[x].value;
			
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
						document.getElementById("span_show").innerHTML=i.responseText;	
					}
				};
				
				i.open("GET","update_stud_ajax.php?croll=" + croll+ "&stud_name=" + stud_name + "&semester=" + semester+"&section="+section+"&batch="+batch+"&class_batch="+class_batch+"&student_id="+student_id,true);
				i.send();
				alert("updation is successful");
				document.location.reload(true);
	}
</script>	
	<div class='table-responsive'>
		<div class='col-md-12'>

	<table class='table'>
	<tr >
    	<th class='text-center'>Class Roll</th>
    	<th class='text-center'>Student Name</th>
        
        <th class='text-center'>Semester</th>
        <th class='text-center'>Section</th>
        <th class='text-center'>Batch</th>
        <th class='text-center'>Class Batch</th>
        <th class='text-center'></th>
    </tr>
	
<?php	
	$stud_rs=mysqli_query($con,"select student_id,class_roll,student_name,batch,class_batch from student_master where semester=$semester && section='$section' order by class_roll") ;
	$i=0;
		
	while($stud_rs1=mysqli_fetch_array($stud_rs))
	{
		echo"<tr>";
			
			echo "<td align='center'>"."<input type='number' name='croll[]' value='$stud_rs1[1]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='text' size='40' name='stud_name[]' value='$stud_rs1[2]' class='formCSS'>"."</td>";
			
			echo "<td align='center'>"."<input type='number' name='semester[]' value='$semester' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='text' name='section[]' value='$section' id='present[]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='number' name='batch[]' value='$stud_rs1[3]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='number' name='class_batch[]' value='$stud_rs1[4]' class='formCSS'>"."</td>";
			echo "<td align='center'>"."<input type='button' value='update' name='update_button[]' onclick='update_val($i,$stud_rs1[0])' class='formButton'>"."</td>";
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