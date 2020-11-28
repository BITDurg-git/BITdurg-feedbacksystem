<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['key'] = false;
class session
{
	public function checkLoggedIn()
	{
		return isset($_SESSION['type']);
	}
}
?>