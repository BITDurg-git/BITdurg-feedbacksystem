<?php

class Login
{
  
  public function doLogin($u='',$p='')
  {
        $db = $GLOBALS['db'];
        // username and password sent from index.php
        $usr = mysqli_real_escape_string($db,trim($u));
        $pwd = mysqli_real_escape_string($db,trim($p));

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
                 if($row['semester'] == -2)
                 {
                    session_unset();    //Unsetting the Session
                    session_destroy();   //Destroys the Session
                    return false;
                 }
                 break;

              /*case 'a':
                 break;*/
              
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

?>