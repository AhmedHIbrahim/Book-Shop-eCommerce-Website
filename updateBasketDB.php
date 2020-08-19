<?php
    include 'connection.php';
    
    if(isset($_POST["bookscount"])  && $_POST["method"] == "updatebookscount"){
        
        $username = $_SESSION['username'];
        

        $bookscount = array_values($_POST["bookscount"]);
        $bookscountsize = count($bookscount);
        
        $keys = array_keys($bookscount);
        $values = array_values($bookscount);

        foreach($values as $x => $x_value) {

            $bookid = NULL;
            $bookcount = NULL;
            $value = 0;
            foreach($x_value as $y => $y_value) {
                if($value == 0){
                    $bookid = (int)$y_value;
                    $value = $value + 1;
                }
                else{
                    $bookcount = (int)$y_value;
                }
                
            }
            
            if($bookcount <= 0){
             
                $query="DELETE baskettable FROM baskettable
                INNER JOIN usertable ON baskettable.userid=usertable.id
                WHERE usertable.name = '$username' AND baskettable.bookid= '$bookid';";

                if(mysqli_query($connect, $query)){
                    $data["just"]="Book was deleted successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
            
            }
            else{
            
                $query="UPDATE baskettable INNER JOIN usertable ON baskettable.userid=usertable.id 
                SET baskettable.count = '$bookcount' WHERE usertable.name = '$username' AND baskettable.bookid='$bookid'";
                if(mysqli_query($connect, $query)){
                    $data["just"]="Book count was updated successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
                
            }
            
            $data["type"] = gettype($bookcount);
            $data[$x]=   $bookid.">>".$bookcount;
            
          }
        
        echo json_encode($data);
    }
    
?>
