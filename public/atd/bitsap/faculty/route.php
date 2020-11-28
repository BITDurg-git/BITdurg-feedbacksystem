<?php
if(isset($_SESSION['type']))
{
	if($_SESSION['type'] != 'f')
		die("Access not granted");
		
	if(isset($_GET['q']))
		$goto = $_GET['q'];
	else
		$goto = '';

	switch ($goto)
	{
		case 'create_test':
			$_SESSION['key']= true;
			include 'create_test.php';
			break;

		case 'edit_test':
			$_SESSION['key']= true;
			include 'edit_test.php';
			break;

		case 'conduct_test':
			$_SESSION['key']= true;
			include 'conduct_test.php';
			break;

		case 'live_test':
			$_SESSION['key']= true;
			include 'live_test.php';
			break;

		case 'invigilation':
			$_SESSION['key']= true;
			include 'invigilation.php';
			break;

		case 'student_report':
			$_SESSION['key']= true;
			include 'student_report.php';
			break;

		case 'test_work':
			$_SESSION['key']= true;
			include 'test_work.php';
			break;

		case 'etw':						//etw = Edit Test Work
			$_SESSION['key']= true;
			include 'etw.php';
			break;

		case 'student_report':
			$_SESSION['key']= true;
			include 'student_report.php';
			break;

		default:
			$_SESSION['key']= true;
			include 'default.php';
			break;
	}
}
?>