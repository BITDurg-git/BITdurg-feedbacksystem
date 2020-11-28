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

<html>
<head>
<!-- include css -->
</head>

<body>


	<div class="col-md-12" >
		
			<div class="panel panel-primary">
			<div class='panel-heading'><h3 class='panel-title' >Upload or Change Your image</h3></div>
			<div class="panel-body">
<form action="upload_image_rcv.php" method="post" enctype="multipart/form-data">

<table>
	
	
	

   <tr><td> Select image to upload</td>
    <td><input type="file" name="fileToUpload" id="fileToUpload">
    </td></tr>
    

	<tr ><td></td><td><input type="submit" value="Upload Image" class='button' name="submit"></td></tr>

</table>

</form>
</div>
</div>
<script>

	</script>

	</script>
</form>

</body>
<?php
include("footer.php");
}
?>