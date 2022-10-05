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

$sql1="SELECT * FROM `shipping` WHERE `orderid`='$_SESSION[orderid]'";
$res1=mysqli_query($conn,$sql1);

$sql2="SELECT * FROM `orderdetails` WHERE `id`='$_SESSION[orderid]'";
$res2=mysqli_query($conn,$sql2);

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(isset($_POST['placeorder']))
  {
    header("location: thankyou.php");
  }
}
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
</head>
<body class="bg-light" style="padding-top: 150px;">

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

  <div class="container col-lg-12">
    <div class="border rounded col-lg-6 p-3">
      <h3 class="py-3">Shipping Details:</h3>
      <?php
      while($row=mysqli_fetch_assoc($res1))
      { ?>
        <ul class='list-group'>
        <li class='list-group-item'><b>FULLNAME: </b><?php echo $row['fullname'] ?></li>
        <li class='list-group-item'><b>MOBILE NO: </b><?php echo $row['mobileno'] ?></li>
        <li class='list-group-item'><b>PINCODE: </b><?php echo $row['pincode'] ?></li>
        <li class='list-group-item'><b>HOUSE NO: </b><?php echo $row['houseno'] ?></li>
        <li class='list-group-item'><b>ADDRESS: </b><?php echo $row['address'] ?></li>
        <li class='list-group-item'><b>CITY: </b><?php echo $row['city'] ?></li>
        <li class='list-group-item'><b>STATE: </b><?php echo $row['state'] ?></li>
        <li class='list-group-item'><b>PAYMENT: </b><?php echo $row['payment'] ?></li>
        </ul>
      <?php  
      }
      ?>
    </div>
  </div>
  <br>
  <br>
  <div class="container col-lg-12">
    <div class="border rounded col-lg-6 p-3">
      <h3 class="py-3">Order Details:</h3>
        <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Product Name</th>
          <th scope="col">Product Price</th>
          <th scope="col">Quantity</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $count1=1;
        while($row=mysqli_fetch_assoc($res2))
        { ?>
        <tr>
          <th scope="row"><?php echo $count1 ?></th>
          <td><?php echo $row['productname'] ?></td>
          <td><?php echo $row['productprice'] ?></td>
          <td><?php echo $row['quantity'] ?></td>
        </tr>
        <?php
        $count1 +=1;  
        }
        ?>
        </tbody>
        </table>
        
    </div>
    <form action="confirmorder.php" method="POST">
    <button name='placeorder' class='btn btn-primary my-5'>Confirm order</button>
    </form>
  </div>

  <script src="https://kit.fontawesome.com/7bbfdad444.js" crossorigin="anonymous"></script>
</body>
</html>  
  
  