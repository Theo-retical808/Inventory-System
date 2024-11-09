<?php
// Connect to your database or define your data source
$connection1 = mysqli_connect('localhost', 'root', '', 'inventory_system');

// Get the search query from the AJAX request
$query1 = $_POST['query1'];

// Perform the search query using your preferred method
$sql1 = "SELECT * FROM product_list WHERE Serial_Code='$query1'";
$result1 = mysqli_query($connection1, $sql1);

// Process the search results
 while ($row = mysqli_fetch_assoc($result1)) {
    echo '<input type="number" id="price" name="pri" readonly min="0" size="10" value="'.$row["Sales_Price"].'">';
                }

// Close the database connection if necessary
?>

