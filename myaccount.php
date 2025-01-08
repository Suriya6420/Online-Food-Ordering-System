<?php
include("header.php");
?>
  <!---->


<!--content-->
<div class="kic-top ">
	<div class="container ">
	<div class="kic "><center><h3>My Account</h3></center></div>
		<div class="col-md-4 kic-top1">
			<a href="customerprofile.php">
				<img src="images/profile.png" class="img-responsive" style="width: 100%;height: 300px;">
			</a>
			<h6>My Profile</h6>
			<p>Update customer profile..</p>
		</div>
		<div class="col-md-4 kic-top1">
			<a href="customerchangepassword.php">
				<img src="images/changepassword.png" class="img-responsive" alt="" style="width: 100%;height: 300px;">
			</a>
			<h6>Change Password</h6>
			<p>Reset password here..</p>
		</div>
		<div class="col-md-4 kic-top1">
			<a href="vieworder.php">
				<img src="images/foodorders.png" class="img-responsive" alt="" style="width: 100%;height: 300px;">
			</a>
			<h6>My Orders</h6>
			<p>View order details</p>
		</div>
	</div>
</div>
<hr>
<?php
include("footer.php");
?>