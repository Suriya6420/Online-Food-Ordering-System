<?php
include("header.php");
if(isset($_SESSION["restaurantid"]))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST[submit]))
{
	$sql= "SELECT * FROM restaurant WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION["restaurantid"] = $rs[restaurantid];
		echo "<script>alert('Logged in successfully...')</script>";
		echo "<script>window.location='restaurantaccount.php';</script>";
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
		<h3 >Restaurant Login Panel</h3>
		<div class="clearfix"> </div>
	</div>
</div>
<!--login-->

	<div class="login">
	
		<div class="main-agileits">
				<div class="form-w3agile">
					<h3>Restaurant Login Panel</h3>
					<form action="#" method="post">
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text" name="loginid" placeholder="enter loginid">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" name="password" placeholder="enter password">
							<div class="clearfix"></div>
						</div>
						<input type="submit" name="submit" value="Login" >
					</form>
				</div>
			</div>
		</div>
<?php
include("footer.php");
?>