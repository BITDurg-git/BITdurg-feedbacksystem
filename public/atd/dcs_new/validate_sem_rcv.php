<?php
include("dbconnect.php");
$sem=$_REQUEST['abc'];
$i=0;
$x=count($sem);

mysqli_query($con,"update semester_master set keyw=0 ");

while($i<$x)
{
	$temp_sem=$sem[$i] ;
	//echo $temp_sem;
	$i++;
	
	mysqli_query($con,"update semester_master set keyw=1 where semester=$temp_sem ");
}

header("location:maps.php");
?>