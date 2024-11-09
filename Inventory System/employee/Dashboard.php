<!DOCTYPE html>
<html lang="en">
	<head>
        <!-- put this logo in the upper-left side
            <img src="" height="100px" width="1000px" class="logo"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="Menui.css">
		<title>Inventory System - Dashboard</title>
  <style>
    .sale-table {
      margin: 3px;
    margin-left: 150px;
    margin-right: 20px;
    border: 1px solid black;
    border-radius: 4px;
    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.9);
    max-width: fit-content;
    max-height: 200px;
    float: left;
    
    }
    .profit-table {
      margin: 3px;
    margin-left: 20px;
    margin-right: 150px;
    border: 1px solid black;
    border-radius: 4px;
    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.9);
    max-width: fit-content;
    max-height: 200px;
    float: right;
    }
    .outer-wrapper {
      margin-left: 170px;
      margin-top: 10px;
      float: center;
    }
    .main{
      padding-bottom: 175px;
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
    color: black;
	background-color: #498bdb;
   }
   .user-name {
    color: black;
   }
   .log-out{
    float: right;
   }
   .log-out button {
  padding: 3px 9px;
  font-size: 20px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: rgb(70, 130, 180);
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.log-out button:hover {background-color: #f1f50e; color: black;}

.log-out button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
  </style>
	</head>
    <body>
    <div class="log-out"><a href="../index.php"><button >Log Out</button></a></div>
    <div class="bodymain">
        <!--Main Navigation-->
<header>
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

<main>
  
  <div class="date">
    <p>
      <?php
      date_default_timezone_set('Asia/Manila');
      ?>
      Date: <?= date ('m/d/Y');?> <?= date ('h:i A'); ?> </p>
  </div>

  <div class="main">
<h3>DASHBOARD</h3>
<div class="inventory-alert">
<div class="outer-wrapper"><div class="inner-wrapper">
		<table border='1' cellspacing='0'>
			<thead>
      <tr>
		 		<th colspan="5" style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color: black;"><b>Out-Of-Stocks</b></th>
				</tr>
			<tr>
		 		<th style='background-color:  rgb(70, 130, 180); color: black'>Serial Code</th>
		 		<th style='background-color:  rgb(70, 130, 180); color: black'>Product Name</th>
		 		<th style='background-color:  rgb(70, 130, 180); color: black'>Quantity</th>
				<th style='background-color:  rgb(70, 130, 180); color: black'>Supplier</th>
				<th style='background-color:  rgb(70, 130, 180); color: black'>Category</th>
				</tr>
			</thead>
     
			<tbody id='result'>
<?php 
    include 'inv.php';

			$product_query1 = "select * from product_list where Quantity='0'";
			$product_result = mysqli_query($conn, $product_query1);


		 while($row = mysqli_fetch_array($product_result)) {
			extract($row);

				echo"<tr style='background-color: rgb(176, 196, 222)'>";

			echo "
			 <td>$Serial_Code</td>
			 <td>$Product_Name</td>
			 <td>$Quantity</td>
			 <td>$Supplier</td>
			 <td>$Category</td>
        </tr>";
		}
	?>
	</tbody>
	</table>
		</div></div>
</div>
</main>
    </body>
    </div>
    </div>
    </hmtl>