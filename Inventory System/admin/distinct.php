<?php
// Connect to your database or define your data source
$connection = mysqli_connect('localhost', 'root', '', 'inventory_system');

// Get the search query from the AJAX request
$query = $_POST['query'];

// Perform the search query using your preferred method
$sql = "SELECT * FROM product_list WHERE Product_Name LIKE '%$query%' OR Serial_Code LIKE '%$query%'";
$result = mysqli_query($connection, $sql);

// Process the search results
 while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="'.$row["Serial_Code"].'">'.$row["Serial_Code"].' - '.$row["Product_Name"].'</option>';
                }

// Close the database connection if necessary
mysqli_close($connection);
?>

