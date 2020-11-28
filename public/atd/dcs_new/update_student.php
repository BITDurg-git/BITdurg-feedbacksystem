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

<script>
	function display_student()
	{
		var semester=document.getElementById("semester").value;
		var section=document.getElementById("section").value;
			
			var i=new XMLHttpRequest();
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_display_student").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","update_student_ajax.php?semester=" + semester + "&section=" + section,true);
			i.send();	
	}
	function display_sdetails()
	{
		var student_id=document.getElementById("student_id").value;
		
			
			var i=new XMLHttpRequest();
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("new_display_student").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","update_student_ajax2.php?student_id=" + student_id,true);
			i.send();
	}
</script>

<form action="update_student_rcv.php" method="post">
	
	<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Update Student Details</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>
        	<td align="right">Semester:</td>
            <td>
            	<select name="semester" id="semester" class="formCSS">
                	<option>Select Semester</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                    <option value="5">5th</option>
                    <option value="6">6th</option>
                    <option value="7">7th</option>
                    <option value="8">8th</option>
                </select>
            </td></tr>
            <tr>
            <td align="right">Section:</td>
            <td>
            	<select name="section" id="section" class="formCSS">
                	<option>Select Section</option>
                    <option>A</option>
                    <option>B</option>
                      <option>C</option>
                    <option>D</option>

                </select>
            </td>
        </tr>
       
       <tr><td colspan="2" align="center">
    		<input type="submit" class="button" value="PROCEED" />
        </tr>
       
       
       <!--<tr><td colspan="2" align="center">
    	<div id="div_display_student">
    
   		 </div></td>
 	   </tr>
       
       <tr>
       		<td colspan="2" align="center">
            	 <div id="new_display_student">
   				</div>
       		</td>
       </tr>	   
       -->
    </table>
    
  </div></div></div>  
</form>

<?php
	include("footer.php");
}
?>