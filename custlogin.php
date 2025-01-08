<?php
include("header.php");
if(isset($_SESSION["customerid"]))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST[submit]))
{
	$sql= "SELECT * FROM customer WHERE emailid='$_POST[email]' AND password='$_POST[password]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION["customerid"] = $rs[customerid];
		$dttime = date("Y-m-d H:i:s");
		$sqlcustomer= "UPDATE customer SET lastlogin='$dttime' WHERE customerid='$_SESSION[customerid]'";
		mysqli_query($con,$sqlcustomer);
		echo "<script>alert('Logged in successfully...')</script>";
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		echo "<script>alert('Failed to login.');</script>";
	}
}
?>
  <!---->
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Login</h3>
		<h4><a href="index.html">Home</a><label>/</label>Login</h4>
		<div class="clearfix"> </div>
	</div>
</div>
<!--login-->

	<div class="login">
	
		<div class="main-agileits">
				<div class="form-w3agile">
					<h3>Login</h3>
					<form action="" method="post">
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text"  name="email" placeholder="Enter Email ID">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" name="password" placeholder="Enter password">
							<div class="clearfix"></div>
						</div>
						<input type="submit" name="submit" value="Login">
					</form>
				</div>
				<div class="forg">
					<a href="#" class="forg-left">Forgot Password</a>
					<a href="register.php" class="forg-right">Register</a>
				<div class="clearfix"></div>
				</div>
			</div>
		</div>
<?php
include("footer.php");
?>