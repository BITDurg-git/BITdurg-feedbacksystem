
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
<div class="col-md-12" >
        
            <div class="panel panel-primary">
            <div class='panel-heading'><h3 class='panel-title' >Upload or Change Your image</h3></div>
            <div class="panel-body">
                <table>
    




<tr><td colspan=3>
<?php




include("dbconnect.php");
$target_dir = "facultyimg/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists $target_file.Please change the name and try again";
    //unlink($target_file);
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large .";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $path=basename( $_FILES['fileToUpload']['name']);
        mysqli_query($con,"update user_master set image_path='$path' where user_id=$user_id");

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


?>
</td></tr></table>
<?php

include("footer.php");
}
?>