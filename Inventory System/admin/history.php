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
   .search-box{
	text-align: left;
   }
   .search-box select{
	padding: 9px 9px;
	font-size: 15px;
   }
   .search-box input{
	padding: 9px 9px;
	font-size: 15px;
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
<div class="main">
<h3>HISTORY</h3>
<div class="search-box">
			Date:<input type="date" id="date">
			Buyer Name:<select id="buyname">
			</select>
		</div>
		<div class="outer-wrapper"><div class="inner-wrapper">
		<table border='1' cellspacing='0'>
			<thead>
			<tr>
		 		<th style='background-color:  rgb(70, 130, 180); color: black'>Reference Code</th>
		 		<th style='background-color:  rgb(70, 130, 180); color: black'>Buyer</th>
		 		<th style='background-color:  rgb(70, 130, 180); color: black'>Product</th>
		 		<th style='background-color:  rgb(70, 130, 180); color: black'>Quantity</th>
				<th style='background-color:  rgb(70, 130, 180); color: black'>Total Price</th>
		 		<th style='background-color:  rgb(70, 130, 180); color: black'>Date</th>
				</tr>
			</thead>
			<tbody id='result'>
<?php 
    include 'inv.php';

			$product_query1 = "SELECT * FROM transaction_history";
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
			 <td>$Reference_Code</td>
			 <td>$Buyer</td>
			 <td>$Products</td>
			 <td>$Quantity</td>
			 <td>$Total_Price</td>
			 <td>$Date</td>
        </tr>";
		}
	?>
	</tbody>
	</table>
		</div></div>
	<hr>
</div>
</div>
	
</div>
</div>
</div>
	</body>	
</html>

<script>
        $(document).ready(function() {
            $('#date').mouseenter(function() {
                var query = $(this).val();

                if (query !== '') {
                    $.ajax({
                        url: 'buyer_name.php',
                        method: 'POST',
                        data: { query: query },
                        success: function(data) {
                            $('#buyname').html(data);
                        }
                    });
                } 
				else {
                    $('#buyname').html('');
                }
            });
        });

		$(document).ready(function() {
            $('#buyname').click(function() {
                var query1 = $('#buyname').val();
				var query2 = $('#date').val();

                if (query1 !== '') {
                    $.ajax({
                        url: 'history_result.php',
                        method: 'POST',
                        data: { query1: query1, query2: query2 },
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

