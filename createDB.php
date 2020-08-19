<?php

    $servername = "localhost";
    $username = "root";
    $password = "";

    // Creating connection
    $connect = mysqli_connect($servername, $username, $password);
    // Checking connection
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Creating a database named newDB
    $sql = "CREATE DATABASE IF NOT EXISTS ecommerceDB";
    if (mysqli_query($connect, $sql)) {
        
        //########CREATING USERTABLE########
        $usertablesql = "CREATE TABLE ecommerceDB.usertable (
            `id` INT(255) NOT NULL UNIQUE AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `role` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`name`));";
        
        
        if (mysqli_query($connect, $usertablesql)) {
            $user1sql="INSERT INTO ecommerceDB.usertable(`id`,`name`, `role`, `password`) VALUES (1,'admin','admin', MD5('admin'))";
            $user2sql="INSERT INTO ecommerceDB.usertable(`id`,`name`, `role`, `password`) VALUES (2,'Ahmed','customer', MD5('admin'))";
            $user3sql="INSERT INTO ecommerceDB.usertable(`id`,`name`, `role`, `password`) VALUES (3,'Gurhan','customer', MD5('admin'))";

            $user1result = mysqli_query($connect, $user1sql);
            $user2result = mysqli_query($connect, $user2sql);
            $user3result = mysqli_query($connect, $user3sql);

            if($user1result AND $user2result AND $user3result){
                echo "Database created successfully with the name ecommerceDB";
            }else{
                echo "can't create users at the moment!";
            }
            
        }else{
            echo "can't create users table at the moment!";
        }

        //########Create userdetails table
        $userdetailstablesql="CREATE TABLE ecommerceDB.userdetailstable (
            `id` INT(255) NOT NULL UNIQUE,
            `email` VARCHAR(1000) NULL,
            `dateofbirth` DATE NULL,
            `profileimage` VARCHAR(300) NULL);"; 

        
        if(mysqli_query($connect, $userdetailstablesql)){
            $duser1sql="INSERT INTO ecommerceDB.userdetailstable(`id`, `email`, `dateofbirth`, `profileimage`) VALUES (1,NULL,NULL,NULL)";
            $duser2sql="INSERT INTO ecommerceDB.userdetailstable(`id`, `email`, `dateofbirth`, `profileimage`) VALUES (2,NULL,NULL,NULL)";
            $duser3sql="INSERT INTO ecommerceDB.userdetailstable(`id`, `email`, `dateofbirth`, `profileimage`) VALUES (3,NULL,NULL,NULL)";
        
            $duser1result = mysqli_query($connect, $duser1sql);
            $duser2result = mysqli_query($connect, $duser2sql);
            $duser3result = mysqli_query($connect, $duser3sql);

            if($duser1result AND $duser2result AND $duser3result){
                echo "Database created successfully with the name ecommerceDB";
            }else{
                echo "can't create user details at the moment!";
            }
        }else{
            echo "can't create users details table at the moment!";
        }

        //#########CREATE BOOKSTABLE##########
        $booktablesql="CREATE TABLE ecommerceDB.booktable (
            `id` INT(255) NOT NULL UNIQUE AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `category` VARCHAR(255) NOT NULL,
            `price` DECIMAL(10,0) NOT NULL,
            `info` VARCHAR(1500) NOT NULL, 
            `imgurl` VARCHAR(2000) NOT NULL,
            PRIMARY KEY (`name`))";

            if(mysqli_query($connect, $booktablesql)){
                $bookssql="INSERT INTO ecommerceDB.booktable (`id`, `name`, `category`, `price`, `info`, `imgurl`) VALUES
                (1, 'Harry Potter', 'Adventure', '16', 'new Harry Poter novel', 'https://s2982.pcdn.co/wp-content/uploads/2014/08/HP_pb_new_6.jpg'),
                (2, 'In Five years', 'Romance', '500', 'In Five Years is as clever as it is moving, the rare read-in-one-sitting novel you won’t forget.” —Chloe Benjamin, New York Times bestselling author', 'https://prodimage.images-bn.com/pimages/9781982137441_p0_v4_s550x406.jpg'),
                (3, 'Little Fires Everywhere', 'Mystery', '14', 'I read Little Fires Everywhere in a single, breathless sitting. With brilliance and beauty, Celeste Ng dissects a microcosm of American society just when we need to see it beneath the microscope:', 'https://prodimage.images-bn.com/pimages/9780735224315_p0_v5_s550x406.jpg'),
                (4, 'No Easy Hope', 'Adventure', '199', 'Find your hope!', 'https://images-na.ssl-images-amazon.com/images/I/41wo6nKYpYL.jpg'),
                (5, 'The Happy Lemon', 'Children’s', '10', 'Amazing novel', 'https://marketplace.canva.com/EADaiDo2aSo/1/0/251w/canva-yellow-lemon-children-book-cover-Fb1rBcVIu2U.jpg'),
                (6, 'The Lives inside your headd', 'Adventure', '50', 'amazing science', 'https://marketplace.canva.com/EADao3x6uFI/1/0/251w/canva-green-and-pink-science-fiction-book-cover-f6ZLyPhf4-E.jpg'),
                (7, 'The Sea Around Us', 'Families & Relationships', '19', 'Written by Author: Rachel Carsonn', 'https://prodimage.images-bn.com/pimages/9780190906764_p0_v2_s550x406.jpg'),
                (8, 'Untamed', 'Adventure', '22', 'In her most revealing and powerful memoir yet, the beloved activist, speaker, and bestselling author of Love Warrior and Carry On, Warrior explores the joy and peace we discover when we stop striving to meet the expectations of the world, and start trusting the voice deep within us.', 'https://prodimage.images-bn.com/pimages/9781984801258_p0_v1_s550x406.jpg'),
                (9, 'Where the crawdads sing', 'Humor', '24', '1 NEW YORK TIMES BESTSELLING PHENOMENON More than 6 million copies sold A Reese Witherspoon x Hello Sunshine Book Club Pick A Business Insider Defining Book of the Decade', 'https://prodimage.images-bn.com/pimages/9780735219090_p0_v10_s550x406.jpg')";

                $booksresult = mysqli_query($connect, $bookssql);
                if($booksresult){
                    echo "Database created successfully with the name ecommerceDB";
                }else{
                    echo "can't create books at the moment!";
                }
            }else{
                echo "can't create books table at the moment!";
            }


            //#########CREATE BASKETTABLE##########
            $baskettablesql="CREATE TABLE ecommerceDB.baskettable (
                `id` INT(255) NOT NULL AUTO_INCREMENT,
                `userid` INT(255) NOT NULL,
                `bookid` INT(255) NOT NULL,
                `count` INT(255) NOT NULL,
                PRIMARY KEY (`id`))";

            $basketresult = mysqli_query($connect, $baskettablesql);

            if($basketresult){
                echo "Database created successfully with the name ecommerceDB";
                header('location:login.php');
            }
            else{
                echo "can't create basket table at the moment!";
            }
                
    } else {
        echo "Error creating database: " . mysqli_error($connect);
    }

    // closing connection
    mysqli_close($connect);

?>