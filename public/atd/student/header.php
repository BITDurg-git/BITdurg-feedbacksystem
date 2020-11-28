<?php

include('dbconnect.php');
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<TITLE> IACTMS </TITLE>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="home.css?<?php echo time(); ?>" />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.dropbtn {
    background-color: #000066;
    color: white;
    padding: 16px;
    font-size: 20px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
    margin-top: 0%;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 110px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover 
{
    background-color: #0B3861;
    color:#fff;

}

.dropdown:hover .dropdown-content {
    display: block;
    background-color: #fff;
}

.dropdown:hover .dropbtn {
    background-color: #000;

}
</style>
</head>
<body>


<div class="container" style="background-color: #0B3861;width:auto;">
    <div class="row">
        <div class="col-md-2" align="center">
            <img src="images/bit1.png" height="150px" class="img-rounded">
        </div>
        <div class="col-md-8">

        
            <h1 align="center" style="color: #fff; font-family:'Times New Roman',George,Serif; font-size: 42px; font-weight: 800; ">Integrated Attendance And Class Test  Management System</h1>

        </div>
        <div class="col-md-2" align="center">
          
                </div>
            </div>
        </div>
    
        
       
            
        
    </div>

<div class="row">
<nav class="navbar navbar-inverse " style="margin-bottom: 0%; background-color: #0B243B  ">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li ><a href="maps.php">Home</a></li>
      <li ><a href="generate_attendance.php">Your Attendance</a></li>
   
      
      <li ><a href="logout.php">Logout</a></li>
      
    

    </ul>
  </div>
</nav>
</div>
</div>
</div>






</div>
</body>
</html>
 