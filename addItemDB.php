<?php
    include 'connection.php';
    header('location:home.php');

    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $info = $_POST['info'];
    $imgUrl = $_POST['imgUrl'];


    $s = "select * from userTable where name = '$name'";

    $result = mysqli_query($connect, $s);

    $num = mysqli_num_rows($result);

    if($num == 1){
        echo "Book is already registered!";
    }
    else{
        $reg= "insert into bookTable(name, category, price, info, imgurl) values ('$name','$category','$price','$info','$imgUrl')";
        mysqli_query($connect, $reg);
        echo "Registration Successful";
    }
?>