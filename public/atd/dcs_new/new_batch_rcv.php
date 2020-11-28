<?php

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
	{	var i=document.getElementById("hid").value;
		var j;
		var flag=0;
		var x= document.getElementsByName("class_roll[]");
		var y= document.getElementsByName("stud_name[]");
		
		for(j=0;j<i;j++)
		{
			if(x[j].value=='')
			{
				alert("Class Roll cannot be EMPTY!");
				flag=1;
				break;
			}
			else if(y[j].value=='')
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
<?php
 
 

 $number_of_students=$_REQUEST['number_of_students'];
 $section=$_REQUEST['section'];
 $batch_year=$_REQUEST['batch_year'];
 $batch_class=$_REQUEST['batch_class'];
 $_SESSION['number_of_students']=$number_of_students;
 $_SESSION['section']=$section;
 $_SESSION['batch']=$batch_year;
 $_SESSION['batch_class']=$batch_class;
 
 ?>
 
 
 <form action="insert_student.php" name="form1" method="post">
 <div class='col-md-12'  >
  <div class='panel panel-primary'>
   <div class='panel-heading'><h3 class='panel-title' >Insert New Batch</h3></div>
   <div class='panel-heading'><h3 class='panel-title' >
   	<?php
   	echo "Semester : 3 / Section : $section / Batch : $batch_class";

   ?></h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>
    <tr>
      <th class="panel-title" style="background-color: #045FB4;color:#fff">SNo.</th>
      <th class="panel-title" style="background-color: #045FB4;color:#fff">University Roll no.</th>
      <th class="panel-title" style="background-color: #045FB4;color:#fff">Class Roll Number </th>
      <th class="panel-title" style="background-color: #045FB4;color:#fff"> Name</th>
      
    </tr>
    <?php
	echo"<input type='hidden' id='hid' value='$number_of_students'>";
	for($i=1;$i<=$number_of_students;$i++)
	{	
		 echo "<tr>";
		 	echo "<td align='center'>".$i."</td>";
		 	echo "<td>"."<input type='number' name='univ_roll[]' class='formCSS'>"."</td>";
		   echo "<td>"."<input type='number' name='class_roll[]' class='formCSS'>"."</td>";
		   echo "<td>"."<input type='text' name='stud_name[]' class='formCSS'>"."</td>";
		     
		 echo "</tr>";
	}
	?>
	 <tr><td colspan="4" align="center"><input type="button" value="Submit" onclick="form_feed_val();" class="Button">   </td></tr>
 </table>
</div></div></div>
 </form>

<?php
include("footer.php");
}
?> 