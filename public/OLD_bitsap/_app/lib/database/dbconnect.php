<?php

$db_host = "localhost";		//domani name
$db_usr = "root";			//define username of DB
$db_pwd = "";			//define password, if present
$db_db = "bitsap";		//name of the DB

$GLOBALS['db'] = mysqli_connect($db_host,$db_usr,$db_pwd,$db_db);	//Can be reused for custom DB Oprtns

if(!$db)
{
	die('Could not connect: ' . mysqli_error($db));
}

mysqli_set_charset($db,"utf8");
?>