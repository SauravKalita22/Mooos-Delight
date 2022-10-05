<?php 
require("navbar.php");
$my = date("Y/m/d 00:00:00");
$my1 = date("Y/m/d 23:59:59");

$sql="select vendor.vendor, product.* from vendor, product where vendor.id = product.vendor_id and product.bestsell = 'yes' and product.status = 1;";
$sql1="select vendor.vendor, product.* from vendor, product where vendor.id = product.vendor_id and product.featured = 'yes' and product.status = 1;";
$sql2="select vendor.vendor, product.* from vendor, product where vendor.id = product.vendor_id and product.new>='$my' and product.new <= '$my1' and product.status = 1;";
$res=mysqli_query($conn,$sql);
$res1=mysqli_query($conn,$sql1);
$res2=mysqli_query($conn,$sql2);
$location="/dairy/media/product/";
?>

  <!-- Carousel -->
  <section>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <div class="carousel-indicators mb-3">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
            <div class="carousel-inner mb-5">
              <div class="carousel-item active">
                <img class="d-block w-100" src="img/car1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="img/car2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="img/car3.png" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            </a>
          </div>
  </section>

  <!-- Best selling products -->
  <section>
        <div class="container">
            <span><h2 class="pb-5 px-auto text-center">Best Selling Products</h2></span>
            <div class="row pb-3 g-3">
              <?php
              while($row=mysqli_fetch_array($res)){?>
              <div class="col-lg-3">
                <div class="card text-center" style="width: 18rem;">
                    <img src="<?php echo $location.$row['image']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row["name"]?></h5>
                      <p class="card-text"><h5 style="text-decoration: line-through;">₹<?php echo $row["mrp"]?></h5><h3>₹<?php echo $row["price"]?></h3></p>
                      <p class="card-text"><?php echo $row['vendor'] ?></p>
                    </div>
                  </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>   
  </section>
  <hr class="hr">

  <!-- Featured Products -->
  <section>
  <div class="container">
            <span><h2 class="pb-5 px-auto text-center">Featured Products</h2></span>
            <div class="row pb-3 g-3">
              <?php
              while($row=mysqli_fetch_array($res1)){?>
              <div class="col-lg-3">
                <div class="card text-center" style="width: 18rem;">
                    <img src="<?php echo $location.$row['image']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row["name"]?></h5>
                      <p class="card-text"><h5 style="text-decoration: line-through;">₹<?php echo $row["mrp"]?></h5><h3>₹<?php echo $row["price"]?></h3></p>
                      <p class="card-text"><?php echo $row['vendor'] ?></p>
                    </div>
                  </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div> 
  </section>
  <hr class="hr">


  <!-- Top Rated Products -->
  <section>
        <div class="container">
            <span><h2 class="pb-5 px-auto text-center">New Products</h2></span>
            <div class="row pb-3 g-3">
              <?php
              while($row=mysqli_fetch_array($res2)){?>
              <div class="col-lg-3">
                <div class="card text-center" style="width: 18rem;">
                    <img src="<?php echo $location.$row['image']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row["name"]?></h5>
                      <p class="card-text"><h5 style="text-decoration: line-through;">₹<?php echo $row["mrp"]?></h5><h3>₹<?php echo $row["price"]?></h3></p>
                      <p class="card-text"><?php echo $row['vendor'] ?></p>
                    </div>
                  </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>  
  </section>
  <hr class="hr">

  <!-- showcase -->
  <div class="container">
    <div class="row">
      <div class="col-10">
       <img src="img/showcase.jpg" alt="">
      </div>
      <div class="col">
      </div>
    </div>
  </div>
  <hr class="hr">
   
<?php 
require ("footer.php");
?>