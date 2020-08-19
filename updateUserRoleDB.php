<?php
    include 'connection.php';
    header('location:changeInfoAdmin.php');



    $id = $_POST['users_list'];
    $role = $_POST['role'];

    
    if($id != "" && $role != "" ){
       
        $sql = "UPDATE userTable SET role = '$role' WHERE id = '".$id."'";

        if(mysqli_query($connect, $sql)){
            echo "User Role was updated successfully.";
        } else {
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    
}
else{
    echo "No change in user Info";
}
?>

