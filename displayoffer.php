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
			<h3>Special Offers</h3>
			<div class="ser-t">
				<b></b>
				<span><i></i></span>
				<b class="line"></b>
			</div>
		</div>
		<div class="tab-head ">
<!--content-->
<div class="content-mid">
	<div class="container">
		
	<?php
	$sqloffer="SELECT * FROM offer where status='Active'";
	$qsqloffer = mysqli_query($con,$sqloffer);
	while($rsoffer = mysqli_fetch_array($qsqloffer))
	{
	?>
		<div class="col-md-4">
			<div class="col-md ">
				<a href="hold.html">
					<img src="images/specialoffer.jpg" class="img-responsive img" alt="">
					<div class="big-sale">
						<div class="big-sale1">
							<p><?php echo $rsoffer['offeramt']; ?>% discount <br>for <?php echo $rsoffer['offertitle']; ?></p>
							<b style="color: yellow;">Offer Code</b>
							<h3><span><?php echo $rsoffer['offercode']; ?></span></h3>
						</div>
					</div>
				</a>
			</div>
		</div>
	<?php
	}
	?>
		
		<div class="clearfix"></div>
	</div>
</div>
<!--content-->
		</div>
	</div>
	</div>
	</div>


<?php
include("footer.php");
?>