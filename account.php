<?php 
require ("dbconnect.php");

session_start();
$userid=$_SESSION['id'];
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin=true;
}
else{
  echo "<script>alert('You must login before continuing');window.location='login.php'</script>";
  $loggedin=false;
  die();
}

$sql = "SELECT * FROM register WHERE id = $userid and type='user'"; 
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mooo's Delight</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/newpage.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body style="padding-top: 200px;">

  <!-- Navigation bar -->
  <header>
        <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
              <a class="navbar-brand px-5 py-3" href="#"><img src="img/logo white.png" width="250px" alt=""></a>
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
                      <li><a class='dropdown-item' href='account.php'>My account</a></li>
                      <li><a class='dropdown-item' href='myorders.php'>My orders</a></li>
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
    <div id="page">
      <div id="maincontent">
        <div class="container px-5">
          <h1>My Account</h1>
        <table class="table table-bordered my-5">
          <tbody>   
          <?php
          while($row=mysqli_fetch_assoc($res))
          {?>
          <tr>
            <th scope="row" >ID</th>
            <td><?php echo $row['id'] ?></td>
          </tr>
          <tr>
            <th scope="row">Name</th>
            <td><?php echo $row['fname'] ?> <?php echo $row['lname']?></td>
          </tr>
          <tr>
            <th scope="row">Email</th>
            <td><?php echo $row['email']?></td>
          </tr>
          <tr>
            <th scope="row">Password</th>
            <td><?php echo $row['password'] ?></td>
          </tr>
          <?php 
          }?>            
          </tbody>
        </table>
        </div>
      </div>
      <div id="menuleftcontent">
          <ul class="list-group">
            <li class="list-group-item"><a href="account.php">My Account</a></li>
            <li class="list-group-item"><a href="myorders.php">My Orders</a></li>
            <li class="list-group-item"><a href="contactus.php">Any Questions?</a></li>
            <li class="list-group-item"><a href="logout.php">Logout</a></li>
          </ul>
      </div>
      <div id="clearingdiv"></div>
  </div>
  </div>
  
  <script src="js/bootstrap.bundle.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- <script src="js/index.js"></script> -->
  <script src="https://kit.fontawesome.com/7bbfdad444.js" crossorigin="anonymous"></script>

</body>
</html>