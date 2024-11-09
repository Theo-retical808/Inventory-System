<?php   session_start();?>
<!-- EDIT -->
<?php 
    include 'inv.php';
            

            
            if(isset($_GET['Edit'])){
                $tid=$_GET['Edit'];
                $edit="SELECT * FROM products WHERE id = '$tid'";
            $result_edit=mysqli_query($conn,$edit);
            $row_edit=mysqli_fetch_array($result_edit);
            if($row_edit>0) {
                extract($row_edit);
                $_SESSION["id"]=$id;
                $_SESSION["product"]=$product;
                $_SESSION["unit"]=$unit;
                $_SESSION["category"]=$category;

            } }
        else {
                $_SESSION["id"]='';
                $_SESSION["product"]='';
                $_SESSION["unit"]='';
                $_SESSION["category"]='';
            }
          
        ?>

<!DOCTYPE html>

<html>
    <head> 
		   <!-- put this logo in the upper-left side
            <img src="" height="100px" width="1000px" class="logo"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Menui.css">
        <title>Inventory System - Products</title>
        <style>
            input[type=number] {
		-moz-appearance: textfield;
	  }
        </style>
    </head>
    <style>
     .main{
      padding-bottom: 85px;
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
<h3>PRODUCTS</h3>
    <div class="show-table">   <div class="outer-wrapper"><div class="inner-wrapper">
            <?php 
                include 'inv.php';
		        if(isset($_GET['search'])){
			        $search = $_GET['search'];
			        $product_query2 = "select * from products where id LIKE '%$search%' or product LIKE '%$search%' or unit LIKE '%$search%' or category LIKE '%$search%'";
			        $product_result = mysqli_query($conn, $product_query2);
		        }
		        else {
			        $product_query1 = "select * from products";
			        $product_result = mysqli_query($conn, $product_query1);

		        }
		
		            $ctr=1;
		        echo "<table border='1' cellspacing='0'";
                echo "<tr>
		        <th style='background-color:rgb(70, 130, 180); color: black'>Id No.</th>
		        <th style='background-color:rgb(70, 130, 180); color: black'>Product Name</th>
		        <th style='background-color:rgb(70, 130, 180); color: black'>Unit</th>
		        <th style='background-color:rgb(70, 130, 180); color: black'>Category</th>
                <th colspan='2' style='background-color: rgb(70, 130, 180); color: black'>Action</th>
		        </tr>";

		        while($row = mysqli_fetch_array($product_result)) {
			        $ctr++;
			        extract($row);
			        if ($ctr%2==1){
				    echo"<tr style='background-color: #9cbaff;'>";
			        }
			        else {
				    echo"<tr style='background-color: rgb(176, 196, 222)'>";
			        }
			        echo "
			        <td>$id</td>
			        <td>$product</td>
			        <td>$unit</td>
			        <td>$category</td>
                    <td><a href='product.php?Edit=$id'>Edit</a></td>
                    <td><a href='product.php?Del=$id'>Delete</a></td>
                    </tr> ";
		        }
                echo '</table>';
            ?></div></div></div>
            <div class="maintenance">
                <form action="" method="post">
                <table>
                <thead>
                    <tr>
                        <th colspan="4" style= "background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%); color:black;">Product Maintenance</th>
                    </tr>
                </thead>
 
                <tbody>
                    <tr>
                        <td>Id:<input required name="id" type="text" maxlength="8" minlength="8" placeholder="########" value="<?php echo $_SESSION['id']; ?>" <?php if(isset($_GET['Edit'])){ echo 'readonly="readonly"';}?>></td>
                        <td>Product Name:<input required name="product_name" value="<?php echo $_SESSION['product']; ?>"></td>
                        <td>Unit:<input required name="unit" value="<?php  echo $_SESSION['unit']; ?>"></td>
                        <td>Category:<select name="category">
                            <option value="Construction">Construction</option>
                            <option value="Roofing">Roofing</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Plumbing">Plumbing</option>
                            <option value="Sewerage">Sewerage</option>
                            <option value="Lighting">Lighting</option>
                            <option value="Toiletries">Toiletries</option>
                            <option value="Miscellanous">Miscellanous</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="btn"><input type="submit" name="<?php if(isset($_GET['Edit'])){ echo 'Update';} else{ echo 'Save';}?>" value="Save"></td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
            </div>
            </div>
	</body>
</html>

<!-- Input Data -->
<?php
    include 'inv.php';
    
    if($_POST){
    $id=$_REQUEST['id'];
        $product_name=$_REQUEST['product_name'];
        $unit=$_REQUEST['unit'];
        $category=$_REQUEST['category'];
    if(isset($_POST['Save'])){
        $same_query="SELECT id FROM products WHERE id='$id'";
        $same_array=mysqli_query($conn, $same_query);
        $same=mysqli_num_rows($same_array);
        if ($same>0) {
            echo "<script>alert ('Id already taken.');</script>";
        }
        else{
        $input="INSERT INTO products VALUES('$id','$product_name','$unit','$category')";
        $in=mysqli_query($conn, $input);
        if($in){
            echo "<script>alert ('Product has been inserted.');
            location.assign('product.php');</script>";
        } 
       
        else{
            echo "<script>alert ('Data not inserted.');</script>";
        }}
        
        
    }
    else{
        $update="UPDATE products SET product='$product_name', unit='$unit', category='$category' WHERE id=$id;";
        if(mysqli_query($conn, $update)){
            echo "<script>alert ('Product has been updated.');
            location.assign('product.php');</script>";
            session_destroy();
        } else{
            echo "<script>alert ('Data has not been updated.');</script>";
            session_destroy();
        }
    }}
?>


<!--Delete Data-->
        <?php if(isset($_GET['Del'])){
            if($_GET){
            $tid=$_GET['Del'];

            $delete="DELETE FROM products WHERE id = '$tid'";
            $result_del=mysqli_query($conn,$delete);
            if($result_del){
            echo "<script>alert ('Product deleted.');
            location.assign('product.php');</script>";
        }
            
        }
    }   
        ?>