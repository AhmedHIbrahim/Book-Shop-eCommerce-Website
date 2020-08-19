<?php
    include 'connection.php';

    if($_SESSION['username'] == ''){
        header('location:login.php');
    }
    else{
        $query = "SELECT * FROM usertable ORDER BY name ASC";
        $userresult = mysqli_query($connect, $query);

        $booksQuery = "SELECT * FROM booktable ORDER BY name ASC";
        $booksResult = mysqli_query($connect, $booksQuery);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Information</title>
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
        <div>
             <?php include "./changeInfoCustomer.php" ?>
        </div>

        <div class="col-md-6 login-right main-form">
            <h2> Manage Users</h2>
            <form action="updateUserRoleDB.php" method="post">
                <div class="form-group">
                    <select class="form-control"  name="users_list" id="users_list" required>
                        <option value="">select User</option>
                        <?php 
                            while($row = mysqli_fetch_array($userresult)){
                                echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <p>Select the new role of the user:</p>
                    <input type="radio" id="admin" name="role" value="admin">
                    <label for="admin">Admin</label><br>
                    <input type="radio" id="customer" name="role" checked="checked" value="customer">
                    <label for="customer">Customer</label><br>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>    
         <div class="col-md-6 login-left main-form">
                <h2> Register new User </h2>
                <form>
                    <div class="form-group">
                        <label> Username</label>
                        <input id="r_username" type="text" name="user" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> Password</label>
                        <input id="r_userpassword" type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <p>Role:</p>
                    <label for="role">
                    <input type="radio" id="r_adminrole" name="role" value="admin">&nbsp Admin &nbsp &nbsp &nbsp 
                    <input type="radio" id="r_customerrole" name="role" checked="checked" value="customer">&nbsp Customer</label><br>
                   
                </div>
                    <button id="registerUserBtn" type="button" class="btn btn-primary"> Register</button>
                </form>
            </div> 
         
        <div style="margin-top:30px" class="col-md-6 login-right main-form">
            <h2 id="manageBook"> Manage Books</h2>
            
            <div class="form-group">
                        <table class="table table-borderless ">
                            <tbody>
                                <tr>
                                <input type="hidden" id="searchBookDb" value="searchBookForm"/>
                                    <th>
                                        <select style="width:100%" class="form-control"  name="books_list" id="books_list" required>
                                            <option value="">select a Book</option>
                                            <?php 
                                                while($row = mysqli_fetch_array($booksResult)){
                                                    echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <button style="width:100%" id="searchBookBtn" class="btn btn-primary">Search</button>
                                    </th>
                                </tr> 
                            </tbody>
                        </table>   
            </div>
            <hr>
            <form action="#" id="editingBookForm">
                    <input type="hidden" id="editingBookFormName" value="editingBookForm"/>
                    <input type="hidden" id="bookId" value="" readonly/>
                    <div class="form-group">
                        <label> Book Name</label>
                        <input id="bookName" type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <table class="table table-borderless ">
                                <tbody>
                                    <tr>
                                        <label> Book Category ----- (Previous | New)</label>
                                        <th style="padding: 0px">
                                             <input style="width:100%" id="preBookCategory" type="text" name="category" class="form-control" readonly>
                                        </th>
                                        <th style="padding: 0px 0px 0px 10px">
                                            <select style="width:100%" id="postBookCategory" class="form-control" name="category">
                                                <optgroup label="Book Categories">
                                                    <option><--Current</option>
                                                    <option>Adventure</option>
                                                    <option>Art</option>
                                                    <option>Children’s</option>
                                                    <option>Cooking</option>
                                                    <option>Development</option>
                                                    <option>Dystopian</option>
                                                    <option>Families & Relationships</option>
                                                    <option>Guide / How-to</option>
                                                    <option>Health</option>
                                                    <option>Historical Fiction</option>
                                                    <option>History</option>
                                                    <option>Horror</option>
                                                    <option>Humor</option>
                                                    <option>Memoir</option>
                                                    <option>Motivational</option>
                                                    <option>Mystery</option>
                                                    <option>Paranormal</option>
                                                    <option>Romance</option>
                                                    <option>Science Fiction</option>
                                                    <option>Self-help / Personal</option>
                                                    <option>Thriller</option>
                                                    <option>Travel</option>
                                                    <option>Other</option>
                                                </optgroup>
                                            </select>  
                                        </th>
                                    </tr> 
                                </tbody>
                            </table>   
                        
                                                                         
                    </div>
                    <div class="form-group">
                        <label> Book Price</label>
                        <input id="bookPrice" type="number" name="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> Book Info</label>
                        <input id="bookInfo" type="text" name="info" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> Book Image URL</label>
                        <input id="bookImgUrl" type="url" name="name" class="form-control" required>
                    </div>
                    <div class="form-box">
                        <button style="width:76%" type="submit" class="btn btn-primary" id="updateBookBtn">
                        Update  </button>
                        <button type="submit"  class="btn btn-danger"  id="deleteBookBtn">
                        Delete </button>
                        <button type="button"  class="btn btn-warning"  id="cancelBtn">
                        Cancel </button>
                    </div>
                </form>
        </div>       
    </div>
</body>
</html>
