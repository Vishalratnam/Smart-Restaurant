<?php
    $servername = "localhost";
    $username = ""; //Fill this in
    $password = ""; //Fill this in
    $dbname = "restaurant";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM orders";
    $result = mysqli_query($conn, $sql);
    
    
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    
</head>

<body>
    <div class="jumbotron text-center">
        <h1>Orders</h1>
    </div>
    
    <div class="container-fluid" id="main">
        
    <?php
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $orders = [];
        while($row = mysqli_fetch_assoc($result)) {
            //echo "Table no: " . $row["table_no"]. " - Item ID: " . $row["item_id"]. " " . $row["timestamp"]. " ".$row["completed"]."<br>";
            if (!in_array($row["table_no"], array_keys($orders)))
            {
                $orders[$row["table_no"]] = [[$row["item_id"]], [$row['quantity']], $row["timestamp"], [$row["completed"]]];
            }
            else
            {
                $table_no = $row["table_no"];
                array_push($orders[$table_no][0], $row["item_id"]);
                array_push($orders[$table_no][1], $row["quantity"]);
                array_push($orders[$table_no][3], $row["completed"]);
            }
        }
        
        echo '<table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">Table Number</th>
                <th class="text-center">Orders</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Time</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>';
        
        foreach($orders as $k=>$v)
        {
            
            if (array_filter($v[3]) == $v[3]){
                $class = "success";
            }
            else{
                $class = "danger";
            }
            echo '<tr class="'.$class.'">';
            
            echo '<td class="text-center">'.$k."</td>";
            echo '<td>';
            if (count($v[0]) > 1){
                echo "<ul>";
                
                foreach($v[0] as $item) {
                    $sql2 = "SELECT * FROM items WHERE id=".$item;
                    $result2 = mysqli_query($conn, $sql2);
                    $row = mysqli_fetch_assoc($result2);
                    echo "<li>".$row['name']."</li>";        
                }
                echo "</ul>";
            }
            else {
                $sql2 = "SELECT * FROM items WHERE id=".$v[0][0].";";
                $result2 = mysqli_query($conn, $sql2);
                $row = mysqli_fetch_assoc($result2);
                echo $row['name'];
            }
            echo "</td>";

            echo '<td>';
            echo "<ul>";
            foreach($v[1] as $item){
                echo "<li>".$item."no </li>";
            }
            echo "</ul>";
            echo "</td>";
            
            echo '<td class="text-center">'.$v[2]."</td>";
            
            echo '<td class="text-center">';
            if (array_filter($v[3]) == $v[3]){
                
                echo '<h3><span class="label label-success">Completed</span></h3>';
            }
            else{
                echo '<h3><span class="label label-danger">Not Completed</span></h3>';
            }
            echo "</td>";
            
            echo "<tr/>";
           }
        }
        else {
        echo '<div class="jumbotron text-center"><h2>No Orders<h2></div>';
    }

    echo "</tbody></table><br>";

    echo '<h1 class="heading">Bills to be sent</h1>';
    
    echo '<form action="bill.php" method="POST">';
    foreach($orders as $k=>$v)
    {
        echo "<p>Generate Bill for table number $k:&nbsp;";
        if (array_filter($v[3]) == $v[3])
        {
            echo '<button class="btn btn-info" type="submit" name="bill" value="'.$k.'">Generate Bill</button>';
        }
        echo "</p>";
    }

    echo '</form>';
    mysqli_close($conn);
?>


    </table>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script>
        $.ajaxSetup({
            async: true,
            cache: false
        });
        
        (function worker() {
            $.ajax({
                url: 'get_orders.php', 
                success: function(data) {
                    $('#main').html(data);
                },
                complete: function() {
                    // Schedule the next request when the current one's complete
                    setTimeout(worker, 5000);
                }
            });
        })();
    </script>
</body>

</html>
