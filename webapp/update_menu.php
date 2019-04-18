<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
 
        <h1 class="heading jumbotron text-center">Update Menu</h1>
        
        <form action="insert.php" method="POST">
            
            <div class="form-group">
                <label for="itemName">Enter Item Name:</label>
                <input type="text" class="form-control" id="itemName" name='itemName' aria-describedby="emailHelp" placeholder="Enter item name" required>
            </div>
            
            <div class="form-group">
                <label for="itemCategory">Category:</label>
                <input type="text" class="form-control" id="itemCategory" name='itemCategory' placeholder="Enter category" required>
            </div>
            
            <div class="form-group">
                <label for="itemPrice">Price:</label>
                <input type="text" class="form-control" id="itemPrice" name='itemPrice' placeholder="Enter price" required>
            </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
        
        </form>
 
    </div>

</body>
</html>