<?php
include 'connection.php';

$responce="";

// Registring user by admin UI

    $username = $_POST["username"];
    $userpass = $_POST["userpass"];
    // Encrypting password
    $userpass = md5($userpass);
    $userrole = $_POST["userrole"];

    // Checking if user alreadu exists
    $checkusersql = "select * from userTable where name = '$username'";
    $userresult = mysqli_query($connect, $checkusersql);
    
    $unum = mysqli_num_rows($userresult);
    
    if($unum == 1){
        $response['message'] = "Username is Already taken!!";
    }
    else{
        // Create user if he doesn't exist
        $reg= "insert into userTable(name, role, password) values ('$username','$userrole','$userpass')";
        if(mysqli_query($connect, $reg)){
            $query = "INSERT INTO userdetailstable(id,email,dateofbirth,profileimage) VALUES ((SELECT id FROM usertable WHERE name = '$username'),NULL,NULL,NULL)";
            if(mysqli_query($connect, $query)){
                //echo "<script type='text/javascript'>alert('Registration Successful!');</script>";
                $response['message'] = "Registration Successful!!";
            }
            else{
                $response['message'] = "Failed to Register a new user!!";
            }
        }
    }
    echo(json_encode($response));
    


?>