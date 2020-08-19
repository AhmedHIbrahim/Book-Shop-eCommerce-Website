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
                echo $row["role"];
                if($row["role"]=="admin"){
                    header('location:changeInfoAdmin.php');
                }
                else{
                   header('location:changeInfoCustomer.php');
                }
            }
        }
?>