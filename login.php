<?php

    include 'connection.php';
    
    if (isset($_SESSION['username'])){
        header('location:home.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;1,600&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="webstoreScript.js" defer></script>
</head>
<body>
    
    <div class="container"> 
        <form action="createDB.php" method="POST" >
            <div class="db">
                <?php
                                
                     $servername = "localhost";
                     $username = "root";
                     $password = "";
                            
                     // Creating connection
                    $connect = mysqli_connect($servername, $username, $password);           
                    $usertableexistance = mysqli_query($connect,"DESCRIBE ecommercedb.usertable");
                    $userdetailstableexistance = mysqli_query($connect,"DESCRIBE ecommercedb.userdetailstable" );
                    $booktableexistance = mysqli_query($connect,"DESCRIBE ecommercedb.booktable" );
                    $baskettableexistance = mysqli_query($connect,"DESCRIBE ecommercedb.baskettable" );

                    if ($usertableexistance AND $userdetailstableexistance AND $booktableexistance AND $baskettableexistance) {
                        echo "<script>
                           
                            $(document).ready(function(){
                                $('#createDbBtn').click(function(){
                                    alert('Database already exists!');
                                    return false;
                                });
                              });
                            </script>";
                    }
                    else{
                        echo "<script>
                            alert('Database doesn't exist,Click on the Create DB button to create it!');</script>";
                    }
                                
                ?>
                    <input type="submit" name="createDbBtn" id="createDbBtn" value="Create DB" class="btn btn-warning">
                    <img style="margin-top:5px;height:40px" src="./images/round.png" alt="get info" onclick="alert('The DB contains three users, admin , and (Gurhan and Ahmed as customers). To have alook at this website, you have to login')">
            </div>
        </form>
        <div class="login-box">
        <div class="row">
            <div class="col-md-6 login-left">
                <h2> Login here</h2>
                <form action="validation.php" method="post">
                    <div class="form-group">
                        <label> Username</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary"> Login</button>
                </form>
            </div>
            <div class="col-md-6 login-right">
                <h2> Register here</h2>
                <form action="registration.php" method="post">
                <div class="form-group">
                        <label> Username</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary"> Register</button>
                </form>
            </div>
        
        </div>
        </div>
    </div>
    
</body>
</html>