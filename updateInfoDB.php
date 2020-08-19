<?php
    include 'connection.php';
    header('location:home.php');
    





    $name = $_POST['user'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $dateofbirth = $_POST['date'];
    $image = $_POST['image'];

    if($name != "" && $pass != "" ){
       
            $sql = "UPDATE userTable SET name = '$name', password = $pass WHERE name = '".$_SESSION['username']."'";

            if(mysqli_query($connect, $sql)){
                $_SESSION['username'] = $name;
                echo "Records were updated successfully.";
              } else {
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
              }
        
    }
    else{
        echo "No change in your Info";
    }
?>

