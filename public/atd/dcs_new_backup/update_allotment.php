<?php
session_start();
$user_id=2;
  include('dbconnect.php');
  $type=mysqli_query($con,"select user_type from user_master where user_id=$user_id");
  $type=mysqli_fetch_array($type);
  if($type[0]=="admin")
    include("header_admin.php");
  else
    include("header.php");
?>
<script>
	function fetch_sub_update()
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
			
			i.open("GET","update_subject_allot.php?semester=" + sem + "&section=" + sec,true);
			i.send();
	}
	
	
	function update_allot_fn(subject_id,x)
		{	
			
			var y=document.getElementsByName("teacher_id[]");
			var teacher_uid=y[x].value;
		
			var j=new XMLHttpRequest();
			
			j.onreadystatechange=function()
			{
				if(j.readyState==4 && j.status==200)
				{
					document.getElementById("div_new").innerHTML=j.responseText;	
				}
			};
			
			j.open("GET","update_allot_ajax.php?subject_id=" + subject_id + "&teacher_id=" + teacher_uid,true);
			j.send();
			
		}
		

</script>


  <div class='col-md-12'  >
  <div class='panel panel-primary'>
    <div class='panel-heading'><h3 class='panel-title' >Update Subjects Allotted</h3></div>
    <div class='panel-body'>
    <table style='table-layout:auto; position:relative;margin-top:1%;margin-bottom:1%; margin-right:3%;'>
	
     
    
    <tr><td align="right">
    	Semester:</td><td>
         <select name="sem_choice" id="sem_choice" onChange='fetch_sub_update();' class="formCSS">
        	<option> ---- </option>
           <?php
		   	$sems_rs=mysqli_query($con,"select semester from semester_master where keyw=1");
			while($sems_rs1=mysqli_fetch_array($sems_rs))
		   	{
				$semm=$sems_rs1[0];
				echo"<option value='$semm'>"."$semm"."</option>";	
				
			}
		   
		   ?>
		 </select>        
      </td></tr>
      <tr><td align="right">   
         Section:</td><td>
          <select name="sec_choice" id="sec_choice" onChange='fetch_sub_update();' class="formCSS">
          	<option value="A"> A </option>
            <option value="B"> B </option>
          </select></td></tr>
    </table>      
        <div id="div_show" class="col-md-12">
    
    	</div>
		     </div></div>
</div>
<?php
	//include("dcs_footer.php");
//}
?> 