<?php
// Connect to your database or define your data source
$connection2 = mysqli_connect('localhost', 'root', '', 'inventory_system');

// Get the search query from the AJAX request
$query2 = $_POST['query2'];

// Perform the search query using your preferred method
$sql2 = "SELECT * FROM product_list WHERE Serial_Code='$query2'";
$result2 = mysqli_query($connection2, $sql2);

// Process the search results
 while ($row2 = mysqli_fetch_assoc($result2)) {
    echo '<input type="number" name="quantity" id="quantity" readonly required min="0" value="'.$row2["Quantity"].'" size="10">';
                }

// Close the database connection if necessary
?>