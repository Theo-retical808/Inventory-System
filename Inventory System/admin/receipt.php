<!-- Confirm Order -->
<?php
	include 'inv.php';
	$total_amount=$_POST['total_amount'];
	$received=$_POST['receive_amount'];
	$change=$_POST['change'];
	$name=$_POST['buyer'];
	$ref=$_POST['reference'];
	$day=date_default_timezone_set('Asia/Manila');
?>

<?php
      
	  date_default_timezone_set('Asia/Manila');
      $date = date('m-d-Y');
      $time = date ('h:i A');
      ?> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
    <title>Transaction Receipt</title>
	<style>
		@media print{
    body *:not(#print):not(#print *){visibility:hidden;}
}
	</style>
</head>
<body style="width: 45%;">
<section id="print">
    <div class="receipt-body">
        <div class="receipt-head">
            <div class="comp-logo"><img src="img/CompanyLogo.png" /></div>
            <p style="text-align: right;">Date: <b><?php  echo $date;?></b> Time: <b><?php  echo $time;?></b> </p>
        </div>
<hr>
        <div class="receipt-main">
        <table border='0' style="collapse: collapse;" cellspacing='3'>
			<tr>
		 <th>Serial Code</th>
		 <th>Product Name</th>
         <th>Price</th>
		 <th>Quantity</th>
		 <th>Total Price</th>
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
			echo "<tr>
			 <td>".$or_row['Serial_Code']."</td>
			 <td>".$or_row['Product']."</td>
			 <td>".$or_row['Price']."</td>
             <td>".$or_row['Quantity']."</td>
			 <td>".$or_row['Total_Price']."</td>
        </tr>";
		}
		
	?>
    <tr>
             <td colspan="4"></td>
			 <td></td>  
    <tr>
    <tr>
             <td colspan="4" style="text-align: right;"> Total:</td>
			 <td><?php echo $toto['SUM(Total_Price)'];?></td>  
    <tr>
    <tr>
             <td colspan="4" style="text-align: right;">Cash Received:</td>
			 <td><?php echo $received;?></td>  
    <tr>
    <tr>
             <td colspan="4" style="text-align: right;">Change:</td>
			 <td><?php echo $change;?></td>  
    <tr>
    </table>
        </div>
<hr>
        <div class="receipt-footer">
            <h4 style="text-align: left;">Buyer: <?php echo $name;?></h4><h2 style="text-align: right;">Ref No.: <?php echo $ref;?></h2>

      </div>  </div>
    </section>
</body>
</html>

<?php
echo "<script>window.print('receipt.php');
location.assign('sell.php');</script>";
	if($received>=$total_amount){
	$sql_add="SELECT * FROM temporary";
	$sql_add_query=mysqli_query($conn, $sql_add);
	$n=0;
	while($add=mysqli_fetch_array($sql_add_query)){
		$n++;
		$add_serial[$n]=$add["Serial_Code"];
		$add_product[$n]=$add["Product"];
		$add_quantity[$n]=$add["Quantity"];
		$add_price[$n]=$add["Total_Price"];
		



		$same_serial[$n]="SELECT * FROM product_list WHERE Serial_Code='$add_serial[$n]'";
		$same_serial_query[$n]=mysqli_query($conn, $same_serial[$n]);
		$same_serial_fetch[$n]=mysqli_fetch_array($same_serial_query[$n]);

		$subtract_quantity[$n]=$same_serial_fetch[$n]['Quantity'];

		$total_retail[$n]=$add_quantity[$n]*$same_serial_fetch[$n]['Retail_Price'];

		$quantity_update[$n]=$subtract_quantity[$n]-$add_quantity[$n];

		$update_data[$n]="UPDATE product_list SET Quantity='$quantity_update[$n]' WHERE Serial_Code='$add_serial[$n]'";
		$confirm_update[$n]=mysqli_query($conn, $update_data[$n]);
		
		$insert_data[$n]="INSERT INTO transaction_history VALUES('','$ref','$name','$add_product[$n]','$add_quantity[$n]',now(),'$total_retail[$n]')";
		$confirm_insert[$n]=mysqli_query($conn, $insert_data[$n]);

		$empty="TRUNCATE TABLE temporary";
		if(mysqli_query($conn,$empty)){
			echo "<script>alert ('Transaction Confirmed');
			location.assign('sell.php');</script>";
		}
		
	}
		} else {
			echo "<script>alert ('Insufficient Payment'); location.assign('sell.php');</script>";
			
		}
?>












	