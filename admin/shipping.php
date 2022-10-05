<?php
require('top.php');

$sql="select * from shipping";
$res=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Shipping Details </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th>ID</th>
							   <th>User ID</th>
							   <th>Order ID</th>
							   <th>Name</th>
							   <th>Mobile No.</th>
							   <th>Pincode</th>
							   <th>House No.</th>
                               <th>Address</th>
                               <th>city</th>
                               <th>State</th>
                               <th>Payment Method</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['userid']?></td>
							   <td><?php echo $row['orderid']?></td>
							   <td><?php echo $row['fullname']?></td>
							   <td><?php echo $row['mobileno']?></td>
							   <td><?php echo $row['pincode']?></td>
                               <td><?php echo $row['houseno']?></td>
                               <td><?php echo $row['address']?></td>
                               <td><?php echo $row['city']?></td>
                               <td><?php echo $row['state']?></td>
                               <td><?php echo $row['payment']?></td>
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