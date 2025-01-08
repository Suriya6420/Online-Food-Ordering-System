<?php
include("header.php");
$sql= "SELECT restaurant.*,location.locationname FROM restaurant LEFT JOIN location ON restaurant.locationid=location.locationid WHERE restaurantid='$_GET[restaurantid]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);

if($rs["restaurantimage"] == "")
{
	$imgname = "images/no-logo.png";
}
else if(file_exists("imgrestaurant/".$rs[restaurantimage]))
{
	$imgname= "imgrestaurant/".$rs[restaurantimage];
}
else
{
	$imgname = "images/no-logo.png";
}
?>
  <!---->
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 ><?php echo $rs[restaurantname]; ?></h3>
		<h4><a href="index.php">Home</a><label></h4>
		<div class="clearfix"> </div>
	</div>
</div>
		<div class="single">
			<div class="container">
						<div class="single-top-main">
	   		<div class="col-md-5 single-top">
	   		<div class="single-w3agile">
							
<div id="picture-frame">
			<?php echo"<img src='$imgname' style='width:100%;height:250px;' >";  ?>
		</div>
		<script src="js/jquery.zoomtoo.js"></script>
		<script>
			$(function() {
				$("#picture-frame").zoomToo({
					magnify: 1
				});
			});
		</script>
		
		
		
			</div>
			</div>
			<div class="col-md-5 single-top-left ">
								<div class="single-right">
				<h3><?php echo $rs[restaurantname]; ?></h3>
				
					
				 <div class="pr-single">
				  <p class="reduced "><?php echo $rs[restauranttype]; ?></p>
				</div>
				<?php
				/*
				<!-- ratings -->
				<div class="block block-w3">
					<div class="starbox small ghosting"> </div>
				</div>
				*/
				?>
				<p class="in-pa"> <?php echo $rs[restaurantdiscription]; ?> </p>
			   	
				<ul class="social-top">
					<li><a href="#" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i><span></span></a></li>
				</ul>
				
				 
			   
			<div class="clearfix"> </div>
			</div>
		 

			</div>
			
			
			<div class="col-md-2 single-top-left ">
								<div class="single-right">				
					
				 <div class="pr-single">
				  <p>
					<b><?php echo $rs[restaurantname]; ?></b><br>
					<?php echo $rs[address]; ?><br>
				  <b></b> <?php echo $rs[locationname]; ?><br><br>
				  <b>Ph.</b> <?php echo $rs[contactno]; ?>
				  </p>
				</div>
				<?php
				/*
				<!-- ratings -->
				<div class="block block-w3">
					<div class="starbox small ghosting"> </div>
				</div>
				*/
				?>
			   
			<div class="clearfix"> </div>
			</div>
		 

			</div>
			
		   <div class="clearfix"> </div>
	   </div>	
				 
				
	</div>
</div>
<div class="content-top offer-w3agile">
	<div class="container ">
			<div class="spec ">
				<h3>Items from <?php echo $rs[restaurantname]; ?></h3>
					<div class="ser-t">
						<b></b>
						<span><i></i></span>
						<b class="line"></b>
					</div>
			</div>
			<div class=" con-w3l wthree-of">
					
	<div class="row">
		<form method="get" action=""> 
		<input type="hidden" name="restaurantid" id="restaurantid" value="<?php echo $_GET[restaurantid]; ?>" >
			<div class="col-md-1"></div>
			<div class="col-md-6">
				<select name="foodtype" id="foodtype" class="form-control">
					<option value="">Select Food Type</option>
					<?php
					$arr = array("General","Breakfast","Lunch","Dinner");
					foreach($arr as $val)
					{
						if($val == $_GET[foodtype])
						{
						echo "<option value='$val' selected>$val</option>";
						}
						else
						{
						echo "<option value='$val'>$val</option>";
						}
					}
					?>
				</select>
			</div>
			<div class="col-md-4">
				<input type="button" value="Select" name="select" class="btn btn-info" onclick="loaditemrecord(foodtype.value,restaurantid.value)" >
			</div>
			<div class="col-md-1"></div>
		</form>
	</div>



</div>	
<br>			
<div id="divitemlist"><?php include("ajaxitemlist.php"); ?></div>
							
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
						 </div>
					</div>
				</div>
<?php
include("footer.php");
?>
<script>
function loaditemrecord(foodtype,restaurantid)
{
	$.post("ajaxitemlist.php", {foodtype: foodtype,restaurantid: restaurantid}, function(result){
		//alert(result);
		$("#divitemlist").html(result);
	});
}
</script>