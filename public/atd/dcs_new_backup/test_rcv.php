<?php
include('dbconnect.php');
$rec=$_REQUEST['send'];
$val_rcv=mysqli_query($con,$rec);

echo "<table border='2'>";
while($val=mysqli_fetch_row($val_rcv))
{
echo "<tr>";
  for($i=0;$i<count($val);$i++)
{
	echo "<td>".$val[$i]."</td>";
}
echo "</tr>";		

}

echo "</table>";


?>