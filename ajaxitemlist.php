<?php
session_start();
include("connection.php");
$sql= "SELECT item.*,restaurant.restaurantname FROM item LEFT JOIN restaurant ON item.restaurantid=restaurant.restaurantid WHERE item.restaurantid='$_REQUEST[restaurantid]' AND item.status='Active' ";
if($_REQUEST[foodtype] !="")
{
	$sql = $sql . " AND foodtype like '%$_REQUEST[foodtype]%'";
}
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
						
	<div class="col-md-4 pro-1" >
	<div style="border: 1px solid grey;border-radius: 5px;cursor:pointer;padding:10px;" >
		<div class="col-m">
			<a href="#" data-toggle="modal" data-target="#myModal<?php echo $rs[0]; ?>" class="offer-img">
				<?php echo "<img src= '$imgname' style='width:100%;height:250px ;' >";  ?>
				<div class="offer"><p><span style="font-size:15px;">Cost ₹<?php echo $rs[itemcost]; ?></span></p></div>
			</a>
			<b><?php 
			 if($rs[itemtype] == "Vegetarian")
			 {
				 echo "<i class='fa fa-dot-circle-o' aria-hidden='true' style='color:#04c30a;font-size:20px;' ></i>";
			 }
			 if($rs[itemtype] == "Non-vegetarian")
			 {
				 echo "<i class='fa fa-dot-circle-o' aria-hidden='true' style='color:red;font-size:20px;' ></i>";
			 }
			 ?> <?php echo $rs[itemname]; ?></p>
					<div class="add">
				   <button class="btn btn-danger my-cart-btn my-cart-b" data-id="<?php echo $rs[0]; ?>" data-name="<?php echo $rs[itemname]; ?>" data-summary="<?php echo $rs[itemdescription]; ?>" data-price="<?php echo $rs[itemcost]; ?>" data-quantity="1" data-image="<?php echo $imgname;  ?>">Click to order</button>
				</div>
			</div>
		</div>
	</div>
													
	<div class="modal fade" id="myModal<?php echo $rs[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-info">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<div class="modal-body modal-spa">
					<div class="col-md-5 span-2">
						<div class="item">
							<?php echo "<img src= '$imgname' style='width:100%;height:250px ;' >";  ?>
						</div>
					</div>
					<div class="col-md-7 span-1 ">
						<h3><?php echo $rs[itemname]; ?> <?php 
										 if($rs[itemtype] == "Vegetarian")
										 {
											 echo "<i class='fa fa-dot-circle-o' aria-hidden='true' style='color:#04c30a;font-size:20px;' ></i>";
										 }
										 if($rs[itemtype] == "Non-vegetarian")
										 {
											 echo "<i class='fa fa-dot-circle-o' aria-hidden='true' style='color:red;font-size:20px;' ></i>";
										 }
							?></h3>
						<p class="in-para"> <?php echo $rs[itemdescription]; ?></p>
						<div class="price_single">
							<span class="reducedfrom ">₹<?php echo $rs[itemcost]; ?></span>

							<div class="clearfix"></div>
						</div>
							<h4 class="quick">Food type:</h4>
							<p class="quick_desc">
				<?php
				$foodtype = unserialize($rs[foodtype]);
				foreach($foodtype as $val)
				{
					$ftype = $ftype  . $val . ",";
				}
				echo $ftype;
				?>
								</p>
						
						<div class="add-to">
							<button class="btn btn-danger my-cart-btn my-cart-btn1 " data-id="<?php echo $rs[0]; ?>" data-name="<?php echo $rs[itemname]; ?>" data-summary="<?php echo $rs[itemdescription]; ?>" data-price="<?php echo $rs[itemcost]; ?>" data-quantity="1" data-image="<?php echo $imgname;  ?>">Add to Cart</button>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
		
	<?php
	}
	?>		
	