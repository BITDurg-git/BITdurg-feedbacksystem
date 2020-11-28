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
	
   	
            
        
        <form action="validate_rcv.php" method="get" name="form1" id="form1">
        <?php
        echo "<div class='col-md-12'  >";
  echo "<div class='panel panel-primary'>";
   echo" <div class='panel-heading'><h3 class='panel-title' >Update Student Details</h3></div>";
    echo "<div class='panel-body'>";
   echo " <table class='table'>";
        echo"<tr>"."<th class='text-center'>"."MONTH"."</th>"."<th class='text-center'>"."YEAR"."</th>"."<th class='text-center'>"."VALID"."</th>"."</tr>";
        $month_yr_rs=mysqli_query($con,"select month_name,year,valid,month_id from month_master");
        while($month_yr_rs1=mysqli_fetch_array($month_yr_rs))
        {
            echo"<tr>";
            $m_name=$month_yr_rs1[0];
            $y_value=$month_yr_rs1[1];
            $valid=$month_yr_rs1[2];
            
            echo"<td align='center'>"."$m_name"."</td>";
            echo"<td align='center'>"."$y_value"."</td>";
            
            if($valid==0)
            {
            echo"<td align='center'>"."<input value='$month_yr_rs1[3]' type='checkbox' name='validity[]' id='validity'>"."</td>";
            }
            
            else if($valid==1)
            {
            echo"<td align='center'>"."<input value='$month_yr_rs1[3]' type='checkbox' name='validity[]' checked id='validity'>"."</td>";
            }
            echo"</tr>";		
        }
		
		echo"<tr>"."<td colspan='3' align='center'>"."<input type='submit' value='Validate' class='Button'/>";
        
        echo"</table>";
        echo "</div></div></div>";
        
        ?>
        
        
   
        </form>
        
     </div>   
<?php
	include("footer.php");
}
?>