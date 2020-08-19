
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
    <title>Add new Book</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="box addItem" id="addBookDiv">
    <div class="sidenav">
         <?php include "./sidenav.php" ?>
     </div>
    <div class="col-md-6 login-left main-form">
                <h2> Add a new Book</h2>
                <form action="addItemDB.php" method="post" name="addBookForm">
                    <div class="form-group">
                        <label> Book Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> Book Category</label>
                        <select class="form-control" name="category">
                            <optgroup label="Book Categories">
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
                    </div>
                    <div class="form-group">
                        <label> Book Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> Book Info</label>
                        <input type="text" name="info" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> Book Image URL</label>
                        <input type="url" name="imgUrl" class="form-control" required>
                    </div>
                    <div class="form-box">
                    <button type="submit" class="btn btn-primary" id="button-share" onclick="submitForm()" >
                    Share  </button>
                    <button type="button"  class="btn btn-danger"  id="button-cancel"  onclick="reset()" >
                    Cancel </button>
                  </div>
                </form>
            </div>
</body>
</html>