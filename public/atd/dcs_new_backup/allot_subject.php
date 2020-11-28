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

	function fetch_sub()
	{
			var sem=document.getElementById("sem_choice").value;
			var sec=document.getElementById("sec_choice").value;
			
			var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
				{
					document.getElementById("div_show").innerHTML=i.responseText;	
				}
			};
			
			i.open("GET","show_subject.php?semester=" + sem + "&section=" + sec,true);
			i.send();
	}
	

</script>

<form action="allot_subject2.php" method="post" name="form1">
  <div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Subject Allotment</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>


<tr>
	<td align="right">
    	Semester:</td>
         <td><select name="sem_choice" id="sem_choice" onChange='fetch_sub();' class="formCSS">
        	<option> ---- </option>
            <option value="3"> 3rd </option>
            <option value="4"> 4th </option>
            <option value="5"> 5th </option>
            <option value="6"> 6th </option>
            <option value="7"> 7th </option>
            <option value="8"> 8th </option>
		 </select> </td>       
 </tr>        
    
   <tr>    <td align="right"> Section:</td>
       <td>  <select name="sec_choice" id="sec_choice" onChange='fetch_sub();' class="formCSS">
          	<option value="A"> A </option>
            <option value="B"> B </option>
          </select></td></tr>
          
        </table>
      </div>
    </div>
  </div>
        
        
         <div id="div_show" class="col-md-12">
    
    	</div>
    </form>
<!--EO of workBox-->
<!--
	<script>
                function check_entry()
                {
                    var semester=document.getElementById("sem_choice").value;
                    var section=document.getElementById("sec_choice").value;
                                       
                    var i=new XMLHttpRequest();
                        
                        i.onreadystatechange=function()
                        {
                            if(i.readyState==4 && i.status==200)
                            {
                                document.getElementById("show_message").innerHTML=i.responseText;	
                            }
                        };
                        
				i.open("GET","subject_allot_chk_ajax.php?semester=" + semester + "&section=" + section,true);
                        i.send();	
                } 
     </script>


 <div id="show_message" style="width:705px; height:auto; border:0px solid #003;">
    
  </div>
  -->  
<?php
	include("footer.php");
}
?> 