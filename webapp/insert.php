<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <?php
        $servername = "localhost";
        $username = ""; //Fill this
        $password = ""; //Fill this
        $dbname = "restaurant";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO items (id, name, category, price, image_path) VALUES (NULL, '".$_POST['itemName']."','".$_POST['itemCategory']."','".$_POST['itemPrice']."', '');";
        
        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success text-center'><h2>New menu item added successfully!<h2></div>";
            echo "<a href='update_menu.php'>Click here!</a> to go back to update page.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    ?>
    </div>  
</body>
</html>