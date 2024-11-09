<html>
    <head> 
		  <!-- put this logo in the upper-left side
            <img src="" height="100px" width="1000px" class="logo"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Menui.css">
		<title>Inventory System - Inventory</title>
		 <!-- put this on the upper-right side  -->

    </head>
	<script src="JQuery/jquery-3.7.0.min.js"></script>
	<style>
			td {
				text-align: center;
			}
			.profile-pic img{
    width: 175px;
	height: 90px;
	border-radius: 32px;
	border: 2px solid #cddc39;
	filter: drop-shadow(0 0 8px #ff5722);
  margin-left: 10px;
   }

   .sidenav a{
    color:black;
   }
   .sidenav a:hover{
    color: #f1f1f1;
	background-color: #498bdb;
   }
   .user-name {
    color: black;
   }
   .outer-wrapper {
    margin: 3px;
    margin-left: 20px;
    margin-right: 20px;
    border: 1px solid black;
    border-radius: 4px;
    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.9);
    max-width: fit-content;
    max-height: 300px;
  
}
   .inner-wrapper {

overflow-y: scroll;
height: 270px;
max-height: 66.4vh;

margin-top: 3px;

margin: 15px;
padding-bottom: 3px;

}
   
	</style>
    <body>
	<div class="bodymain">
	<header>
	<div class="date">
    <p>
      <?php
      date_default_timezone_set('Asia/Manila');
      ?>
      Date: <?= date ('m/d/Y');?> <?= date ('h:i A'); ?> </p>
  </div>
<div class="sidenav">
  <div class="profile-pic">
  <img src="img/CompanyLogo.png"/>
  </div>
  <div class="user-name">
  Employee
  </div>
  <a href="Dashboard.php">Dashboard</a> 
    <a href="sell.php">Transaction</a>
    <a href="inventory.php">Inventory</a>
    <a href="history.php">Transaction History</a>
</div>


</header>
<div class="main">
<h3>INVENTORY</h3>
<div class="search-box">
			<input type="text" id="search" placeholder="Search"/>
		</div>
		<div class="outer-wrapper"><div class="inner-wrapper">
		<table border='1' cellspacing='0'>
			<thead>
			<tr>
		 		<th style='background-color: #0091db; color: black'>Serial Code</th>
		 		<th style='background-color: #0091db; color: black'>Product Name</th>
		 		<th style='background-color: #0091db; color: black'>Unit</th>
		 		<th style='background-color: #0091db; color: black'>Quantity</th>
				<th style='background-color: #0091db; color: black'>Retail Price</th>
		 		<th style='background-color: #0091db; color: black'>Sales Price</th>
				<th style='background-color: #0091db; color: black'>Supplier</th>
				<th style='background-color: #0091db; color: black'>Category</th>
				</tr>
			</thead>
			<tbody id='result'>
<?php 
    include 'inv.php';

			$product_query1 = "select * from product_list";
			$product_result = mysqli_query($conn, $product_query1);

		
		$ctr=1;

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
			 <td>$Serial_Code</td>
			 <td>$Product_Name</td>
			 <td>$Unit</td>
			 <td>$Quantity</td>
			 <td>$Retail_Price</td>
			 <td>$Sales_Price</td>
			 <td>$Supplier</td>
			 <td>$Category</td>
        </tr>";
		}
	?>
	</tbody>
	</table>
		</div></div>
	<hr>
	<!-- Show Maintenance -->
<?php
include 'inv.php';
	if(isset($_GET['edit'])){
		$code=$_GET['edit'];
		
		$sql_edit="SELECT * FROM product_list WHERE Serial_Code='$code'";
		$query_edit=mysqli_query($conn, $sql_edit);
		$fetch_edit=mysqli_fetch_assoc($query_edit);
		echo '
		<table>
		
		<thead>
			<tr>
				<th colspan="7" style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Product Maintenance</th>
			</tr>
			<tr>
				<th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Serial Code</th>
				<th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Product</th>
				<th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Unit</th>
				<th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Quantity</th>
				<th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Retail Price</th>
				<th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Sales Price</th>
			</tr>
		</thead>

		<tbody>
		<form action="" method="get">
				<tr>
					<td><input name="cod" value="'.$fetch_edit['Serial_Code'].'" readonly="readonly"></td>
					<td><input type="text" value="'.$fetch_edit['Product_Name'].'" readonly></td>
					<td><input type="text" value="'.$fetch_edit['Unit'].'" readonly></td>
					<td><input type="number" size="5" name="quan" value="'.$fetch_edit['Quantity'].'"></td>
					<td><input type="number" size="5" name="ret" value="'.$fetch_edit['Retail_Price'].'"></td>
					<td><input type="number" size="5" name="sal" value="'.$fetch_edit['Sales_Price'].'"></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="7" class="btn"><input type="submit" name="update" value="Update"></td>
				</tr>
				</form>
		</tbody>

		</table>
		
		
		 
		';
	}
?>
</div>
</div>
	
</div>
</div>
</div>
	</body>	
</html>

<?php
	if(isset($_GET['update'])){
		include 'inv.php';
		
		$c=$_GET['cod'];
		$q=$_GET['quan'];
		$r=$_GET['ret'];
		$s=$_GET['sal'];
		$sql_update="UPDATE product_list SET Quantity='$q', Retail_Price='$r', Sales_Price='$s' WHERE Serial_Code='$c'";
		$sql_update_result=mysqli_query($conn, $sql_update);
		if($sql_update_result){
			echo "<script>alert('Data Updated'); location.assign('inventory.php');</script>";
		}

	}
?>

<script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                var query = $(this).val();

                if (query !== '') {
                    $.ajax({
                        url: 'search.php',
                        method: 'POST',
                        data: { query: query },
                        success: function(data) {
                            $('#result').html(data);
                        }
                    });
                } 
				else {
                    $('#result').html('');
                }
            });
        });
    </script>
