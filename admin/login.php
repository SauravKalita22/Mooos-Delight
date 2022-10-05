<?php
require("dbconnect.php");
require("functions.php");
$msg='';
if(isset($_POST['submit'])){
  $email = get_safe_value($conn,$_POST['email']);
  $password = get_safe_value($conn,$_POST['password']);
  $sql ="SELECT * FROM register WHERE email='$email' and password='$password' and type='admin'";
  $res =mysqli_query($conn,$sql);
  $count =mysqli_num_rows($res);
  if($count>0){
     session_start();
     $_SESSION['ADMIN_LOGIN']='yes';
     header ('location: vendor.php');
     die();
  }
  else{
    $msg="Please enter correct login credentials";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="stylesheet" href="assets/css/navbar.css">
  <link rel="stylesheet" href="assets/css/my-login.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body class="bg-light" style="padding-top: 250px;">
  <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <div class="container-fluid">
              <a class="navbar-brand px-5 py-3" href="index.php"><img src="images/logo.png" width="250px" alt=""></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
          </nav>      
  </header>

  <!--admin login -->
  <div class="loginpage">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card">
          <div class="card-body">
            <h3 class="card-title text-center pb-3">ADMIN LOGIN</h3>
            <form action="login.php" method="POST" id="login">
              <div class="form-group">
                <label for="email">Username</label>
                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                <small id="emailHelp" class="form-text text-muted">Enter your email here</small>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required data-eye>
              </div>

              <div class="form-group m-0 pt-3">
                <button type="submit" name="submit" class="btn btn-primary btn-block">
                  Login
                </button>
              </div>
            </form>
            <div class="py-3 text-danger font-weight-bold">
            <?php  echo $msg?>
            </div>
          </div>
				</div>
			</div>
		</div>
	</section>
  </div>
	

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/validation.js"></script>
</body>
</html>
