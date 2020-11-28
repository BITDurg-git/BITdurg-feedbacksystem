<?php
		include("dbconnect.php");
		$sem=$_REQUEST['semester'];
		$sec=$_REQUEST['section'];
		
		$sub_rs=mysqli_query($con,"select subject_name,subject_id from subject_master where semester=$sem") or die("hello");
		//echo"<table class='table'>";
		echo "<td class='text-center'>"."Subject:"."</td>";
		echo "<td align='center' >"."<select name='subject_id' style='width:176px;'>";
		while($sub_rs1=mysqli_fetch_array($sub_rs))
		{
			echo"<option value='$sub_rs1[1]'>".$sub_rs1[0]."</option>";	
		}
		
		echo "</select>"."</td>";
		//echo"</table>";</
?>