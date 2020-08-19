<?php

//
include 'connection.php';


// Normal user registration
$name = $_POST['user'];
$pass = $_POST['password'];
// To encrypt password
$passw = md5($pass);

$s = "select * from userTable where name = '$name'";

$result = mysqli_query($connect, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    echo "<script type='text/javascript'>alert('Username has been Already taken!'); window.location.href = 'login.php';</script>";
   // header('location:login.php');
}
else{
    $reg= "insert into userTable(name, role, password) values ('$name','customer','$passw')";
    if(mysqli_query($connect, $reg)){
        $query = "INSERT INTO userdetailstable(id,email,dateofbirth,profileimage) VALUES ((SELECT id FROM usertable WHERE name = '$name'),NULL,NULL,NULL)";
        if(mysqli_query($connect, $query)){
            echo "<script type='text/javascript'>alert('Registration Successful!, Login now'); window.location.href = 'login.php';</script>";
        }
    }
}
?>