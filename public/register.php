<?php

    session_start();

    $con = mysqli_connect('localhost', 'root','123456', 'LegalLawzZ_registration');


    $name = $_POST['username'];
    $email = $_POST['email'];
    $regis = $_POST['reg_id'];
    $number = $_POST['number'];
    $password = $_POST['pass'];

    $s = " select * from register where regis ='$regis'";

    $result = mysqli_query($con, $s);

    $num = mysqli_num_rows($result);

    if($num == 1)
    {
        echo"user already exists";
    }
    else{

        $reg = "insert into table register (name ,email, regis, number, password) values ('$name', '$email', '$regis', '$number', '$password')";
        $result = mysqli_query($con, $reg);
        if ($result) {
            echo "User created";
        } else {
            echo "Error: "."<br>".mysqli_error($conn);
        }
    }

?>