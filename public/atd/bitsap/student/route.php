<?php
if(isset($_SESSION['type']))
{
	if(isset($_GET['q']))
		$goto = $_GET['q'];
	else
		$goto = '';

	switch ($goto)
	{
		case 'live_test':
			$_SESSION['key']= true;
			include 'live_test.php';
			break;
		case 'report':
			$_SESSION['key']= true;
			include 'report.php';
			break;
		case 'profile':
			$_SESSION['key']= true;
			include 'profile.php';
			break;
		case 'QnA':
			$_SESSION['key']= true;
			include 'qna.php';
			break;
		default:
			$_SESSION['key']= true;
			include 'default.php';
			break;
	}
}
?>