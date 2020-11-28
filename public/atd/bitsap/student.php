<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if(!isset($_SESSION['type']) || $_SESSION['type'] != 's') 
{
  	header("location: index.php");
}
include 'header.php';
$_SESSION['key'] = true;
include 'student/dashboard.php';
?>
<script type="text/javascript" src="js/student.js"></script>
<?php
include 'footer.php';
?>