<?php
    include 'connection.php';
    
    if($_SESSION['username'] == ''){
        header('location:login.php');
    }

    // Taking current username and bookname
    $bookname = $_POST["bookname"];
    $username = $_SESSION['username'];

    // Getting all info abount them from DB
    $bookq = "select * from booktable where name = '$bookname'";
    $userq = "select * from usertable where name = '$username'";

    // Checking our Query
    $bresult = mysqli_query($connect, $bookq);
    $uresult = mysqli_query($connect, $userq);

    // Getting the occurance of each (usernam, bookname)
    $bnum = mysqli_num_rows($bresult);
    $unum = mysqli_num_rows($uresult);

    // Checking if they both exist
    if($bnum == 1 && $unum == 1){
        // Taking data about the two queries
        $brow = mysqli_fetch_array($bresult);
        $urow = mysqli_fetch_array($uresult);

        // Gerring book id and user id
        $bookid = $brow["id"];
        $userid = $urow["id"];
        
        // Preparing responce 
        $response = array();


        $cartq = "select * from baskettable where bookid = '$bookid' AND userid = '$userid' ";
        $cresult = mysqli_query($connect, $cartq);
        $cnum = mysqli_num_rows($cresult);
        if($cnum < 1 ){
            $reg= "insert into basketTable(userid, bookid, count) values ('$userid','$bookid', 1)";
            mysqli_query($connect, $reg);
            if($bookid != ""){
                $response['message'] = "The book is in your Cart now!";
            }
            
        }
        else{
            $response['message'] = "Book already exist in your Cart!";
        }
        echo(json_encode($response));
    }
    else{
        echo "Book not founf";
    }
?>