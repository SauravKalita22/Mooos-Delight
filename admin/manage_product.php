<?php
require('top.php');
$vendor_id='';
$name='';
$mrp='';
$price='';
$image='';
$bestsell='';
$featured='';

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$vendor_id=$row['vendor_id'];
		$name=$row['name'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$bestsell=$row['bestsell'];
		$featured=$row['featured'];
	}else{
		header('location:product.php');
		die();
	}
}

if(isset($_POST['submit']))
{
	$vendor_id=get_safe_value($conn,$_POST['vendor_id']);
	$name=get_safe_value($conn,$_POST['name']);
	$mrp=get_safe_value($conn,$_POST['mrp']);
	$price=get_safe_value($conn,$_POST['price']);
	$bestsell=get_safe_value($conn,$_POST['bestsell']);
	$featured=get_safe_value($conn,$_POST['featured']);
	
	$res=mysqli_query($conn,"select * from product where name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	if($_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image format";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image format";
			}
		}
	}

	// image saved
	$file1=rand(111111111,999999999).'_'.$_FILES['image']['name'];
    $file_tmp1=$_FILES['image']['tmp_name'];
	$location="../media/product/";
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$update_sql="update product set vendor_id='$vendor_id',name='$name',mrp='$mrp',price='$price',image='$file1',bestseller='$bestsell',featured='$featured' where id='$id'";
				move_uploaded_file($file_tmp1,$location.$file1);
			}else{
				$update_sql="update product set vendor_id='$vendor_id',name='$name',mrp='$mrp',price='$price',bestsell='$bestsell',featured='$featured' where id='$id'";
			}
			mysqli_query($conn,$update_sql);
		}else{
			mysqli_query($conn,"insert into product(vendor_id,name,mrp,price,status,image,bestsell,featured) values('$vendor_id','$name','$mrp','$price',1,'$file1','$bestsell','$featured')");
			move_uploaded_file($file_tmp1,$location.$file1);
		}
		header('location:product.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="vendor" class=" form-control-label">Vendor</label>
									<select class="form-control" name="vendor_id">
										<option>Select Category</option>
										<?php
										$res=mysqli_query($conn,"select id,vendor from vendor order by vendor asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$vendor_id){
												echo "<option selected value=".$row['id'].">".$row['vendor']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['vendor']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="name" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
								</div>
								
								<div class="form-group">
									<label for="mrp" class=" form-control-label">MRP</label>
									<input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
								</div>
								
								<div class="form-group">
									<label for="price" class=" form-control-label">Price</label>
									<input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
								</div>

								<div class="form-group">
									<label for="bestsell" class=" form-control-label">Best-Selling</label>
									<input type="text" name="bestsell" placeholder="Type yes or no" class="form-control" required value="<?php echo $bestsell?>">
								</div>

								<div class="form-group">
									<label for="featured" class=" form-control-label">Featured</label>
									<input type="text" name="featured" placeholder="Type yes or no" class="form-control" required value="<?php echo $featured?>">
								</div>
								
								<div class="form-group">
									<label for="image" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
								</div>
								
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
		<script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>