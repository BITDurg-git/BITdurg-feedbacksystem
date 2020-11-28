<?php
session_start();
if(!session_id())
{
  session_start();
}
if(!isset($_SESSION['user_id']))
{
  header("location:login.php");
}
else
{
  $user_id=$_SESSION['user_id'];
  include('dbconnect.php');
  $type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
  $type=mysqli_fetch_array($type);
  if($type[0]=="admin")
    include("header_admin.php");
  else
    include("header.php");
  ?>

 
<form action="1_rcv.php" method="post" name="form1" id="form1">
   <table  width="100%" class="formTable" cellspacing="5">
    	<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Validate Faculty Options</h3></div>
    <div class='panel-body'>
    <table class="table">
      <tr>
      <th align="right">Current Enabled:</th>
      <td >
      <?php
      $month_res=mysqli_query($con,"select attendanceoption from admincontrols");
      $month_res1=mysqli_fetch_array($month_res);
      $a=$month_res1[0];
      if($a==1)
      echo" Up certain to month ";
      else if($a==2) 
      echo" Particular Month ";
      else
       echo" Both";
      ?></td> 
      </tr>
      
      
     
        	<th align="right">Select Option:</th>
			
      <td>
  <select name="aayush">
  <option value="1">Enable Up to Certain Month Option</option>
  <option value="2">Enable Particular Month Option</option>
  <option value="3"> Enable Both</option>
  </select>
     </td> 
  </tr>    
   <tr>  
        <td colspan="2" align="center">
       <input style="width:100px" type="submit" value="Submit"  >
    	</td>
    </tr>
   </table> 
 </div>
</div>
</div>
   </form>

   
   <?php
  include("footer.php"); 
   
   }
   ?>
  