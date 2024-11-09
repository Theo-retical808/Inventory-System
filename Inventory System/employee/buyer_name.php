<?php
// Connect to your database or define your data source
$connection = mysqli_connect('localhost', 'root', '', 'inventory_system');

// Get the search query from the AJAX request
$query = $_POST['query'];

// Perform the search query using your preferred method
$sql_date="SELECT DISTINCT(Buyer) FROM transaction_history WHERE Date='$query'";
$result_date=mysqli_query($connection, $sql_date);

// Process the search results
while ($sel=mysqli_fetch_array($result_date)){
    extract($sel);
    echo "<option value='$Buyer'>$Buyer</option>";
}

// Close the database connection if necessary
mysqli_close($connection);
?>