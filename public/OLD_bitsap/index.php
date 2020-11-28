<?php
// Sahaj Version 1.0

/*
Attention:-

When working on localhost, give root directory name inside
	1) both .htaccess files (one in root folder and other in _app folder)
	2) below define function

When uploading on live server (not any localhost), then set them all blank ('')
*/

define('root_dir_name', 'bitsap');		//Mention root directory name if working on Localhost
									// else leave it blank

//Import libraries here (do not change order)
require "_app/lib/database/crud.php";			//Import when DB opeartions are to be done
require "_app/lib/view_engine/render.php";
require "_app/lib/router/router.php";
require '_app/lib/mail/mail.php';


if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

//Import app
require '_app/app.php';

?>