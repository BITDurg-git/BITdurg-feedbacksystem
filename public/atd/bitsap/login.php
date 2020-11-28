<?php
   require 'check_key.php';

   @require_once("dbconnect.php");
   date_default_timezone_set('Asia/Kolkata');

   class login
   {
      
      public function doLogin($u='',$p='')
      {
            $db = $GLOBALS['db'];
            // username and password sent from index.php
            $usr = mysqli_real_escape_string($db,$u);
            $pwd = mysqli_real_escape_string($db,$p);

            if(empty($usr) || empty($pwd))
            {
               session_destroy();
               return false;
            }
            
            $sql = "SELECT type,semester,password FROM user WHERE uid = '$usr'";
            $result = mysqli_query($db,$sql);

            // If result matched $myusername and $mypassword, no. of row must be 1
            $count = mysqli_num_rows($result);
            $row=mysqli_fetch_assoc($result);
            
            if($count == 1 && (md5($pwd) == md5($row['password'])))
            {
               $_SESSION['userid'] = $usr;
               $_SESSION['type'] = $row['type'];

               switch ($_SESSION['type'])
               {
                  case 's':
                     $_SESSION['sem'] = $row['semester'];
                     break;

                  case 'f':
                     $cookie_name = "userid";
                     $cookie_value = $usr;
                     setcookie($cookie_name, $cookie_value, time() + (86400), "/");
                     // 86400 = 1 day
                     break;

                  case 'a':
                     break;
                  
                  default:
                     //Something's Wrong!
                     return false;
                     break;
               }

               return true;     
            }
            else
            {
               return false;
            }
      }
   }
   require 'unset_key.php';
?>