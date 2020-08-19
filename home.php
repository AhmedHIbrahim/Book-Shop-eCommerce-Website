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
            
            <h1 style="padding-top:10px;text-align:center;font-family: 'Open Sans', sans-serif;color:darkblue;font-weight:bolder;"> Welcome <?php echo  $_SESSION['username']; ?> !</h1>

            <!-- Add books from Database to the homepage-->
            <div class="offeredBooks">
            <ul class="nav">
            <?php
                $sql = "SELECT * FROM bookTable";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0){ 
                    while( $row = mysqli_fetch_assoc($result)){ 
                        echo '<li>';
                        echo '<img class="offeredBook" src="';
                        echo $row["imgurl"];
                        echo '" alt="'; 
                        echo $row["name"]; 
                        echo '"title="';
                        echo $row["name"];
                        echo '">';
                        echo '</li>';
                    } 
                } else 
                { echo "There are no images!"; }
            ?>
            </ul>
            </div>

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