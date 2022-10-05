<?php
require("navbar.php");
$showAlert = '';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $email = $_POST["email"];
  $name = $_POST["name"];
  $comments = $_POST["comments"];

  $sql = "INSERT INTO `contactus` VALUES (NULL,'$email','$name','$comments',CURRENT_TIMESTAMP());";  
  $result = mysqli_query($conn, $sql);
  if ($result) 
  {
    $showAlert = true; 
  }
}
?>
<!-- Carousel -->
<!-- <section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-indicators mb-3">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
        <div class="carousel-inner mb-5">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/cow1.png" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/sky.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/carousel3.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        </a>
      </div>
    </div>  
</section> -->

<div class="container my-5">
  <div class="row align-items-center">
      <div class="col-lg">
      </div>
      <div class="col-lg">
      <?php
      if($showAlert)
      {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Your question has been added successfully. We will get back to you soon.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
      }
      ?>
          <div class="card" style="width: 700px;">
              <form action="contactus.php" method="POST">
                  <h1 class="text-center mt-5">Contact Us</h1>
                  <div class="form-group m-5">
                    <label for="email"><h4>Email address</h4></label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="AlexanderPickerbell333@hotmail.com">
                  </div>
                  <div class="form-group m-5">
                    <label for="name"><h4>Your Name</h4></label>
                    <input type="text" class="form-control" name="name" placeholder="Alex Bell">
                  </div>
                  <div class="form-group m-5">
                      <label for="comments"><h4>Your comments</h4></label>
                      <textarea class="form-control" name="comments" placeholder="Hi, I am Alex and this question is regarding your product........."></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary mx-5 mb-5">Submit</button>
              </form>
          </div>
      </div>
      <div class="col-lg">
      </div>
  </div>
</div>    

<?php
require("footer.php");
?>