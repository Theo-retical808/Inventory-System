<html>
    <head> 
		  <!-- put this logo in the upper-left side
            <img src="" height="100px" width="1000px" class="logo"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Menui.css">
		<title>Inventory System - Inventory</title>
		 <!-- put this on the upper-right side  -->
    </head>
	<style>
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
  Admin
  </div>
  <a href="Dashboard.php">Dashboard</a> 
    <a href="sell.php">Transaction</a>
    <a href="inventory.php">Inventory</a>
    <a href="order.php">Order Product</a>
    <a href="product.php">Products</a>
    <a href="supplier.php">Supplier</a>
    <a href="history.php">Transaction History</a>
    <a href="users.php">Users</a>
</div>


</header>
<div class="main" style="margin-top: 10px;">
<h3>ORDER PRODUCT</h3>
<div class="outer-wrapper"><div class="inner-wrapper">
	<form action="" method="get">
			<table border='1' cellspacing='0'>
			<tr>
		 <th style='background-color: #0091db; color: black'>Serial Code</th>
		 <th style='background-color: #0091db; color: black'>Product Name</th>
		 <th style='background-color: #0091db; color: black'>Unit</th>
		 <th style='background-color: #0091db; color: black'>Quantity</th>
		 <th style='background-color: #0091db; color: black'>Retail Price</th>
		 <th style='background-color: #0091db; color: black'>Sales Price</th>
		 <th style='background-color: #0091db; color: black'>Action</th>
		 </tr>
		</div>
        <?php 
    include 'inv.php';
		
		
		if(isset($_GET['search'])){
			$search = $_GET['find'];
			$or_query2 = "select * from incoming_order where Serial_Code LIKE '%$search%' or Product_Name LIKE '%$search%' or Quantity LIKE '%$search%' or Retail_Price LIKE '%$search%' or Sales_Price LIKE '%$search%' or Supplier LIKE '%$search%' or Category LIKE '%$search%'";
			$or_result = mysqli_query($conn, $product_query2);
		}
		else {
			$or_query1 = "select * from incoming_order";
			$or_result = mysqli_query($conn, $or_query1);

		}
		
		$ctr=1;
		

		 while($or_row = mysqli_fetch_array($or_result)) {
			$ctr++;
			if ($ctr%2==1){
				echo"<tr style='background-color: #ff7b00'>";
			}
			else {
				echo"<tr style='background-color: #ffe200'>";
			}
			echo "
			 <td>".$or_row['Serial_Code']."</td>
			 <td>".$or_row['Product_Name']."</td>
			 <td>".$or_row['Unit']."</td>
			 <td>".$or_row['Quantity']."</td>
			 <td>".$or_row['Retail_Price']."</td>
			 <td>".$or_row['Sales_Price']."</td>
			 <td><a href='order.php?Del=".$or_row['Serial_Code']."'>Delete</a></td>
        </tr>";
		}
		
	?>
	
	</table>
</div></div>
				
	<div class="btn" style="text-align: right;">
	<input type="submit" name="add" value="Confirm Products" >
	</div>
</form>
	<hr>
	<div class="maintenance" style="margin-left: 0%; margin-rigt: 40%;">
		<form action="" method="get">
			<table>
				<thead>
					<tr>
						<th colspan="5" style="background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%);">Order Product</th>
					</tr>
					<tr>
						<th style='background-color: #0091db; color: black' name="Product_field">Product</th>
						<th style='background-color: #0091db; color: black' name="Supplier_field">Supplier</th>
						<th style='background-color: #0091db; color: black' name="Supplier_Price_field">Supplier Price</th>
						<th style='background-color: #0091db; color: black' name="Quantity_field">Quantity</th>
						<th style='background-color: #0091db; color: black' name="SRP_field">SRP</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<select name="prod">
								<?php
								include 'inv.php';
								$get_products="SELECT * FROM products";
								$query_products=mysqli_query($conn, $get_products);
								while($row_products = mysqli_fetch_array($query_products)){
								extract($row_products);
								echo '<option value="'.$id.'">'.$id." - ".$product.'</option>';
								}
								?>
							</select>
						</td>
						<td>
							<select name="sup">
							<?php
								include 'inv.php';
								$get_supply="SELECT * FROM supplier";
								$query_supply=mysqli_query($conn, $get_supply);
								while($row_supply = mysqli_fetch_array($query_supply)){
								extract($row_supply);
								echo '<option value="'.$Code.'">'.$Code." - ".$Supplier_Name.'</option>';
								}
								?>
							</select>
						</td>
						<td><input type="number" name="retail_price" required min="0" size="10"></td>
						<td><input type="number" name="quantity" required min="0" size="10"></td>
						<td><input type="number" name="mark_up" required min="0" size="10"></td>
						</tr>
						<tr>
						<td colspan="4" class="btn"><input type="submit" name="submit" value="Add Product"></td>
					</tr>
				</tbody>
			</table>
			<hr>
</div>
</div>
	<hr/>
	</body>
</div>
</div>
</html>


<?php
/* Order Product */
	if(isset($_GET['submit'])){
		include 'inv.php';
		$sup=$_GET['sup'];
		$pro=$_GET['prod'];	
		$rp=$_GET['retail_price'];
		$qt=$_GET['quantity'];
		$mu=$_GET['mark_up'];

		/* Product Info */
		$find_product="SELECT * FROM products WHERE id='$pro'";
		$find_product_query=mysqli_query($conn, $find_product);
		$find_product_fetch=mysqli_fetch_array($find_product_query);
		$pnm=$find_product_fetch['product'] ;
		$un=$find_product_fetch['unit'] ;
		$cat=$find_product_fetch['category'] ;

		/* Supplier Info */
		$find_product="SELECT * FROM supplier WHERE Code='$sup'";
		$find_product_query=mysqli_query($conn, $find_product);
		$find_product_fetch=mysqli_fetch_array($find_product_query);
		$snm=$find_product_fetch['Supplier_Name'] ;

		/* Computation for Sales Price*/
		$sale=$mu;

		if($rp>$mu){
			echo "<script>alert ('SRP should not be lesser than Supplier Price');</script>";
		} else {
			/* Insert Order */
			$insert_order="INSERT INTO incoming_order VALUES('','$sup-$pro','$pnm','$un','$qt','$rp','$sale','$snm','$cat')";
		if(mysqli_query($conn,$insert_order)){
			echo "<script>location.assign('order.php');</script>";
		}
		}

		
		
	}
?>

<!-- Confirm Order -->
 <?php
	if(isset($_GET['add'])){
		include 'inv.php';

		$sql_add="SELECT * FROM incoming_order";
		$sql_add_query=mysqli_query($conn, $sql_add);
		$n=0;
		while($add=mysqli_fetch_array($sql_add_query)){
			$n++;
			$add_serial[$n]=$add["Serial_Code"];
			$add_product[$n]=$add["Product_Name"];
			$add_unit[$n]=$add["Unit"];
			$add_quantity[$n]=$add["Quantity"];
			$add_retail[$n]=$add["Retail_Price"];
			$add_sale[$n]=$add["Sales_Price"];
			$add_supplier[$n]=$add["Supplier"];
			$add_category[$n]=$add["Category"];



			$same_serial[$n]="SELECT * FROM incoming_order WHERE Serial_Code='$add_serial[$n]'";
			$same_serial_query[$n]=mysqli_query($conn, $same_serial[$n]);
			$same_serial_fetch[$n]=mysqli_fetch_array($same_serial_query[$n]);

			$same_serial1[$n]="SELECT * FROM product_list WHERE Serial_Code='$add_serial[$n]'";
			$same_serial_query1[$n]=mysqli_query($conn, $same_serial1[$n]);
			$same_serial_fetch1[$n]=mysqli_fetch_array($same_serial_query1[$n]);
			$r=mysqli_num_rows($same_serial_query1[$n]);

			if($r>0){
				$add_quantity_order[$n]=$same_serial_fetch[$n]["Quantity"];
				$add_quantity_product[$n]=$same_serial_fetch1[$n]["Quantity"];
				$sql_update_quantity[$n]=$add_quantity_order[$n]+$add_quantity_product[$n];
				$sql_update[$n]="UPDATE product_list SET Quantity='$sql_update_quantity[$n]' WHERE Serial_Code='$add_serial[$n]'";

				if(mysqli_query($conn, $sql_update[$n])){
					$empty="TRUNCATE TABLE incoming_order";
					if(mysqli_query($conn,$empty)){
					echo "<script>alert ('Data has been inserted into the Inventory');
					location.assign('order.php');</script>";
				}
			}

			} else {
				$insert_data[$n]="INSERT INTO product_list VALUES('$add_serial[$n]','$add_product[$n]','$add_unit[$n]','$add_quantity[$n]','$add_retail[$n]','$add_sale[$n]','$add_supplier[$n]','$add_category[$n]')";
				if(mysqli_query($conn, $insert_data[$n])){
					$empty="TRUNCATE TABLE incoming_order";
					if(mysqli_query($conn,$empty)){
						echo "<script>alert ('Data has been inserted into the Inventory');
						location.assign('order.php');</script>";
					}
				}

			}
		}

	}
 ?>

<!--Delete Data-->
<?php if(isset($_GET['Del'])){
	include 'inv.php';
            if($_GET){
            $tid=$_GET['Del'];

            $delete="DELETE FROM incoming_order WHERE Serial_Code = '$tid'";
            $result_del=mysqli_query($conn,$delete);
            if($result_del){
            echo "<script>alert ('Product deleted.');
            location.assign('order.php');</script>";
        }
            
        }
    }   
        ?>