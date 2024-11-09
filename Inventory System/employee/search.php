<?php
// Connect to your database or define your data source
$connection = mysqli_connect('localhost', 'root', '', 'inventory_system');

// Get the search query from the AJAX request
$query = $_POST['query'];

// Perform the search query using your preferred method
$sql = "SELECT * FROM product_list WHERE Serial_Code LIKE '%$query%' OR Product_Name LIKE '%$query%' OR Unit LIKE '%$query%' OR Supplier LIKE '%$query%' OR Category LIKE '%$query%'";
$result = mysqli_query($connection, $sql);
$ctr=1;

// Process the search results
 while ($row = mysqli_fetch_assoc($result)) {
    if ($ctr%2==1){
        echo"<tr style='background-color: #99c9ff'>";
    }
    else {
        echo"<tr style='background-color: #afd2ff'>";
    }
                        echo "<td>".$row['Serial_Code']."</td>";
                        echo "<td>".$row['Product_Name']."</td>";
                        echo "<td>".$row['Unit']."</td>";
                        echo "<td>".$row['Quantity']."</td>";
                        echo "<td>".$row['Retail_Price']."</td>";
                        echo "<td>".$row['Sales_Price']."</td>";
                        echo "<td>".$row['Supplier']."</td>";
                        echo "<td>".$row['Category']."</td>";
				echo "</tr>";
                }

// Close the database connection if necessary
mysqli_close($connection);
?>
