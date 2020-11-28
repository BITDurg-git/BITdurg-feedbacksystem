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
	
  

        <form action="validate_sem_rcv.php" method="get" name="form1" id="form1">
        <?php
        
       // include("dbconnect.php");
        //include("dcs_header.php");
        
        
    echo "<div class='col-md-12'  >";
  echo "<div class='panel panel-primary'>";
   echo" <div class='panel-heading'><h3 class='panel-title' >Update Student Details</h3></div>";
    echo "<div class='panel-body'>";
   echo " <table class='table'>";
        echo"<tr>"."<th class='text-center'>"."SEMESTERS"."</th>"."<th class='text-center'>"."VALID"."</th>"."</tr>";
        
        $sem_rs=mysqli_query($con,"select * from semester_master");
        while($sem_rs1=mysqli_fetch_array($sem_rs))
        {
            echo"<tr>";
            $sem_value=$sem_rs1[1];
            $index=$sem_rs1[2];
            
            
            echo"<td align='center'>"."$sem_value"."</td>";
        
            
            if($index==0)
            {
            echo"<td align='center'>"."<input type='checkbox' value='$sem_value' name='abc[]' id='sem'>"."</td>";
            }
            
            else if($index==1)
            {
            echo"<td align='center'>"."<input type='checkbox' value='$sem_value' name='abc[]' checked id='sem'>"."</td>";
            }
            echo"</tr>";		
        }
		echo"<tr>"."<td colspan='3' align='center'>"."<input type='submit' value='Validate' class='Button'/>";
        
        echo"</table>";
        echo "</div></div><div>";
        
        ?>


</form>
</div>
<?php
	include("footer.php");
}
?>