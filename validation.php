<?php
include 'connection.php';

$name = $_POST['user'];
$pass = $_POST['password'];
$pass = md5($pass);

$s = "select * from userTable where name = '$name' && password='$pass'";

$result = mysqli_query($connect, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $row = mysqli_fetch_array($result);
    $_SESSION['userid'] = $row['id'];
    $_SESSION['username'] = $row['name'];
    
    header('location:home.php');
}
else{
    echo "<script type='text/javascript'>alert('Your authentication information is incorrect!, Login again'); window.location.href = 'login.php';</script>";
}
?>