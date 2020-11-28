<?php
include('dbconnect.php');

$sem=$_REQUEST['semester'];
$sec=$_REQUEST['section'];
echo "<table class='table'>";
echo "<tr>";
echo "<td>Student Name:</td>";
echo "<td><select name=student_name>";
echo "<option value=0>Select a Student Name</option>";
$stud=mysqli_query($stu,"select student_id,student_name from student_master where semester=$sem and section='$sec' order by student_name");
while($stud1=mysqli_fetch_array($stud))
{

	echo "<option value='$stud1[0]'>".$stud1[1]."</option>";
}
echo "</select></td>";
echo "</tr>";
echo "<tr><td></td><td><input type='submit' value='Submit'  ></td></tr>";
echo "</table>";
?>