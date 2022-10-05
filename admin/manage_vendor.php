<?php
require('top.php');
$vendor='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from vendor where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$vendor=$row['vendor'];
	}else{
		header('location:vendor.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$vendor=get_safe_value($conn,$_POST['vendor']);
	$res=mysqli_query($conn,"select * from vendor where vendor='$vendor'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="vendor already exist";
			}
		}else{
			$msg="vendor already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($conn,"update vendor set vendor='$vendor' where id='$id'");
		}else{
			mysqli_query($conn,"insert into vendor(vendor,status) values('$vendor','1')");
		}
		header('location:vendor.php');
		die();
	}
}
?>
		<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Vendor</strong></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="vendor" class=" form-control-label">Vendor</label>
									<input type="text" name="vendor" placeholder="Enter vendor name" class="form-control" required value="<?php echo $vendor?>">
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