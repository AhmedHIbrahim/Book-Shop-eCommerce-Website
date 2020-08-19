<?php
    include 'connection.php';

    if($_SESSION['username'] == ''){
        header('location:login.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="webstoreScript.js" defer></script>
    
    
</head>
<body>
    <div class="sidenav">
         <?php include "./sidenav.php" ?>
    </div>
    <div class="mainbg">
        <div class="col-md-6 login-left main-form">
            <h2> Your Shopping Cart</h2>
            <form action="addItemDB.php" method="post" name="addBookForm">
                        <table class="table table-borderless ">
                            <tbody>
                                    <tr>
                                        <th>
                                            <div class="form-group">
                                            <label> Book Name</label>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="form-group">
                                            <label> Price</label>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="form-group">
                                            <label> Count</label>
                                            </div>
                                        </th>
                                        <th>
                                    <button type="button" title="save changes" class="btn btn-success"  id="saveBasketBtn">Save Changes!</button>
                                    </th>
                                    </tr>
                                    <hr>
                                    <?php
                                        $sql = "SELECT  booktable.id, booktable.name, booktable.category, booktable.imgurl, booktable.info, booktable.price, baskettable.count 
                                        FROM baskettable INNER JOIN booktable ON baskettable.bookid=booktable.id
                                        INNER JOIN usertable ON baskettable.userid=usertable.id WHERE usertable.name='".$_SESSION['username']."'";

                                        $result = mysqli_query($connect, $sql);
                                        if (mysqli_num_rows($result) > 0){ 
                                            $rows = [];
                                            while( $row = mysqli_fetch_assoc($result)){ 
                                                
                                                
                                                // append to array
                                                $rows[] = $row; 
                                                
                                                echo '<tr class="bookrow" id="';
                                                echo $row["id"];
                                                echo '"><th style="width:50%;"><div class="form-group">';
                                                echo '<input type="text" style="margin: 0px;
                                                height: 38px;
                                                width: 100%;
                                                padding-left: 10px;
                                                border: 0;" name="bookname" value="';
                                                echo $row["name"];
                                                echo '" title="';
                                                echo $row["name"];
                                                echo '" class="offeredBook form-control" readonly>';
                                                echo '</div></th><th style="width:15%;><div class="form-group"><input type="text" name="bookprice" value="';
                                                echo $row["price"];
                                                echo ' $" class="form-control" readonly>';
                                                echo '</div></th><th style="width:10%;"><div class="form-group">';
                                                echo '<input type="text" min="1" name="counter[';
                                                echo $row["id"];
                                                echo ']" value="';
                                                echo $row["count"];
                                                echo '" class="form-control counterValue" readonly>';
                                                echo '</div></th><th  style="width:30%;"><div class="form-box">';
                                                echo '<button type="button" title="increment" data-type="plus" class="operationBtn btn btn-primary" id="incrementBtn" data-field="counter[';
                                                echo $row["id"];
                                                echo ']">&#10138;</button><button style="margin-left:5px;" type="button" data-type="minus" title="decrement" class="operationBtn btn btn-warning"  id="decrementBtn" data-field="counter[';
                                                echo $row["id"];
                                                echo ']">&#10136;</button><button style="margin-left:5px;" type="button" data-type="delete" title="delete" class="operationBtn btn btn-danger"  id="deleteBtn" data-field="counter[';
                                                echo $row["id"];
                                                echo ']">&#9751;</button>';
                                            echo '</div></th></tr>';
                                            } 
                                            echo "<script> var basket_books = " . json_encode($rows) . "; </script>";
                                        } else 
                                        { echo "<h1>There are no Books in your Cart!</h1>"; }
                                    ?>
                                    <tr>
                                        <th colspan="1">
                                        <a href="#paymentForm"><button type="button" style="padding: 18px;width:100%" title="check out" class="btn btn-primary"  id="checkOutBtn">Check Out</button></a>
                                        </th>
                                        <th colspan="2">
                                            <input type="text" style="font-weight:bold;background-color:#dfeeff;padding: 19px;height: 100%;width:100%" name="totalPrice" id="basketTotalPrice" value="0" class="form-control" readonly>
                                        </th>
                                        <th>
                                            <a href="home.php"><button type="button" onclick="" style="width:100%" title="homepage" class="btn btn-primary"  id="continueShoppingBtn">Continue Shopping</button></a>
                                        </th>
                                        
                                    </tr>
                            </tbody>
                        </table>
                    </form>
        </div>
        <div id="paymentForm" style="display:none;">
            <div  class="col-md-6 login-left main-form">
                <form action="#" id="">
                    <div class="">
                        <h3>Payment</h3>
                        <label for="fname">Accepted Cards</label>
                        <div class="icon-container">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                        </div>
                        <div class="form-group">
                            <label for="cname">Name on Card</label>
                            <input class="form-control" type="text" id="cname" name="cardname" placeholder="Omar M. Yildiz" required>
                        </div>    
                        <div class="form-group">
                            <label for="ccnum">Credit card number</label>
                            <input class="form-control" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
                        </div>
                        
                        <div class="form-group">
                                <label for="expmonth">Exp(Month:Year)</label>
                                <input class="form-control" type="month" id="expmonth" name="expmonth" required>
                        </div>
                        <div class="col-50 form-group">
                                <label for="cvv">CVV</label>
                                <input class="form-control" type="text" id="cvv" name="cvv" placeholder="352" required>
                        </div>
                        
                    </div>
                    
                    <div>
                            <h3>Billing Address</h3>
                            <div class="form-group">
                                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                <input class="form-control" type="text" id="fname" name="firstname" placeholder="Omar M. Yildiz" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                <input class="form-control" type="text" id="email" name="email" placeholder="omar@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                <input class="form-control" type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
                            </div>
                            <div class="form-group">     
                                <label for="city"><i class="fa fa-institution"></i> City</label>
                                <input class="form-control" type="text" id="city" name="city" placeholder="Mugla" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="state">State</label>
                                <input class="form-control" type="text" id="state" name="state" placeholder="Mentese" required>
                            </div>
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input class="form-control" type="text" id="zip" name="zip" placeholder="48000" required>
                            </div>
                            
                        </div>
                        <label>
                            <input type="checkbox" checked="checked" name="sameadr"> Accept <a style="color:#031837" target="_blank" href="https://www.gdpr-info.eu">Privacy Policy</a>
                        </label>
                        <div class="form-box">
                            <button onclick="alert('We will contact you soon!');" style="width:100%" type="submit" class="btn btn-primary" id="updateBookBtn">
                            Continue to Check out  </button>
                            
                        </div>
                        
                    </form>
            </div>
        </div>
        <div class="detailsHolder" style="display:none; width:275px">
                <table class="table table-borderless ">
                    <tbody>
                        <tr>
                            <th >
                                <button style="float:left;;" class="btn btn-danger"  id="button-hide" > <img style="height:20px; width:auto" src="images/hide.png" alt="hide book details"></button>
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
    </div>
</body>
</html>