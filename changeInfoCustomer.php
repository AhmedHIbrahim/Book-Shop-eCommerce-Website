<?php
    include 'connection.php';

    // Some attributes
    $oldusername=$_SESSION['username'];
    $msg = "";
    $detailsupdatequery="";
    $target = NULL;
    
    // Checking Login in state
    if($_SESSION['username'] == ''){
        header('location:login.php');
    }
    // If the form button ar clicked
    if(isset($_POST['insert'])){

        // Getting data from the form
        $name = $_POST['user'];
        $pass = $_POST['password'];
        $email = $_POST['email'];
        $dateofbirth = $_POST['date'];

        // Checking image uploading without errors and it is set.
        if(isset($_FILES['image']['name']) AND !($_FILES["image"]["error"])){
            // Taking image file
            $image = $_FILES['image']['name'];
            // Putting image file to new path in image folder on the server
            $target = "images/".basename($image);
            // Making a query to update user details including his image
            $detailsupdatequery="UPDATE userdetailstable SET email = '$email',dateofbirth='$dateofbirth',profileimage='$image' WHERE id = (SELECT id FROM usertable WHERE name = '$oldusername')";
        }
       else{
           // Making a query to update user details excluding his image
            $detailsupdatequery="UPDATE userdetailstable SET email = '$email',dateofbirth='$dateofbirth' WHERE id = (SELECT id FROM usertable WHERE name = '$oldusername')";
        }
        
        // Checking both of the queries
        if(mysqli_query($connect, $detailsupdatequery)){

            // Checking if the image is uploading to the image folder on the server
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                $msg = "Image uploaded successfully";
            }
            
            // Making a query to update user auth. information .. name, pass
            // encrypting password
             $pass = md5($pass);
            $userupdatequery = "UPDATE usertable SET name = '$name', password = '$pass' WHERE name = '$oldusername'";
                    
            if(mysqli_query($connect, $userupdatequery)){
                $_SESSION['username'] = $name;   
                echo '<script>alert("details are updated!");</script>';
            }
            else{
                echo '<script>alert("no details are updated!");</script>';
            }
        }
        else{
            echo '<script>alert("failed while updating your details, try again later!");</script>';
        }
      
      
      
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Information</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="webstoreScript.js" defer></script>
</head>
<body>
    <div class="sidenav">
         <?php include "./sidenav.php" ?>
     </div>
     <div class="mainbg">
        <div style="margin-top:90px;" class="col-md-6 login-left main-form">
            <h2> Update your Personal Information</h2>
            <form method="post" enctype="multipart/form-data">
                <?php
                $sqlquery="SELECT * FROM userdetailstable WHERE id = (SELECT id FROM usertable WHERE name='".$_SESSION['username']."')";
                $result = mysqli_query($connect, $sqlquery);
                $youremail="";
                if(mysqli_num_rows($result) > 0){
                    $srow = mysqli_fetch_assoc($result);
                    $youremail = $srow['email'];
                    
                }else{
                    echo '<script>console.log("no details are updated!");</script>';
                }
                ?>
                <div class="form-group">
                      <label> Username</label>
                      <input type="text" name="user" id="c_username" value= <?php echo  $_SESSION['username']; ?> class="form-control" required>
                </div>
                <div class="form-group">
                      <label> Email</label>
                      <input type="email" name="email" value="<?php echo $youremail;?>" id="c_useremail" class="form-control">
                </div>
                <div class="form-group">
                       <label> Password</label>
                       <input type="password" name="password" value="" id="c_userpassword" class="form-control" required>
                </div>
                <div class="form-group">
                      <label> Date of Birth</label>
                      <input type="date" name="date" value="<?php echo $srow["dateofbirth"];?>" id="c_userbirth" class="form-control">
                </div>
                <div class="form-group">
                       <label> Profile Image</label>
                       <input type="file" name="image" value="" id="c_userimage" class="form-control">
                </div>
                <input type="submit" name="insert" id="insert" value="Update" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>
</html>
