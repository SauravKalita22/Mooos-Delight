<?php 
include "dbconnect.php";
$showerror=false;;
session_start();
$msg='';
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM register WHERE email ='$email' and type='user'"; 
  $result = mysqli_query($conn, $sql);
  $num= mysqli_num_rows($result);
  if($num>0)
  {  
    $_SESSION['loggedin']=true;
    $_SESSION['email']=$email;
    while($row= mysqli_fetch_assoc($result))
    {
      $_SESSION['fname']=$row["fname"];
      $_SESSION['id']=$row["id"]; 
    } 
    echo "<script> alert('Logged in successfully!');window.location='index.php'</script>";
    die(); 
  }
  else
  {
   $msg="Please enter correct login credentials";
   $showerror=true;
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
	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600&display=swap" rel="stylesheet">
  <style>
  body {
  background-image:  linear-gradient(
    rgba(0,0,0,0.1),
    rgba(0,0,0,0.5)
    ),url('img/login.jpg');
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>

<body class="bg-light" style="padding-top: 250px;">
	<!-- Navigation bar -->
	<header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <div class="container-fluid">
              <a class="navbar-brand px-2 py-3" href="index.php"><img src="img/logo.png" width="250px" alt=""></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 px-5 ms-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="register.php"><small>REGISTER</small></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>      
  </header>

  <!-- login -->
  <div class="loginpage">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card">
          <div class="card-body">
            <h3 class="card-title text-center">LOGIN</h3>
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
                <button type="submit" class="btn btn-primary btn-block">
                  Login
                </button>
              </div>
              <div class="mt-4 text-center">
                Don't have an account? <a href="register.php">Register Now</a>
              </div>
              <?php 
              if($showerror)
              {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <p>"; echo $msg;
                echo "</p>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
              }
              ?>   
            </form>
          </div>
          <div class="py-3 text-center">
                <a href="admin/login.php">LOGIN AS ADMIN</a>
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
