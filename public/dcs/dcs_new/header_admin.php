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
          
                  <div class="col-md-12">
                    <img src=
                    <?php
                    $path=mysqli_query($con,"select image_path from user_master where user_id=$user_id");
                    $path=mysqli_fetch_array($path);
                    //$path1="facultyimg/".$path[0];
                    //echo $path[0];
                    echo "facultyimg/".$path[0];
                    ?> height="110px" alt="facultyimg/alt.jpg" class="img-rounded">
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown">
                         <font size=4px color=#fff>
                         <?php
                                 $user_name=mysqli_query($con,"select name from user_master where user_id=$user_id");
                                    $user_name_rs=mysqli_fetch_array($user_name);
                                     echo "<b>".$user_name_rs[0];
                            ?> </font>
                <div class="dropdown-content">
                 <a href="update_your_profile1.php">My Profile</a>
                  <a href="upload_image.php">Upload your image</a>
                    <a href="change_password.php">Password</a>
                    <a href="logout.php">Logout</a>
                </div>
                </div>
            </div>
        </div>
    
        
       
            
        
    </div>

<div class="row">
<nav class="navbar navbar-inverse " style="margin-bottom: 0%; background-color: #0B243B  ">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li ><a href="maps.php">Home</a></li>
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Add new
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
          <li ><a href="new_batch.php">Batch</a></li>
          <li><a href="add_faculty.php">Faculty</a></li>
          <li ><a href="add_student.php">Student</a></li>
        </ul>
      </li>
       <li ><a href="generate_attendance.php">Attendance Report</a></li>
       <li ><a href="print_redlist.php">BlackList Report</a></li>
       <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Edit
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
          <li ><a href="Update_attendance.php">Attendance</a></li>
          <li><a href="#">Allotment</a></li>
           <li ><a href="update_subject.php">Subject</a></li>
          <li ><a href="update_student.php">Student</a></li>

          <li ><a href="delete_attendance.php">Delete Attendance</a></li>
        </ul>
      </li>
      <li ><a href="allot_subject.php">Subject Allotment</a></li>
      <li ><a href="status_of_users.php">Status of users</a></li>
       <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Other Reports
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
          <li ><a href="generate_compare.php">Compare Attendance</a></li>
          <li ><a href="remedial_class.php">Remedial Class List </a></li>
        </ul>
      </li>
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Semester
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
          <li ><a href="update_semester.php">Increment</a></li>
          <li><a href="decrement_semester.php">Decrement</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Validate 
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="validate_sem.php">Semester</a></li>
       <li><a href="validate_monthes.php">Month</a></li>
        <li><a href="1.php">Faculty Options</a></li>

        </ul>
      </li>

       <li><a href="admin_review.php">Admin Review</a></li>
       


    </ul>
  </div>
</nav>
</div>
</div>
</div>






</div>
</body>
</html>
 