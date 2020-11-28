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
	//include ("back_button.php");
?>
<script>
	function form_feed_val()
	{
		var x= document.getElementById("studentt").value;
		if(x=='')
		{
			alert("Number of students can't be EMPTY!");	
		}	
		else{
				document.form1.submit();
			}
	}
</script>


<form action="new_batch_rcv.php" name="form1" method="post">

<div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Insert New Batch</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>
<tr><td colspan=2 id='show_message' ></td></tr>
   
   
     <tr><td align="right">Batch:</td><td>
     
     <select name="batch_year" id="batch" class="formCSS" onchange="check_entry();">
        	<option value="0">Select Batch </option>
            
            <option value="2017"> 2017 </option>
            <option value="2018"> 2018 </option>
            <option value="2019"> 2019 </option>
            <option value="2020"> 2020 </option>
            <option value="2021"> 2021 </option>
            <option value="2022"> 2022 </option>
            <option value="2023"> 2023 </option>
            <option value="2024"> 2024 </option>
            <option value="2025"> 2025 </option>
            
		 </select>
     
     </td></tr>
   
	<tr><td align="right">Semester:</td><td><input type="number" name="semester"  disabled value="3" class="formCSS"></td></tr>
    <tr><td align="right">Section:</td><td>
    <select name="section" class="formCSS" onchange="check_entry();" id="sec">
    <option value="">Select Section</option>
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="D">D</option>
    <option value="E">E</option>

    </select></td></tr>
    <tr><td align="right">Number of students:</td><td><input type="number" id="studentt" name="number_of_students" class="formCSS" onfocus="check_entry();"></td></tr>
    <tr><td align="right">Batch:</td><td>
     
     <select name="batch_class"  class="formCSS"">
            <option value="1">B1 </option>
            <option value="2"> B2 </option>
            
           
            
         </select>
     
     </td></tr>

     <tr><td align="center" colspan="2"><input  type="button" value="Submit" class='button' onclick="form_feed_val();" ></td></tr>

</table>

</form>
</div><!-- EO workBox-->
<script>
                function check_entry()
                {
                    var batch=document.getElementById("batch").value;
					var sec=document.getElementById("sec").value;
                                       
                    var i=new XMLHttpRequest();
                        
                        i.onreadystatechange=function()
                        {
                            if(i.readyState==4 && i.status==200)
                            {
                                document.getElementById("show_message").innerHTML=i.responseText;	
                            }
                        };
                        
						i.open("GET","batch_chk_entry_ajax.php?batch=" + batch + "&sec=" + sec,true);
                        i.send();	
                } 
 </script>
 



<?php
include("footer.php");
}
?>