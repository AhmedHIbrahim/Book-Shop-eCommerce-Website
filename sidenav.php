<?php
    
    
    include 'connection.php';
    
    if($_SESSION['username'] == ''){
        header('location:login.php');
    }
    else{
        $query="SELECT * from usertable WHERE name = '".$_SESSION['username']."'";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            
        }
    }
    $imgquery="SELECT profileimage from userdetailstable WHERE id = (SELECT id FROM usertable WHERE name = '".$_SESSION['username']."')";
    $imgresult = mysqli_query($connect,$imgquery);

?>
<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
        <div style='margin-left:15px;margin-bottom:16px;' id='img_div'>   
        <?php
            while ($nrow = mysqli_fetch_array($imgresult)) {
                if($nrow['profileimage'] != NULL){
                echo "<img style='background-color:white;border:2px solid #007bff;border-radius:100%;padding:5px;height:50px;width:50px' src='images/".$nrow['profileimage']."' >";
                }else{
                    echo "<img style='background-color:white;border:2px solid #007bff;border-radius:100%;padding:5px;height:50px;width:50px' src='./images/boy.png' >";
                }
            }
        ?>
        </div>
        <div style="text-align:center; box-sizing: border-box;">
            
            <div class="iconGroup">
                 <div class="tinybox"></div>
                <a href="home.php"><img class="barIcon" src="./images/homepage.png" alt="homepage" title="homepage"></a>
                <!--
                <?php
                    if($row["role"]=="admin"){
                        echo '<a href="searchBook.php"><img class="barIcon" src="./images/search.png" alt="searchBook" title="search Book"></a>
                        ';
                    }
                    
                ?>
                -->
                <?php
                    if($row["role"]=="admin"){
                        echo '<a href="addItem.php"><img class="barIcon" src="./images/upload.png" alt="uploadBook" title="Upload Book"></a>
                        ';
                    }
                    
                ?>
                <a href="yourBasket.php"><img class="barIcon" src="./images/basket.png" alt="basket" title="Your Basket"></a>
                <a href="redirectPerson.php"><img class="barIcon" src="./images/person.png" alt="personal" title="Edit your informatin"></a>
                <a href="logout.php"><img class="barIcon" src="./images/login.png" alt="homepage" title="Logout"></a>
            </div>
        </div>
</body>
</html>