<?php
require ("dbconnect.php");
$loggedin='';
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin=true;
}
else{
  echo "<script>alert('You must login before continuing');window.location='login.php'</script>";
  $loggedin=false;
  die();
}
unset($_SESSION['orderid']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mooo's Delight</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script>
         setTimeout(function(){
            window.location.href = 'index.php';
         }, 5000);
    </script>
</head>

<body class="bg-light" style="padding-top: 150px;">

  <!-- Navigation bar -->
  <header>
        <nav class="navbar fixed-top navbar-expand-lg bg-light navbar-light">
            <div class="container-fluid">
              <a class="navbar-brand px-5 py-3" href="#"><img src="img/logo.png" width="250px" alt=""></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 px-5 ms-auto">
                  <li class="nav-item px-3">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item px-3 dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Vendors
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class='dropdown-item' href='vendor1.php'>MK's Dairy</a></li>
                      <li><a class='dropdown-item' href='vendor2.php'>FreshFromFarm Dairy</a></li>
                      <li><a class='dropdown-item' href='vendor3.php'>Sethi's Dairy</a></li>
                      <li><a class='dropdown-item' href='vendor4.php'>Deepam's Dairy</a></li>
                    </ul>                
                  </li>
                  <li class="nav-item px-3">
                    <a class="nav-link" href="aboutus.php">About us</a>
                  </li>
                  <li class="nav-item px-3">
                    <a class="nav-link" href="contactus.php">Contact us</a>
                  </li>
                  
                  <?php
                  $count=0;
                  if(isset($_SESSION['cart']))
                  {
                    $count=count($_SESSION['cart']);
                  };
                  ?>
                  <li class="nav-item px-2">
                    <a class="nav-link" href="shoppingcart.php"><small>CART (<?php echo $count; ?>)</small></a>
                  </li>

                  <!-- after login -->
                  <?php
                  if($loggedin){
                  echo "<li class='nav-item px-3 dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    Hi ". $_SESSION["fname"];                    
                  echo  "</a>
                  <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                      <li><a class='dropdown-item' href='#'>My account</a></li>
                      <li><a class='dropdown-item' href='#'>My orders</a></li>
                      <li><a class='dropdown-item' href='logout.php'>Logout</a></li>
                    </ul>
                  </li>";
                  }
                  else{
                  echo '<li class="nav-item">
                    <a class="nav-link" href="login.php"><small>LOGIN</small></a>
                  </li>';
                  }
                  ?>
                  
                </ul>
              </div>
            </div>
          </nav>      
  </header>

  <div class="container">
    <div class="text-center bg-light my-5">
        
    </div>
    <div class="row">
      <div class="col" style="padding-left: 200px;"><img src="img/thumbs2.jpg" width="300px" alt=""></div>
      <div class="col" style="padding-top: 150px; padding-right: 200px;">
        <h1>YOUR ORDER HAS BEEN SUCCESSFULLY PLACED</h1>
        <br>
    </div>
  </div>

</body>
</html>