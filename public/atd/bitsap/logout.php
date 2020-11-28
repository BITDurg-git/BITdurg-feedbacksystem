<?php
   session_start();
   session_unset();		//Unsetting the Session
   
   if(session_destroy()) //Destroys the Session
   {
   		if(isset($_COOKIE['userid']))
         {
            setcookie("userid", "", time() - 3600);
         }
   		include_once('dbconnect.php');
      	mysqli_close($db);
   		header("location: index.php");
   }
?>