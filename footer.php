<!--footer-->
<div class="footer">

	<div class="container">

			<div class="footer-bottom">
			
		<div class="col-md-12">
				<h2 ><a href="index.html">FoodBite<span>ONLINE FOOD ORDER</span></a></h2>
		</div>
		<div class="col-md-12 footer-grid">
			<?php
			if(!isset($_SESSION['employeeid']))
			{
				if(!isset($_SESSION['customerid']))
				{
			?>
			<p >	<a href="restlogin.php" style="color:white;">Restaurant Login</a> 

			| <a href="restregister.php" style="color:white;">Restaurant Register</a>
			<?php
				}
			}
			?>
			</p>
		</div>

				<div class=" address">
					<div class="col-md-4 fo-grid1">
							<p><i class="fa fa-home" aria-hidden="true"></i>12K Street  Building Road Mangalore</p>
					</div>
					<div class="col-md-4 fo-grid1">
							<p><i class="fa fa-phone" aria-hidden="true"></i>+1234 758 839 , +1273 748 730</p>	
					</div>
					<div class="col-md-4 fo-grid1">
						<p><a href="mailto:info@example.com"><i class="fa fa-envelope-o" aria-hidden="true"></i>FoodBite@gmail.com</a></p>
					</div>
					<div class="clearfix"></div>
					
					</div>
			</div>
		<div class="copy-right">
			<p> &copy; 2019 Restaurant Hub. All Rights Reserved | Designed by Lavanya & Akshatha 
			<?php
			if(!isset($_SESSION['employeeid']))
			{
				if(!isset($_SESSION['customerid']))
				{
			?>
			| <a href="emplogin.php">Employee Login Panel</a>
			<?php
				}
			}
			?>
			</p>
			
		</div>
	</div>
</div>
<!-- //footer-->

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
		<script type='text/javascript' src="js/jquery.mycart.js"></script>
  <script type="text/javascript">
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
<!-- //for bootstrap working -->

</body>
</html>