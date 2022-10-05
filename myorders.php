<?php 
require ("dbconnect.php");
$loggedin='';
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin=true;
}
else{
  $loggedin=false;
}

$sql="SELECT * FROM `orderdetails` where `userid`=$_SESSION[id] ORDER BY `id` DESC;";
$res=mysqli_query($conn,$sql);
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
    <title>Document</title>
</head>
<body style="padding-top:200px;">
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
                  <!-- <li class="nav-item px-3 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Products
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="productpage.html">Milk</a></li>
                      <li><a class="dropdown-item" href="#">Paneer</a></li>
                      <li><a class="dropdown-item" href="#">Curd</a></li>
                      <li><a class="dropdown-item" href="#">Chaas</a></li>
                      <li><a class="dropdown-item" href="#">Cheese</a></li>
                      <li><a class="dropdown-item" href="#">Butter</a></li>
                    </ul>
                  </li> -->
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
        <h1>My Orders</h1>
        <table class="table my-5">
          <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col">Placed On</th>
            <th scope="col">Status</th>
          </tr>
          </thead>
          <tbody>
          <?php
          while($row=mysqli_fetch_assoc($res))
          { ?>
          <tr>
            <th scope="row"><img src='<?php echo $row['image'] ?>' style='height: 100px; width: 100px;'></th>
            <td><?php echo $row['productname'] ?></td>
            <td>₹ <?php echo $row['productprice'] ?></td>
            <td><?php echo $row['quantity'] ?></td>
            <td>₹ <?php echo ($row['quantity']*$row['productprice']) ?></td>
            <td><?php echo $row['dateplaced'] ?></td>
            <?php
            if($row['status'] == 0)
            {
              echo "<td>Delivered</td>";
            }
            else
            {
              echo "<td>En Route</td>";
            }
            ?>          
          </tr>
          <?php
          }
        ?>
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

</body>
</html>