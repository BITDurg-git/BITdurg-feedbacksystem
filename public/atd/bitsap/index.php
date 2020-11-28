<?php
	require 'session.php';
	$session_obj = new session;
	//include 'header.php';
	
	if($session_obj->checkLoggedIn())
	{	
		include 'route.php';
	}
	else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['submit'] == 'Login')
	{
		$_SESSION['key'] = true;
		require 'login.php';
		$login_obj = new login;

		if($login_obj->doLogin($_POST['usr'],$_POST['pwd']))
			include 'route.php';
		else
			include 'homepage.php';
	}
	else
	{
		include 'homepage.php';
	}
?>