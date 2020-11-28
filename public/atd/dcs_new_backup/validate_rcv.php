<?php
include("dbconnect.php");
$validity=$_REQUEST['validity'];
$i=0;
$x=count($validity);

mysqli_query($con,"update month_master set valid=0");

while($i<$x)
{
	$temp_month_id=$validity[$i] ;
	
	$i++;
	
	mysqli_query($con,"update month_master set valid=1 where month_id=$temp_month_id") ;
}

header("location:maps.php");
?>