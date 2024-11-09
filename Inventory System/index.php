<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  background-color: skyblue;
}
form {
  font-family: Arial, Helvetica, sans-serif;
	font-family: "Lato", sans-serif;
	background-color: blue;
	margin-left: 35%;
	margin-top: 200px;
	margin-bottom: 30%;
	margin-right: 35%;
	border-top: #111 3px solid;
	border-bottom: #111 3px solid;
	border-right: #111 3px solid;
	border-left: #111 3px solid;
	border-radius: 32px;
	box-shadow: 5px 5px 5px 5px gold ;
	height: 75%;
	min-height: 75%;
	max-height: max-content;
	overflow-y: hidden;
  width: 30%;
  text-align: center;
  }

input[type=text], input[type=password] {
  width: 90%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #757272;
  color: white;
  padding: 14px 20px;
  border: none;
  cursor: pointer;
  width: 30%;
}

button:hover {
  opacity: 0.8;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}
.log-out button {
  padding: 9px 9px;
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

.log-out button:hover {background-color: yellow;}

.log-out button:active {
  background-color: gold;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
.comp-logo img{
  border: 4px solid black;
  float: right;
  margin-right: 35.5%;
  margin-top: 10%;
  border-radius: 30px;
  padding: 1px 1px 1px 1px;
}
</style>
</head>
<body>
  <div class="comp-logo"><img src="img/CompanyLogo.png" /></div>
<form action="" method="post">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
<br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <br>        
    <div class="log-out"><button type="submit">Login</button></div>
  </div>
</form>

</body>
</html>
	<?php	
  if($_POST){
    include 'inv.php';
        $uname=$_POST['uname'];
        $pass=$_POST['psw'];


        $sql="SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
        $result = mysqli_query($conn,$sql);
        $rowcount = mysqli_num_rows($result);
        $position = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
        $position_result = mysqli_query($conn,$sql);
        $fetch_position = mysqli_fetch_array($position_result);
        $pos = $fetch_position['position'];

        if ($rowcount > 0) {
          switch ($pos) {
            case 'Administrator':
              echo "<script>window.location.assign('admin/Dashboard.php'); </script>";
                break;
            case 'Employee':
              echo "<script>window.location.assign('employee/Dashboard.php'); </script>";
                break;
        }
        } else {
            echo "Your username and/or password is incorrect";
        }
      }
    ?>

</body>
</html>