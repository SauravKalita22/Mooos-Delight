<?php
require('top.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='status'){
		$product=get_safe_value($conn,$_GET['productname']);
		$operation=get_safe_value($conn,$_GET['operation']);
		$id=get_safe_value($conn,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update orderdetails set status='$status' where id='$id' and productname='$product'";
		mysqli_query($conn,$update_status_sql);
	}
}

$sql="select * from orderdetails where id>=1";
$res=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Orders</h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <!-- <th class="serial">#</th> -->
							   <th>ID</th>
							   <th>User ID</th>
							   <th>Image</th>
							   <th>Name</th>
							   <th>Price</th>
							   <th>Quantity</th>
							   <th>Operations</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['userid']?></td>
							   <td><img src="<?php echo $row['image']?>"/></td>
							   <td><?php echo $row['productname']?></td>
							   <td><?php echo $row['productprice']?></td>
							   <td><?php echo $row['quantity']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&productname=".$row['productname']."&id=".$row['id']."'>En Route</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&productname=".$row['productname']."&id=".$row['id']."'>Delivered</a></span>&nbsp;";
								}
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
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