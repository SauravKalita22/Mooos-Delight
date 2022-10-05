<?php 

$showAlert = false;
include ("dbconnect.php");

$sql = "select id from register ORDER BY id DESC LIMIT 1;";
$result1 = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result1)) {
$addid =(int)$row['id'] + 1;
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];

  #email existing
  $sql2="SELECT email FROM `register`";
  $res=mysqli_query($conn,$sql2);
  while($row=mysqli_fetch_array($res))
  {
    if($row['email']==$email)
    {
      echo "<script> alert('Email already exists');window.location='register.php' </script>";
      die();
    }
  }

  $password = $_POST["password"]; 
  $sql = "INSERT INTO `register` (id,fname,lname,email,`password`) VALUES ('$addid','$fname','$lname','$email','$password');";  
  $result2 = mysqli_query($conn, $sql);
  if ($result2) 
  { 
    session_start();
    $_SESSION['loggedin']==true;
    echo "<script> alert('Your account is successfully created and you can login now');window.location='login.php'</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
  body {
  background-image:  linear-gradient(
    rgba(0,0,0,0.1),
    rgba(0,0,0,0.5)
    ),url('img/register.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  }
  </style>
</head>

<body style="padding-top: 150px;">

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
                    <a class="nav-link" href="#"><small>LOGIN</small></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>      
  </header>

  <div class="loginpage">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card" style="width: 400px;">
          <div class="card-body">
            <h3 class="card-title text-center">REGISTER</h3>

            <form action="register.php" method="post" id="register">
              <div class="form-group">
                <label for="fname">First Name</label>
                <input id="fname" type="text" class="form-control" name="fname" required>
              </div>

              <div class="form-group">
                <label for="lname">Last Name</label>
                <input id="lname" type="text" class="form-control" name="lname" required>
              </div>

              <div class="form-group">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password">
              </div>

              <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input id="cpassword" type="password" class="form-control" name="cpassword">
              </div>

              <div class="form-group">
                <div class="custom-checkbox custom-control pb-3">
                  <input type="checkbox" name="agree" id="agree" class="custom-control-input">
                  <label for="agree" class="custom-control-label">I agree to the Terms and Conditions</label>
                </div>
              </div>

              <div class="form-group m-0">
                <button type="submit" class="btn btn-primary btn-block">
                  Register
                </button>
              </div>         
              <div class="mt-4 text-center">
                Already have an account? <a href="login.php">Login</a>
              </div>
              <?php
              if ($showAlert)
              {
                echo '<div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                <strong>Your account is successfully created.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
              }
              ?>
            </form>
          </div>
			</div>
		</div>
	</section>
  </div>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="js/validation.js"></script>
</body>
</html>