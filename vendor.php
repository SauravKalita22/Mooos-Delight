<?php 
require ("navbar.php");

if(isset($_GET['id']))
{
    $ID=mysqli_real_escape_string($conn,$_GET['id']);
    $sql="SELECT * FROM `product` where vendor_id=$ID;";
    $res=mysqli_query($conn,$sql);
    $sql1="SELECT * FROM `vendor` where id=$ID;";
    $res1=mysqli_query($conn,$sql1);
}
$location="/dairy/media/product/";
?>

<!-- Carousel -->
<section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner mb-5">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/vendor.jpg" alt="First slide">
            </div>
        </div>
    </div>
</section>

<!-- Products -->
<section>
<div class="container">
    <?php 
    while($row=mysqli_fetch_array($res1)){ ?>
    <span><h2 class="pb-5 px-auto text-center"><?php echo $row["vendor"] ?> Products</h2></span>
    <?php
    }
    ?>
    <div class="row pb-3 g-3">
      <?php
      while($row=mysqli_fetch_assoc($res)){?>
      <div class="col-lg-3">
        <form action="managecart.php" method="POST">
        <div class="card text-center" style="width: 18rem;">
            <img src="<?php echo $location.$row['image']?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row["name"]?></h5>
              <p class="card-text"><h5 style="text-decoration: line-through;">₹<?php echo $row["mrp"]?></h5><h3>₹<?php echo $row["price"]?></h3></p>
              <button type="submit" name="addtocart" class="btn btn-dark">Add to cart</button>
              <input type="hidden" name="image" value="<?php echo $location.$row['image']?>">
              <input type="hidden" name="price" value="<?php echo $row["price"]?>">
              <input type="hidden" name="product" value="<?php echo $row["name"]?>">
            </div>
        </div>
        </form>
      </div>
      <?php } ?>
    </div>
</div>
</div>   
</section>

<?php
require ("footer.php");
?>