<?php
ini_set('max_execution_time', 300);
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
	function form_feed_val()
	{
		
		var x= document.getElementById("fac1").value;
		var y= document.getElementById("user_name").value;
		var z= document.getElementById("fac3").value;
		
		if(x=='')
		{
			alert("Faculty Name can't be EMPTY!");	
		}	
		else if(y=='')
		{
			alert("Username can't be EMPTY!");	
		}
		else if(z=='')
		{
			alert("Password can't be EMPTY!");	
		}
		else
		{
				document.form1.submit();
		}
		
	}
</script>


	
	<form action="add_faculty_rcv.php" method="post" name="form1">
    	<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Add Faculty</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>

        
            <tr>
              <td align="right">Faculty Type:</td>
             <td align="left"><select name="user_type" class="formCSS" >
                     <option value="faculty" selected="selected">Faculty</option>
                     <option value="admin">Admin</option>
                     </select></td></tr>
        	<tr><td align="right">Faculty Name:</td><td><input type="text" name="faculty_name" class="formCSS" id="fac1"></td></tr>
            <tr><td align="right">Username:</td><td><input type="text" id="user_name" name="faculty_user" class="formCSS" ><span id="message" style="color:red;">
    
    </span></td></tr>
            <tr><td align="right">Password:</td><td><input type="text" name="faculty_pswd" onFocus="check_username();" class="formCSS" id="fac3"></td></tr>
            <tr><td colspan="2" align="center"><input type="button" value="Submit" class="button" onclick="form_feed_val();"></td></tr>
            
            
        </table>
	

	</form>
	
<?php
	include("footer.php");
}
?>