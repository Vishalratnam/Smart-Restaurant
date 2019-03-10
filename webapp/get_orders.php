<?php
    $servername = "localhost";
    $username = ""; //Fill this in
    $password = ""; //Fill this in
    $dbname = "restaurant";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $sql = "SELECT * FROM orders";
    $result = mysqli_query($conn, $sql);
?>

<?php
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $orders = [];
        while($row = mysqli_fetch_assoc($result)) {
            //echo "Table no: " . $row["table_no"]. " - Item ID: " . $row["item_id"]. " " . $row["timestamp"]. " ".$row["completed"]."<br>";
            if (!in_array($row["table_no"], array_keys($orders)))
            {
                $orders[$row["table_no"]] = [[$row["item_id"]], [$row['quantity']], $row["timestamp"], $row["completed"]];
            }
            else
            {
                $table_no = $row["table_no"];
                array_push($orders[$table_no][0], $row["item_id"]);
                array_push($orders[$table_no][1], $row["quantity"]);
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
            if ($v[3]){
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
            if ($v[3]){
                
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
    //print_r($orders);
    mysqli_close($conn);
?>