<?php
// Connect to your database or define your data source
$connection = mysqli_connect('localhost', 'root', '', 'inventory_system');

// Get the search query from the AJAX request
$query1 = $_POST['query1'];
$query2 = $_POST['query2'];

// Perform the search query using your preferred method
$sql_date="SELECT * FROM transaction_history WHERE Buyer='$query1' AND Date='$query2'";
$product_result=mysqli_query($connection, $sql_date);
$row_count=mysqli_num_rows($product_result);
$ctr = 1;
// Process the search results
if($row_count>0){
    while($row = mysqli_fetch_array($product_result)) {
    $ctr++;
    extract($row);
    if ($ctr%2==1){
        echo"<tr style='background-color: #99c9ff'>";
    }
    else {
        echo"<tr style='background-color: #afd2ff'>";
    }
    echo "
     <td>$Reference_Code</td>
     <td>$Buyer</td>
     <td>$Products</td>
     <td>$Quantity</td>
     <td>$Total_Price</td>
     <td>$Date</td>
</tr>";
}
} else {
    echo "<td colspan='6' style='background-color: #99c9ff; font-size: 20px;'><b>No Transaction Found</b></td>";
}


// Close the database connection if necessary
mysqli_close($connection);
?>