<!DOCTYPE html>
<?php   session_start(); error_reporting(0);?>
<html>
    <head> 
		   <!-- put this logo in the upper-left sCodee
            <img src="" height="100px" wCodeth="1000px" class="logo"> -->
        <meta name="viewport" content="wCodeth=device-wCodeth, initial-scale=1">
        <link rel="stylesheet" href="Menui.css">
        <title>Inventory System - supplier</title>
        <style>
            input[type=number] {
		-moz-appearance: textfield;
	  }
      .profile-pic img{
    width: 175px;
	height: 90px;
	border-radius: 32px;
	border: 2px solid #cddc39;
	filter: drop-shadow(0 0 8px #ff5722);
  margin-left: 10px;
   }
    .main{
      padding-bottom: 85px;
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
  <div class="sidenav">
    <div class="profile-pic">
    <img src="img/CompanyLogo.png"/>
    </div>
  <div class="user-name">Admin </div>
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
<div class="date">
    <p>
      <?php
      date_default_timezone_set('Asia/Manila');
      ?>
      Date: <?= date ('m/d/Y');?> <?= date ('h:i A'); ?> </p>
  </div>
<div class="main">
<h3>SUPPLIER</h3>
    <div class="show-table">
    <div class="outer-wrapper"><div class="inner-wrapper">
            <?php 
                include 'inv.php';
		        if(isset($_GET['search'])){
			        $search = $_GET['search'];
			        $product_query2 = "select * from supplier where Code LIKE '%$search%' or Supplier_Name LIKE '%$search%' or Address LIKE '%$search%' or category LIKE '%$search%'";
			        $product_result = mysqli_query($conn, $product_query2);
		        }
		        else {
			        $product_query1 = "select * from supplier";
			        $product_result = mysqli_query($conn, $product_query1);

		        }
		
		            $ctr=1;
		        echo "<table border='1' cellspacing='0'";
                echo "<tr>
		        <th style='background-color:  rgb(70, 130, 180); color: black'>Code</th>
		        <th style='background-color:  rgb(70, 130, 180); color: black'>Supplier</th>
		        <th style='background-color:  rgb(70, 130, 180); color: black'>Address</th>
                <th colspan='2' style='background-color:  rgb(70, 130, 180); color: black'>Action</th>
		        </tr>";

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
			        <td>$Code</td>
			        <td>$Supplier_Name</td>
			        <td>$Address</td>
                    <td><a href='supplier.php?Edit=$Code'>Edit</a></td>
                    <td><a href='supplier.php?Del=$Code'>Delete</a></td>
                    </tr> ";
		        }
                echo '</table>';
            ?></div></div></div>
            <div class="maintenance">
                <form action="" method="post">
                <table>
                <thead>
                    <tr>
                        <th style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;" colspan="3">Supplier Maintenance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Code:<input required type='text' Code='myText' onchange="check_input(event)" name="code" maxlength="5" minlength="5" placeholder="#####" value="<?php if(isset($_GET['Edit'])){ echo $_SESSION['Code'];} ?>" <?php if(isset($_GET['Edit'])){ echo 'readonly="readonly"';}?>></td>
                        <td>Supplier Name:<input required name="SupplierName" value="<?php if(isset($_GET['Edit'])){ echo $_SESSION['Supplier_Name'];} ?>"></td>
                        <td>Address:<input required name="address" value="<?php if(isset($_GET['Edit'])){ echo $_SESSION['Address'];} ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="btn"><input type="submit" name="<?php if(isset($_GET['Edit'])){ echo 'Update';} else{ echo 'Save';}?>" value="Save"></td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
            </div>
</div>
</div>
	</body>
</html>

<!-- Input Data -->
<?php
    include 'inv.php';
    if($_POST){
    $Code=$_REQUEST['code'];
    $SupplierName=$_REQUEST['SupplierName'];
    $address=$_REQUEST['address'];
    if(isset($_POST['Save'])){
        $same_query="SELECT Code FROM supplier WHERE Code='$Code'";
        $same_array=mysqli_query($conn, $same_query);
        $same=mysqli_num_rows($same_array);
        if ($same>0) {
            echo "<script>alert ('Code already taken.');</script>";
        }
        else{
        $input="INSERT INTO supplier VALUES('$Code','$SupplierName','$address')";
        $in=mysqli_query($conn, $input);
        if($in){
            echo "<script>alert ('Supplier has been Registered.');
            location.assign('supplier.php');</script>";
        } 
       
        else{
            echo "<script>alert ('Data not inserted.');</script>";
        }}
        
        
    }
    else{
        $update="UPDATE supplier SET Supplier_Name='$SupplierName', Address='$address' WHERE Code='$Code'";
        if(mysqli_query($conn, $update)){
            echo "<script>alert ('Supplier has been updated.');
            location.assign('supplier.php');</script>";
            session_destroy();
        } else{
            echo "<script>alert ('Data has not been updated.');</script>";
            session_destroy();
        }
    }}
?>

<?php if(isset($_GET['Edit'])){
            $tCode=$_GET['Edit'];

            $edit="SELECT * FROM supplier WHERE Code = '$tCode'";
            $result_edit=mysqli_query($conn,$edit);
            $row_edit=mysqli_fetch_array($result_edit);
            
            if($row_edit>0) {
                extract($row_edit);
                $_SESSION["Code"]=$Code;
                $_SESSION["Supplier_Name"]=$Supplier_Name;
                $_SESSION["Address"]=$Address;

            } 
        else {
                $_SESSION["Code"]='';
                $_SESSION["Supplier_Name"]='';
                $_SESSION["Address"]='';
            }
        }  
        ?>
<!--Delete Data-->
        <?php if(isset($_GET['Del'])){
            if($_GET){
            $tCode=$_GET['Del'];

            $delete="DELETE FROM supplier WHERE Code = '$tCode'";
            $result_del=mysqli_query($conn,$delete);
            if($result_del){
            echo "<script>alert ('Supplier deleted.');
            location.assign('supplier.php');</script>";
        }
            
        }
    }   
        ?>

<script>
    function check_input(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key == 8);
};
</script>