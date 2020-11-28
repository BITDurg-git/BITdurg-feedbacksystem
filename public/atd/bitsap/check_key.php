<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if(!$_SESSION['key'])
{
   die("Access not Granted");
}
?>