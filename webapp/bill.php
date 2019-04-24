<?php
    $servername = "localhost";
    $username = ""; //Fill this in
    $password = ""; //Fill this in
    $dbname = "restaurant";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill</title>
</head>
<body>
    <div class="container">
    <h1 class="heading jumbotron text-center">Bill</h1>
    <?php
        $table_no = $_POST['bill'];
        
        $sql = "SELECT table_no, SUM(quantity * price) AS total FROM orders, items WHERE orders.item_id = items.id AND table_no = $table_no GROUP BY table_no";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];

        $insert = "INSERT INTO completed_orders VALUES($table_no, $total)";
        $result = mysqli_query($conn, $insert);

        echo '<table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">Table Number</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>';
        echo '<tr>
        <td>'.$table_no.'</td>
        <td>'.$total.'</td>
        </tr>';
        echo '</tbody></table>';
        echo '<a href="index.php"><button class="btn btn-info">Go Back</button></a>';
        $del = "DELETE FROM orders WHERE table_no = $table_no";
        $result = mysqli_query($conn, $del);
        mysql_close($conn);
    ?>
    
    </div>
    
</body>
</html>