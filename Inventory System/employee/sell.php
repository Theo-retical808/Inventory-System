<html>
    <head> 
		  <!-- put this logo in the upper-left side
            <img src="" height="100px" width="1000px" class="logo"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Menui.css">
		<title>Inventory System - Inventory</title>
		<script src="JQuery/jquery-3.7.0.min.js"></script>
		<style>
			.order {
				float: right;
				position: absolute;
  				top: 250px;
  				right: 0px;;
				text-align: right;
			}
			.order .but {
				margin-left: 20%;
				margin-top: 20%;
			}
			.main{
      padding-bottom: 90px;
    }
    h3{
        background: linear-gradient(315deg, #8bcfff 0%, #9ff8fe 100%);
        width: 40%;
        height: 50px;
    }
    th{
       background-color:  rgb(70, 130, 180);
       color: black;
    }
	.profile-pic img{
    width: 175px;
	height: 90px;
	border-radius: 32px;
	border: 2px solid #cddc39;
	filter: drop-shadow(0 0 8px #ff5722);
  margin-left: 10px;
   }
   h3{
        background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%);
        width: 40%;
        height: 50px;
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
    </head>
    <body>
	<div class="bodymain">
	<header>
	<div class="date">
    <p>
      <?php
      date_default_timezone_set('Asia/Manila');
      ?>
      Date: <?php $date = date('m-d-Y'); echo $date;?> <?php $time = date ('h:i A'); echo $time?> </p>
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
<div class="main" style="margin-top: 10px;">
<h3>TRANSACTION</h3>
				<form action="receipt.php" method="post">
					<input name="buyer" required placeholder="Buyer Name" value=""><input name="reference" minlength="8" maxlength="8" required placeholder="Receipt Code"  value="">
					<div class="outer-wrapper"><div class="inner-wrapper">
			<table border='1' cellspacing='0'>
			<tr>
		 <th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Serial Code</th>
		 <th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Product Name</th>
		 <th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Quantity</th>
		 <th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Price</th>
		 <th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Total Price</th>
		 <th></th>
		 </tr>
		</div>
        <?php 
    include 'inv.php';
			$tot="SELECT SUM(Total_Price) FROM temporary";
			$result_tot=mysqli_query($conn, $tot);
			$or_query1 = "select * from temporary";
			$or_result = mysqli_query($conn, $or_query1);
		$ctr=1;
		$toto=mysqli_fetch_array($result_tot);

		while($or_row = mysqli_fetch_array($or_result)) {
			$ctr++;
			if ($ctr%2==1){
				echo"<tr style='background-color: #666666'>";
			}
			else {
				echo"<tr style='background-color: #999999'>";
			}
			echo "
			 <td>".$or_row['Serial_Code']."</td>
			 <td>".$or_row['Product']."</td>
			 <td>".$or_row['Quantity']."</td>
			 <td>".$or_row['Price']."</td>
			 <td>".$or_row['Total_Price']."</td>
			 <td><a href='sell.php?Del=".$or_row['Serial_Code']."'>Remove</a></td>
        </tr>";
		}
		
	?>
	</table>
	</div></div>
	<div class="order">
	<table border='1' cellspacing='0'>
	<tr>
		<td colspan='4' style='text-align: right; background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;'><b>Total:</b></td>
	<td colspan='2'><input type='number' id='num1' size="7" name='total_amount' value='<?php echo $toto['SUM(Total_Price)'];?>' readonly></td>
</tr>
		<tr>
			<td colspan='4' style='text-align: right; background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;'><b>Amount Received:</b></td>
		<td colspan='2'><input type='number' size="7" id='num2' name='receive_amount'></td>
	</tr>
		<tr>
			<td colspan='4' style='text-align: right; background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;'><b>Change:</b></td>
		<td colspan='2'><input id='change' size="7" name='change' readonly></td>
	</tr>
		</table>
	
	<div class="btn" style="text-align: right; margin-right:200px;">
	<input class="but" type="submit" name="adding" value="Confirm Products">
	</div>
</form>
	<form action="" method="post">
	</div>
	<hr>
	<div class="maintenance" style="margin-left: 0%;">

			<table>
				<thead>
					<tr>
						<th colspan="6"  style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Order Product</th>
					</tr>
					<tr>
						<th style='background-color: #0091db; color: black' name="Product_field">Product Search</th>
						<th style='background-color: #0091db; color: black' name="Supplier_field">Product</th>
						<th style='background-color: #0091db; color: black' name="Supplier_Price_field">Price</th>
						<th style='background-color: #0091db; color: black' name="Quantity_field">Inventory Quantity</th>
						<th style='background-color: #0091db; color: black' name="Quantity_field">Take Quantity</th>
						<th style='background-color: #0091db; color: black' name="Quantity_field"></th>
					</tr>
				</thead>
		
				<tbody>
					<tr>
						<td>
							<input type='text' name="cat" id="cat" placeholder='Search'/>
						</td>
						<td>
							<select name="prod" id="prod">
								<?php
								$pro_sql='SELECT * FROM product_list';
								$pro_result=mysqli_query($conn, $pro_sql);
								while ($pro_row = mysqli_fetch_assoc($pro_result)) {
									echo '<option value="'.$pro_row["Serial_Code"].'">'.$pro_row["Serial_Code"].' - '.$pro_row["Product_Name"].'</option>';
												}
								?>
							</select>
						</td>
						<td id="pri"><input type="number" size="5" id="price" name="price" readonly min="0" size="10"></td>
						<td id="qty"><input type="number" size="5" name="quantity" id="quantity" required min="0"></td>
						<td id="try"><input type="number" size="5" name="qty" id="quantity" required min="0"></td>
											</tr>
											<tr>
						<td colspan="4" class="btn"><input type="submit" name="add" value="Add Order"></td>
					</tr>
				</tbody>
			</form>
			</table>

</div>
</div>
	</body>
</div>
</div>
</html>
<script>
        $(document).ready(function() {
            $('#cat').keyup(function() {
                var query = $(this).val();

                if (query !== '') {
                    $.ajax({
                        url: 'distinct.php',
                        method: 'POST',
                        data: { query: query },
                        success: function(data) {
                            $('#prod').html(data);
                        }
                    });
                } 
				else {
                    $('#prod').html('');
                }
            });
        });

		$(document).ready(function() {
            $('#prod').click(function() {
                var query1 = $(this).val();

                if (query1 !== '') {
                    $.ajax({
                        url: 'price.php',
                        method: 'POST',
                        data: { query1: query1 },
                        success: function(data) {
                            $('#pri').html(data);
                        }
                    });
                } 
				else {
                    $('#pri').html('');
                }
            });
        });

		$(document).ready(function() {
            $('#prod').click(function() {
                var query2 = $(this).val();

                if (query2 !== '') {
                    $.ajax({
                        url: 'compute.php',
                        method: 'POST',
                        data: { query2: query2 },
                        success: function(data) {
                            $('#qty').html(data);
                        }
                    });
                } 
				else {
                    $('#qty').html('');
                }
            });
        });
		
		$(document).ready(function() {
            $('#num2').keyup(function() {
				var change =  Number($('#num2').val()) - Number($('#num1').val());
				$('#change').val(change);
                });
            });
</script>

	<!-- Add order -->
	<?php
		if(isset($_POST['add'])){
			include 'inv.php';
			$Serial_Code=$_POST['prod'];
			$quantity=$_POST['qty'];
			
			

			$sql_order="SELECT * FROM product_list WHERE Serial_Code='$Serial_Code'";
			$sql_order1="SELECT * FROM temporary WHERE Serial_Code='$Serial_Code'";
			$result_order=mysqli_query($conn, $sql_order);
			$result_order1=mysqli_query($conn, $sql_order1);
			$fetch_order=mysqli_fetch_assoc($result_order);

			$product=$fetch_order['Product_Name'];
			$price=$fetch_order['Sales_Price'];
		
			$total=$quantity*$price;

		if(mysqli_num_rows($result_order1)>0){
			echo '<script> alert ("Product already ordered");</script>';
		} else {
			$sql_insert="INSERT INTO temporary VALUES('$Serial_Code','$product','$quantity','$price','$total')";
			$result_insert=mysqli_query($conn, $sql_insert);
			if($result_insert){
				echo '<script> location.assign ("sell.php");</script>';
			}
		}}
	?>


	<!--Delete Data-->
<?php if(isset($_GET['Del'])){
	include 'inv.php';
            if($_GET){
            $tid=$_GET['Del'];

            $delete="DELETE FROM temporary WHERE Serial_Code = '$tid'";
            $result_del=mysqli_query($conn,$delete);
            if($result_del){
            echo "<script>alert ('Order deleted.');
            location.assign('sell.php');</script>";
        }
            
        }
    }   
        ?>