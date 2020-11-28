<?php
if(isset($_SESSION['type']))
{
	if(isset($_GET['q']))
		$goto = $_GET['q'];
	else
		$goto = '';

	switch ($goto)
	{
		case 'promote_sem':
			$_SESSION['key']= true;
			include 'promote_semester.php';
			break;
		case 'f':
			
			break;
		case 'a':
			
			break;
		default:
			$_SESSION['key']= true;
			include 'default.php';
			break;
	}
}
?>