<!DOCTYPE html>
<?php   session_start();?>
<?php if(isset($_GET['Edit'])){
    include 'inv.php';
            $tid=$_GET['Edit'];

            $edit="SELECT * FROM users WHERE id = '$tid'";
            $result_edit=mysqli_query($conn,$edit);
            $row_edit=mysqli_fetch_array($result_edit);
            
            if($row_edit>0) {
                extract($row_edit);
                $_SESSION["id"]=$id;
                $_SESSION["uname"]=$user_name;
                $_SESSION["pass"]=$password;
                $_SESSION["fname"]=$first_name;
                $_SESSION["lname"]=$last_name;
                $_SESSION["pos"]=$position;

            } 
        else {
            $_SESSION["id"]='';
            $_SESSION["uname"]='';
            $_SESSION["pass"]='';
            $_SESSION["fname"]='';
            $_SESSION["lname"]='';
            $_SESSION["pos"]='';

            }
        }  
        ?>
<html>
    <head> 
        <div class="bodymain">
		   <!-- put this logo in the upper-left side
            <img src="" height="100px" width="1000px" class="logo"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Menui.css">
        <title>Inventory System - Products</title>
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
      padding-bottom: 65px;
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
<h3>USERS</h3>
    <div class="show-table">   <div class="outer-wrapper"><div class="inner-wrapper">
            <?php 
                include 'inv.php';
		        if(isset($_GET['search'])){
			        $search = $_GET['search'];
			        $product_query2 = "select * from users where id LIKE '%$search%' or product LIKE '%$search%' or unit LIKE '%$search%' or category LIKE '%$search%'";
			        $product_result = mysqli_query($conn, $product_query2);
		        }
		        else {
			        $product_query1 = "select * from users";
			        $product_result = mysqli_query($conn, $product_query1);

		        }
		
		            $ctr=1;
		        echo "<table border='1' cellspacing='0'";
                echo "<tr>
		        <th style='background-color:  rgb(70, 130, 180); color: black'>Name</th>
		        <th style='background-color:  rgb(70, 130, 180); color: black'>Username</th>
		        <th style='background-color:  rgb(70, 130, 180); color: black'>Password</th>
		        <th style='background-color:  rgb(70, 130, 180); color: black'>Position</th>
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
			        <td>$first_name $last_name</td>
			        <td>$user_name</td>
			        <td>$password</td>
			        <td>$position</td>
                    <td><a href='users.php?Edit=$id'>Edit</a></td>
                    <td><a href='users.php?Del=$id'>Delete</a></td>
                    </tr> ";
		        }
                echo '</table>';
            ?></div></div></div>
            <div class="maintenance">
                <form action="" method="post">
                <table>
                <thead>
                    <tr>
                        <th style="background: linear-gradient(90deg, #ff7b00 0%, #ffe200 100%);" colspan="5">User Maintenance</th>
                    </tr>
                </thead>
 
                <tbody>
                    <tr>
                        <td>User Name:<input required name="uname" value="<?php if(isset($_GET['Edit'])){ echo $_SESSION['uname'];} ?>"></td>
                        <td>Password:<input required name="psw" value="<?php if(isset($_GET['Edit'])){ echo $_SESSION['pass'];} ?>"></td>
                        <td>Last Name:<input required name="lname" value="<?php if(isset($_GET['Edit'])){ echo $_SESSION['lname'];} ?>"></td>
                        <td>First Name:<input required name="fname" value="<?php if(isset($_GET['Edit'])){ echo $_SESSION['fname'];} ?>"></td>
                        <td>Position:<select name="pos">
                            <option value="Administrator">Administrator</option>
                            <option value="Employee">Employee</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="btn"><input type="submit" name="<?php if(isset($_GET['Edit'])){ echo 'Update';} else{ echo 'Save';}?>" value="<?php if(isset($_GET['Edit'])){ echo 'Update';} else{ echo 'Save';}?>"></td>
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
        $uname=$_REQUEST['uname'];
        $fname=$_REQUEST['fname'];
        $lname=$_REQUEST['lname'];
        $psw=$_REQUEST['psw'];
        $pos=$_REQUEST['pos'];
    if(isset($_POST['Save'])){
        $same_query="SELECT user_name FROM users WHERE user_name='$uname'";
        $same_array=mysqli_query($conn, $same_query);
        $same=mysqli_num_rows($same_array);
        if ($same>0) {
            echo "<script>alert ('Username already taken.');</script>";
        }
        else{
        $input="INSERT INTO users VALUES('','$uname','$psw','$fname','$lname','$pos')";
        $in=mysqli_query($conn, $input);
        if($in){
            echo "<script>alert ('User has been registered.');
            location.assign('users.php');</script>";
        } 
       
        else{
            echo "<script>alert ('User has not been registered.');</script>";
        }}
        
        
    }
    else if(isset($_POST['Update'])){
        $id=$_SESSION["id"];
        $update="UPDATE users SET user_name='$uname', password='$psw', first_name=' $fname', last_name='$lname', position='$pos' WHERE id=$id;";
        if(mysqli_query($conn, $update)){
            echo "<script>alert ('User has been updated.');
            location.assign('users.php');</script>";
            session_destroy();
        } else{
            echo "<script>alert ('User has not been updated.');</script>";
            session_destroy();
        }
    }}
?>


<!--Delete Data-->
        <?php if(isset($_GET['Del'])){
            if($_GET){
            $tid=$_GET['Del'];

            $delete="DELETE FROM users WHERE id = '$tid'";
            $result_del=mysqli_query($conn,$delete);
            if($result_del){
            echo "<script>alert ('User has been removed.');
            location.assign('users.php');</script>";
        }
            
        }
    }   
        ?>