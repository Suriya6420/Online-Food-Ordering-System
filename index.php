<?php
include("header.php");
?>
  <!---->
<div data-vide-bg="video/video">
    <div class="container">
		<div class="banner-info">
			<h3 style="color: black;"><b>One Thousand Flavours in One Place</b> </h3>	
			<div class="search-form">
				<form action="displayrestaurant.php" method="get">
					<input type="text" placeholder="Search Your Favorite Restaurant here..." name="search">
					<input type="submit" value=" " >
				</form>
			</div>		
		</div>	
    </div>
</div>

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
				<nav class="nav-sidebar">
					<ul class="nav tabs ">
<?php
$sqlcategory = "select * FROM category WHERE categorystatus='Active'";
$qsqlcategory = mysqli_query($con,$sqlcategory);
echo mysqli_error($con);
$iset=0;
while($rscategory = mysqli_fetch_array($qsqlcategory))
{
?>					
  <li 
  <?php
  if($iset == 0)
  {
	echo ' class="active" ';
	$iset=1;
  }
  ?>
  ><a href="#tab<?php echo $rscategory[0]; ?>" data-toggle="tab"><?php echo $rscategory['categoryname']; ?></a></li>
<?php
}
?>				  
					</ul>
				</nav>
				<div class=" tab-content tab-content-t ">
<?php
$sqlcategory = "select * FROM category WHERE categorystatus='Active'";
$qsqlcategory = mysqli_query($con,$sqlcategory);
echo mysqli_error($con);
$iset=0;
while($rscategory = mysqli_fetch_array($qsqlcategory))
{
?>		
					<div class="tab-pane   <?php
  if($iset == 0)
  {
	echo ' active ';
	$iset=1;
  }
  ?> text-style" id="tab<?php echo $rscategory[0]; ?>">
						<div class=" con-w3l">
						
<?php
$sql= "SELECT item.*,restaurant.restaurantname FROM item LEFT JOIN restaurant ON item.restaurantid=restaurant.restaurantid WHERE item.status='Active' AND item.categoryid='$rscategory[0]' AND restaurant.locationid='$_SESSION[locationid]' order by rand() limit 0,4 ";
//echo $sql;
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
//echo mysqli_num_rows($qsql);
while($rs = mysqli_fetch_array($qsql))
{
	if($rs["itemimage"] == "")
	{
		$imgname = "images/noimage.png";
	}
	else if(file_exists("itemimage/".$rs[itemimage]))
	{
		$imgname= "itemimage/".$rs[itemimage];
	}
	else
	{
		$imgname = "images/noimage.png";
	}
?>
						
	<div class="col-md-3 m-wthree">
		<div class="col-m">								
			<a href="#" data-toggle="modal" data-target="#myModal1" class="offer-img">
				<img src="<?php echo $imgname; ?>" class="img-responsive" style="width:100%;height: 223px;">
				<div class="offer"><p><span>Offer</span></p></div>
			</a>
			<div class="mid-1">
				<div class="women">
					<h6><a href="#"><?php echo $rs[itemname]; ?></a></h6>							
				</div>
				<div class="mid-2">
					<p ><em class="item_price">₹<?php echo $rs[itemcost]; ?></em></p>
					  <div class="block">
						<?php 
			 if($rs[itemtype] == "Vegetarian")
			 {
				 echo "<i class='fa fa-dot-circle-o' aria-hidden='true' style='color:#04c30a;font-size:20px;' ></i>";
			 }
			 if($rs[itemtype] == "Non-vegetarian")
			 {
				 echo "<i class='fa fa-dot-circle-o' aria-hidden='true' style='color:red;font-size:20px;' ></i>";
			 }
			 ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="add">
				   <button class="btn btn-danger my-cart-btn my-cart-b" data-id="<?php echo $rs[0]; ?>" data-name="<?php echo $rs[itemname]; ?>" data-summary="<?php echo $rs[itemdescription]; ?>" data-price="<?php echo $rs[itemcost]; ?>" data-quantity="1" data-image="<?php echo $imgname;  ?>">Click to order</button>
				</div>				
			</div>
		</div>
	</div>
<?php
}
?>												
							<div class="clearfix"></div>
						 </div>
					</div>
<?php
}
?>
				</div>
			</div>
	</div>
	</div>
	</div>

  <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
      </ol>
      
     

<!--content-->
	<div class="product">
		<div class="container">
			<div class="spec ">
				<h3>Restaurant..</h3>
				<div class="ser-t">
					<b></b>
					<span><i></i></span>
					<b class="line"></b>
				</div>
			</div>
				<div class=" con-w3l">
				
				
						
<?php
$sql= "SELECT * FROM restaurant LEFT JOIN location on location.locationid=restaurant.locationid WHERE restaurant.status='Active' AND restaurant.locationid='$_SESSION[locationid]' order by rand() limit 0,8 ";
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
while($rs = mysqli_fetch_array($qsql))
{
	if($rs["restaurantimage"] == "")
	{
		$imgname = "images/noimage.png";
	}
	else if(file_exists("imgrestaurant/".$rs[restaurantimage]))
	{
		$imgname= "imgrestaurant/".$rs[restaurantimage];
	}
	else
	{
		$imgname = "images/noimage.png";
	}
	
?>			
		<div class="col-md-3 pro-1">
			<div class="col-m">
			<a href="restaurantdetail.php?restaurantid=<?php $rs[0]; ?>"  class="offer-img">
					<img src="<?php echo $imgname; ?>" class="img-responsive" alt="" style="width: 100%; height: 170px;">
				</a>
				<div class="mid-1">
					<div class="women">
						<h6><a href="restaurantdetail.php?restaurantid=<?php $rs[0]; ?>"><?php echo $rs['restaurantname']; ?></a> <br>(<?php
if($rs['restauranttype'] == "Both")											
{
echo "Veg & Non-veg";
}
else
{
echo $rs['restauranttype'];
}
						?>)</h6>							
					</div>
					<div class="mid-2">
						<p ><em class="item_price" style="color: red;">Location : <?php echo $rs['locationname']; ?></em></p>
						<div class="clearfix"></div>
					</div>
						<div class="add add-2">
					   <button class="btn btn-danger" onclick="window.location='restaurantdetail.php?restaurantid=<?php echo $rs[0]; ?>';" >VIEW</button>
					</div>
				</div>
			</div>
		</div>
<?php
}
?>							
							
							<div class="clearfix"></div>
						 </div>
		</div>
	</div>
<?php
include("footer.php");
?>