<?php
	if(isset($_SESSION['type']))
	{
		switch ($_SESSION['type'])
		{
			case 's':
				header('location: student.php');
				break;
			case 'f':
				header('location: faculty.php');
				break;
			case 'a':
				header('location: admin.php');
				break;
			default:
				echo "Something's not right!";
				break;
		}
	}
?>