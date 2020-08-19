<?php
    include 'connection.php';

    /*
    if($_SESSION['username'] == ''){
        header('location:login.php');
    }*/
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homepage</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;1,600&display=swap" rel="stylesheet">
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
        <div class="main">
            
            <form action="">
                <label>This page will be implemented soon!</label>
                <table>
                <tbody>
                <tr>
                <td>
                <input style="width:100%" class="form-control" type="text" name="search">
                
                </td>
                <td>
                <input style="width:100%" class="btn btn-primary" type="submit" name="submit"> 
                </td>
                </tr>
                </tbody>
                </table>
                           
            </form>
            <!-- Showing the details of the book onclick of book's cover-->
        </div>
        <div class="detailsHolder ">
                <table class="table table-borderless ">
                    <tbody>
                        <tr>
                            <th>
                                <button style="width:100%;" class="btn btn-primary" id="addCartBtn">Add to your Cart</button>
                            </th>
                            <th rowspan="6" >
                                <button style="width:100%;" class="btn btn-danger"  id="button-hide" >hide</button>
                            </th>
                            
                        </tr>
                        <tr>
                        <td><img style="height:300px; width:auto;" class="offeredBook" id="bookImg" src="" alt=""></td>
                        </tr>
                        <tr>
                        <td><p class="dHolder"> Name:<br /><span id="bookName"></span></p></td>
                        </tr>
                        <tr>
                        <td><p class="dHolder"> Category:<br /><span id="bookCategory"></span></p></td>
                        </tr>
                        <tr>
                        <td><p class="dHolder">Price:<br /><span id="bookPrice"></span> $</p></td>
                        </tr>
                        <tr>
                        <td><p class="dHolder">Info:<br /><span id="bookInfo"></span></p></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>