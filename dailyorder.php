<?php
include("header.php");
if(isset($_POST['submit']))
{
	$dttime= date("Y-m-d H:i:s");
	$sql ="UPDATE payment SET orderdatetime='$dttime',customerid='$_POST[customerid]',paidamount='$_POST[paidamount]',offerid='$_POST[offerid]',paymenttype='$_POST[paymenttype]',paymentdetail='$_POST[paymentdetail]',orderdatetime='$dttim',employeeid='$_POST[employeeid]',address='<b>$_POST[name]</b><br>$_POST[address]',locationid='$_POST[locationid]',cityid='$_POST[cityid]',contactno='$_POST[contactno]',status='Paid' WHERE status='Inactive' AND customerid='$_POST[customerid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) >= 1)
	{			
		$sql="UPDATE foodorder SET status='Paid' WHERE paymentid!='0' AND customerid='$_POST[customerid]' AND status='Inactive'";
		$qsql = mysqli_query($con,$sql);
		echo "<script>alert('Daily Order Payment done successfully..');</script>";
		echo "<script>window.location='viewdailyorderpayment.php';</script>";
	} 
	else
	{
		echo mysqli_error($con);
	}
}
else
{
	$sql ="DELETE FROM  foodorder WHERE customerid='$_SESSION[customerid]' AND status='Inactive'";
	mysqli_query($con,$sql);
	$sql ="DELETE FROM  payment WHERE customerid='$_SESSION[customerid]' AND status='Inactive'";
	mysqli_query($con,$sql);
}
?>

 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>Daily Order</h3>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact">
	<div class="container">

		<div class=" contact-w3">	
			<div class="col-md-12 contact-left">
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<ul class="resp-tabs-list hor_1">
							<li><i class="fa fa-calendar" aria-hidden="true"></i> Select items</li>
							<li> <i class="fa fa-table" aria-hidden="true"></i> View Daily order Cart</span></li>
							<li onclick="loaddailyorderpayment()"> <i class="fa fa-map-marker" aria-hidden="true"></i> Make payment</li>
						</ul>
						<div class="resp-tabs-container hor_1">
							<div>
								<form action="#" method="post">

<input type="button" value="Vegetarian" onclick="loadrestaurant('displaydailyorderrestaurant.php?restauranttype=Vegetarian')" > 
<input type="button" value="Non-Vegetarian" onclick="loadrestaurant('displaydailyorderrestaurant.php?restauranttype=Non-Vegetarian')" > 
<input type="button" value="Veg & Non-Veg" onclick="loadrestaurant('displaydailyorderrestaurant.php?restauranttype=Both')"> 
<hr>
<div class="row" >
	<div class="col-md-12">
		<div id="divrestaurant"></div>
	</div>
</div>
<hr>
<div class="row" >
	<div class="col-md-12">
		<div id="divrestaurantdetail"></div>
	</div>
</div>
								</form>
							</div>
							<div>
							
<div class="map-grid" id="divdailyorderlist">
</div>
<div id="divcalendar"><?php include("ajaxcalendar.php"); ?></div>
							</div>
							<div>
								<div class="map-grid" >
	<div id="divdailyorderpayment"><img src="images/loading.gif"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!--Plug-in Initialisation-->
				<script type="text/javascript">
				$(document).ready(function() {
					//Horizontal Tab
					$('#parentHorizontalTab').easyResponsiveTabs({
						type: 'default', //Types: default, vertical, accordion
						width: 'auto', //auto or any width like 600px
						fit: true, // 100% fit in a container
						tabidentify: 'hor_1', // The tab groups identifier
						activate: function(event) { // Callback function if tab is switched
							var $tab = $(this);
							var $info = $('#nested-tabInfo');
							var $name = $('span', $info);
							$name.text($tab.text());
							$info.show();
						}
					});

					// Child Tab
					$('#ChildVerticalTab_1').easyResponsiveTabs({
						type: 'vertical',
						width: 'auto',
						fit: true,
						tabidentify: 'ver_1', // The tab groups identifier
						activetab_bg: '#fff', // background color for active tabs in this group
						inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
						active_border_color: '#c1c1c1', // border color for active tabs heads in this group
						active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
					});

					//Vertical Tab
					$('#parentVerticalTab').easyResponsiveTabs({
						type: 'vertical', //Types: default, vertical, accordion
						width: 'auto', //auto or any width like 600px
						fit: true, // 100% fit in a container
						closed: 'accordion', // Start closed if in accordion view
						tabidentify: 'hor_1', // The tab groups identifier
						activate: function(event) { // Callback function if tab is switched
							var $tab = $(this);
							var $info = $('#nested-tabInfo2');
							var $name = $('span', $info);
							$name.text($tab.text());
							$info.show();
						}
					});
				});
			</script>
				
			</div>
			
		<div class="clearfix"></div>
	</div>
	</div>
</div>
<!-- //contact -->

<?php
include("footer.php");
?>
<script>
function loadrestaurant(url)
{
	//document.getElementById("divrestaurant").innerHTML=;
	$.get(url, function(data) 
	{
    $('#divrestaurant').html(data);
  });
}
</script>
<script>
function displayrestaurantdetail(url)
{
	$.get(url, function(data) 
	{
    $('#divrestaurantdetail').html(data);
  });
}
</script>
<script>
function loaddailyorderpayment()
{
	$.get('jsdailyordermakepayment.php', function(data) 
	{
    $('#divdailyorderpayment').html(data);
  });
}
</script>
<!-- tabs -->
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true   // 100% fit in a container
			});
		});				
	</script>
<!-- //tabs -->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
<!-- for bootstrap working -->
		<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<script type='text/javascript' src="js/jquery.mycart.js"></script>
  <script type="text/javascript">
  $(function () {
  $(function () {
  $(function () {
  $(function () {
  $(function () {
  $(function () {
  $(function () {
    var goToCartIcon = function($addTocartBtn){
      var $cartIcon = $(".my-cart-icon");
      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
      $addTocartBtn.prepend($image);
      var position = $cartIcon.position();
      $image.animate({
        top: position.top,
        left: position.left
      }, 500 , "linear", function() {
        $image.remove();
      });
    }

    $('.my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      affixCartIcon: true,
      checkoutCart: function(products) {
        $.each(products, function(){
          console.log(this);
        });
      },
      clickOnAddToCart: function($addTocart){
        goToCartIcon($addTocart);
      },
      getDiscountPrice: function(products) {
        var total = 0;
        $.each(products, function(){
          total += this.quantity * this.price;
        });
        return total * 1;
      }
    });
  });
</script>
<script>
function addtodailycart(itemid)
{
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("divitemid"+itemid).innerHTML = this.responseText;
			viewdailyorderlist();
		}
	};
	xmlhttp.open("GET","ajaxdailyorderaddtocart.php?itemid="+itemid,true);
	xmlhttp.send();
}
function viewdailyorderlist()
{
	if (window.XMLHttpRequest) 
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} 
	else 
	{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("divdailyorderlist").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","ajaxdailyorderlist.php",true);
	xmlhttp.send();
}
function updatecart(id,qty)
{
	if (window.XMLHttpRequest) 
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("divdailyorderlist").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","ajaxdailyorderlist.php?id="+id+"&qty="+qty,true);
	xmlhttp.send();
}
function loadcalendar(month,year)
{
	if (window.XMLHttpRequest) 
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("divcalendar").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","ajaxcalendar.php?month="+month+"&year="+year,true);
	xmlhttp.send();
}
function insertpayment(paydt,grandtotal,chkid)
{
	if(document.getElementById("selecteddt[" + chkid + "]").checked == true)
	{
		if (window.XMLHttpRequest) 
		{
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) {
				//	alert(this.responseText);
				//document.getElementById("divcalendar").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","ajaxdailyorderpayment.php?paydt="+paydt+"&grandtotal="+grandtotal+"&chk=True",true);
		xmlhttp.send();	
	}
	if(document.getElementById("selecteddt[" + chkid + "]").checked == false)
	{
		if (window.XMLHttpRequest) 
		{
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) {
				//	alert(this.responseText);
				//document.getElementById("divcalendar").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","ajaxdailyorderpayment.php?paydt="+paydt+"&grandtotal="+grandtotal+"&chk=False",true);
		xmlhttp.send();	
	}
}
function insertpaymenttime(paydt,grandtotal,chkid,tim)
{
	if (window.XMLHttpRequest) 
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) {
			//	alert(this.responseText);
			//document.getElementById("divcalendar").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","ajaxdailyorderpayment.php?paydt="+paydt+"&grandtotal="+grandtotal+"&chk=Time&tim="+tim,true);
	xmlhttp.send();	
}
</script>