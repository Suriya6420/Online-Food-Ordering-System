<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$pagename=basename($_SERVER['PHP_SELF']);
if(isset($_GET[locationid]))
{
	$_SESSION['locationid'] = $_GET['locationid'];
	echo "<script>window.location='$pagename';</script>";
}
include("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>FoodBite</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Restaurant Portal" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- js -->
   <script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
<!--- start-rate---->
<script src="js/jstarbox.js"></script>
	<link rel="stylesheet" href="css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript">
			jQuery(function() {
			jQuery('.starbox').each(function() {
				var starbox = jQuery(this);
					starbox.starbox({
					average: starbox.attr('data-start-value'),
					changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
					ghosting: starbox.hasClass('ghosting'),
					autoUpdateAverage: starbox.hasClass('autoupdate'),
					buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
					stars: starbox.attr('data-star-count') || 5
					}).bind('starbox-value-changed', function(event, value) {
					if(starbox.hasClass('random')) {
					var val = Math.random();
					starbox.next().text(' '+val);
					return val;
					} 
				})
			});
		});
		</script>
<!---//End-rate---->

<link href="datatable/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="datatable/jquery.dataTables.min.js"></script>
<style>
	.errmsg
	{
		color: red;
	}
</style>
</head>
<body>
<a href="displayoffer.php"><img src="images/download.png" class="img-head" alt=""></a>

<div style="z-index: 11110;  position: absolute;  right: 0;  top: 0;height: 40px;background-color: #ED0612;padding: 10px;"  data-toggle="modal" data-target="#myModal"><a href="#" style="color: white;" class="hyper"><span><?php
if(isset($_SESSION['locationid']))
{
	$sqllocation= "SELECT * FROM location WHERE locationid='$_SESSION[locationid]'";
	$qsqllocation = mysqli_query($con,$sqllocation);
	$rslocation = mysqli_fetch_array($qsqllocation);
	echo " <i class='fa fa-map-marker' aria-hidden='true' style='font-size: 25px;'></i>$rslocation[locationname]";
}
else
{
	echo "Select Location";
}
?>
</span></a></div>

<div class="header">

		<div class="container">
			
			<div class="logo">
				<h1 ><a href="index.php">FoodBite<span>Online Food Order</span></a></h1>
			</div>
			<div class="head-t">
				<ul class="card">
					<?php
					if(isset($_SESSION['customerid']))
					{	
					?>
					<li><a href="myaccount.php" ><i class="fa fa-user" aria-hidden="true"></i>My Account</a></li>
					<li><a href="viewfoodorderpayment.php" ><i class="fa fa-file-text-o" aria-hidden="true"></i>Regular orders</a></li>
					<li><a href="viewdailyorderpayment.php" ><i class="fa fa-ship" aria-hidden="true"></i>Daily Orders</a></li>
					<?php
					}
					else if(isset($_SESSION[restaurantid]))
					{
					?>
					<li><a href="restaurantaccount.php" ><i class="fa fa-user" aria-hidden="true"></i>Restaurant Account </a></li>
					<?php
					}
					else if(isset($_SESSION[employeeid]))
					{
					?>
					<li><a href="dashboard.php" ><i class="fa fa-user" aria-hidden="true"></i>Dashboard </a></li>
					<li><a href="viewfoodorderpayment.php" ><i class="fa fa-file-text-o" aria-hidden="true"></i>Regular Order Report</a></li>
					<li><a href="viewdailyorderpayment.php" ><i class="fa fa-ship" aria-hidden="true"></i>Daily Order Report</a></li>
				   <?php
					}
					else
					{
                    ?>						
					<li><a href="custlogin.php" ><i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
					<li><a href="register.php" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Register</a></li>
                    <?php
					}
					if(isset($_SESSION[customerid]))
					{
					?>
<li><a href="logout.php" ><i class="fa fa-file-text-o" aria-hidden="true"></i>Logout</a></li>					
					<?php
					}
					else if(isset ($_SESSION[restaurantid]))
					{
					?>
<li><a href="logout.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>Logout</a></li>
                    <?php
					}
					else if(isset($_SESSION[employeeid]))
					{
					?>
<li><a href="logout.php" ><i class="fa fa-file-text-o" aria-hidden="true"></i>Logout</a></li>	
										
				    <?php
					}
					?>
				</ul>	
			</div>
			

				<div class="nav-top"  style="background-color: #353535;">
					<nav class="navbar navbar-default">
					
					<div class="navbar-header nav_2">
						<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div> 
					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
						<ul class="nav navbar-nav ">
<li <?php if($pagename == "index.php") { echo " class='active' "; } ?>  ><a href="index.php" class="hyper "><span>Home</span></a></li>			
<li <?php if($pagename == "about.php") { echo " class='active' "; } ?> ><a href="about.php" class="hyper "><span>About Us</span></a></li>		
<li <?php if($pagename == "displayrestaurant.php" && $_GET['restauranttype'] == "Vegetarian") { echo " class='active' "; } ?> ><a href="displayrestaurant.php?restauranttype=Vegetarian" class="hyper "><span>Veg Restaurant</span></a></li>
<li <?php if($pagename == "displayrestaurant.php" && $_GET['restauranttype'] == "Non-vegetarian") { echo " class='active' "; } ?> ><a href="displayrestaurant.php?restauranttype=Non-vegetarian" class="hyper "><span>Non-Veg Restaurant</span></a></li>
<li <?php if($pagename == "displayrestaurant.php" && $_GET['restauranttype'] == "Both") { echo " class='active' "; } ?> ><a href="displayrestaurant.php?restauranttype=Both" class="hyper "><span>Veg & Non-Veg Restaurant</span></a></li>
<li <?php if($pagename == "dailyorder.php") { echo " class='active' "; } ?> ><a href="dailyorder.php" class="hyper "><span>Daily order</span></a></li>
							
	<li <?php if($pagename == "contact.php") { echo " class='active' "; } ?> ><a href="contact.php" class="hyper"><span>Contact Us</span></a></li>
<?php
/*
	<li class="dropdown ">
		<a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown" ><span>Kitchen<b class="caret"></b></span></a>
		<ul class="dropdown-menu multi">
			<div class="row">
				<div class="col-sm-3">
					<ul class="multi-column-dropdown">

						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Water & Beverages</a></li>
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Fruits & Vegetables</a></li>
						<li><a href="kitchen.php"> <i class="fa fa-angle-right" aria-hidden="true"></i>Staples</a></li>
						<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Branded Food</a></li>
				
					</ul>
				
				</div>
				<div class="col-sm-3">
				
					<ul class="multi-column-dropdown">
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Breakfast &amp; Cereal</a></li>
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Snacks</a></li>
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Spices</a></li>
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Biscuit &amp; Cookie</a></li>
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Sweets</a></li>
				
					</ul>
				
				</div>
				<div class="col-sm-3">
				
					<ul class="multi-column-dropdown">
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Pickle & Condiment</a></li>
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Instant Food</a></li>
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Dry Fruit</a></li>
						<li><a href="kitchen.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Tea &amp; Coffee</a></li>
				
					</ul>
				</div>
				<div class="col-sm-3 w3l">
					<a href="kitchen.php"><img src="images/me.png" class="img-responsive" alt=""></a>
				</div>
				<div class="clearfix"></div>
			</div>	
		</ul>
	</li>
	<li class="dropdown">
	
		<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown" ><span> Personal Care <b class="caret"></b></span></a>
		<ul class="dropdown-menu multi multi1">
			<div class="row">
				<div class="col-sm-3">
					<ul class="multi-column-dropdown">
						<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Ayurvedic </a></li>
						<li><a href="care.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Baby Care</a></li>
						<li><a href="care.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Cosmetics</a></li>
						<li><a href="care.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Deo & Purfumes</a></li>
				
					</ul>
					
				</div>
				<div class="col-sm-3">
					
					<ul class="multi-column-dropdown">
						<li><a href="care.html"> <i class="fa fa-angle-right" aria-hidden="true"></i>Hair Care </a></li>
						<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Oral Care</a></li>
						<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Personal Hygiene</a></li>
						<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Skin care</a></li>
				
					</ul>
					
				</div>
				<div class="col-sm-3">
					
					<ul class="multi-column-dropdown">
						<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Fashion Accessories </a></li>
						<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Grooming Tools</a></li>
						<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Shaving Need</a></li>
						<li><a href="care.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Sanitary Needs</a></li>
				
					</ul>
				</div>
				<div class="col-sm-3 w3l">
					<a href="care.html"><img src="images/me1.png" class="img-responsive" alt=""></a>
				</div>
				<div class="clearfix"></div>
			</div>	
		</ul>
	</li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown" ><span>Household<b class="caret"></b></span></a>
		<ul class="dropdown-menu multi multi2">
			<div class="row">
				<div class="col-sm-3">
					<ul class="multi-column-dropdown">
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Cleaning Accessories</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>CookWear</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Detergents</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Gardening Needs</a></li>
				
					</ul>
				
				</div>
				<div class="col-sm-3">
					
					<ul class="multi-column-dropdown">
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Kitchen & Dining</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>KitchenWear</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Pet Care</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Plastic Wear</a></li>
				
					</ul>
				
				</div>
				<div class="col-sm-3">
				
					<ul class="multi-column-dropdown">
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Pooja Needs</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Serveware</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Safety Accessories</a></li>
						<li><a href="hold.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Festive Decoratives </a></li>
				
					</ul>
				</div>
				<div class="col-sm-3 w3l">
					<a href="hold.html"><img src="images/me2.png" class="img-responsive" alt=""></a>
				</div>
				<div class="clearfix"></div>
			</div>	
		</ul>
	</li>
	<li><a href="codes.html" class="hyper"> <span>Codes</span></a></li>
	<li><a href="#"  data-toggle="modal" data-target="#myModal" class="hyper"> <span>Select Location</span></a></li>
*/
?>
							
						
						</ul>
					</div>
					</nav>
					 <div class="cart" 
<?php
if(!isset($_SESSION['customerid']))
{
	echo " onclick='window.location=`custlogin.php`;' ";
}
?>
>
						<span class="fa fa-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
					</div>
					<div class="clearfix"></div>
				</div>
					
				</div>			
</div>

<!-- Modal starts-->
<?php
if(!isset($_SESSION['locationid']))
{
?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
<?php
}
?>
  <div class="modal fade" id="myModal" role="dialog"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Kindly select Location</h4>
        </div>
        <div class="modal-body">
          <p>
	<?php
	$sql= "SELECT * FROM location WHERE status='Active'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<button type='button' onclick='window.location=`$pagename?locationid=$rs[0]&pagename=$pagename`' class='btn btn-warning' style='width: 250px;height: 75px;'><br><i class='fa fa-map-marker' aria-hidden='true' style='font-size: 25px;'></i> $rs[locationname]<br> &nbsp;</button>";
	}
	?><br> &nbsp;
		  </p>
        </div>
      </div>
    </div>
  </div>