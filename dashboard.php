<?php
include("header.php");
?>
  <!---->
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
<script src="js/jquery.vide.min.js"></script>

<!--content-->
<div class="content-top ">
	<div class="container ">
		<div class="spec ">
			<h3>Admin Dashboard</h3>
			<div class="ser-t">
				<b></b>
				<span><i></i></span>
				<b class="line"></b>
			</div>
		</div>
		
	</div>
	</div>
	</div>

	
	<!-- contact -->
<div class="contact">
	<div class="container">
		<div class=" contact-w3">	
<?php
include("sidebar.php");
?>
			<div class="col-md-9 ">
				<div id="container">

				
					
		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="#">
					<img src="images/catimg.png" class="img-responsive img" alt="" style="height:300px;">
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;" >
						<div class="big-sale1" style="margin: 0em 0 0;">
							<h3 style="color:red;">
							<?php
							$sql="SELECT * FROM category";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p  style="color:red;">Number of Category  </p>
						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="#">
					<img src="images/cityimg.jpeg" class="img-responsive img" alt="" style="height:300px;">
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;">
						<div class="big-sale1" style="margin: 0em 0 0;">
							<h3>
							<?php
							$sql="SELECT * FROM city";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p> City</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="#">
					<img src="images/custimg.png" class="img-responsive img" alt="" style="height:300px;">
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;">
						<div class="big-sale1" style="margin: 0em 0 0;">
							<h3>
							<?php
							$sql="SELECT * FROM customer";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p>No Of Customers</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="#">
					<img src="images/orderimg.jpg" class="img-responsive img" alt="" style="height:300px;">
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;">
						<div class="big-sale1" style="margin: 0em 0 0;">
							<h3>
							<?php
							$sql="SELECT * FROM foodorder";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p>No Of Food Order</p>
						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="#">
					<img src="images/co.jpg" class="img-responsive img" alt="" style="height:300px;">
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;">
						<div class="big-sale1" style="margin: 0em 0 0;">
							<h3>
							<?php
							$sql="SELECT * FROM item";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p>No Of Items</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="hold.html">
					<img src="images/co.jpg" class="img-responsive img" alt="" style="height:300px;">
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;">
						<div class="big-sale1" style="margin: 0em 0 0;">
							<h3>
							<?php
							$sql="SELECT * FROM location";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p>Location </p>
						</div>
					</div>
				</a>
			</div>
		</div>
		
		
		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="#">
					<img src="images/empimg.jpg" class="img-responsive img" alt="" style="height:300px;" >
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;">
						<div class="big-sale1" style="margin: 0em 0 0;">
						<h3>
						<?php
							$sql="SELECT * FROM employee";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p>Employee</p>
						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="hold.html">
					<img src="images/co.jpg" class="img-responsive img" alt="" style="height:300px;">
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;">
						<div class="big-sale1" style="margin: 0em 0 0;">
							<h3>
							<?php
							$sql="SELECT * FROM offer";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p>Offer</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="hold.html">
					<img src="images/co.jpg" class="img-responsive img" alt="" style="height:300px;">
					<div class="big-sale" style="background: rgba(176, 175, 80, 0.3); opacity: 167.5; filter: alpha(opacity=1);width: 140px;height: 140px;">
						<div class="big-sale1" style="margin: 0em 0 0;">
							<h3>
							<?php
							$sql="SELECT * FROM restaurant";
							$qsql = mysqli_query($con,$sql);
							echo mysqli_num_rows($qsql);
							?>
							</h3>
							<p>No Of Restaurant</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		
		
		<div class="clearfix"></div>
				
				</div>
				</div>
			
		<div class="clearfix"></div>
	</div>
	</div>
</div>
<!-- //contact -->


<?php
include("footer.php");
?>