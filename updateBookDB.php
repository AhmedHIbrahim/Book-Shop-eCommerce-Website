<?php
    include 'connection.php';
    ///////////////////////////////////////////BOOK////////////////////////////////////////////
    ///////////////////////////////////////////search////////////////////////////////////////////////
    ///////////////////////////////////////////edit//////////////////////////////////////////////
    ///////////////////////////////////////////delete////////////////////////////////////////////////  
    
    if(isset($_POST["id"]) && isset($_POST["formname"]) && $_POST["formname"] == "searchBookForm"){
        
        $query = "SELECT * FROM bookTable WHERE id = '".$_POST["id"]."'";
        $result = mysqli_query($connect, $query);
        $num = mysqli_num_rows($result);

        if($num == 1){
            while( $row = mysqli_fetch_array($result)){
                $data["id"] = $row["id"];
                $data["name"] = $row["name"];
                $data["imgurl"] = $row["imgurl"];
                $data["category"] = $row["category"];
                $data["price"] = $row["price"];
                $data["info"] = $row["info"];
            }
            echo json_encode($data);
        }
        else{
            $data["warning"] = "No data";
        }
        
    }  elseif(isset($_POST["id"]) && isset($_POST["formname"]) && $_POST["formname"] == "editingBookForm"){
        
        $id = $_POST["id"];
        $name = $_POST["name"];
        $category = $_POST["category"];
        $price = $_POST["price"];
        $info = $_POST["info"];
        $imgurl = $_POST["imgurl"];

        
        $sql = "UPDATE `bookTable` SET 
            `name` = '$name', 
            `category` = '$category', 
            `price` = '$price', 
            `info` = '$info', 
            `imgurl` = '$imgurl' 
            WHERE `id` = '$id' ";    


        if(mysqli_query($connect, $sql)){
            echo "Book was updated successfully.";
        } else {
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }  elseif(isset($_POST["id"]) && isset($_POST["formname"]) && $_POST["formname"] == "deleteBookForm"){
        $id = $_POST["id"];

        $sql = "DELETE FROM `bookTable` WHERE `id` = '$id' ";

        if(mysqli_query($connect, $sql)){
            echo "Book was deleted successfully.";
            header('location:home.php');
        } else {
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
?>

