<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if(!isset($_SESSION['type']) || $_SESSION['type'] != 'f') 
{
  	header("location: index.php");
}
include 'header.php';
$_SESSION['key'] = true;
include 'faculty/dashboard.php';
?>
<script type="text/javascript" src="js/faculty.js"></script>
<?php
include 'footer.php';
?>