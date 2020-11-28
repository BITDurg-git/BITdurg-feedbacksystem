<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if(!isset($_SESSION['type']) || $_SESSION['type'] != 'a') 
{
  	header("location: index.php");
}
include 'header.php';
$_SESSION['key'] = true;
include 'admin/dashboard.php';
?>
<script type="text/javascript" src="js/admin.js"></script>
<?php
include 'footer.php';
?>