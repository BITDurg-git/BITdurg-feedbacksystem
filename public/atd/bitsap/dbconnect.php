<?php

$db_host = "localhost";
$db_usr = "root";
$db_pwd = "";
$db_db = "online_test_portal";

$GLOBALS['db'] = mysqli_connect($db_host,$db_usr,$db_pwd,$db_db);

if(!$db)
{
	die('Could not connect: ' . mysqli_error($db));
}
?>