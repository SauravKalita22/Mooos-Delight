<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require ("dbconnect.php");
$showshipping=false;
$orderid='';

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

$sqladd = "select id from orderdetails ORDER BY id DESC LIMIT 1;";
$result1 = mysqli_query($conn, $sqladd);
while ($row = mysqli_fetch_array($result1))
{
  $orderid =(int)$row['id'] + 1;
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(isset($_POST['checkout']))
  {
    $showshipping=true;
  }
  
  if(isset($_POST['confirm_order']))
  {
    $userid=$_SESSION["id"];
    $fullname=$_POST["fullname"];
    $mobile=$_POST["mobile"];
    $pincode=$_POST["pincode"];
    $houseno=$_POST["houseno"];
    $address=$_POST["address"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    $payment=$_POST["payment"];

    $_SESSION['orderid']=$orderid;
    $query1="insert into shipping values('NULL','$userid','$orderid','$fullname','$mobile','$pincode','$houseno','$address','$city','$state','$payment')";
    if(mysqli_query($conn,$query1))
    {
      $sql="INSERT INTO `orderdetails`(`id`, `userid`, `image`, `productname`, `productprice`, `quantity`,`status`) VALUES (?,?,?,?,?,?,1)";
      $stmt=mysqli_prepare($conn,$sql);
      if($stmt)
      {
          mysqli_stmt_bind_param($stmt,"iissii",$orderid,$userid,$image,$productname,$productprice,$quantity);
          foreach($_SESSION['cart'] as $key => $values)
          {
            $image=$values['image'];
            $productname=$values['product'];
            $productprice=$values['price'];
            $quantity=$values['quantity'];
            mysqli_stmt_execute($stmt);
          }
          unset($_SESSION['cart']);
          echo "<script>alert('Checking out');window.location='confirmorder.php'</script>";
      }
    }  
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
                    <a class="nav-link" href="shoppingcart.php"><small> CART (<?php echo $count; ?>)</small></a>
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
  <!-- cart -->
  <div class="container">
    <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light my-5">
            <h1>SHOPPING CART</h1>
        </div>
          <div class="col-lg-10">
            <table class="table">
              <thead class="text-center">
              <tr>
                <th scope="col">Serial No.</th>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col"></th>
              </tr>
              </thead>
              <tbody class="text-center">
                <?php 
                if(isset($_SESSION['cart']))
                {
                  $total=0;
                  foreach($_SESSION['cart'] as $key => $value)
                  {
                    $sr=$key+1;
                    $total=$total+$value['price'];
                    echo "<tr>
                    <th scope='row'>$sr</th>
                    <td><img src='$value[image]' style='height: 40px; width: 40px;'></td>
                    <td>$value[product]<input type='hidden' name='product' value='$value[product]'</td>
                    <td>₹ $value[price]<input type='hidden' class='iprice' name='price' value='$value[price]'></td>;
                    <td>
                      <form action='managecart.php' method='POST'>
                        <input class='text-center iquantity' name='mod_quantity' onchange='this.form.submit();' type='number' value='$value[quantity]' min='1' max='10'>
                        <input type='hidden' name='product' value='$value[product]'>
                      </form>
                    </td>
                    <td class='itotal'></td>
                    <td>
                      <form action='managecart.php' method='POST'>
                        <button name='removeproduct' class='btn btn-sm btn-outline-danger'>REMOVE</button>
                        <input type='hidden' name='product' value='$value[product]'>
                      </form>
                    </td>
                    </tr>";
                  }
                }
                ?>
              </tbody>
            </table>     
          </div>   
          <div class="col-lg-2 border rounded bg-light">
            <br>
            <h3 class='text-center'>Total Amount:</h3>
            <h4 class='text-center' id='gtotal'></h4>
            <br>
            <?php
            if($_SESSION['checkout'])
            {?>
            <form action="shoppingcart.php" method="POST">
              <button type='submit' name='checkout' class='btn btn-warning w-100 my-5'>Checkout</button>
            </form>
            <?php
            }
            ?>  
            <br>  
          </div>     
    </div>
  </div>

  <?php
  if($showshipping)
  {
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
    { ?>
      <div class="container text-center my-5 py-3">
      <h1>SHIPPING DETAILS</h1>
      <h5>Enter your shipping details</h5>
      </div>
      <div class="container border rounded p-5">
      <form action="shoppingcart.php" method="POST">
        <div class="form-group">
            <label for="fullname"><b>FULL NAME</b></label>
            <input type="text" class="form-control" name="fullname" placeholder="Enter your full name" required>
        </div>
        <br>
        <div class="form-group">
            <label for="mobile"><b>MOBILE NUMBER</b></label>
            <input type="text" class="form-control" name="mobile" maxlength=10 placeholder="Enter your mobile number" required>
        </div>
        <br>
        <div class="form-group">
            <label for="pincode"><b>PIN CODE</b></label>
            <input type="text" class="form-control" name="pincode" maxlength=6 placeholder="Enter your pincode" required>
        </div>
        <br>
        <div class="form-group">
            <label for="houseno"><b>HOUSE NO/FLAT NO/APARTMENT</b></label>
            <input type="text" class="form-control" name="houseno" placeholder="Enter your house number" required>
        </div>
        <br>
        <div class="form-group">
            <label for="address"><b>FULL ADDRESS</b></label>
            <textarea class="form-control" name="address" rows="3" placeholder="Enter your full address" required></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="city"><b>TOWN/CITY</b></label>
            <input type="text" class="form-control" name="city" placeholder="Enter your city" required>
        </div>
        <br>
        <div class="form-group">
            <label for="state"><b>STATE</b></label>
            <input type="text" class="form-control" name="state" placeholder="Enter your state" required>
        </div>
        <br>
        <div class="form-group">
            <label for="payment"><b>PAYMENT METHOD</b></label>
            <br>
            <select name="payment">
                <option value="COD">Cash on Delivery</option>
                <option value="Card">Debit/Credit Card</option>
                <option value="Net Banking">Net Banking</option>
                <option value="UPI">UPI</option>
            </select>
        </div>
        <button type="submit" name="confirm_order" class="btn btn-primary mt-5">Confirm Order</button>
      </form>
      </div>
    <?php
    }
    else
    {
      echo "<script>alert('You must login before continuing');window.location='login.php'</script>";
      $loggedin=false;
      die();
    }
  }?>
  
  <!-- item*quantity=total script -->
  <script>
    var gt=0;
    var iprice=document.getElementsByClassName('iprice');
    var iquantity=document.getElementsByClassName('iquantity');
    var itotal=document.getElementsByClassName('itotal');
    var gtotal=document.getElementById('gtotal');

    function subtotal()
    {
      gt=0;
      for(i=0;i<iprice.length;i++)
      {
        itotal[i].innerText='₹ '+(iprice[i].value)*(iquantity[i].value);
        gt=gt+(iprice[i].value)*(iquantity[i].value);
      }
      gtotal.innerText='₹ '+gt;
    }
    subtotal();
  </script>

  <script src="js/bootstrap.bundle.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- <script src="js/index.js"></script> -->

</body>
</html>