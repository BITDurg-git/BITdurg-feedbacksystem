<?php

//include('header.php');

?>

<script>
	
var p=0;
var count=0;
 function check_credentials()
{
count++;

var user_name=document.getElementById("login_name").value;
var password=document.getElementById("login_pwd").value;

if(user_name=="")
{

	alert("Please enter a Username");
}

else
{
	var i=new XMLHttpRequest();
			
			i.onreadystatechange=function()
			{
				if(i.readyState==4 && i.status==200)
			{ 
					myObj = JSON.parse(this.responseText);
					p=myObj.val;
					if(p==1)
						document.form1.submit();
		
						
					else if(p==0)
					{
					document.getElementById("errormsg").innerHTML="Entered User  or password not found! Please try again";	
					 
					document.getElementById('login_name').style.borderColor = "red";
					document.getElementById('login_pwd').style.borderColor = "red";
					form1.reset();
					}
					else if(p==2)
					{
						document.getElementById("errormsg").innerHTML="More than 3 unsuccessful attempts has been done.Your account has been locked!!!";
						form1.reset();
					}
					else
					{
						document.getElementById("errormsg").innerHTML="your account is locked!Contact admin";

						form1.reset();
					}

				}
			};
			
			i.open("POST","checklogincredentials.php?login_name=" + user_name + "&password="+ password +"&count="+count ,true);
			i.send();
}
	


}


</script>


<html lang="en">
<head>
	<meta charset="utf-8">
	<TITLE> IACTMS </TITLE>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="home.css?<?php echo time(); ?>" />
</head>
<body>


<div class="col-md-12" style="background-color: #0B3861">
    <div class="row">
        <div class="col-md-2" align="center">
            <img src="images/bit1.png" height="150px" class="img-rounded">
        </div>
        <div class="col-md-8">

            <h1 align="center" style="color: #fff; font-family:'Times New Roman',George,Serif; font-size: 42px; font-weight: 800; ">Integrated Attendance And Class Test  Management System</h1>
            
          

        </div>
       
        <div class="col-md-1" align="center">
        </div>
    </div>
</div>

<div class="container"  >

	<div class="row">
	<div class="col-md-3">
		
	</div>
	<div class="col-md-6">

		<form method="post" action="checklogin.php" name="form1">
			<div class="panel panel-primary" style="margin-top: 5%;">
			<div class="panel-heading" style="background-color:#0B3861;"><h3 class='panel-title' >Enter Login Credential</h3></div>
			<div class="panel-body">
				<table class="table">
 	    <tr><td>User</td><td><input type="text" required name="login_name" id="login_name" class="form-control"></td></tr>
 		<tr><td>Password</td><td><input type="password" required name="login_pwd" id="login_pwd" class="form-control"></td></tr>
 	</table>
    <div class="col-12"> <p><input type="button" value="Login" onclick="check_credentials();" style="height:35px;width:110px;float:right;margin-right:35px;background-color:#2E64FE;font-weight:bold;color:#fff"></p></div>
    <div class="col-12"> <p style="float:right;margin-right:35px;"><a href=""><u>Forget your password?</u></a></p></div>
 			</div>
 		</div>
 	</form>
	 
	

	</div>
	<div class="col-md-3">
		
	</div>
 	</div>
	<div class="row" style="margin-bottom: 0%; ">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-6">
			<div class="panel panel-warning"  >
			<div class='panel-heading'><h3 class='panel-title' " id="errormsg" ><marquee > There is no Batch System in BE 3rd Semester. while giving attendence to 3rd semester theory  Take the option "whole class" while giving lab attendence take the option"Batch1".Do you have any problem? Please contact Admin.</marquee>
	<marquee><font color="red" >More than three unsuccessful attempts will lock your account.</font> </marquee>
</h3></div>
		</div>
			
		</div>
		<div class="col-md-3">
			
		</div>
	</div>


	
</div>
 

-->

<?php
include("footer.php");
?>
 </body>
 </html>