<?php
    
    include 'connection.php';
   
    if(isset($_POST["pressedBookName"])){
        
        $query = "SELECT * FROM bookTable WHERE name = '".$_POST["pressedBookName"]."'";
        $result = mysqli_query($connect, $query);
        $num = mysqli_num_rows($result);

        if($num == 1){
            while( $row = mysqli_fetch_array($result)){
                $data["name"] = $row["name"];
                $data["imgurl"] = $row["imgurl"];
                $data["category"] = $row["category"];
                $data["price"] = $row["price"];
                $data["info"] = $row["info"];
            }
            echo json_encode($data);
        }
        else{
            $data["info"] = "No data";
        }
        
    }
?>